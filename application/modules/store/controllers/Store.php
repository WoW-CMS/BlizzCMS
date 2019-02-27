<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * BlizzCMS
 *
 * An Open Source CMS for "World of Warcraft"
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2017 - 2019, ProjectCMS
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
 * @author  ProjectCMS
 * @copyright  Copyright (c) 2017 - 2019, ProjectCMS.
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://projectcms.net
 * @since   Version 1.0.1
 * @filesource
 */

class Store extends MX_Controller {

    public function __construct()
    {
        parent::__construct();

        if (!ini_get('date.timezone'))
           date_default_timezone_set($this->config->item('timezone'));

        if (!$this->m_permissions->getMaintenance())
            redirect(base_url(),'refresh');

        if (!$this->m_modules->getStoreStatus())
            redirect(base_url(),'refresh');

        if (!$this->m_data->isLogged())
            redirect(base_url('login'),'refresh');

        $this->load->model('store_model');
    }

    public function index($id = '')
    {
        $data = array(
            'idlink' => $id,
            'pagetitle' => $this->lang->line('nav_store'),
        );

        $this->load->config('store');

        $this->load->view('header', $data);

        if($this->config->item('shopStyle') == 1)
            $this->load->view('index1', $data);
        else
            $this->load->view('index2', $data);

        $this->load->view('footer');
    }

    public function cart($id)
    {
        if (!$this->m_data->isLogged())
            redirect(base_url('login'),'refresh');

        if ($this->store_model->getExistItem($id) < 1)
            redirect(base_url('store'),'refresh');

        $data = array(
            'idlink' => $id,
            'pagetitle' => $this->lang->line('nav_cart'),
        );

        $this->load->view('header', $data);

        if (isset($_GET['tp']))
        {
            $mode = $_GET['tp'];

            if ($mode != 'vp' && $mode != 'dp')
                redirect(base_url('store'),'refresh');

            if ($mode == "vp")
                $this->store_model->getVPTrue($id);
            if ($mode == "dp")
                $this->store_model->getDPTrue($id);

            $data['idlink'] = $id;
            $this->load->view('cart', $data);
        }
        else
            redirect(base_url('store'),'refresh');

        $this->load->view('footer');
    }
}
