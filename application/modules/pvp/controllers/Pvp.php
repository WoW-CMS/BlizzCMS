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

class Pvp extends MX_Controller {

    public function __construct()
    {
        parent::__construct();

        if(!ini_get('date.timezone'))
           date_default_timezone_set($this->config->item('timezone'));

        if(!$this->m_permissions->getMaintenance())
            redirect(base_url(),'refresh');

        if (!$this->m_modules->getPVPStatus())
            redirect(base_url(),'refresh');

        $this->load->model('pvp_model');
    }

    public function index()
    {
        $data = array(
            'pagetitle' => $this->lang->line('nav_pvp_statistics'),
            'nav_arena_statistics' => $this->lang->line('nav_arena_statistics'),
            'lang_2v2' => $this->lang->line('arena_top_2v2'),
            'lang_3v3' => $this->lang->line('arena_top_3v3'),
            'lang_5v5' => $this->lang->line('arena_top_5v5'),
            'column_team_name' => $this->lang->line('column_team_name'),
            'column_members' => $this->lang->line('column_members'),
            'column_rating' => $this->lang->line('column_rating'),
            //general
            'realms' => $this->m_data->getRealms()->result(),
        );

        $this->load->view('header', $data);
        $this->load->view('index', $data);
        $this->load->view('footer');
    }
}
