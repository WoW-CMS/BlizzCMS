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

class Forum extends MX_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('forum_model');
        $this->load->model('logs_model', 'logs'); // Logs System

        if(!ini_get('date.timezone'))
           date_default_timezone_set($this->config->item('timezone'));

        if(!$this->wowgeneral->getMaintenance())
            redirect(base_url('maintenance'),'refresh');

        if (!$this->wowmodule->getForumStatus())
            redirect(base_url(),'refresh');
    }

    public function index()
    {
        $data = array(
            'pagetitle' => $this->lang->line('tab_forum'),
        );

        $this->template->build('index', $data);
    }

    public function category($id)
    {
        if (empty($id) || is_null($id))
            redirect(base_url('forum'),'refresh');

        if($this->wowauth->getIsAdmin($this->session->userdata('wow_sess_gmlevel')))
            $tiny = $this->wowgeneral->tinyEditor('Admin');
        else
            $tiny = $this->wowgeneral->tinyEditor('User');

        $data = array(
            'idlink' => $id,
            'pagetitle' => $this->lang->line('tab_forum'),
            'tiny' => $tiny
        );

        if ($this->forum_model->getType($id) == 2 && $this->wowauth->isLogged())
            if ($this->wowauth->getRank($this->session->userdata('wow_sess_id')) > 0) { }
        else
            redirect(base_url('forum'),'refresh');

        $this->template->build('category', $data);
    }

    public function topic($id)
    {
        if (empty($id) || is_null($id))
            redirect(base_url('forum'),'refresh');

        if ($this->forum_model->getType($this->forum_model->getTopicForum($id)) == 2 && $this->wowauth->isLogged())
            if ($this->wowauth->getRank($this->session->userdata('wow_sess_id')) > 0) { }
        else
            redirect(base_url('forum'),'refresh');

        if($this->wowauth->getIsAdmin($this->session->userdata('wow_sess_gmlevel')))
            $tiny = $this->wowgeneral->tinyEditor('Admin');
        else
            $tiny = $this->wowgeneral->tinyEditor('User');

        $data = array(
            'idlink' => $id,
            'pagetitle' => $this->lang->line('tab_forum'),
            'lang' => $this->lang->lang(),
            'tiny' => $tiny
        );

        $this->template->build('topic', $data);
    }

    public function newtopic($idlink)
    {
        if($this->wowauth->getIsAdmin($this->session->userdata('wow_sess_gmlevel')))
            $tiny = $this->wowgeneral->tinyEditor('Admin');
        else
            $tiny = $this->wowgeneral->tinyEditor('User');

        $data = array(
            'idlink' => $idlink,
            'pagetitle' => $this->lang->line('tab_forum'),
            'lang' => $this->lang->lang(),
            'tiny' => $tiny,
        );

        $this->template->build('new_topic', $data);
    }

    public function reply()
    {
        if (!$this->wowauth->isLogged())
            redirect(base_url(),'refresh');

        $ssesid = $this->session->userdata('wow_sess_id');
        $topicid = $this->input->post('topic');
        $reply = $_POST['reply'];
        echo $this->forum_model->insertComment($reply, $topicid, $ssesid);
    }

    public function deletereply()
    {
        if (!$this->wowauth->isLogged())
            redirect(base_url(),'refresh');

        $id = $this->input->post('value');
        echo $this->forum_model->removeComment($id);
    }

    public function addtopic()
    {
        if (!$this->wowauth->isLogged())
            redirect(base_url(),'refresh');

        $category = $this->input->post('category');
        $title = $this->input->post('title');
        $ssesid = $this->session->userdata('wow_sess_id');
        $description = $_POST['description'];
        echo $this->forum_model->insertTopic($category, $title, $ssesid, $description, '0', '0');
    }
}
