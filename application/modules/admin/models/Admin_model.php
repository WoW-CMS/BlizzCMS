<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {

    private $_limit,
            $_pageNumber,
            $_offset;
    /**
     * Admin_model constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->auth = $this->load->database('auth', TRUE);

        if (!$this->wowmodule->getStatusModule('Admin Panel'))
            redirect(base_url(),'refresh');
    }

    public function setLimit($limit)
    {
        $this->_limit = $limit;
    }

    public function setPageNumber($pageNumber)
    {
        $this->_pageNumber = $pageNumber;
    }

    public function setOffset($offset)
    {
        $this->_offset = $offset;
    }

    public function countAccounts()
    {
        $this->db->from('users');
        return $this->db->count_all_results();
    }

    public function accountsList()
    {
        return $this->db->select('*')->limit($this->_pageNumber, $this->_offset)->get('users')->result();
    }

    public function getAccountExist($id)
    {
        return $this->db->select('*')->where('id', $id)->get('users')->num_rows();
    }

    public function getAdminCharactersList($multirealm)
    {
        $this->multirealm = $multirealm;
        return $this->multirealm->select('guid, account, name')->order_by('name', 'ASC')->get('characters');
    }

    public function getUserHistoryDonate($id)
    {
        return $this->db->select('*')->where('user_id', $id)->order_by('id', 'DESC')->get('donate_logs');
    }

    public function getDonateStatus($id)
    {
        switch ($id) {
            case 0: return $this->lang->line('status_cancelled'); break;
            case 1: return $this->lang->line('status_completed'); break;
        }
    }

    public function getDonateLogs()
    {
        return $this->db->order_by('id', 'DESC')->get('donate_logs')->result();
    }

    public function getVoteLogs()
    {
        return $this->db->order_by('id', 'DESC')->get('votes_logs')->result();
    }

    public function updateAccountData($id, $dp, $vp)
    {
        $update = array(
            'dp' => $dp,
            'vp' => $vp
        );

        $this->db->where('id', $id)->update('users', $update);
        return true;
    }

    public function insertBanAccount($iduser, $reason)
    {
        $date = $this->wowgeneral->getTimestamp();
        $id = $this->session->userdata('wow_sess_id');

        if (empty($reason))
            $reason = $this->lang->line('log_banned');

        $data2 = array(
            'id' => $iduser,
            'bandate' => $date,
            'unbandate' => $date,
            'bannedby' => $id,
            'banreason' => $reason,
        );

        $this->auth->insert('account_banned', $data2);

        if ($this->wowgeneral->getExpansionAction() == 2)
            $this->auth->insert('battlenet_account_bans', $data2);

        return true;
    }

    public function delBanAccount($id)
    {
        $this->auth->where('id', $id)->delete('account_banned');

        if ($this->wowgeneral->getExpansionAction() == 2)
            $this->auth->where('id', $id)->delete('battlenet_account_bans');

        return true;
    }


    public function insertRankAccount($id, $gmlevel)
    {
        $data = array(
            'id' => $id,
            'gmlevel' => $gmlevel,
            'RealmID' => '-1'
        );

        $this->auth->insert('account_access', $data);
        return true;
    }

    public function delRankAccount($id)
    {
        $this->auth->where('id', $id)->delete('account_access');
        return true;
    }

    public function getBanCount()
    {
        return $this->auth->select('id')->get('account_banned')->num_rows();
    }

    public function getBanSpecify($id)
    {
        return $this->auth->select('*')->where('id', $id)->where('active', '1')->get('account_banned');
    }

    public function getGmCount($idrealm)
    {
        return $this->auth->select('id')->where('RealmID', $idrealm)->or_where('RealmID', '-1')->get('account_access')->num_rows();
    }

    public function getAccCreated()
    {
        return $this->auth->select('id')->get('account')->num_rows();
    }

    public function getCharOn($multirealm)
    {
        $this->multirealm = $multirealm;

        return $this->multirealm->select('*')->where('online', '1')->get('characters')->num_rows();
    }

    public function getNewsCreated()
    {
        return $this->db->select('id')->get('news')->num_rows();
    }

    public function updateGeneralSettings($project, $timezone, $maintenance, $discord, $realmlist, $theme, $facebook, $twitter, $youtube)
    {
        $this->load->library('config_writer');

        $writer = $this->config_writer->get_instance(APPPATH.'config/blizzcms.php', 'config');
        $writer->write('website_name', $project);
        $writer->write('timezone', $timezone);
        $writer->write('maintenance_mode', $maintenance);
        $writer->write('discord_invitation', $discord);
        $writer->write('realmlist', $realmlist);
        $writer->write('theme_name', $theme);
        $writer->write('social_facebook', $facebook);
        $writer->write('social_twitter', $twitter);
        $writer->write('social_youtube', $youtube);
        return true;
    }

    public function updateOptionalSettings($admin, $mod, $recaptcha, $register, $smtphost, $smtpport, $smtpcrypto, $smtpuser, $smtppass, $sender, $sendername)
    {
        $this->load->library('config_writer');

        $writer = $this->config_writer->get_instance(APPPATH.'config/blizzcms.php', 'config');
        $writer->write('recaptcha_sitekey', $recaptcha);
        $writer->write('smtp_host', $smtphost);
        $writer->write('smtp_user', $smtpuser);
        $writer->write('smtp_pass', $smtppass);
        $writer->write('smtp_port', $smtpport);
        $writer->write('smtp_crypto', $smtpcrypto);
        $writer->write('email_settings_sender', $sender);
        $writer->write('email_settings_sender_name', $sendername);
        $writer->write('account_activation_required', ($register == 'TRUE')  ? true : false);
        $writer->write('admin_access_level', $admin);
        $writer->write('mod_access_level', $mod);
        return true;
    }

    public function updateSeoSettings($metastatus, $description, $keywords, $twitterstatus, $graphstatus)
    {
        $this->load->library('config_writer');

        $writer = $this->config_writer->get_instance(APPPATH.'config/seo.php', 'config');
        $writer->write('seo_meta_enable', ($metastatus == 'TRUE')  ? true : false);
        $writer->write('seo_meta_desc', $description);
        $writer->write('seo_meta_keywords', $keywords);
        $writer->write('seo_twitter_enable', ($twitterstatus == 'TRUE')  ? true : false);
        $writer->write('seo_og_enable', ($graphstatus == 'TRUE')  ? true : false);
        return true;
    }

    public function updateDonateSettings($currency, $mode, $client, $password, $currencySymbol)
    {
        $this->load->library('config_writer');

        $writer = $this->config_writer->get_instance(APPPATH.'modules/donate/config/donate.php', 'config');
        $writer->write('paypal_currency', $currency);
        $writer->write('paypal_mode', $mode);
        $writer->write('paypal_userid', $client);
        $writer->write('paypal_secretpass', $password);
        $writer->write('paypal_currency_symbol', $currencySymbol);
        return true;
    }

    public function updateBugtrackerSettings($textarea)
    {
        $this->load->library('config_writer');

        $writer = $this->config_writer->get_instance(APPPATH.'modules/bugtracker/config/bugtracker.php', 'config');
        $writer->write('textarea', $textarea);
        return true;
    }

    public function insertMenu($name, $url, $icon, $main, $child, $type)
    {
        $data = array(
            'name' => $name,
            'url' => $url,
            'icon' => $icon,
            'main' => $main,
            'child' => $child,
            'type' => $type
        );

        $this->db->insert('menu', $data);
        return true;
    }

    public function updateSpecifyMenu($id, $name, $url, $icon, $main, $child, $type)
    {
        $update = array(
            'name' => $name,
            'url' => $url,
            'icon' => $icon,
            'main' => $main,
            'child' => $child,
            'type' => $type
        );

        $this->db->where('id', $id)->update('menu', $update);
        return true;
    }

    public function delSpecifyMenu($id)
    {
        $this->db->where('id', $id)->delete('menu');
        return true;
    }

    public function getMenu()
    {
        return $this->db->select('*')->get('menu')->result();
    }

    public function getMenuSpecifyRows($id)
    {
        return $this->db->select('*')->where('id', $id)->get('menu')->num_rows();
    }

    public function getMenuSpecifyName($id)
    {
        return $this->db->select('name')->where('id', $id)->get('menu')->row('name');
    }

    public function getMenuSpecifyUrl($id)
    {
        return $this->db->select('url')->where('id', $id)->get('menu')->row('url');
    }

    public function getMenuSpecifyIcon($id)
    {
        return $this->db->select('icon')->where('id', $id)->get('menu')->row('icon');
    }

    public function getMenuSpecifyMain($id)
    {
        return $this->db->select('main')->where('id', $id)->get('menu')->row('main');
    }

    public function getMenuSpecifyChild($id)
    {
        return $this->db->select('child')->where('id', $id)->get('menu')->row('child');
    }

    public function getMenuSpecifyType($id)
    {
        return $this->db->select('type')->where('id', $id)->get('menu')->row('type');
    }

    public function insertRealm($hostname, $username, $password, $database, $realm_id, $soaphost, $soapuser, $soappass, $soapport, $emulator)
    {
        $data = array(
            'hostname' => $hostname,
            'username' => $username,
            'password' => $password,
            'char_database' => $database,
            'realmID' => $realm_id,
            'console_hostname' => $soaphost,
            'console_username' => $soapuser,
            'console_password' => $soappass,
            'console_port' => $soapport,
            'emulator' => $emulator
        );

        $this->db->insert('realms', $data);
        return true;
    }

    public function updateSpecifyRealm($id, $hostname, $username, $password, $database, $realm_id, $soaphost, $soapuser, $soappass, $soapport, $emulator)
    {
        $update = array(
            'hostname' => $hostname,
            'username' => $username,
            'password' => $password,
            'char_database' => $database,
            'realmID' => $realm_id,
            'console_hostname' => $soaphost,
            'console_username' => $soapuser,
            'console_password' => $soappass,
            'console_port' => $soapport,
            'emulator' => $emulator
        );

        $this->db->where('id', $id)->update('realms', $update);
        return true;
    }

    public function delSpecifyRealm($id)
    {
        $this->db->where('id', $id)->delete('realms');
        return true;
    }

    public function countRealms()
    {
        $this->db->from('realms');
        return $this->db->count_all_results();
    }

    public function realmsList()
    {
        return $this->db->select('*')->limit($this->_pageNumber, $this->_offset)->get('realms')->result();
    }

    public function getRealmsSpecifyRows($id)
    {
        return $this->db->select('*')->where('id', $id)->get('realms')->num_rows();
    }

    public function getRealmSpecifyHost($id)
    {
        return $this->db->select('hostname')->where('id', $id)->get('realms')->row('hostname');
    }

    public function getRealmSpecifyUser($id)
    {
        return $this->db->select('username')->where('id', $id)->get('realms')->row('username');
    }

    public function getRealmSpecifyPass($id)
    {
        return $this->db->select('password')->where('id', $id)->get('realms')->row('password');
    }

    public function getRealmSpecifyCharDB($id)
    {
        return $this->db->select('char_database')->where('id', $id)->get('realms')->row('char_database');
    }

    public function getRealmSpecifyId($id)
    {
        return $this->db->select('realmID')->where('id', $id)->get('realms')->row('realmID');
    }

    public function getRealmSpecifyConsoleHost($id)
    {
        return $this->db->select('console_hostname')->where('id', $id)->get('realms')->row('console_hostname');
    }

    public function getRealmSpecifyConsoleUser($id)
    {
        return $this->db->select('console_username')->where('id', $id)->get('realms')->row('console_username');
    }

    public function getRealmSpecifyConsolePass($id)
    {
        return $this->db->select('console_password')->where('id', $id)->get('realms')->row('console_password');
    }

    public function getRealmSpecifyConsolePort($id)
    {
        return $this->db->select('console_port')->where('id', $id)->get('realms')->row('console_port');
    }

    public function getRealmSpecifyEmulator($id)
    {
        return $this->db->select('emulator')->where('id', $id)->get('realms')->row('emulator');
    }

    public function insertSlide($title, $description, $type, $route)
    {
        $data = array(
            'title' => $title,
            'description' => $description,
            'type' => $type,
            'route' => $route
        );

        $this->db->insert('slides', $data);
        return true;
    }

    public function updateSpecifySlide($id, $title, $description, $type, $route)
    {
        $update = array(
            'title' => $title,
            'description' => $description,
            'type' => $type,
            'route' => $route
        );

        $this->db->where('id', $id)->update('slides', $update);
        return true;
    }

    public function delSpecifySlide($id)
    {
        $this->db->where('id', $id)->delete('slides');
        return true;
    }

    public function countSlides()
    {
        $this->db->from('slides');
        return $this->db->count_all_results();
    }

    public function slidesList()
    {
        return $this->db->select('*')->limit($this->_pageNumber, $this->_offset)->get('slides')->result();
    }

    public function getSlidesSpecifyRows($id)
    {
        return $this->db->select('*')->where('id', $id)->get('slides')->num_rows();
    }

    public function getSlideSpecifyTitle($id)
    {
        return $this->db->select('title')->where('id', $id)->get('slides')->row('title');
    }

    public function getSlideSpecifyDescription($id)
    {
        return $this->db->select('description')->where('id', $id)->get('slides')->row('description');
    }

    public function getSlideSpecifyType($id)
    {
        return $this->db->select('type')->where('id', $id)->get('slides')->row('type');
    }

    public function getSlideSpecifyRoute($id)
    {
        return $this->db->select('route')->where('id', $id)->get('slides')->row('route');
    }

    public function insertNews($title, $description, $image)
    {
        $date = $this->wowgeneral->getTimestamp();

        $data = array(
            'title' => $title,
            'image' => $image,
            'description' => $description,
            'date' => $date,
        );

        $this->db->insert('news', $data);

        redirect(base_url('admin/news'),'refresh');
    }

    public function updateSpecifyNews($id, $title, $description, $image)
    {
        $unlink = $this->getFileNameImage($id);
        unlink('./assets/images/news/'.$unlink);

        $date = $this->wowgeneral->getTimestamp();

        $update = array(
            'title' => $title,
            'image' => $image,
            'description' => $description,
            'date' => $date
        );

        $this->db->where('id', $id)->update('news', $update);

        redirect(base_url('admin/news'),'refresh');
    }

    public function delSpecifyNew($id)
    {
        $this->db->where('id', $id)->delete('news');
        return true;
    }

    public function countNews()
    {
        $this->db->from('news');
        return $this->db->count_all_results();
    }

    public function newsList()
    {
        return $this->db->select('*')->limit($this->_pageNumber, $this->_offset)->get('news')->result();
    }

    public function getNewsSpecifyRows($id)
    {
        return $this->db->select('*')->where('id', $id)->get('news')->num_rows();
    }

    public function getNewIDperDate($date)
    {
        return $this->db->select('id')->where('date', $date)->get('news')->row('id');
    }

    public function getFileNameImage($id)
    {
        return $this->db->select('image')->where('id', $id)->get('news')->row('image');
    }

    public function getNewsSpecifyName($id)
    {
        return $this->db->select('title')->where('id', $id)->get('news')->row('title');
    }

    public function getNewsSpecifyDesc($id)
    {
        return $this->db->select('description')->where('id', $id)->get('news')->row('description');
    }

    public function insertChangelog($title, $description)
    {
        $date = $this->wowgeneral->getTimestamp();

        $data = array(
            'title' => $title,
            'description' => $description,
            'date' => $date,
        );

        $this->db->insert('changelogs', $data);
        return true;
    }

    public function updateSpecifyChangelog($id, $title, $description)
    {
        $date = $this->wowgeneral->getTimestamp();

        $update = array(
            'title' => $title,
            'description' => $description,
            'date' => $date
        );

        $this->db->where('id', $id)->update('changelogs', $update);
        return true;
    }

    public function delChangelog($id)
    {
        $this->db->where('id', $id)->delete('changelogs');
        return true;
    }

    public function countChangelogs()
    {
        $this->db->from('changelogs');
        return $this->db->count_all_results();
    }

    public function changelogsList()
    {
        return $this->db->select('*')->limit($this->_pageNumber, $this->_offset)->get('changelogs')->result();
    }

    public function getChangelogsCreated()
    {
        return $this->db->select('id')->get('changelogs')->num_rows();
    }

    public function getChangelogSpecifyRows($id)
    {
        return $this->db->select('*')->where('id', $id)->get('changelogs')->num_rows();
    }

    public function getChangelogSpecifyName($id)
    {
        return $this->db->select('title')->where('id', $id)->get('changelogs')->row('title');
    }

    public function getChangelogSpecifyDesc($id)
    {
        return $this->db->select('description')->where('id', $id)->get('changelogs')->row('description');
    }

    public function insertPage($title, $uri, $description)
    {
        $date = $this->wowgeneral->getTimestamp();
        $rand = rand(1, 15);

        if($this->pagecheckUri($uri) == TRUE)
        {
            $new_uri = $uri."-".$rand;

            $data = array(
                'title' => $title,
                'uri_friendly' => strtolower($new_uri),
                'description' => $description,
                'date' => $date
            );

            $this->db->insert('pages', $data);
            return true;
        }
        else
            $data1 = array(
                'title' => $title,
                'uri_friendly' => $uri,
                'description' => $description,
                'date' => $date
            );

            $this->db->insert('pages', $data1);
            return true;
    }

    public function updateSpecifyPage($id, $title, $uri, $description)
    {
        $date = $this->wowgeneral->getTimestamp();

        $update = array(
            'title' => $title,
            'uri_friendly' => strtolower($uri),
            'description' => $description,
            'date' => $date
        );

        $this->db->where('id', $id)->update('pages', $update);
        return true;
    }

    public function delPage($id)
    {
        $this->db->where('id', $id)->delete('pages');
        return true;
    }

    public function countPages()
    {
        $this->db->from('pages');
        return $this->db->count_all_results();
    }

    public function pagesList()
    {
        return $this->db->select('*')->limit($this->_pageNumber, $this->_offset)->get('pages')->result();
    }

    public function getPagesSpecifyRows($id)
    {
        return $this->db->select('*')->where('id', $id)->get('pages')->num_rows();
    }

    public function pagecheckUri($uri)
    {
        $qq = $this->db->select('uri_friendly')->where('uri_friendly', $uri)->get('pages')->row('uri_friendly');

        if($qq == $uri)
            return true;
        else
            return false;
    }

    public function getPagesSpecifyName($id)
    {
        return $this->db->select('title')->where('id', $id)->get('pages')->row('title');
    }

    public function getPagesSpecifyURI($id)
    {
        return $this->db->select('uri_friendly')->where('id', $id)->get('pages')->row('uri_friendly');
    }

    public function getPagesSpecifyDesc($id)
    {
        return $this->db->select('description')->where('id', $id)->get('pages')->row('description');
    }

    public function insertTopsite($name, $url, $time, $points, $image)
    {
        $data = array(
            'name' => $name,
            'url' => $url,
            'time' => $time,
            'points' => $points,
            'image' => $image
        );

        $this->db->insert('votes', $data);
        return true;
    }

    public function updateSpecifyTopsite($id, $name, $url, $time, $points, $image)
    {
        $update = array(
            'name' => $name,
            'url' => $url,
            'time' => $time,
            'points' => $points,
            'image' => $image
        );

        $this->db->where('id', $id)->update('votes', $update);
        return true;
    }

    public function delTopsite($id)
    {
        $this->db->where('id', $id)->delete('votes');
        return true;
    }

    public function countTopsites()
    {
        $this->db->from('votes');
        return $this->db->count_all_results();
    }

    public function topsitesList()
    {
        return $this->db->select('*')->limit($this->_pageNumber, $this->_offset)->get('votes')->result();
    }

    public function getTopsitesSpecifyRows($id)
    {
        return $this->db->select('*')->where('id', $id)->get('votes')->num_rows();
    }

    public function getTopsiteSpecifyName($id)
    {
        return $this->db->select('name')->where('id', $id)->get('votes')->row('name');
    }

    public function getTopsiteSpecifyURL($id)
    {
        return $this->db->select('url')->where('id', $id)->get('votes')->row('url');
    }

    public function getTopsiteSpecifyTime($id)
    {
        return $this->db->select('time')->where('id', $id)->get('votes')->row('time');
    }

    public function getTopsiteSpecifyPoints($id)
    {
        return $this->db->select('points')->where('id', $id)->get('votes')->row('points');
    }

    public function getTopsiteSpecifyImage($id)
    {
        return $this->db->select('image')->where('id', $id)->get('votes')->row('image');
    }

    public function getModules()
    {
        return $this->db->select('*')->get('modules')->result();
    }

    public function enableSpecifyModule($id)
    {
        $update = array(
            'status' => '1'
        );

        $this->db->where('id', $id)->update('modules', $update);
        return true;
    }

    public function disableSpecifyModule($id)
    {
        $update = array(
            'status' => '0'
        );

        $this->db->where('id', $id)->update('modules', $update);
        return true;
    }

    public function getDropDownsSpecify()
    {
        return $this->db->select('*')->where('main', '2')->where('father', '0')->get('store_categories');

    }

    public function insertStoreCategory($name, $route, $realmid, $main, $father)
    {
        if(!$this->StoreCategoryCheckRoute($route))
        {
            $data = array(
                'name' => $name,
                'route' => strtolower($route),
                'realmid' => $realmid,
                'main' => $main,
                'father' => $father
            );
    
            $this->db->insert('store_categories', $data);
            return true;
        }
        else
            return 'Rouerr';
    }

    public function updateSpecifyStoreCategory($idlink, $name, $route, $realmid)
    {
        if(!$this->StoreCategoryCheckRoute($route))
        {
            $update = array(
                'name' => $name,
                'route' => strtolower($route),
                'realmid' => $realmid
            );

            $this->db->where('id', $idlink)->update('store_categories', $update);
            return true;
        }
        else
            return 'Rouerr';
    }

    public function StoreCategoryCheckRoute($route)
    {
        $qq = $this->db->select('route')->where('route', $route)->get('store_categories')->row('route');

        if($qq == $route)
            return true;
        else
            return false;
    }

    public function deleteStoreCategory($id)
    {
        $this->db->where('id', $id)->delete('store_categories');
        return true;
    }

    public function countStoreCategories()
    {
        $this->db->from('store_categories');
        return $this->db->count_all_results();
    }

    public function storeCategoryList()
    {
        return $this->db->select('*')->limit($this->_pageNumber, $this->_offset)->get('store_categories')->result();
    }

    public function getCategoryStore()
    {
        return $this->db->select('*')->get('store_categories');
    }

    public function getStoreCategorySpecifyRows($id)
    {
        return $this->db->select('*')->where('id', $id)->get('store_categories')->num_rows();
    }

    public function getStoreCategoryName($id)
    {
        return $this->db->select('name')->where('id', $id)->get('store_categories')->row('name');
    }

    public function getStoreCategoryRoute($id)
    {
        return $this->db->select('route')->where('id', $id)->get('store_categories')->row('route');
    }

    public function getStoreCategoryRealm($id)
    {
        return $this->db->select('realmid')->where('id', $id)->get('store_categories')->row('realmid');
    }

    public function insertItem($name, $description, $category, $type, $price_type, $pricedp, $pricevp, $icon, $command)
    {
        if ($price_type == 1) {
            $setdp = $pricedp;
            $setvp = 0;
        }
        else if ($price_type == 2) {
            $setdp = 0;
            $setvp = $pricevp;
        }
        else if($price_type == 3) {
            $setdp = $pricedp;
            $setvp = $pricevp;
        }

        $data = array(
            'name' => $name,
            'description' => $description,
            'category' => $category,
            'type' => $type,
            'price_type' => $price_type,
            'dp' => $setdp,
            'vp' => $setvp,
            'icon' => $icon,
            'command' => $command
        );

        $this->db->insert('store_items', $data);
        return true;
    }

    public function updateSpecifyItem($id, $name, $description, $category, $type, $price_type, $pricedp, $pricevp, $icon, $command)
    {
        if ($price_type == 1) {
            $setdp = $pricedp;
            $setvp = 0;
        }
        else if ($price_type == 2) {
            $setdp = 0;
            $setvp = $pricevp;
        }
        else if($price_type == 3) {
            $setdp = $pricedp;
            $setvp = $pricevp;
        }

        $update = array(
            'name' => $name,
            'description' => $description,
            'category' => $category,
            'type' => $type,
            'price_type' => $price_type,
            'dp' => $setdp,
            'vp' => $setvp,
            'icon' => $icon,
            'command' => $command
        );

        $this->db->where('id', $id)->update('store_items', $update);
        return true;
    }

    public function delStoreItem($id)
    {
        $this->db->where('id', $id)->delete('store_items');
        $this->db->where('store_item', $id)->delete('store_top');
        return true;
    }

    public function countStoreItems()
    {
        $this->db->from('store_items');
        return $this->db->count_all_results();
    }

    public function storeItemList()
    {
        return $this->db->select('*')->limit($this->_pageNumber, $this->_offset)->get('store_items')->result();
    }

    public function getStoreItems()
    {
        return $this->db->select('*')->order_by('id', 'ASC')->get('store_items')->result();
    }

    public function getItemSpecifyRows($id)
    {
        return $this->db->select('*')->where('id', $id)->get('store_items')->num_rows();
    }

    public function getItemSpecifyName($id)
    {
        return $this->db->select('name')->where('id', $id)->get('store_items')->row('name');
    }

    public function getItemSpecifyDescription($id)
    {
        return $this->db->select('description')->where('id', $id)->get('store_items')->row('description');
    }

    public function getItemSpecifyCategory($id)
    {
        return $this->db->select('category')->where('id', $id)->get('store_items')->row('category');
    }

    public function getItemSpecifyType($id)
    {
        return $this->db->select('type')->where('id', $id)->get('store_items')->row('type');
    }

    public function getItemSpecifyPriceType($id)
    {
        return $this->db->select('price_type')->where('id', $id)->get('store_items')->row('price_type');
    }

    public function getItemSpecifyDpPrice($id)
    {
        return $this->db->select('dp')->where('id', $id)->get('store_items')->row('dp');
    }

    public function getItemSpecifyVpPrice($id)
    {
        return $this->db->select('vp')->where('id', $id)->get('store_items')->row('vp');
    }

    public function getItemSpecifyIcon($id)
    {
        return $this->db->select('icon')->where('id', $id)->get('store_items')->row('icon');
    }

    public function getItemSpecifyCommand($id)
    {
        return $this->db->select('command')->where('id', $id)->get('store_items')->row('command');
    }

    public function insertStoreTop($item)
    {
        $data = array(
            'store_item' => $item
        );

        $this->db->insert('store_top', $data);
        return true;
    }

    public function updateSpecifyStoreTop($idlink, $item)
    {
        $update = array(
            'store_item' => $item
        );

        $this->db->where('id', $idlink)->update('store_top', $update);
        return true;
    }

    public function deleteStoreTop($id)
    {
        $this->db->where('id', $id)->delete('store_top');
        return true;
    }

    public function countStoreTop()
    {
        $this->db->from('store_top');
        return $this->db->count_all_results();
    }

    public function storeTopList()
    {
        return $this->db->select('*')->limit($this->_pageNumber, $this->_offset)->get('store_top')->result();
    }

    public function getStoreTopSpecifyRows($id)
    {
        return $this->db->select('*')->where('id', $id)->get('store_top')->num_rows();
    }

    public function getTopSpecifyItem($id)
    {
        return $this->db->select('store_item')->where('id', $id)->get('store_top')->row('store_item');
    }

    public function insertDonation($name, $price, $tax, $points)
    {
        $data = array(
            'name' => $name,
            'price' => $price,
            'tax' => $tax,
            'points' => $points
        );

        $this->db->insert('donate', $data);
        return true;
    }

    public function updateDonation($id, $name, $price, $tax, $points)
    {
        $update = array(
            'name' => $name,
            'price' => $price,
            'tax' => $tax,
            'points' => $points
        );

        $this->db->where('id', $id)->update('donate', $update);
        return true;
    }

    public function delSpecifyDonation($id)
    {
        $this->db->where('id', $id)->delete('donate');
        return true;
    }

    public function getDonateList()
    {
        return $this->db->select('*')->order_by('id', 'ASC')->get('donate')->result();
    }

    public function getDonateSpecifyName($id)
    {
        return $this->db->select('name')->where('id', $id)->get('donate')->row('name');
    }

    public function getDonateSpecifyPrice($id)
    {
        return $this->db->select('price')->where('id', $id)->get('donate')->row('price');
    }

    public function getDonateSpecifyTax($id)
    {
        return $this->db->select('tax')->where('id', $id)->get('donate')->row('tax');
    }

    public function getDonateSpecifyPoints($id)
    {
        return $this->db->select('points')->where('id', $id)->get('donate')->row('points');
    }

    public function insertForum($name, $description, $icon, $type, $category)
    {
        $data = array(
            'name' => $name,
            'category' => $category,
            'description' => $description,
            'icon' => $icon,
            'type' => $type
        );

        $this->db->insert('forum', $data);
        return true;
    }

    public function updateSpecifyForum($id, $name, $description, $icon, $type, $category)
    {
        $update = array(
            'name' => $name,
            'category' => $category,
            'description' => $description,
            'icon' => $icon,
            'type' => $type
        );

        $this->db->where('id', $id)->update('forum', $update);
        return true;
    }

    public function deleteForum($id)
    {
        $this->db->where('id', $id)->delete('forum');
        return true;
    }

    public function countForumElements()
    {
        $this->db->from('forum');
        return $this->db->count_all_results();
    }

    public function forumElementList()
    {
        return $this->db->select('*')->limit($this->_pageNumber, $this->_offset)->get('forum')->result();
    }

    public function getSpecifyForumRows($id)
    {
        return $this->db->select('*')->where('id', $id)->get('forum')->num_rows();
    }

    public function getSpecifyForumName($id)
    {
        return $this->db->select('name')->where('id', $id)->get('forum')->row('name');
    }

    public function getSpecifyForumDesc($id)
    {
        return $this->db->select('description')->where('id', $id)->get('forum')->row('description');
    }

    public function getSpecifyForumIcon($id)
    {
        return $this->db->select('icon')->where('id', $id)->get('forum')->row('icon');
    }

    public function getSpecifyForumCategory($id)
    {
        return $this->db->select('category')->where('id', $id)->get('forum')->row('category');
    }

    public function getSpecifyForumType($id)
    {
        return $this->db->select('type')->where('id', $id)->get('forum')->row('type');
    }

    public function insertForumCategory($category)
    {
        $data = array(
            'name' => $category
        );

        $this->db->insert('forum_category', $data);
        return true;
    }

    public function updateForumCategory($id, $category)
    {
        $update = array(
            'name' => $category
        );

        $this->db->where('id', $id)->update('forum_category', $update);
        return true;
    }

    public function deleteForumCategory($id)
    {
        $this->db->where('id', $id)->delete('forum_category');
        return true;
    }

    public function countForumCategories()
    {
        $this->db->from('forum_category');
        return $this->db->count_all_results();
    }

    public function forumCategoryList()
    {
        return $this->db->select('*')->limit($this->_pageNumber, $this->_offset)->get('forum_category')->result();
    }

    public function getForumCategoryList()
    {
        return $this->db->select('*')->order_by('id', 'ASC')->get('forum_category');
    }

    public function getSpecifyForumCategoryRows($id)
    {
        return $this->db->select('*')->where('id', $id)->get('forum_category')->num_rows();
    }

    public function getForumCategoryName($id)
    {
        return $this->db->select('name')->where('id', $id)->get('forum_category')->row('name');
    }

    /**
    * Download
    **/
    
    public function getDownload()
    {
        return $this->db->select('*')->get('download')->result();
    }
    
    public function getDownloadSpecifyRows($id)
    {
        return $this->db->select('*')->where('id', $id)->get('download')->num_rows();
    }
    
    public function insertDownload($fileName, $url, $image, $category, $weight, $type)
    {
        $data = array(
            'fileName' => $fileName,
            'url' => $url,
            'image' => $image,
            'category' => $category,
            'weight' => $weight,
            'type' => $type
        );

        $this->db->insert('download', $data);
        return true;
    }

    public function delSpecifyDownload($id)
    {
        $this->db->where('id', $id)->delete('download');
        return true;
    }
    
    public function updateSpecifyDownload($id, $fileName, $url, $image, $category, $weight, $type)
    {
        $update = array(
            'id' => $id,
            'fileName' => $fileName,
            'url' => $url,
            'image' => $image,
            'category' => $category,
            'weight' => $weight,
            'type' => $type
        );

        $this->db->where('id', $id)->update('download', $update);
        return true;
    }

    public function getDownloadSpecifyfileName($id)
    {
        return $this->db->select('fileName')->where('id', $id)->get('download')->row('fileName');
    }

    public function getDownloadSpecifyUrl($id)
    {
        return $this->db->select('url')->where('id', $id)->get('download')->row('url');
    }

    public function getDownloadSpecifyImage($id)
    {
        return $this->db->select('image')->where('id', $id)->get('download')->row('image');
    }

    public function getDownloadSpecifyCategory($id)
    {
        return $this->db->select('category')->where('id', $id)->get('download')->row('category');
    }

    public function getDownloadSpecifyWeight($id)
    {
        return $this->db->select('weight')->where('id', $id)->get('download')->row('weight');
    }

    public function getDownloadSpecifyType($id)
    {
        return $this->db->select('type')->where('id', $id)->get('download')->row('type');
    }

    /**
     * Tickets
     */

    public function countTickets($multirealm)
    {
        $this->multirealm = $multirealm;
        $this->multirealm->from('gm_ticket');
        return $this->multirealm->count_all_results();
    }

    public function ticketsList($multirealm)
    {
        $this->multirealm = $multirealm;
        return $this->multirealm->select('*')->limit($this->_pageNumber, $this->_offset)->get('gm_ticket')->result();
    }
}
