<?php
/**
 * BlizzCMS
 *
 * @author  WoW-CMS
 * @copyright  Copyright (c) 2017 - 2021, WoW-CMS.
 * @copyright  Copyright (c) 2008 - 2014, EllisLab, Inc. (https://ellislab.com/)
 * @copyright  Copyright (c) 2014 - 2019, British Columbia Institute of Technology (https://bcit.ca/)
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://wow-cms.com
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Cart extends CI_Cart
{
    /**
     * Reference to the CodeIgniter instance
     *
     * @var object
     */
    protected $CI;

    /**
     * These are the regular expression rules that we use to validate the product ID and product name
     * alpha-numeric, dashes, underscores, or periods
     *
     * @var string
     */
    public $product_id_rules = '\.a-z0-9_-';

    /**
     * These are the regular expression rules that we use to validate the product ID and product name
     * Regex may contain only alphanumeric characters, spaces, and  ~ ! # $ % & [ ] * - _ + = | : . ' characters.
     *
     * @var string
     */
    public $product_name_rules = "A-Z0-9 ~!#$%\&\[\]\*\-_+=|:.'";

    /**
     * only allow safe product names
     *
     * @var bool
     */
    public $product_name_safe = true;

    /**
     * Contents of the cart
     *
     * @var array
     */
    protected $_cart_contents = [];

    /**
     * Shopping Class Constructor
     *
     * The constructor loads the Session class, used to store the shopping cart contents.
     *
     * @param array
     * @return void
     */
    public function __construct($params = [])
    {
        // Set the super object to a local variable for use later
        $this->CI =& get_instance();

        // Are any config settings being passed manually?  If so, set them
        $config = is_array($params) ? $params : [];

        // Load the Sessions class
        $this->CI->load->driver('session', $config);

        // Grab the shopping cart array from the session table
        $this->_cart_contents = $this->CI->session->userdata('cart_contents');
        if ($this->_cart_contents === null)
        {
            // No cart exists so we'll set some base values
            $this->_cart_contents = ['total_items' => 0, 'total_dp' => 0, 'total_vp' => 0, 'count_items' => 0, 'valid_items' => 0];
        }

        log_message('info', 'Cart Class Initialized');
    }

    /**
     * Insert
     *
     * @param array
     * @return bool
     */
    protected function _insert($items = [])
    {
        // Was any cart data passed? No? Bah...
        if (! is_array($items) OR count($items) === 0)
        {
            log_message('error', 'The insert method must be passed an array containing data.');
            return false;
        }

        // --------------------------------------------------------------------

        // Does the $items array contain an id, quantity, name, dp, vp, realm and guid?  These are required
        if (! isset($items['id'], $items['qty'], $items['name'], $items['dp'], $items['vp'], $items['realm'], $items['guid']))
        {
            log_message('error', 'The cart array must contain a product ID, quantity, name, dp, vp, realm and guid.');
            return false;
        }

        // --------------------------------------------------------------------

        // Prep the quantity. It can only be a number.  Duh... also trim any leading zeros
        $items['qty'] = (float) $items['qty'];

        // If the quantity is zero or blank there's nothing for us to do
        if ($items['qty'] == 0)
        {
            return false;
        }

        // --------------------------------------------------------------------

        // Validate the product ID. It can only be alpha-numeric, dashes, underscores or periods
        // Not totally sure we should impose this rule, but it seems prudent to standardize IDs.
        // Note: These can be user-specified by setting the $this->product_id_rules variable.
        if (! preg_match('/^['.$this->product_id_rules.']+$/i', $items['id']))
        {
            log_message('error', 'Invalid product ID.  The product ID can only contain alpha-numeric characters, dashes, and underscores');
            return false;
        }

        // --------------------------------------------------------------------

        // Validate the product name. It can only be alpha-numeric, dashes, underscores, colons or periods.
        // Note: These can be user-specified by setting the $this->product_name_rules variable.
        if ($this->product_name_safe && ! preg_match('/^['.$this->product_name_rules.']+$/i'.(UTF8_ENABLED ? 'u' : ''), $items['name']))
        {
            log_message('error', 'An invalid name was submitted as the product name: '.$items['name'].' The name can only contain alpha-numeric characters, dashes, underscores, colons, and spaces');
            return false;
        }

        // --------------------------------------------------------------------

        // Prep the dp and vp. Remove leading zeros and anything that isn't a number or decimal point.
        $items['dp'] = (float) $items['dp'];
        $items['vp'] = (float) $items['vp'];
        // Prep realm and guid
        $items['realm'] = (int) $items['realm'];
        $items['guid'] = (int) $items['guid'];

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

    /**
     * Update the cart
     *
     * This function permits changing item properties.
     * Typically it is called from the "view cart" page if a user makes
     * changes to the quantity before checkout. That array must contain the
     * rowid and quantity for each item.
     *
     * @param array
     * @return bool
     */
    protected function _update($items = [])
    {
        // Without these array indexes there is nothing we can do
        if (! isset($items['rowid'], $this->_cart_contents[$items['rowid']]))
        {
            return false;
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
                return true;
            }
        }

        // find updatable keys
        $keys = array_intersect(array_keys($this->_cart_contents[$items['rowid']]), array_keys($items));
        // if a dp was passed, make sure it contains valid data
        if (isset($items['dp']))
        {
            $items['dp'] = (float) $items['dp'];
        }

        if (isset($items['vp']))
        {
            $items['vp'] = (float) $items['vp'];
        }

        if (isset($items['realm']))
        {
            $items['realm'] = (int) $items['realm'];
        }

        if (isset($items['guid']))
        {
            $items['guid'] = (int) $items['guid'];
        }

        // product id & name shouldn't be changed
        foreach (array_diff($keys, ['id', 'name']) as $key)
        {
            $this->_cart_contents[$items['rowid']][$key] = $items[$key];
        }

        return true;
    }

    /**
     * Save the cart array to the session DB
     *
     * @return bool
     */
    protected function _save_cart()
    {
        // Let's add up the individual prices and set the cart sub-total
        $this->_cart_contents['total_items'] = $this->_cart_contents['total_dp'] = $this->_cart_contents['total_vp'] = $this->_cart_contents['count_items'] = $this->_cart_contents['valid_items'] = 0;
        foreach ($this->_cart_contents as $key => $val)
        {
            // We make sure the array contains the proper indexes
            if (! is_array($val) OR ! isset($val['dp'], $val['qty']) OR ! isset($val['vp'], $val['qty']) OR ! isset($val['guid']) OR ! isset($val['realm']))
            {
                continue;
            }

            $this->_cart_contents['total_dp'] += ($val['dp'] * $val['qty']);
            $this->_cart_contents['total_vp'] += ($val['vp'] * $val['qty']);
            $this->_cart_contents['total_items'] += $val['qty'];
            $this->_cart_contents['count_items'] += ($val['id'] != 0);
            $this->_cart_contents['valid_items'] += ($val['guid'] != 0);
        }

        // Is our cart empty? If so we delete it from the session
        if (count($this->_cart_contents) <= 2)
        {
            $this->CI->session->unset_userdata('cart_contents');

            // Nothing more to do... coffee time!
            return false;
        }

        // If we made it this far it means that our cart has data.
        // Let's pass it to the Session class so it can be stored
        $this->CI->session->set_userdata(['cart_contents' => $this->_cart_contents]);

        // Woot!
        return true;
    }

    /**
     * Total DP
     *
     * @return int
     */
    public function total_dp()
    {
        return $this->_cart_contents['total_dp'];
    }

    /**
     * Total VP
     *
     * @return int
     */
    public function total_vp()
    {
        return $this->_cart_contents['total_vp'];
    }

    /**
     * Count Items on cart
     *
     * @return int
     */
    public function count_items()
    {
        return $this->_cart_contents['count_items'];
    }

    /**
     * Valid guid on items
     *
     * @return int
     */
    public function valid_items()
    {
        return $this->_cart_contents['valid_items'];
    }

    /**
     * Cart Contents
     *
     * Returns the entire cart array
     *
     * @param bool
     * @return array
     */
    public function contents($newest_first = false)
    {
        // do we want the newest first?
        $cart = ($newest_first) ? array_reverse($this->_cart_contents) : $this->_cart_contents;

        // Remove these so they don't create a problem when showing the cart table
        unset($cart['total_items']);
        unset($cart['total_dp']);
        unset($cart['total_vp']);
        unset($cart['count_items']);
        unset($cart['valid_items']);

        return $cart;
    }

    /**
     * Get cart item
     *
     * Returns the details of a specific item in the cart
     *
     * @param string $row_id
     * @return array
     */
    public function get_item($row_id)
    {
        return (in_array($row_id, ['total_items', 'total_dp', 'total_vp', 'count_items','valid_items'], true) OR ! isset($this->_cart_contents[$row_id]))
            ? false
            : $this->_cart_contents[$row_id];
    }

    /**
     * Destroy the cart
     *
     * Empties the cart and kills the session
     *
     * @return void
     */
    public function destroy()
    {
        $this->_cart_contents = ['total_items' => 0, 'total_dp' => 0, 'total_vp' => 0, 'count_items' => 0, 'valid_items' => 0];
        $this->CI->session->unset_userdata('cart_contents');
    }
}
