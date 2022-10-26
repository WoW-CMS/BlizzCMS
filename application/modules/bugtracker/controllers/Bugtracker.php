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

class Bugtracker extends MX_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('bugtracker_model');
        $this->load->config('bugtracker');
        $this->load->library('pagination');

        if(!ini_get('date.timezone'))
           date_default_timezone_set($this->config->item('timezone'));

        if(!$this->wowgeneral->getMaintenance())
            redirect(base_url('maintenance'),'refresh');

        if (!$this->wowmodule->getStatusModule('Bugtracker'))
            redirect(base_url(),'refresh');

        if(!$this->wowauth->isLogged())
            redirect(base_url('login'),'refresh');
    }

    public function index()
    {
        $data = array(
            'pagetitle' => $this->lang->line('tab_bugtracker'),
        );

        $config['total_rows'] = $this->bugtracker_model->getAllBugs();
        $data['total_count'] = $config['total_rows'];
        $config['suffix'] = '';

        if ($config['total_rows'] > 0)
        {
            $page_number = $this->uri->segment(3);
            $config['base_url'] = base_url().'bugtracker/';

            if (empty($page_number))
                $page_number = 1;

            $offset = ($page_number - 1) * $this->pagination->per_page;
            $this->bugtracker_model->setPageNumber($this->pagination->per_page);
            $this->bugtracker_model->setOffset($offset);
            $this->pagination->initialize($config);

            $data['pagination_links'] = $this->pagination->create_links();
            $data['bugtrackerList'] = $this->bugtracker_model->bugtrackerList();
        }

        $this->template->build('index', $data);
    }

    public function newreport()
    {
        if($this->wowauth->getRank($this->session->userdata('wow_sess_id')) >= config_item('admin_access_level'))
            $tiny = $this->wowgeneral->tinyEditor('Admin');
        else
            $tiny = $this->wowgeneral->tinyEditor('User');

        $data = array(
            'pagetitle' => $this->lang->line('tab_bugtracker'),
            'lang' => $this->lang->lang(),
            'tiny' => $tiny,
        );

        $this->template->build('new_report', $data);
    }

    public function report($id)
    {
        if (empty($id) || is_null($id) || $id == '0')
            redirect(base_url(),'refresh');

        if (!$this->wowmodule->getStatusModule('Bugtracker'))
            redirect(base_url(),'refresh');

		if ($this->bugtracker_model->ReportExist($id) == 0)
			redirect(base_url('404'), 'refresh');
        
        if($this->wowauth->getRank($this->session->userdata('wow_sess_id')) >= config_item('admin_access_level'))
            $tiny = $this->wowgeneral->tinyEditor('Admin');
        else
            $tiny = $this->wowgeneral->tinyEditor('User');

        $data = array(
            'idlink' => $id,
            'pagetitle' => $this->lang->line('tab_bugtracker'),
            'tiny' => $tiny,
        );

        $this->template->build('report', $data);
    }

    public function create()
    {
        $title = $this->input->post('title');
        $description = $_POST['description'];
        $type = $this->input->post('type');
        $priority = $this->input->post('priority');
        echo $this->bugtracker_model->insertIssue($title, $description, $type, $priority);
    }
}
