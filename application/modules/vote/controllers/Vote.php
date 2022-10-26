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

class Vote extends MX_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('vote_model');

        if (!ini_get('date.timezone'))
           date_default_timezone_set($this->config->item('timezone'));

        if (!$this->wowgeneral->getMaintenance())
            redirect(base_url('maintenance'),'refresh');

        if (!$this->wowmodule->getStatusModule('Vote'))
            redirect(base_url(),'refresh');

        if (!$this->wowauth->isLogged())
            redirect(base_url('login'),'refresh');
    }

    public function index()
    {
        $data = array(
            'pagetitle' => $this->lang->line('tab_vote'),
            'voteList' => $this->vote_model->getVotes(),
        );

        $this->template->build('index', $data);
    }

    public function voteNow($id)
    {
        echo $this->vote_model->voteNow($id);
    }

    public function voteNowCount()
    {
        $id = $this->input->post('value', TRUE);
        $seconds = $this->vote_model->getVoteTime($id);
        echo $this->vote_model->getCountDownHTML($id, $seconds);
    }

    public function voteCallURL()
    {
        $id = $this->input->post('value', TRUE);
        echo $this->vote_model->getVoteUrl($id);
    }
}
