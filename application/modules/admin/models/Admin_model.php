<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model
{
    private $_limit,
            $_pageNumber,
            $_offset;
    /**
     * Admin_model constructor.
     */
    public function __construct()
    {
        parent::__construct();
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

    /**
     * @return int
     */
    public function countAccounts()
    {
        return $this->db->from('users')
            ->count_all_results();
    }

    /**
     * @return object
     */
    public function accountsList()
    {
        return $this->db->limit($this->_pageNumber, $this->_offset)
            ->get('users')
            ->result();
    }

    /**
     * @param int $id
     * @return int
     */
    public function getAccountExist($id)
    {
        return $this->db->where('id', $id)
            ->get('users')
            ->num_rows();
    }

    /**
     * @param object $multirealm
     * @return mixed
     */
    public function getAdminCharactersList($multirealm)
    {
        $this->multirealm = $multirealm;

        return $this->multirealm->select('guid, account, name')
            ->order_by('name', 'ASC')
            ->get('characters');
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getUserHistoryDonate($id)
    {
        return $this->db->where('user_id', $id)
            ->order_by('id', 'DESC')
            ->get('donate_logs');
    }

    /**
     * @param int $id
     * @return string
     */
    public function getDonateStatus($id)
    {
        switch ($id) {
            case 0:
                return lang('status_cancelled');

            case 1:
                return lang('status_completed');
        }
    }

    /**
     * @return object
     */
    public function getDonateLogs()
    {
        return $this->db->order_by('id', 'DESC')
            ->get('donate_logs')
            ->result();
    }

    /**
     * @return object
     */
    public function getVoteLogs()
    {
        return $this->db->order_by('id', 'DESC')
            ->get('votes_logs')
            ->result();
    }

    /**
     * @param int $id
     * @param int $dp
     * @param int $vp
     * @return bool
     */
    public function updateAccountData($id, $dp, $vp)
    {
        $this->db->where('id', $id)->update('users', [
            'dp' => $dp,
            'vp' => $vp
        ]);
        return true;
    }

    /**
     * @param int $iduser
     * @param string $reason
     * @return bool
     */
    public function insertBanAccount($iduser, $reason)
    {
        $reason = $reason === '' ? lang('log_banned') : $reason;

        $authdb = $this->wowauth->auth_database();

        $data = [
            'id'        => $iduser,
            'bandate'   => $this->wowgeneral->getTimestamp(),
            'unbandate' => $this->wowgeneral->getTimestamp(),
            'bannedby'  => $this->session->userdata('wow_sess_id'),
            'banreason' => $reason
        ];

        $authdb->insert('account_banned', $data);

        if (config_item('bnet_enabled')) {
            $authdb->insert('battlenet_account_bans', $data);
        }

        return true;
    }

    /**
     * @param int $id
     * @return bool
     */
    public function delBanAccount($id)
    {
        $authdb = $this->wowauth->auth_database();

        $authdb->where('id', $id)
            ->delete('account_banned');

        if (config_item('bnet_enabled')) {
            $authdb->where('id', $id)
                ->delete('battlenet_account_bans');
        }

        return true;
    }

    /**
     * @param int $id
     * @param int $gmlevel
     * @return bool
     */
    public function insertRankAccount($id, $gmlevel)
    {
        $this->wowauth->auth_database()
            ->insert('account_access', [
                'id'      => $id,
                'gmlevel' => $gmlevel,
                'RealmID' => '-1'
            ]);

        return true;
    }

    /**
     * @param int $id
     * @return bool
     */
    public function delRankAccount($id)
    {
        $this->wowauth->auth_database()
            ->where('id', $id)
            ->delete('account_access');

        return true;
    }

    /**
     * @return int
     */
    public function getBanCount()
    {
        return $this->wowauth->auth_database()
            ->get('account_banned')
            ->num_rows();
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getBanSpecify($id)
    {
        return $this->wowauth->auth_database()
            ->where('id', $id)
            ->where('active', '1')
            ->get('account_banned');
    }

    /**
     * @param int $idrealm
     * @return int
     */
    public function getGmCount($idrealm)
    {
        return $this->wowauth->auth_database()
            ->where('RealmID', $idrealm)
            ->or_where('RealmID', '-1')
            ->get('account_access')
            ->num_rows();
    }

    /**
     * @return int
     */
    public function getAccCreated()
    {
        return $this->wowauth->auth_database()
            ->get('account')
            ->num_rows();
    }

    /**
     * @param object $multirealm
     * @return int
     */
    public function getCharOn($multirealm)
    {
        $this->multirealm = $multirealm;

        return $this->multirealm->where('online', '1')
            ->get('characters')
            ->num_rows();
    }

    /**
     * @return int
     */
    public function getNewsCreated()
    {
        return $this->db->get('news')
            ->num_rows();
    }

    /**
     * @param string $project
     * @param string $timezone
     * @param string $maintenance
     * @param string $discord
     * @param string $realmlist
     * @param string $theme
     * @param string $facebook
     * @param string $twitter
     * @param string $youtube
     * @return bool
     */
    public function updateGeneralSettings($project, $timezone, $maintenance, $discord, $realmlist, $theme, $facebook, $twitter, $youtube)
    {
        $this->load->library('config_writer');

        $writer = $this->config_writer->get_instance(APPPATH . 'config/blizzcms.php', 'config');

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

    /**
     * @param string $admin
     * @param string $mod
     * @param string $recaptcha
     * @param string $register
     * @param string $smtphost
     * @param string $smtpport
     * @param string $smtpcrypto
     * @param string $smtpuser
     * @param string $smtppass
     * @param string $sender
     * @param string $sendername
     * @return bool
     */
    public function updateOptionalSettings($admin, $mod, $recaptcha, $register, $smtphost, $smtpport, $smtpcrypto, $smtpuser, $smtppass, $sender, $sendername)
    {
        $this->load->library('config_writer');

        $writer = $this->config_writer->get_instance(APPPATH . 'config/blizzcms.php', 'config');

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

    /**
     * @param string $metastatus
     * @param string $description
     * @param string $keywords
     * @param string $twitterstatus
     * @param string $graphstatus
     * @return bool
     */
    public function updateSeoSettings($metastatus, $description, $keywords, $twitterstatus, $graphstatus)
    {
        $this->load->library('config_writer');

        $writer = $this->config_writer->get_instance(APPPATH . 'config/seo.php', 'config');

        $writer->write('seo_meta_enable', ($metastatus == 'TRUE')  ? true : false);
        $writer->write('seo_meta_desc', $description);
        $writer->write('seo_meta_keywords', $keywords);
        $writer->write('seo_twitter_enable', ($twitterstatus == 'TRUE')  ? true : false);
        $writer->write('seo_og_enable', ($graphstatus == 'TRUE')  ? true : false);
        return true;
    }

    /**
     * @param string $currency
     * @param string $mode
     * @param string $client
     * @param string $password
     * @param string $currencySymbol
     * @return bool
     */
    public function updateDonateSettings($currency, $mode, $client, $password, $currencySymbol)
    {
        $this->load->library('config_writer');

        $writer = $this->config_writer->get_instance(APPPATH . 'modules/donate/config/donate.php', 'config');

        $writer->write('paypal_currency', $currency);
        $writer->write('paypal_mode', $mode);
        $writer->write('paypal_userid', $client);
        $writer->write('paypal_secretpass', $password);
        $writer->write('paypal_currency_symbol', $currencySymbol);
        return true;
    }

    /**
     * @param string $textarea
     * @return bool
     */
    public function updateBugtrackerSettings($textarea)
    {
        $this->load->library('config_writer');

        $writer = $this->config_writer->get_instance(APPPATH . 'modules/bugtracker/config/bugtracker.php', 'config');

        $writer->write('textarea', $textarea);
        return true;
    }

    /**
     * @param string $name
     * @param string $url
     * @param string $icon
     * @param int $main
     * @param int $child
     * @param int $type
     * @return bool
     */
    public function insertMenu($name, $url, $icon, $main, $child, $type)
    {
        $this->db->insert('menu', [
            'name'  => $name,
            'url'   => $url,
            'icon'  => $icon,
            'main'  => $main,
            'child' => $child,
            'type'  => $type
        ]);
        return true;
    }

    /**
     * @param int $id
     * @param string $name
     * @param string $url
     * @param string $icon
     * @param int $main
     * @param int $child
     * @param int $type
     * @return bool
     */
    public function updateSpecifyMenu($id, $name, $url, $icon, $main, $child, $type)
    {
        $this->db->where('id', $id)->update('menu', [
            'name'  => $name,
            'url'   => $url,
            'icon'  => $icon,
            'main'  => $main,
            'child' => $child,
            'type'  => $type
        ]);
        return true;
    }

    /**
     * @param int $id
     * @return bool
     */
    public function delSpecifyMenu($id)
    {
        $this->db->where('id', $id)->delete('menu');
        return true;
    }

    /**
     * @return object
     */
    public function getMenu()
    {
        return $this->db->get('menu')
            ->result();
    }

    /**
     * @param int $id
     * @return int
     */
    public function getMenuSpecifyRows($id)
    {
        return $this->db->where('id', $id)
            ->get('menu')
            ->num_rows();
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getMenuSpecifyName($id)
    {
        return $this->db->where('id', $id)
            ->get('menu')
            ->row('name');
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getMenuSpecifyUrl($id)
    {
        return $this->db->where('id', $id)
            ->get('menu')
            ->row('url');
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getMenuSpecifyIcon($id)
    {
        return $this->db->where('id', $id)
            ->get('menu')
            ->row('icon');
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getMenuSpecifyMain($id)
    {
        return $this->db->where('id', $id)
            ->get('menu')
            ->row('main');
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getMenuSpecifyChild($id)
    {
        return $this->db->where('id', $id)
            ->get('menu')
            ->row('child');
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getMenuSpecifyType($id)
    {
        return $this->db->where('id', $id)
            ->get('menu')
            ->row('type');
    }

    /**
     * @param string $hostname
     * @param string $username
     * @param string $password
     * @param string $database
     * @param int $realm_id
     * @param string $soaphost
     * @param string $soapuser
     * @param string $soappass
     * @param string $soapport
     * @param string $emulator
     * @return bool
     */
    public function insertRealm($hostname, $username, $password, $database, $realm_id, $soaphost, $soapuser, $soappass, $soapport, $emulator)
    {
        $this->db->insert('realms', [
            'hostname'         => $hostname,
            'username'         => $username,
            'password'         => $password,
            'char_database'    => $database,
            'realmID'          => $realm_id,
            'console_hostname' => $soaphost,
            'console_username' => $soapuser,
            'console_password' => $soappass,
            'console_port'     => $soapport,
            'emulator'         => $emulator
        ]);
        return true;
    }

    /**
     * @param int $id
     * @param string $hostname
     * @param string $username
     * @param string $password
     * @param string $database
     * @param int $realm_id
     * @param string $soaphost
     * @param string $soapuser
     * @param string $soappass
     * @param string $soapport
     * @param string $emulator
     * @return bool
     */
    public function updateSpecifyRealm($id, $hostname, $username, $password, $database, $realm_id, $soaphost, $soapuser, $soappass, $soapport, $emulator)
    {
        $this->db->where('id', $id)->update('realms', [
            'hostname'         => $hostname,
            'username'         => $username,
            'password'         => $password,
            'char_database'    => $database,
            'realmID'          => $realm_id,
            'console_hostname' => $soaphost,
            'console_username' => $soapuser,
            'console_password' => $soappass,
            'console_port'     => $soapport,
            'emulator'         => $emulator
        ]);
        return true;
    }

    /**
     * @param int $id
     * @return bool
     */
    public function delSpecifyRealm($id)
    {
        $this->db->where('id', $id)->delete('realms');
        return true;
    }

    /**
     * @return int
     */
    public function countRealms()
    {
        return $this->db->from('realms')
            ->count_all_results();
    }

    /**
     * @return object
     */
    public function realmsList()
    {
        return $this->db->limit($this->_pageNumber, $this->_offset)
            ->get('realms')
            ->result();
    }

    /**
     * @param int $id
     * @return int
     */
    public function getRealmsSpecifyRows($id)
    {
        return $this->db->where('id', $id)
            ->get('realms')
            ->num_rows();
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getRealmSpecifyHost($id)
    {
        return $this->db->where('id', $id)
            ->get('realms')
            ->row('hostname');
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getRealmSpecifyUser($id)
    {
        return $this->db->where('id', $id)
            ->get('realms')
            ->row('username');
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getRealmSpecifyPass($id)
    {
        return $this->db->where('id', $id)
            ->get('realms')
            ->row('password');
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getRealmSpecifyCharDB($id)
    {
        return $this->db->where('id', $id)
            ->get('realms')
            ->row('char_database');
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getRealmSpecifyId($id)
    {
        return $this->db->where('id', $id)
            ->get('realms')
            ->row('realmID');
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getRealmSpecifyConsoleHost($id)
    {
        return $this->db->where('id', $id)
            ->get('realms')
            ->row('console_hostname');
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getRealmSpecifyConsoleUser($id)
    {
        return $this->db->where('id', $id)
            ->get('realms')
            ->row('console_username');
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getRealmSpecifyConsolePass($id)
    {
        return $this->db->where('id', $id)
            ->get('realms')
            ->row('console_password');
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getRealmSpecifyConsolePort($id)
    {
        return $this->db->where('id', $id)
            ->get('realms')
            ->row('console_port');
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getRealmSpecifyEmulator($id)
    {
        return $this->db->where('id', $id)
            ->get('realms')
            ->row('emulator');
    }

    /**
     * @param string $title
     * @param string $description
     * @param int $type
     * @param string $route
     * @return bool
     */
    public function insertSlide($title, $description, $type, $route)
    {
        $this->db->insert('slides', [
            'title'       => $title,
            'description' => $description,
            'type'        => $type,
            'route'       => $route
        ]);
        return true;
    }

    /**
     * @param int $id
     * @param string $title
     * @param string $description
     * @param int $type
     * @param string $route
     * @return bool
     */
    public function updateSpecifySlide($id, $title, $description, $type, $route)
    {
        $this->db->where('id', $id)->update('slides', [
            'title'       => $title,
            'description' => $description,
            'type'        => $type,
            'route'       => $route
        ]);
        return true;
    }

    /**
     * @param int $id
     * @return bool
     */
    public function delSpecifySlide($id)
    {
        $this->db->where('id', $id)->delete('slides');
        return true;
    }

    /**
     * @return int
     */
    public function countSlides()
    {
        return $this->db->from('slides')
            ->count_all_results();
    }

    /**
     * @return object
     */
    public function slidesList()
    {
        return $this->db->limit($this->_pageNumber, $this->_offset)
            ->get('slides')
            ->result();
    }

    /**
     * @param int $id
     * @return int
     */
    public function getSlidesSpecifyRows($id)
    {
        return $this->db->where('id', $id)
            ->get('slides')
            ->num_rows();
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getSlideSpecifyTitle($id)
    {
        return $this->db->where('id', $id)
            ->get('slides')
            ->row('title');
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getSlideSpecifyDescription($id)
    {
        return $this->db->where('id', $id)
            ->get('slides')
            ->row('description');
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getSlideSpecifyType($id)
    {
        return $this->db->where('id', $id)
            ->get('slides')
            ->row('type');
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getSlideSpecifyRoute($id)
    {
        return $this->db->where('id', $id)
            ->get('slides')
            ->row('route');
    }

    /**
     * @param string $title
     * @param string $description
     * @param string $image
     * @return bool
     */
    public function insertNews($title, $description, $image)
    {
        $this->db->insert('news', [
            'title'       => $title,
            'image'       => $image,
            'description' => $description,
            'date'        => $this->wowgeneral->getTimestamp()
        ]);

        redirect(site_url('admin/news'), 'refresh');
    }

    /**
     * @param int $id
     * @param string $title
     * @param string $description
     * @param string $image
     * @return bool
     */
    public function updateSpecifyNews($id, $title, $description, $image)
    {
        $unlink = $this->getFileNameImage($id);

        unlink('./assets/images/news/' . $unlink);

        $this->db->where('id', $id)->update('news', [
            'title'       => $title,
            'image'       => $image,
            'description' => $description,
            'date'        => $this->wowgeneral->getTimestamp()
        ]);

        redirect(site_url('admin/news'), 'refresh');
    }

    /**
     * @param int $id
     * @return bool
     */
    public function delSpecifyNew($id)
    {
        $this->db->where('id', $id)->delete('news');
        return true;
    }

    /**
     * @return int
     */
    public function countNews()
    {
        return $this->db->from('news')
            ->count_all_results();
    }

    /**
     * @return object
     */
    public function newsList()
    {
        return $this->db->limit($this->_pageNumber, $this->_offset)
            ->get('news')
            ->result();
    }

    /**
     * @param int $id
     * @return int
     */
    public function getNewsSpecifyRows($id)
    {
        return $this->db->where('id', $id)
            ->get('news')
            ->num_rows();
    }

    /**
     * @param int $date
     * @return mixed
     */
    public function getNewIDperDate($date)
    {
        return $this->db->where('date', $date)
            ->get('news')
            ->row('id');
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getFileNameImage($id)
    {
        return $this->db->where('id', $id)
            ->get('news')
            ->row('image');
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getNewsSpecifyName($id)
    {
        return $this->db->where('id', $id)
            ->get('news')
            ->row('title');
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getNewsSpecifyDesc($id)
    {
        return $this->db->where('id', $id)
            ->get('news')
            ->row('description');
    }

    /**
     * @param string $title
     * @param string $description
     * @return bool
     */
    public function insertChangelog($title, $description)
    {
        $this->db->insert('changelogs', [
            'title'       => $title,
            'description' => $description,
            'date'        => $this->wowgeneral->getTimestamp()
        ]);
        return true;
    }

    /**
     * @param int $id
     * @param string $title
     * @param string $description
     * @return bool
     */
    public function updateSpecifyChangelog($id, $title, $description)
    {
        $this->db->where('id', $id)->update('changelogs', [
            'title'       => $title,
            'description' => $description,
            'date'        => $this->wowgeneral->getTimestamp()
        ]);
        return true;
    }

    /**
     * @param int $id
     * @return bool
     */
    public function delChangelog($id)
    {
        $this->db->where('id', $id)->delete('changelogs');
        return true;
    }

    /**
     * @return int
     */
    public function countChangelogs()
    {
        return $this->db->from('changelogs')
            ->count_all_results();
    }

    /**
     * @return object
     */
    public function changelogsList()
    {
        return $this->db->limit($this->_pageNumber, $this->_offset)
            ->get('changelogs')
            ->result();
    }

    /**
     * @return int
     */
    public function getChangelogsCreated()
    {
        return $this->db->get('changelogs')
            ->num_rows();
    }

    /**
     * @param int $id
     * @return int
     */
    public function getChangelogSpecifyRows($id)
    {
        return $this->db->where('id', $id)
            ->get('changelogs')
            ->num_rows();
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getChangelogSpecifyName($id)
    {
        return $this->db->where('id', $id)
            ->get('changelogs')
            ->row('title');
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getChangelogSpecifyDesc($id)
    {
        return $this->db->where('id', $id)
            ->get('changelogs')
            ->row('description');
    }

    /**
     * @param string $title
     * @param string $uri
     * @param string $description
     * @return bool
     */
    public function insertPage($title, $uri, $description)
    {
        $uri = $this->pagecheckUri($uri) ? $uri . '-' . rand(1, 15) : $uri;

        $this->db->insert('pages', [
            'title'        => $title,
            'uri_friendly' => strtolower($uri),
            'description'  => $description,
            'date'         => $this->wowgeneral->getTimestamp()
        ]);
        return true;
    }

    /**
     * @param int $id
     * @param string $title
     * @param string $uri
     * @param string $description
     * @return bool
     */
    public function updateSpecifyPage($id, $title, $uri, $description)
    {
        $this->db->where('id', $id)->update('pages', [
            'title'        => $title,
            'uri_friendly' => strtolower($uri),
            'description'  => $description,
            'date'         => $this->wowgeneral->getTimestamp()
        ]);
        return true;
    }

    /**
     * @param int $id
     * @return bool
     */
    public function delPage($id)
    {
        $this->db->where('id', $id)->delete('pages');
        return true;
    }

    /**
     * @return int
     */
    public function countPages()
    {
        return $this->db->from('pages')
            ->count_all_results();
    }

    /**
     * @return object
     */
    public function pagesList()
    {
        return $this->db->limit($this->_pageNumber, $this->_offset)
            ->get('pages')
            ->result();
    }

    /**
     * @param int $id
     * @return int
     */
    public function getPagesSpecifyRows($id)
    {
        return $this->db->where('id', $id)
            ->get('pages')
            ->num_rows();
    }

    public function pagecheckUri($uri)
    {
        $query = $this->db->where('uri_friendly', $uri)
            ->get('pages')
            ->row();

        if (! empty($query)) {
            return true;
        }

        return false;
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getPagesSpecifyName($id)
    {
        return $this->db->where('id', $id)
            ->get('pages')
            ->row('title');
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getPagesSpecifyURI($id)
    {
        return $this->db->where('id', $id)
            ->get('pages')
            ->row('uri_friendly');
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getPagesSpecifyDesc($id)
    {
        return $this->db->where('id', $id)
            ->get('pages')
            ->row('description');
    }

    /**
     * @param string $name
     * @param string $url
     * @param int $time
     * @param int $points
     * @param string $image
     * @return bool
     */
    public function insertTopsite($name, $url, $time, $points, $image)
    {
        $this->db->insert('votes', [
            'name'   => $name,
            'url'    => $url,
            'time'   => $time,
            'points' => $points,
            'image'  => $image
        ]);
        return true;
    }

    /**
     * @param int $id
     * @param string $name
     * @param string $url
     * @param int $time
     * @param int $points
     * @param string $image
     * @return bool
     */
    public function updateSpecifyTopsite($id, $name, $url, $time, $points, $image)
    {
        $this->db->where('id', $id)->update('votes', [
            'name'   => $name,
            'url'    => $url,
            'time'   => $time,
            'points' => $points,
            'image'  => $image
        ]);
        return true;
    }

    /**
     * @param int $id
     * @return bool
     */
    public function delTopsite($id)
    {
        $this->db->where('id', $id)->delete('votes');
        return true;
    }

    /**
     * @return int
     */
    public function countTopsites()
    {
        return $this->db->from('votes')
            ->count_all_results();
    }

    /**
     * @return object
     */
    public function topsitesList()
    {
        return $this->db->limit($this->_pageNumber, $this->_offset)
            ->get('votes')
            ->result();
    }

    /**
     * @param int $id
     * @return int
     */
    public function getTopsitesSpecifyRows($id)
    {
        return $this->db->where('id', $id)
            ->get('votes')
            ->num_rows();
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getTopsiteSpecifyName($id)
    {
        return $this->db->where('id', $id)
            ->get('votes')
            ->row('name');
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getTopsiteSpecifyURL($id)
    {
        return $this->db->where('id', $id)
            ->get('votes')
            ->row('url');
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getTopsiteSpecifyTime($id)
    {
        return $this->db->where('id', $id)
            ->get('votes')
            ->row('time');
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getTopsiteSpecifyPoints($id)
    {
        return $this->db->where('id', $id)
            ->get('votes')
            ->row('points');
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getTopsiteSpecifyImage($id)
    {
        return $this->db->where('id', $id)
            ->get('votes')
            ->row('image');
    }

    /**
     * @return object
     */
    public function getModules()
    {
        return $this->db->get('modules')
            ->result();
    }

    public function enableSpecifyModule($id)
    {
        $this->db->where('id', $id)->update('modules', [
            'status' => '1'
        ]);
        return true;
    }

    public function disableSpecifyModule($id)
    {
        $this->db->where('id', $id)->update('modules', [
            'status' => '0'
        ]);
        return true;
    }

    /**
     * @return mixed
     */
    public function getDropDownsSpecify()
    {
        return $this->db->where('main', '2')
            ->where('father', '0')
            ->get('store_categories');
    }

    /**
     * @param string $name
     * @param string $route
     * @param int $realmid
     * @param int $main
     * @param int $father
     * @return mixed
     */
    public function insertStoreCategory($name, $route, $realmid, $main, $father)
    {
        if ($this->StoreCategoryCheckRoute($route)) {
            return 'Rouerr';
        }

        $this->db->insert('store_categories', [
            'name'    => $name,
            'route'   => strtolower($route),
            'realmid' => $realmid,
            'main'    => $main,
            'father'  => $father
        ]);
        return true;
    }

    /**
     * @param int $idlink
     * @param string $name
     * @param string $route
     * @param int $realmid
     * @return mixed
     */
    public function updateSpecifyStoreCategory($idlink, $name, $route, $realmid)
    {
        if ($this->StoreCategoryCheckRoute($route)) {
            return 'Rouerr';
        }

        $this->db->where('id', $idlink)->update('store_categories', [
            'name'    => $name,
            'route'   => strtolower($route),
            'realmid' => $realmid
        ]);
        return true;
    }

    public function StoreCategoryCheckRoute($route)
    {
        $query = $this->db->where('route', $route)
            ->get('store_categories')
            ->row();

        if (! empty($query)) {
            return true;
        }

        return false;
    }

    /**
     * @param int $id
     * @return bool
     */
    public function deleteStoreCategory($id)
    {
        $this->db->where('id', $id)->delete('store_categories');
        return true;
    }

    /**
     * @return int
     */
    public function countStoreCategories()
    {
        return $this->db->from('store_categories')
            ->count_all_results();
    }

    /**
     * @return object
     */
    public function storeCategoryList()
    {
        return $this->db->limit($this->_pageNumber, $this->_offset)
            ->get('store_categories')
            ->result();
    }

    /**
     * @return mixed
     */
    public function getCategoryStore()
    {
        return $this->db->get('store_categories');
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getStoreCategorySpecifyRows($id)
    {
        return $this->db->where('id', $id)
            ->get('store_categories')
            ->num_rows();
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getStoreCategoryName($id)
    {
        return $this->db->where('id', $id)
            ->get('store_categories')
            ->row('name');
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getStoreCategoryRoute($id)
    {
        return $this->db->where('id', $id)
            ->get('store_categories')
            ->row('route');
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getStoreCategoryRealm($id)
    {
        return $this->db->where('id', $id)
            ->get('store_categories')
            ->row('realmid');
    }

    /**
     * @param string $name
     * @param string $description
     * @param int $category
     * @param int $type
     * @param int $price_type
     * @param int $pricedp
     * @param int $pricevp
     * @param string $icon
     * @param string $command
     * @return bool
     */
    public function insertItem($name, $description, $category, $type, $price_type, $pricedp, $pricevp, $icon, $command)
    {
        $pricedp = $price_type == 2 ? 0 : $pricedp;
        $pricevp = $price_type == 1 ? 0 : $pricevp;

        $this->db->insert('store_items', [
            'name'        => $name,
            'description' => $description,
            'category'    => $category,
            'type'        => $type,
            'price_type'  => $price_type,
            'dp'          => $pricedp,
            'vp'          => $pricevp,
            'icon'        => $icon,
            'command'     => $command
        ]);
        return true;
    }

    /**
     * @param int $id
     * @param string $name
     * @param string $description
     * @param int $category
     * @param int $type
     * @param int $price_type
     * @param int $pricedp
     * @param int $pricevp
     * @param string $icon
     * @param string $command
     * @return bool
     */
    public function updateSpecifyItem($id, $name, $description, $category, $type, $price_type, $pricedp, $pricevp, $icon, $command)
    {
        $pricedp = $price_type == 2 ? 0 : $pricedp;
        $pricevp = $price_type == 1 ? 0 : $pricevp;

        $this->db->where('id', $id)->update('store_items', [
            'name'        => $name,
            'description' => $description,
            'category'    => $category,
            'type'        => $type,
            'price_type'  => $price_type,
            'dp'          => $pricedp,
            'vp'          => $pricevp,
            'icon'        => $icon,
            'command'     => $command
        ]);
        return true;
    }

    /**
     * @param int $id
     * @return bool
     */
    public function delStoreItem($id)
    {
        $this->db->where('id', $id)->delete('store_items');
        $this->db->where('store_item', $id)->delete('store_top');
        return true;
    }

    /**
     * @return int
     */
    public function countStoreItems()
    {
        return $this->db->from('store_items')
            ->count_all_results();
    }

    /**
     * @return object
     */
    public function storeItemList()
    {
        return $this->db->limit($this->_pageNumber, $this->_offset)
            ->get('store_items')
            ->result();
    }

    /**
     * @return object
     */
    public function getStoreItems()
    {
        return $this->db->order_by('id', 'ASC')
            ->get('store_items')
            ->result();
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getItemSpecifyRows($id)
    {
        return $this->db->where('id', $id)
            ->get('store_items')
            ->num_rows();
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getItemSpecifyName($id)
    {
        return $this->db->where('id', $id)
            ->get('store_items')
            ->row('name');
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getItemSpecifyDescription($id)
    {
        return $this->db->where('id', $id)
            ->get('store_items')
            ->row('description');
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getItemSpecifyCategory($id)
    {
        return $this->db->where('id', $id)
            ->get('store_items')
            ->row('category');
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getItemSpecifyType($id)
    {
        return $this->db->where('id', $id)
            ->get('store_items')
            ->row('type');
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getItemSpecifyPriceType($id)
    {
        return $this->db->where('id', $id)
            ->get('store_items')
            ->row('price_type');
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getItemSpecifyDpPrice($id)
    {
        return $this->db->where('id', $id)
            ->get('store_items')
            ->row('dp');
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getItemSpecifyVpPrice($id)
    {
        return $this->db->where('id', $id)
            ->get('store_items')
            ->row('vp');
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getItemSpecifyIcon($id)
    {
        return $this->db->where('id', $id)
            ->get('store_items')
            ->row('icon');
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getItemSpecifyCommand($id)
    {
        return $this->db->where('id', $id)
            ->get('store_items')
            ->row('command');
    }

    /**
     * @param int $item
     * @return bool
     */
    public function insertStoreTop($item)
    {
        $this->db->insert('store_top', [
            'store_item' => $item
        ]);
        return true;
    }

    /**
     * @param int $idlink
     * @param int $item
     * @return bool
     */
    public function updateSpecifyStoreTop($idlink, $item)
    {
        $this->db->where('id', $idlink)->update('store_top', [
            'store_item' => $item
        ]);
        return true;
    }

    /**
     * @param int $id
     * @return bool
     */
    public function deleteStoreTop($id)
    {
        $this->db->where('id', $id)->delete('store_top');
        return true;
    }

    /**
     * @return int
     */
    public function countStoreTop()
    {
        return $this->db->from('store_top')
            ->count_all_results();
    }

    /**
     * @return object
     */
    public function storeTopList()
    {
        return $this->db->limit($this->_pageNumber, $this->_offset)
            ->get('store_top')
            ->result();
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getStoreTopSpecifyRows($id)
    {
        return $this->db->where('id', $id)
            ->get('store_top')
            ->num_rows();
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getTopSpecifyItem($id)
    {
        return $this->db->where('id', $id)
            ->get('store_top')
            ->row('store_item');
    }

    /**
     * @param string $name
     * @param string $price
     * @param string $tax
     * @param int $points
     * @return bool
     */
    public function insertDonation($name, $price, $tax, $points)
    {
        $this->db->insert('donate', [
            'name'   => $name,
            'price'  => $price,
            'tax'    => $tax,
            'points' => $points
        ]);
        return true;
    }

    /**
     * @param int $id
     * @param string $name
     * @param string $price
     * @param string $tax
     * @param int $points
     * @return bool
     */
    public function updateDonation($id, $name, $price, $tax, $points)
    {
        $this->db->where('id', $id)->update('donate', [
            'name'   => $name,
            'price'  => $price,
            'tax'    => $tax,
            'points' => $points
        ]);
        return true;
    }

    /**
     * @param int $id
     * @return bool
     */
    public function delSpecifyDonation($id)
    {
        $this->db->where('id', $id)->delete('donate');
        return true;
    }

    /**
     * @return object
     */
    public function getDonateList()
    {
        return $this->db->order_by('id', 'ASC')
            ->get('donate')
            ->result();
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getDonateSpecifyName($id)
    {
        return $this->db->where('id', $id)
            ->get('donate')
            ->row('name');
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getDonateSpecifyPrice($id)
    {
        return $this->db->where('id', $id)
            ->get('donate')
            ->row('price');
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getDonateSpecifyTax($id)
    {
        return $this->db->where('id', $id)
            ->get('donate')
            ->row('tax');
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getDonateSpecifyPoints($id)
    {
        return $this->db->where('id', $id)
            ->get('donate')
            ->row('points');
    }

    /**
     * @param string $name
     * @param string $description
     * @param string $icon
     * @param int $type
     * @param int $category
     * @return bool
     */
    public function insertForum($name, $description, $icon, $type, $category)
    {
        $this->db->insert('forum', [
            'name'        => $name,
            'category'    => $category,
            'description' => $description,
            'icon'        => $icon,
            'type'        => $type
        ]);
        return true;
    }

    /**
     * @param int $id
     * @param string $name
     * @param string $description
     * @param string $icon
     * @param int $type
     * @param int $category
     * @return bool
     */
    public function updateSpecifyForum($id, $name, $description, $icon, $type, $category)
    {
        $this->db->where('id', $id)->update('forum', [
            'name'        => $name,
            'category'    => $category,
            'description' => $description,
            'icon'        => $icon,
            'type'        => $type
        ]);
        return true;
    }

    /**
     * @param int $id
     * @return bool
     */
    public function deleteForum($id)
    {
        $this->db->where('id', $id)->delete('forum');
        return true;
    }

    /**
     * @return int
     */
    public function countForumElements()
    {
        return $this->db->from('forum')
            ->count_all_results();
    }

    /**
     * @return object
     */
    public function forumElementList()
    {
        return $this->db->limit($this->_pageNumber, $this->_offset)
            ->get('forum')
            ->result();
    }

    /**
     * @param int $id
     * @return int
     */
    public function getSpecifyForumRows($id)
    {
        return $this->db->where('id', $id)
            ->get('forum')
            ->num_rows();
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getSpecifyForumName($id)
    {
        return $this->db->where('id', $id)
            ->get('forum')
            ->row('name');
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getSpecifyForumDesc($id)
    {
        return $this->db->where('id', $id)
            ->get('forum')
            ->row('description');
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getSpecifyForumIcon($id)
    {
        return $this->db->where('id', $id)
            ->get('forum')
            ->row('icon');
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getSpecifyForumCategory($id)
    {
        return $this->db->where('id', $id)
            ->get('forum')
            ->row('category');
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getSpecifyForumType($id)
    {
        return $this->db->where('id', $id)
            ->get('forum')
            ->row('type');
    }

    /**
     * @param string $category
     * @return bool
     */
    public function insertForumCategory($category)
    {
        $this->db->insert('forum_category', [
            'name' => $category
        ]);
        return true;
    }

    /**
     * @param int $id
     * @param string $category
     * @return bool
     */
    public function updateForumCategory($id, $category)
    {
        $this->db->where('id', $id)->update('forum_category', [
            'name' => $category
        ]);
        return true;
    }

    /**
     * @param int $id
     * @return bool
     */
    public function deleteForumCategory($id)
    {
        $this->db->where('id', $id)->delete('forum_category');
        return true;
    }

    /**
     * @return int
     */
    public function countForumCategories()
    {
        return $this->db->from('forum_category')
            ->count_all_results();
    }

    /**
     * @return object
     */
    public function forumCategoryList()
    {
        return $this->db->limit($this->_pageNumber, $this->_offset)
            ->get('forum_category')
            ->result();
    }

    /**
     * @return mixed
     */
    public function getForumCategoryList()
    {
        return $this->db->order_by('id', 'ASC')
            ->get('forum_category');
    }

    /**
     * @param int $id
     * @return int
     */
    public function getSpecifyForumCategoryRows($id)
    {
        return $this->db->where('id', $id)
            ->get('forum_category')
            ->num_rows();
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getForumCategoryName($id)
    {
        return $this->db->where('id', $id)
            ->get('forum_category')
            ->row('name');
    }

    /**
     * @return object
     */
    public function getDownload()
    {
        return $this->db->get('download')
            ->result();
    }

    public function getDownloadSpecifyRows($id)
    {
        return $this->db->where('id', $id)
            ->get('download')
            ->num_rows();
    }

    /**
     * @param string $fileName
     * @param string $url
     * @param string $image
     * @param int $category
     * @param int $weight
     * @param int $type
     * @return bool
     */
    public function insertDownload($fileName, $url, $image, $category, $weight, $type)
    {
        $this->db->insert('download', [
            'fileName' => $fileName,
            'url'      => $url,
            'image'    => $image,
            'category' => $category,
            'weight'   => $weight,
            'type'     => $type
        ]);
        return true;
    }

    /**
     * @param int $id
     * @return bool
     */
    public function delSpecifyDownload($id)
    {
        $this->db->where('id', $id)->delete('download');
        return true;
    }

    /**
     * @param int $id
     * @param string $fileName
     * @param string $url
     * @param string $image
     * @param int $category
     * @param int $weight
     * @param int $type
     * @return bool
     */
    public function updateSpecifyDownload($id, $fileName, $url, $image, $category, $weight, $type)
    {
        $this->db->where('id', $id)->update('download', [
            'id'       => $id,
            'fileName' => $fileName,
            'url'      => $url,
            'image'    => $image,
            'category' => $category,
            'weight'   => $weight,
            'type'     => $type
        ]);
        return true;
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getDownloadSpecifyfileName($id)
    {
        return $this->db->where('id', $id)
            ->get('download')
            ->row('fileName');
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getDownloadSpecifyUrl($id)
    {
        return $this->db->where('id', $id)
            ->get('download')
            ->row('url');
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getDownloadSpecifyImage($id)
    {
        return $this->db->where('id', $id)
            ->get('download')
            ->row('image');
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getDownloadSpecifyCategory($id)
    {
        return $this->db->where('id', $id)
            ->get('download')
            ->row('category');
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getDownloadSpecifyWeight($id)
    {
        return $this->db->where('id', $id)
            ->get('download')
            ->row('weight');
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getDownloadSpecifyType($id)
    {
        return $this->db->where('id', $id)
            ->get('download')
            ->row('type');
    }

    /**
     * @param object $multirealm
     * @return int
     */
    public function countTickets($multirealm)
    {
        $this->multirealm = $multirealm;

        return $this->multirealm->from('gm_ticket')
            ->count_all_results();
    }

    /**
     * @param object $multirealm
     * @return object
     */
    public function ticketsList($multirealm)
    {
        $this->multirealm = $multirealm;

        return $this->multirealm->limit($this->_pageNumber, $this->_offset)
            ->get('gm_ticket')
            ->result();
    }
}
