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

class News extends MX_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('news_model');

        if(!ini_get('date.timezone'))
           date_default_timezone_set($this->config->item('timezone'));

        if(!$this->wowgeneral->getMaintenance())
            redirect(base_url('maintenance'),'refresh');

        if (!$this->wowmodule->getStatusModule('News'))
            redirect(base_url(),'refresh');
    }

    public function article($id)
    {
        $this->load->model('forum/forum_model');

        if($this->wowauth->getRank($this->session->userdata('wow_sess_id')) >= config_item('admin_access_level'))
            $tiny = $this->wowgeneral->tinyEditor('Admin');
        else
            $tiny = $this->wowgeneral->tinyEditor('User');

        $data = array(
            'idlink' => $id,
            'pagetitle' => $this->lang->line('tab_news'),
            'lang' => $this->lang->lang(),
            'tiny' => $tiny
        );

        $this->template->build('article', $data);
    }

    public function reply()
    {
        if (!$this->wowauth->isLogged())
            redirect(base_url(),'refresh');

        $ssesid = $this->session->userdata('wow_sess_id');
        $newsid = $this->input->post('news');
        $reply = $_POST['reply'];
        echo $this->news_model->insertComment($reply, $newsid, $ssesid);
    }

    public function deletereply()
    {
        if (!$this->wowauth->isLogged())
            redirect(base_url(),'refresh');

        $id = $this->input->post('value');
        echo $this->news_model->removeComment($id);
    }
}
