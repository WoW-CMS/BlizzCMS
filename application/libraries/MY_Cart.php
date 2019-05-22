<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * BlizzCMS
 *
 * An Open Source CMS for "World of Warcraft"
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2017 - 2019, WoW-CMS
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @author  WoW-CMS
 * @copyright  Copyright (c) 2017 - 2019, WoW-CMS.
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://wow-cms.com
 * @since   Version 1.0.1
 * @filesource
 */

class MY_Cart extends CI_Cart {

	public function __construct($params = array())
	{
		// Set the super object to a local variable for use later
		$this->CI =& get_instance();

		// Are any config settings being passed manually?  If so, set them
		$config = is_array($params) ? $params : array();

		// Load the Sessions class
		$this->CI->load->driver('session', $config);

		// Grab the shopping cart array from the session table
		$this->_cart_contents = $this->CI->session->userdata('cart_contents');
		if ($this->_cart_contents === NULL)
		{
			// No cart exists so we'll set some base values
			$this->_cart_contents = array('cart_total' => 0, 'total_items' => 0, 'total_dp' => 0, 'total_vp' => 0, 'count_items' => 0, 'valid_items' => 0);
		}

		log_message('info', 'Cart Class Initialized');
	}

	// --------------------------------------------------------------------

	/**
	 * Insert
	 *
	 * @param	array
	 * @return	bool
	 */
	protected function _insert($items = array())
	{
		// Was any cart data passed? No? Bah...
		if ( ! is_array($items) OR count($items) === 0)
		{
			log_message('error', 'The insert method must be passed an array containing data.');
			return FALSE;
		}

		// --------------------------------------------------------------------

		// Does the $items array contain an id, quantity, price, name, dp and vp?  These are required
		if ( ! isset($items['id'], $items['qty'], $items['price'], $items['name'], $items['category'], $items['dp'], $items['vp'], $items['guid']))
		{
			log_message('error', 'The cart array must contain a product ID, quantity, price, name, category, dp, vp and guid.');
			return FALSE;
		}

		// --------------------------------------------------------------------

		// Prep the quantity. It can only be a number.  Duh... also trim any leading zeros
		$items['qty'] = (float) $items['qty'];

		// If the quantity is zero or blank there's nothing for us to do
		if ($items['qty'] == 0)
		{
			return FALSE;
		}

		// --------------------------------------------------------------------

		// Validate the product ID. It can only be alpha-numeric, dashes, underscores or periods
		// Not totally sure we should impose this rule, but it seems prudent to standardize IDs.
		// Note: These can be user-specified by setting the $this->product_id_rules variable.
		if ( ! preg_match('/^['.$this->product_id_rules.']+$/i', $items['id']))
		{
			log_message('error', 'Invalid product ID.  The product ID can only contain alpha-numeric characters, dashes, and underscores');
			return FALSE;
		}

		// --------------------------------------------------------------------

		// Validate the product name. It can only be alpha-numeric, dashes, underscores, colons or periods.
		// Note: These can be user-specified by setting the $this->product_name_rules variable.
		if ($this->product_name_safe && ! preg_match('/^['.$this->product_name_rules.']+$/i'.(UTF8_ENABLED ? 'u' : ''), $items['name']))
		{
			log_message('error', 'An invalid name was submitted as the product name: '.$items['name'].' The name can only contain alpha-numeric characters, dashes, underscores, colons, and spaces');
			return FALSE;
		}

		// --------------------------------------------------------------------

		// Prep the price, dp and vp. Remove leading zeros and anything that isn't a number or decimal point.
		$items['price'] = (float) $items['price'];
		$items['category'] = (float) $items['category'];
		$items['dp'] = (float) $items['dp'];
		$items['vp'] = (float) $items['vp'];
		$items['guid'] = (float) $items['guid'];

		// We now need to create a unique identifier for the item being inserted into the cart.
		// Every time something is added to the cart it is stored in the master cart array.
		// Each row in the cart array, however, must have a unique index that identifies not only
		// a particular product, but makes it possible to store identical products with different options.
		// For example, what if someone buys two identical t-shirts (same product ID), but in
		// different sizes?  The product ID (and other attributes, like the name) will be identical for
		// both sizes because it's the same shirt. The only difference will be the size.
		// Internally, we need to treat identical submissions, but with different options, as a unique product.
		// Our solution is to convert the options array to a string and MD5 it along with the product ID.
		// This becomes the unique "row ID"
		if (isset($items['options']) && count($items['options']) > 0)
		{
			$rowid = md5($items['id'].serialize($items['options']));
		}
		else
		{
			// No options were submitted so we simply MD5 the product ID.
			// Technically, we don't need to MD5 the ID in this case, but it makes
			// sense to standardize the format of array indexes for both conditions
			$rowid = md5($items['id']);
		}

		// --------------------------------------------------------------------

		// Now that we have our unique "row ID", we'll add our cart items to the master array
		// grab quantity if it's already there and add it on
		$old_quantity = isset($this->_cart_contents[$rowid]['qty']) ? (int) $this->_cart_contents[$rowid]['qty'] : 0;

		// Re-create the entry, just to make sure our index contains only the data from this submission
		$items['rowid'] = $rowid;
		$items['qty'] += $old_quantity;
		$this->_cart_contents[$rowid] = $items;

		return $rowid;
	}

	// --------------------------------------------------------------------

	/**
	 * Update the cart
	 *
	 * This function permits changing item properties.
	 * Typically it is called from the "view cart" page if a user makes
	 * changes to the quantity before checkout. That array must contain the
	 * rowid and quantity for each item.
	 *
	 * @param	array
	 * @return	bool
	 */
	protected function _update($items = array())
	{
		// Without these array indexes there is nothing we can do
		if ( ! isset($items['rowid'], $this->_cart_contents[$items['rowid']]))
		{
			return FALSE;
		}

		// Prep the quantity
		if (isset($items['qty']))
		{
			$items['qty'] = (float) $items['qty'];
			// Is the quantity zero?  If so we will remove the item from the cart.
			// If the quantity is greater than zero we are updating
			if ($items['qty'] == 0)
			{
				unset($this->_cart_contents[$items['rowid']]);
				return TRUE;
			}
		}

		// find updatable keys
		$keys = array_intersect(array_keys($this->_cart_contents[$items['rowid']]), array_keys($items));
		// if a price was passed, make sure it contains valid data
		if (isset($items['price']))
		{
			$items['price'] = (float) $items['price'];
		}

		if (isset($items['category']))
		{
			$items['category'] = (float) $items['category'];
		}

		if (isset($items['dp']))
		{
			$items['dp'] = (float) $items['dp'];
		}

		if (isset($items['vp']))
		{
			$items['vp'] = (float) $items['vp'];
		}

		if (isset($items['guid']))
		{
			$items['guid'] = (float) $items['guid'];
		}

		// product id & name shouldn't be changed
		foreach (array_diff($keys, array('id', 'name')) as $key)
		{
			$this->_cart_contents[$items['rowid']][$key] = $items[$key];
		}

		return TRUE;
	}

	// --------------------------------------------------------------------

	/**
	 * Save the cart array to the session DB
	 *
	 * @return	bool
	 */
	protected function _save_cart()
	{
		// Let's add up the individual prices and set the cart sub-total
		$this->_cart_contents['total_items'] = $this->_cart_contents['cart_total'] = $this->_cart_contents['total_dp'] = $this->_cart_contents['total_vp'] = $this->_cart_contents['count_items'] = $this->_cart_contents['valid_items'] = 0;
		foreach ($this->_cart_contents as $key => $val)
		{
			// We make sure the array contains the proper indexes
			if ( ! is_array($val) OR ! isset($val['price'], $val['qty']) OR ! isset($val['dp'], $val['qty']) OR ! isset($val['vp'], $val['qty']) OR ! isset($val['guid']) OR ! isset($val['category']))
			{
				continue;
			}

			$this->_cart_contents['cart_total'] += ($val['price'] * $val['qty']);
			$this->_cart_contents['total_dp'] += ($val['dp'] * $val['qty']);
			$this->_cart_contents['total_vp'] += ($val['vp'] * $val['qty']);
			$this->_cart_contents['total_items'] += $val['qty'];
			$this->_cart_contents['count_items'] += ($val['id'] != 0);
			$this->_cart_contents['valid_items'] += ($val['guid'] != 0);
			$this->_cart_contents[$key]['subtotal'] = ($this->_cart_contents[$key]['price'] * $this->_cart_contents[$key]['qty']);
		}

		// Is our cart empty? If so we delete it from the session
		if (count($this->_cart_contents) <= 2)
		{
			$this->CI->session->unset_userdata('cart_contents');

			// Nothing more to do... coffee time!
			return FALSE;
		}

		// If we made it this far it means that our cart has data.
		// Let's pass it to the Session class so it can be stored
		$this->CI->session->set_userdata(array('cart_contents' => $this->_cart_contents));

		// Woot!
		return TRUE;
	}

	// --------------------------------------------------------------------

	/**
	 * Total DP
	 *
	 * @return	int
	 */
	public function total_dp()
	{
		return $this->_cart_contents['total_dp'];
	}

	// --------------------------------------------------------------------

	/**
	 * Total VP
	 *
	 * @return	int
	 */
	public function total_vp()
	{
		return $this->_cart_contents['total_vp'];
	}

	// --------------------------------------------------------------------

	/**
	 * Count Items on cart
	 *
	 * @return	int
	 */
	public function count_items()
	{
		return $this->_cart_contents['count_items'];
	}

	// --------------------------------------------------------------------

	/**
	 * Valid guid on items
	 *
	 * @return	int
	 */
	public function valid_items()
	{
		return $this->_cart_contents['valid_items'];
	}

	// --------------------------------------------------------------------

	/**
	 * Cart Contents
	 *
	 * Returns the entire cart array
	 *
	 * @param	bool
	 * @return	array
	 */
	public function contents($newest_first = FALSE)
	{
		// do we want the newest first?
		$cart = ($newest_first) ? array_reverse($this->_cart_contents) : $this->_cart_contents;

		// Remove these so they don't create a problem when showing the cart table
		unset($cart['total_items']);
		unset($cart['cart_total']);
		unset($cart['total_dp']);
		unset($cart['total_vp']);
		unset($cart['count_items']);
		unset($cart['valid_items']);

		return $cart;
	}

	// --------------------------------------------------------------------

	/**
	 * Get cart item
	 *
	 * Returns the details of a specific item in the cart
	 *
	 * @param	string	$row_id
	 * @return	array
	 */
	public function get_item($row_id)
	{
		return (in_array($row_id, array('total_items', 'cart_total', 'total_dp', 'total_vp', 'count_items','valid_items'), TRUE) OR ! isset($this->_cart_contents[$row_id]))
			? FALSE
			: $this->_cart_contents[$row_id];
	}

	// --------------------------------------------------------------------

	/**
	 * Destroy the cart
	 *
	 * Empties the cart and kills the session
	 *
	 * @return	void
	 */
	public function destroy()
	{
		$this->_cart_contents = array('cart_total' => 0, 'total_items' => 0, 'total_dp' => 0, 'total_vp' => 0, 'count_items' => 0, 'valid_items' => 0);
		$this->CI->session->unset_userdata('cart_contents');
	}
}
