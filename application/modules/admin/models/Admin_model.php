<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {

    public function __construct()
    {
        $this->auth = $this->load->database('auth', TRUE);
        parent::__construct();

        if (!$this->m_modules->getACPStatus())
            redirect(base_url(),'refresh');
    }

    public function insertShop($itemid, $type, $name, $pricedp, $pricevp, $iconname, $groups, $image)
    {
        if ($pricevp == '0' && $pricedp == '0')
        redirect(base_url('admin/items?p'),'refresh');

        if ($pricedp == '0')
            $pricedp = NULL;

        if ($pricevp == '0')
            $pricevp = NULL;

        $data = array(
            'itemid' => $itemid,
            'type' => $type,
            'name' => $name,
            'price_dp' => $pricedp,
            'price_vp' => $pricevp,
            'iconname' => $iconname,
            'groups' => $groups,
            'image' => $image,
        );

        $this->db->insert('store', $data);

        redirect(base_url('admin/items'),'refresh');
    }

    public function getCategoryStore()
    {
        return $this->db->select('*')
                ->get('store_groups');
    }

    public function insertChangelog($title, $desc)
    {
        $date = $this->m_data->getTimestamp();

        $data = array(
            'title' => $title,
            'description' => $desc,
            'date' => $date,
        );

        $this->db->insert('changelogs', $data);

        redirect(base_url('admin/changelogs'),'refresh');
    }

    public function getChangelogSpecifyRows($id)
    {
        return $this->db->select('*')
                ->where('id', $id)
                ->get('changelogs')
                ->num_rows();
    }

    public function getChangelogSpecifyName($id)
    {
        return $this->db->select('title')
                ->where('id', $id)
                ->get('changelogs')
                ->row('title');
    }

    public function getChangelogSpecifyDesc($id)
    {
        return $this->db->select('description')
                ->where('id', $id)
                ->get('changelogs')
                ->row_array()['description'];
    }

    public function updateSpecifyChangelog($id, $title, $description)
    {
        $date = $this->m_data->getTimestamp();

        $update = array(
            'title' => $title,
            'description' => $description,
            'date' => $date
        );

        $this->db->where('id', $id)
                ->update('changelogs', $update);

        redirect(base_url('admin/changelogs'),'refresh');
    }

    public function pagecheckUri($uri)
    {
      $qq = $this->db->select('uri_friendly')
                  ->where('uri_friendly', $uri)
                  ->get('pages')->row('uri_friendly');
      if($qq == $uri)
      {
        return true;
      } else {
        return false;
      }
    }

    public function insertPage($uri, $title, $desc)
    {
        $date = $this->m_data->getTimestamp();

        $data = array(
            'uri_friendly' => $uri,
            'title' => $title,
            'description' => $desc,
            'date' => $date,
        );

        $this->db->insert('pages', $data);

        $uris = $this->db->select('uri_friendly')
                ->where('uri_friendly', $uri)
                ->get('pages')
                ->row('uri_friendly');

        redirect(base_url('admin/pages?newpage='.$uris),'refresh');
    }

    public function getPagesSpecifyRows($id)
    {
        return $this->db->select('*')
                ->where('id', $id)
                ->get('pages')
                ->num_rows();
    }

    public function getPagesSpecifyName($id)
    {
        return $this->db->select('title')
                ->where('id', $id)
                ->get('pages')
                ->row('title');
    }

    public function getPagesSpecifyDesc($id)
    {
        return $this->db->select('description')
                ->where('id', $id)
                ->get('pages')
                ->row_array()['description'];
    }

    public function updateSpecifyPage($id, $title, $description)
    {
        $date = $this->m_data->getTimestamp();

        $update = array(
            'title' => $title,
            'description' => $description,
            'date' => $date
        );

        $this->db->where('id', $id)
                ->update('pages', $update);

        redirect(base_url('admin/pages'),'refresh');
    }

    public function delShopItm($id)
    {
        $this->db->where('id', $id)
                ->delete('store');

        $this->db->where('id_store', $id)
                ->delete('store_top');

        redirect(base_url('admin/items'),'refresh');
    }

    public function getShopGroupList()
    {
        return $this->db->select('*')
            ->order_by('id', 'ASC')
            ->get('store_groups');
    }

    public function deleteGroup($id)
    {
        $this->db->where('id', $id)
                ->delete('store_groups');

        redirect(base_url('admin/groups'),'refresh');
    }

    public function insertGroup($name)
    {
        $data = array(
            'name' => $name,
        );

        $this->db->insert('store_groups', $data);

        redirect(base_url('admin/groups'),'refresh');
    }

    public function getShopAll()
    {
        return $this->db->select('*')
                ->order_by('id', 'ASC')
                ->get('store');
    }

    public function getItemSpecifyRows($id)
    {
        return $this->db->select('*')
                ->where('id', $id)
                ->get('store')
                ->num_rows();
    }

    public function getItemSpecifyName($id)
    {
        return $this->db->select('name')
                ->where('id', $id)
                ->get('store')
                ->row('name');
    }

    public function getItemSpecifyDpPrice($id)
    {
        return $this->db->select('price_dp')
                ->where('id', $id)
                ->get('store')
                ->row_array()['price_dp'];
    }

    public function getItemSpecifyVpPrice($id)
    {
        return $this->db->select('price_vp')
                ->where('id', $id)
                ->get('store')
                ->row_array()['price_vp'];
    }

    public function getItemSpecifyId($id)
    {
        return $this->db->select('itemid')
                ->where('id', $id)
                ->get('store')
                ->row_array()['itemid'];
    }

    public function getItemSpecifyIcon($id)
    {
        return $this->db->select('iconname')
                ->where('id', $id)
                ->get('store')
                ->row_array()['iconname'];
    }

    public function getItemSpecifyImg($id)
    {
        return $this->db->select('image')
                ->where('id', $id)
                ->get('store')
                ->row_array()['image'];
    }

    public function getItemSpecifyGroup($id)
    {
        return $this->db->select('groups')
                ->where('id', $id)
                ->get('store')
                ->row_array()['groups'];
    }

    public function getGroupName($id)
    {
        return $this->db->select('name')
                    ->where('id', $id)
                    ->get('store_groups')
                    ->row_array()['name'];

    }

    public function getItemSpecifyType($id)
    {
        return $this->db->select('type')
                ->where('id', $id)
                ->get('store')
                ->row_array()['type'];
    }

    public function updateSpecifyItem($id, $name, $group, $type, $pricedp, $pricevp, $itemid, $icon, $image)
    {
        $update = array(
            'name' => $name,
            'groups' => $group,
            'type' => $type,
            'price_dp' => $pricedp,
            'price_vp' => $pricevp,
            'itemid' => $itemid,
            'iconname' => $icon,
            'image' => $image
        );

        $this->db->where('id', $id)
                ->update('store', $update);

        redirect(base_url('admin/items'),'refresh');
    }

    public function getGroupSpecifyRows($id)
    {
        return $this->db->select('*')
                ->where('id', $id)
                ->get('store_groups')
                ->num_rows();
    }

    public function updateSpecifyGroup($idlink, $group)
    {
        $update = array(
            'name' => $group,
        );

        $this->db->where('id', $idlink)
                ->update('store_groups', $update);

        redirect(base_url('admin/groups'),'refresh');
    }

    public function getChangelogs()
    {
        return $this->db->select('*')
                ->get('changelogs')
                ->result();
    }

    public function getPages()
    {
        return $this->db->select('*')
                ->get('pages')
                ->result();
    }

    public function delPage($id)
    {
        $this->db->where('id', $id)
                ->delete('pages');

        redirect(base_url('admin/pages'),'refresh');
    }

    public function delChangelog($id)
    {
        $this->db->where('id', $id)
                ->delete('changelogs');

        redirect(base_url('admin/changelogs'),'refresh');
    }

    public function delSpecifyNew($id)
    {
        $this->db->where('id', $id)
                ->delete('news');

        $this->db->where('id_new', $id)
                ->delete('news_top');

        redirect(base_url('admin/news'),'refresh');
    }

    public function getNewsSpecifyName($id)
    {
        return $this->db->select('title')
                ->where('id', $id)
                ->get('news')
                ->row_array()['title'];
    }

    public function getNewsSpecifyDesc($id)
    {
        return $this->db->select('description')
                ->where('id', $id)
                ->get('news')
                ->row_array()['description'];
    }

    public function getNewsSpecifyRows($id)
    {
        return $this->db->select('*')
                ->where('id', $id)
                ->get('news')
                ->num_rows();
    }

    public function getAdminAccountsList()
    {
        return $this->auth->select('id, username, email')
                ->order_by('id', 'ASC')
                ->get('account');
    }

    public function insertForum($name, $category, $description, $icon, $type)
    {
        $data = array(
            'name' => $name,
            'category' => $category,
            'description' => $description,
            'icon' => $icon,
            'type' => $type,
        );

        $this->db->insert('forum_forums', $data);

        redirect(base_url('admin/forums'),'refresh');
    }

    public function deleteForum($id)
    {
        $this->db->where('id', $id)
                ->delete('forum_forums');

        redirect(base_url('admin/forums'),'refresh');
    }

    public function getForumCategoryListAjax()
    {
        return $this->db->select('*')
            ->order_by('id', 'ASC')
            ->get('forum_category');
    }

    public function getSpecifyForumCategoryName($id)
    {
        return $this->db->select('categoryName')
                ->where('id', $id)
                ->get('forum_category')
                ->row_array()['categoryName'];
    }

    public function getSpecifyForumName($id)
    {
        return $this->db->select('name')
                ->where('id', $id)
                ->get('forum_forums')
                ->row_array()['name'];
    }

    public function getSpecifyForumDesc($id)
    {
        return $this->db->select('description')
                ->where('id', $id)
                ->get('forum_forums')
                ->row_array()['description'];
    }

    public function getSpecifyForumIcon($id)
    {
        return $this->db->select('icon')
                ->where('id', $id)
                ->get('forum_forums')
                ->row_array()['icon'];
    }

    public function getSpecifyForumCategory($id)
    {
        return $this->db->select('category')
                ->where('id', $id)
                ->get('forum_forums')
                ->row_array()['category'];
    }

    public function getSpecifyForumType($id)
    {
        return $this->db->select('type')
                ->where('id', $id)
                ->get('forum_forums')
                ->row_array()['type'];
    }

    public function getSpecifyForumRows($id)
    {
        return $this->db->select('*')
                ->where('id', $id)
                ->get('forum_forums')
                ->num_rows();
    }

    public function updateSpecifyForum($id, $name, $category, $description, $icon, $type)
    {
        $update = array(
            'name' => $name,
            'category' => $category,
            'description' => $description,
            'icon' => $icon,
            'type' => $type
        );

        $this->db->where('id', $id)
                ->update('forum_forums', $update);

        redirect(base_url('admin/forums'),'refresh');
    }

    public function insertCategoryAjax($name)
    {
        $data = array(
            'categoryName' => $name
        );
        $this->db->insert('forum_category', $data);
    }

    public function insertDonationAjax($name, $price, $tax, $points)
    {
        $data = array(
            'name' => $name,
            'price' => $price,
            'tax' => $price,
            'points' => $price
        );
        $this->db->insert('donate', $data);
    }

    public function updateCategoryAjax($id, $name, $column)
    {
        $this->db->set($column, $name)
                ->where('id', $id)
                ->update('forum_category');
    }

    public function deleteCategoryAjax($id)
    {
        $this->db->where('id', $id)
                ->delete('forum_category');
    }

    public function deleteDonationAjax($id)
    {
        $this->db->where('id', $id)
                ->delete('donate');
    }

    public function getForumForumList()
    {
        return $this->db->select('*')
            ->order_by('id', 'ASC')
            ->get('forum_forums');
    }

    public function getAdminCharactersList($multirealm)
    {
        $this->multirealm = $multirealm;
        return $this->multirealm->select('guid, account, name')
            ->order_by('name', 'ASC')
            ->get('characters');
    }

    public function insertBanChar($id, $reason, $multirealm, $idrealm)
    {
        $date       = $this->m_data->getTimestamp();
        $idsession  = $this->session->userdata('fx_sess_id');

        if (empty($reason))
            $reason = $this->lang->line('log_banned');

        $data2 = array(
            'guid' => $id,
            'bandate,' => $date,
            'unbandate' => $date,
            'bannedby' => $idsession,
            'banreason' => $reason,
            'active' => '1'
        );

        $this->multirealm = $multirealm;
        $this->multirealm->insert('character_banned', $data2);

        $data1 = array(
            'idchar' => $id,
            'annotation' => $this->lang->line('alert_banned_reason').' '.$reason,
            'date' => $date,
            'realmid' => $idrealm
        );

        $this->db->insert('chars_annotations', $data1);

        redirect(base_url().'admin/managecharacter/'.$id.'/'.$idrealm,'refresh');
    }

    public function insertCustomizeChar($id, $multirealm, $idrealm)
    {
        if ($this->m_characters->getCharActive($id, $multirealm) == '1')
            redirect(base_url().'admin/managecharacter/'.$id.'/'.$idrealm.'?char','refresh');

        $date       = $this->m_data->getTimestamp();
        $annotation = $this->lang->line('log_customization');

        $data = array(
            'idchar' => $id,
            'annotation' => $annotation,
            'date' => $date,
            'realmid' => $idrealm
        );

        $this->db->insert('chars_annotations', $data);

        $this->multirealm = $multirealm;
        $this->multirealm->set('at_login', '8')
                ->where('guid', $id)
                ->update('characters');

        redirect(base_url().'admin/managecharacter/'.$id.'/'.$idrealm,'refresh');
    }

    public function getDonateListAjax()
    {
        return $this->db->select('*')
            ->order_by('id', 'ASC')
            ->get('donate');
    }

    public function updateDonationAjax($id, $name, $column)
    {
        $this->db->set($column, $name)
                ->where('id', $id)
                ->update('donate');
    }

    public function delSpecifyDonation($id)
    {
        $this->db->where('id', $id)
                ->delete('donate');

        redirect(base_url('admin/donate'),'refresh');
    }

    public function insertDonation($name, $price, $tax, $points)
    {
        $data = array(
            'name' => $name,
            'price' => $price,
            'tax' => $tax,
            'points' => $points,
        );

        $this->db->insert('donate', $data);

        redirect(base_url('admin/donate'),'refresh');
    }

    public function getAdminNewsList()
    {
        return $this->db->select('id, title, date')
            ->order_by('id', 'ASC')
            ->get('news');
    }

    public function getUserHistoryDonate($id)
    {
        return $this->db->select('*')
                ->where('user_id', $id)
                ->order_by('id', 'DESC')
                ->get('donate_history');
    }

    public function getDonateStatus($id)
    {
        switch ($id) {
            case 0: return $this->lang->line('status_donate_cancell'); break;
            case 1: return $this->lang->line('status_donate_complete'); break;
        }
    }

    public function insertNews($title, $image, $description, $type)
    {
        $date = $this->m_data->getTimestamp();

        $data = array(
            'title' => $title,
            'image' => $image,
            'description' => $description,
            'date' => $date,
        );

        $this->db->insert('news', $data);

        if ($type == 2)
        {
            $id = $this->getNewIDperDate($date);

            $data = array(
            'id_new' => $id,
            );

            $this->db->insert('news_top', $data);
        }

        redirect(base_url('admin/news'),'refresh');
    }

    public function updateSpecifyNews($id, $title, $image, $description, $type)
    {
        $unlink = $this->getFileNameImage($id);
        unlink('./assets/images/news/'.$unlink);

        $date = $this->m_data->getTimestamp();

        $update1 = array(
            'title' => $title,
            'image' => $image,
            'description' => $description,
            'date' => $date
        );

        $this->db->where('id', $id)
                ->update('news', $update1);

        $this->db->where('id_new', $id)
                ->delete('news_top');

        if ($type == 2)
        {
            $data['id_new'] = $id;

            $this->db->insert('news_top', $data);
        }

        redirect(base_url('admin/news'),'refresh');
    }

    public function getNewIDperDate($date)
    {
        return $this->db->select('id')
            ->where('date', $date)
            ->get('news')
            ->row('id');
    }

    public function getFileNameImage($id)
    {
        return $this->db->select('image')
            ->where('id', $id)
            ->get('news')
            ->row_array()['image'];
    }

    public function insertChangeFactionChar($id, $multirealm, $idrealm)
    {
        if ($this->m_characters->getCharActive($id, $multirealm) == '1')
            redirect(base_url().'admin/managecharacter/'.$id.'/'.$idrealm.'?char','refresh');

        $date       = $this->m_data->getTimestamp();
        $annotation = $this->lang->line('log_change_faction');

        $data = array(
                'idchar' => $id,
                'annotation' => $annotation,
                'date' => $date,
                'realmid' => $idrealm
            );

        $this->db->insert('chars_annotations', $data);

        $this->multirealm = $multirealm;
        $this->multirealm->set('at_login', '64')
                ->where('guid', $id)
                ->update('characters');

        redirect(base_url().'admin/managecharacter/'.$id.'/'.$idrealm,'refresh');
    }

    public function insertChangeRaceChar($id, $multirealm, $idrealm)
    {
        if ($this->m_characters->getCharActive($id, $multirealm) == '1')
            redirect(base_url().'admin/managecharacter/'.$id.'/'.$idrealm.'?char','refresh');

        $date       = $this->m_data->getTimestamp();
        $annotation = $this->lang->line('log_change_race');

        $data = array(
               'idchar' => $id,
               'annotation' => $annotation,
               'date' => $date,
               'realmid' => $idrealm
            );

        $this->db->insert('chars_annotations', $data);

        $this->multirealm = $multirealm;
        $this->multirealm->set('at_login', '128')
                ->where('guid', $id)
                ->update('characters');

        redirect(base_url().'admin/managecharacter/'.$id.'/'.$idrealm,'refresh');
    }

    public function insertUnbanChar($id, $multirealm, $idrealm)
    {
        $this->multirealm = $multirealm;
        $this->multirealm->where('guid', $id)
                ->delete('character_banned');

        $date       = $this->m_data->getTimestamp();
        $annotation = $this->lang->line('log_unbanned');

        $data = array(
                'idchar' => $id,
                'annotation' => $annotation,
                'date' => $date,
                'realmid' => $idrealm
            );

        $this->db->insert('chars_annotations', $data);

        redirect(base_url().'admin/managecharacter/'.$id.'/'.$idrealm,'refresh');
    }

    public function insertCharRename($id, $name, $multirealm, $realm)
    {
        if ($this->m_characters->getCharActive($id, $multirealm) == '1')
            redirect(base_url().'admin/managecharacter/'.$id.'/'.$realm.'?char','refresh');

        if ($this->m_characters->getCharNameAlreadyExist($name, $multirealm)->num_rows())
            redirect(base_url().'admin/managecharacter/'.$id.'/'.$realm.'?name','refresh');

        $date       = $this->m_data->getTimestamp();
        $annotation = $this->lang->line('log_new_name').' -> '.$name.' | '.$this->lang->line('log_old_name').' -> '.$this->m_characters->getCharName($id, $multirealm);

        $data = array(
                'idchar' => $id,
                'annotation' => $annotation,
                'date' => $date,
                'realmid' => $realm
            );

        $this->db->insert('chars_annotations', $data);

        $this->multirealm = $multirealm;
        $this->multirealm->set('name', $name)
                ->where('guid', $id)
                ->update('characters');

        redirect(base_url().'admin/managecharacter/'.$id.'/'.$realm,'refresh');
    }

    public function insertChangeLevelChar($id, $level, $multirealm, $realm)
    {
        if ($this->m_characters->getCharActive($id, $multirealm) == '1')
            redirect(base_url().'admin/managecharacter/'.$id.'/'.$realm.'?char','refresh');

        $date       = $this->m_data->getTimestamp();
        $annotation = $this->lang->line('log_new_level').' -> '.$level.' | '.$this->lang->line('log_old_level').' -> '.$this->m_characters->getCharLevel($id, $multirealm);

        $data = array(
                'idchar' => $id,
                'annotation' => $annotation,
                'date' => $date,
                'realmid' => $realm
            );

        $this->db->insert('chars_annotations', $data);

        $this->multirealm = $multirealm;
        $this->multirealm->set('level', $level)
                ->where('guid', $id)
                ->update('characters');

        redirect(base_url().'admin/managecharacter/'.$id.'/'.$realm,'refresh');
    }

    public function getAnnotationsSpecifyChar($id, $realm)
    {
        return $this->db->select('*')
            ->where('idchar', $id)
            ->where('realmid', $realm)
            ->order_by('id', 'DESC')
            ->get('chars_annotations');
    }

    public function insertRankAcc($id, $gmlevel)
    {
        $data = array(
                'id' => $id,
                'gmlevel' => $gmlevel,
                'RealmID' => '-1',
            );

        $this->auth->insert('account_access', $data);

        $date   = $this->m_data->getTimestamp();
        $reason = $this->lang->line('log_gm_assigned');

        $data = array(
                'iduser' => $id,
                'annotation' => $reason,
                'date' => $date,
            );

        $this->db->insert('users_annotations', $data);

        redirect(base_url().'admin/manageaccount/'.$id,'refresh');
    }

    public function getAnnotationsSpecify($id)
    {
        return $this->db->select('*')
            ->where('iduser', $id)
            ->get('users_annotations');
    }

    public function inserUnBanAcc($id)
    {
        $date = $this->m_data->getTimestamp();

        if (empty($reason))
            $reason = $this->lang->line('log_unbanned');

        $data = array(
                'iduser' => $id,
                'annotation' => $reason,
                'date' => $date,
            );

        $this->db->insert('users_annotations', $data);

        $this->auth->where('id', $id)
                ->delete('account_banned');

        if ($this->m_general->getExpansionAction() == 2)
            $this->auth->where('id', $id)
                    ->delete('battlenet_account_bans');

        redirect(base_url().'admin/manageaccount/'.$id,'refresh');
    }

    public function removeRankAcc($id)
    {
        $this->auth->where('id', $id)
                ->delete('account_access');

        $date   = $this->m_data->getTimestamp();
        $reason = $this->lang->line('log_gm_removed');

        $data = array(
                'iduser' => $id,
                'annotation' => $reason,
                'date' => $date,
            );

        $this->db->insert('users_annotations', $data);

        redirect(base_url().'admin/manageaccount/'.$id,'refresh');
    }

    public function insertBanAcc($iduser, $reason)
    {
        $date = $this->m_data->getTimestamp();
        $id   = $this->session->userdata('fx_sess_id');

        if (empty($reason))
            $reason = $this->lang->line('log_banned');

        $data1 = array(
                'iduser' => $iduser,
                'annotation' => $reason,
                'date' => $date,
            );

        $this->db->insert('users_annotations', $data1);

        $data2 = array(
                'id' => $iduser,
                'bandate' => $date,
                'unbandate' => $date,
                'bannedby' => $id,
                'banreason' => $reason,
            );

        $this->auth->insert('account_banned', $data2);

        if ($this->m_general->getExpansionAction() == 2)
            $this->auth->insert('battlenet_account_bans', $data2);

        redirect(base_url().'admin/manageaccount/'.$iduser,'refresh');
    }

    public function getBanCount()
    {
        return $this->auth->select('id')
            ->get('account_banned')
            ->num_rows();
    }

    public function getBanSpecify($id)
    {
        return $this->auth->select('*')
            ->where('id', $id)
            ->where('active', '1')
            ->get('account_banned');
    }

    public function getGmCount($idrealm)
    {
        return $this->auth->select('id')
            ->where('RealmID', $idrealm)
            ->or_where('RealmID', '-1')
            ->get('account_access')
            ->num_rows();
    }

    public function getAccCreated()
    {
        return $this->auth->select('id')
            ->get('account')
            ->num_rows();
    }

    public function getCharOn($multirealm)
    {
        $this->multirealm = $multirealm;

        return $this->multirealm->select('*')
            ->where('online', '1')
            ->get('characters')
            ->num_rows();
    }

    public function getNewsCreated()
    {
        return $this->db->select('id')
            ->get('news')
            ->num_rows();
    }

    public function getChangelogsCreated()
    {
        return $this->db->select('id')
            ->get('changelogs')
            ->num_rows();
    }

    //blizzcms
    public function settingBlizzCMS($data)
    {
        $filename = $data['filename'];

        $Configsearch = array(
            $data['actualName'],
            $data['actualTimeZone'],
            $data['actualDiscord'],
            $data['actualRealmlist'],
            $data['actualStaffColor'],
            $data['actualTheme']
        );

        $Configreplace = array(
            $data['blizzcmsName'],
            $data['blizzcmsTimeZone'],
            $data['blizzcmsDiscord'],
            $data['blizzcmsRealmlist'],
            $data['blizzcmsStaffColor'],
            $data['blizzcmsThemeName']
        );

        $fileConfig = file_get_contents($filename);
        $newConfig = str_replace($Configsearch, $Configreplace, $fileConfig);
        $openConfig = fopen($filename,"w");
        fwrite($openConfig, $newConfig);
        fclose($openConfig);

        redirect(base_url('admin/settings'),'refresh');
    }

    public function getProjectName($filename)
    {
        $fileHandle = file($filename);
        $fileHandle = substr($fileHandle[11], 26);
        $fileHandle = explode(";", $fileHandle);
        return str_replace("'", "", $fileHandle[0]);
    }

    public function getTimeZone($filename)
    {
        $fileHandle = file($filename);
        $fileHandle = substr($fileHandle[21], 23);
        $fileHandle = explode(";", $fileHandle);
        return str_replace("'", "", $fileHandle[0]);
    }

    public function getDiscordInv($filename)
    {
        $fileHandle = file($filename);
        $fileHandle = substr($fileHandle[42], 25);
        $fileHandle = explode(";", $fileHandle);
        return str_replace("'", "", $fileHandle[0]);
    }

    public function getRealmlist($filename)
    {
        $fileHandle = file($filename);
        $fileHandle = substr($fileHandle[52], 24);
        $fileHandle = explode(";", $fileHandle);
        return str_replace("'", "", $fileHandle[0]);
    }

    public function getStaffColor($filename)
    {
        $fileHandle = file($filename);
        $fileHandle = substr($fileHandle[65], 31);
        $fileHandle = explode(";", $fileHandle);
        return str_replace("'", "", $fileHandle[0]);
    }

    public function getThemeName($filename)
    {
        $fileHandle = file($filename);
        $fileHandle = substr($fileHandle[96], 25);
        $fileHandle = explode(";", $fileHandle);
        return str_replace("'", "", $fileHandle[0]);
    }

    //database
    public function settingDatabase($data)
    {
        $filename = $data['filename'];

        $Configsearch = array(
            $data['actualdbCmsHost'],
            $data['actualdbCmsUser'],
            $data['actualdbCmsPassword'],
            $data['actualdbCmsdbName'],
            $data['actualdbAuthHost'],
            $data['actualdbAuthUser'],
            $data['actualdbAuthPassword'],
            $data['actualdbAuthName']
        );

        $Configreplace = array(
            $data['dbCmsHost'],
            $data['dbCmsUser'],
            $data['dbCmsPassword'],
            $data['dbCmsName'],
            $data['dbAuthHost'],
            $data['dbAuthUser'],
            $data['dbAuthPassword'],
            $data['dbAuthName']
        );

        $fileConfig = file_get_contents($filename);
        $newConfig = str_replace($Configsearch, $Configreplace, $fileConfig);
        $openConfig = fopen($filename,"w");
        fwrite($openConfig, $newConfig);
        fclose($openConfig);

        redirect(base_url('admin/settings'),'refresh');
    }

    public function getDatabaseCmsHost($filename)
    {
        $fileHandle = file($filename);
        $fileHandle = substr($fileHandle[8], 16);
        $fileHandle = explode(",", $fileHandle);
        return str_replace("'", "", $fileHandle[0]);
    }

    public function getDatabaseCmsUser($filename)
    {
        $fileHandle = file($filename);
        $fileHandle = substr($fileHandle[9], 16);
        $fileHandle = explode(",", $fileHandle);
        return str_replace("'", "", $fileHandle[0]);
    }

    public function getDatabaseCmsPassword($filename)
    {
        $fileHandle = file($filename);
        $fileHandle = substr($fileHandle[10], 16);
        $fileHandle = explode(",", $fileHandle);
        return str_replace("'", "", $fileHandle[0]);
    }

    public function getDatabaseCmsName($filename)
    {
        $fileHandle = file($filename);
        $fileHandle = substr($fileHandle[11], 16);
        $fileHandle = explode(",", $fileHandle);
        return str_replace("'", "", $fileHandle[0]);
    }

    public function getDatabaseAuthHost($filename)
    {
        $fileHandle = file($filename);
        $fileHandle = substr($fileHandle[30], 16);
        $fileHandle = explode(",", $fileHandle);
        return str_replace("'", "", $fileHandle[0]);
    }

    public function getDatabaseAuthUser($filename)
    {
        $fileHandle = file($filename);
        $fileHandle = substr($fileHandle[31], 16);
        $fileHandle = explode(",", $fileHandle);
        return str_replace("'", "", $fileHandle[0]);
    }

    public function getDatabaseAuthPassword($filename)
    {
        $fileHandle = file($filename);
        $fileHandle = substr($fileHandle[32], 16);
        $fileHandle = explode(",", $fileHandle);
        return str_replace("'", "", $fileHandle[0]);
    }

    public function getDatabaseAuthName($filename)
    {
        $fileHandle = file($filename);
        $fileHandle = substr($fileHandle[33], 16);
        $fileHandle = explode(",", $fileHandle);
        return str_replace("'", "", $fileHandle[0]);
    }

    //recaptcha
    public function settingRecaptcha($data)
    {
        $filename = $data['filename'];

        $Configsearch = array(
            $data['actualrecaptchaKey']
        );

        $Configreplace = array(
            $data['recaptchaKey']
        );

        $fileConfig = file_get_contents($filename);
        $newConfig = str_replace($Configsearch, $Configreplace, $fileConfig);
        $openConfig = fopen($filename,"w");
        fwrite($openConfig, $newConfig);
        fclose($openConfig);

        redirect(base_url('admin/settings'),'refresh');
    }

    public function getRecaptchaKey($filename)
    {
        $fileHandle = file($filename);
        $fileHandle = substr($fileHandle[13], 31);
        $fileHandle = explode(";", $fileHandle);
        return str_replace("'", "", $fileHandle[0]);
    }

    //smtp
    public function settingSMTP($data)
    {
        $filename = $data['filename'];

        $Configsearch = array(
            $data['actualsmtpHost'],
            $data['actualsmtpUser'],
            $data['actualsmtpPass'],
            $data['actualsmtpPort'],
            $data['actualsmtpCrypto'],
            $data['actualsenderEmail'],
            $data['actualsenderName']
        );

        $Configreplace = array(
            $data['smtpHost'],
            $data['smtpUser'],
            $data['smtpPass'],
            $data['smtpPort'],
            $data['smtpCrypto'],
            $data['senderEmail'],
            $data['senderName']
        );

        $fileConfig = file_get_contents($filename);
        $newConfig = str_replace($Configsearch, $Configreplace, $fileConfig);
        $openConfig = fopen($filename,"w");
        fwrite($openConfig, $newConfig);
        fclose($openConfig);

        redirect(base_url('admin/settings'),'refresh');
    }

    public function getSMTPHost($filename)
    {
        $fileHandle = file($filename);
        $fileHandle = substr($fileHandle[24], 23);
        $fileHandle = explode(";", $fileHandle);
        return str_replace("'", "", $fileHandle[0]);
    }

    public function getSMTPUser($filename)
    {
        $fileHandle = file($filename);
        $fileHandle = substr($fileHandle[25], 23);
        $fileHandle = explode(";", $fileHandle);
        return str_replace("'", "", $fileHandle[0]);
    }

    public function getSMTPPass($filename)
    {
        $fileHandle = file($filename);
        $fileHandle = substr($fileHandle[26], 23);
        $fileHandle = explode(";", $fileHandle);
        return str_replace("'", "", $fileHandle[0]);
    }

    public function getSMTPPort($filename)
    {
        $fileHandle = file($filename);
        $fileHandle = substr($fileHandle[27], 23);
        $fileHandle = explode(";", $fileHandle);
        return str_replace("'", "", $fileHandle[0]);
    }

    public function getSMTPCrypto($filename)
    {
        $fileHandle = file($filename);
        $fileHandle = substr($fileHandle[28], 25);
        $fileHandle = explode(";", $fileHandle);
        return str_replace("'", "", $fileHandle[0]);
    }

    public function getSenderEmail($filename)
    {
        $fileHandle = file($filename);
        $fileHandle = substr($fileHandle[38], 35);
        $fileHandle = explode(";", $fileHandle);
        return str_replace("'", "", $fileHandle[0]);
    }

    public function getSenderName($filename)
    {
        $fileHandle = file($filename);
        $fileHandle = substr($fileHandle[39], 40);
        $fileHandle = explode(";", $fileHandle);
        return str_replace("'", "", $fileHandle[0]);
    }

    //register
    public function settingRegister($data)
    {
        $filename = $data['filename'];

        $Configsearch = array(
            $data['actualregisterType']
        );

        $Configreplace = array(
            $data['registerType']
        );

        $fileConfig = file_get_contents($filename);
        $newConfig = str_replace($Configsearch, $Configreplace, $fileConfig);
        $openConfig = fopen($filename,"w");
        fwrite($openConfig, $newConfig);
        fclose($openConfig);

        redirect(base_url('admin/settings'),'refresh');
    }

    public function getRegisterType($filename)
    {
        $fileHandle = file($filename);
        $fileHandle = substr($fileHandle[52], 41);
        $fileHandle = explode(";", $fileHandle);
        return str_replace("'", "", $fileHandle[0]);
    }

    //bugtracker
    public function settingBugtracker($data)
    {
        $filename = $data['filename'];

        $Configsearch = array(
            $data['actualbugtrackerText']
        );

        $Configreplace = array(
            $data['bugtrackerText']
        );

        $fileConfig = file_get_contents($filename);
        $newConfig = str_replace($Configsearch, $Configreplace, $fileConfig);
        $openConfig = fopen($filename,"w");
        fwrite($openConfig, $newConfig);
        fclose($openConfig);

        redirect(base_url('admin/settings'),'refresh');
    }

    public function getBugtrackerText($filename)
    {
        $fileHandle = file($filename);
        $fileHandle = substr($fileHandle[11], 23);
        $fileHandle = explode(";", $fileHandle);
        return str_replace("'", "", $fileHandle[0]);
    }

    //donate
    public function settingDonate($data)
    {
        $filename = $data['filename'];

        $Configsearch = array(
            $data['actualpaypalCurrency'],
            $data['actualpaypalMode'],
            $data['actualpaypalclientId'],
            $data['actualpaypalPassword']
        );

        $Configreplace = array(
            $data['paypalCurrency'],
            $data['paypalMode'],
            $data['paypalclientId'],
            $data['paypalPassword']
        );

        $fileConfig = file_get_contents($filename);
        $newConfig = str_replace($Configsearch, $Configreplace, $fileConfig);
        $openConfig = fopen($filename,"w");
        fwrite($openConfig, $newConfig);
        fclose($openConfig);

        redirect(base_url('admin/settings'),'refresh');
    }

    public function getPaypalCurrency($filename)
    {
        $fileHandle = file($filename);
        $fileHandle = substr($fileHandle[12], 27);
        $fileHandle = explode(";", $fileHandle);
        return str_replace("'", "", $fileHandle[0]);
    }

    public function getPaypalMode($filename)
    {
        $fileHandle = file($filename);
        $fileHandle = substr($fileHandle[25], 21);
        $fileHandle = explode(";", $fileHandle);
        return str_replace("'", "", $fileHandle[0]);
    }

    public function getPaypalClientID($filename)
    {
        $fileHandle = file($filename);
        $fileHandle = substr($fileHandle[36], 21);
        $fileHandle = explode(";", $fileHandle);
        return str_replace("'", "", $fileHandle[0]);
    }

    public function getPaypalPassword($filename)
    {
        $fileHandle = file($filename);
        $fileHandle = substr($fileHandle[47], 25);
        $fileHandle = explode(";", $fileHandle);
        return str_replace("'", "", $fileHandle[0]);
    }

    //ranks
    public function settingRanks($data)
    {
        $filename = $data['filename'];

        $Configsearch = array(
            $data['actualadminLevel'],
            $data['actualmodLevel']
        );

        $Configreplace = array(
            $data['adminLevel'],
            $data['modLevel']
        );

        $fileConfig = file_get_contents($filename);
        $newConfig = str_replace($Configsearch, $Configreplace, $fileConfig);
        $openConfig = fopen($filename,"w");
        fwrite($openConfig, $newConfig);
        fclose($openConfig);

        redirect(base_url('admin/settings'),'refresh');
    }

    public function getRankAdminLevel($filename)
    {
        $fileHandle = file($filename);
        $fileHandle = substr($fileHandle[62], 32);
        $fileHandle = explode(";", $fileHandle);
        return str_replace("'", "", $fileHandle[0]);
    }

    public function getRankModLevel($filename)
    {
        $fileHandle = file($filename);
        $fileHandle = substr($fileHandle[72], 30);
        $fileHandle = explode(";", $fileHandle);
        return str_replace("'", "", $fileHandle[0]);
    }

    public function delSpecifyRealm($id)
    {
        $this->db->where('id', $id)
                ->delete('realms');

        redirect(base_url('admin/settings'),'refresh');
    }

    public function insertNewSlides($title, $image)
    {
        $data = array(
            'title' => $title,
            'image' => $image,
        );

        $this->db->insert('slides', $data);

        redirect(base_url('admin/slides'),'refresh');
    }

    public function delSpecifySlide($id)
    {
        $this->db->where('id', $id)
                ->delete('slides');

        redirect(base_url('admin/slides'),'refresh');
    }

    public function getAdminSlideList()
    {
        return $this->db->select('id, title')
            ->order_by('id', 'ASC')
            ->get('slides');
    }

    public function delSpecifyFaq($id)
    {
        $this->db->where('id', $id)
                ->delete('faq');

        redirect(base_url('admin/faq'),'refresh');
    }

    public function getFaqSpecifyName($id)
    {
        return $this->db->select('title')
                ->where('id', $id)
                ->get('faq')
                ->row_array()['title'];
    }

    public function getFaqSpecifyType($id)
    {
        return $this->db->select('type')
                ->where('id', $id)
                ->get('faq')
                ->row_array()['type'];
    }

    public function getFaqSpecifyDesc($id)
    {
        return $this->db->select('description')
                ->where('id', $id)
                ->get('faq')
                ->row_array()['description'];
    }

    public function getFaqSpecifyRows($id)
    {
        return $this->db->select('*')
                ->where('id', $id)
                ->get('faq')
                ->num_rows();
    }

    public function getFaqTypeList()
    {
        return $this->db->select('*')
            ->order_by('id', 'ASC')
            ->get('faq_type');
    }

    public function getFaq()
    {
        return $this->db->select('*')
                ->get('faq')
                ->result();
    }

    public function getFaqTypeName($type)
    {
        return $this->db->select('title')
                ->where('id', $type)
                ->get('faq_type')
                ->row_array()['title'];
    }

    public function insertFaq($title, $type, $description)
    {
        $date = $this->m_data->getTimestamp();

        $data = array(
            'title' => $title,
            'type' => $type,
            'description' => $description,
            'date' => $date,
        );

        $this->db->insert('faq', $data);

        redirect(base_url('admin/faq'),'refresh');
    }

    public function updateSpecifyFaq($id, $title, $type, $description)
    {
        $date = $this->m_data->getTimestamp();

        $update = array(
            'title' => $title,
            'type' => $type,
            'description' => $description,
            'date' => $date
        );

        $this->db->where('id', $id)
                ->update('faq', $update);

        redirect(base_url('admin/faq'),'refresh');
    }

    public function getTopsites()
    {
        return $this->db->select('*')
                ->get('votes')
                ->result();
    }

    public function delTopsite($id)
    {
        $this->db->where('id', $id)
                ->delete('votes');

        redirect(base_url('admin/topsites'),'refresh');
    }

    public function insertTopsite($name, $url, $time, $points, $image)
    {
        $data = array(
            'name' => $name,
            'url' => $url,
            'time' => $time,
            'points' => $points,
            'image' => $image,
        );

        $this->db->insert('votes', $data);

        redirect(base_url('admin/topsites'),'refresh');
    }

    public function getTopsitesSpecifyRows($id)
    {
        return $this->db->select('*')
                ->where('id', $id)
                ->get('votes')
                ->num_rows();
    }

    public function getTopsiteSpecifyName($id)
    {
        return $this->db->select('name')
                ->where('id', $id)
                ->get('votes')
                ->row('name');
    }

    public function getTopsiteSpecifyURL($id)
    {
        return $this->db->select('url')
                ->where('id', $id)
                ->get('votes')
                ->row('url');
    }

    public function getTopsiteSpecifyTime($id)
    {
        return $this->db->select('time')
                ->where('id', $id)
                ->get('votes')
                ->row('time');
    }

    public function getTopsiteSpecifyPoints($id)
    {
        return $this->db->select('points')
                ->where('id', $id)
                ->get('votes')
                ->row('points');
    }

    public function getTopsiteSpecifyImage($id)
    {
        return $this->db->select('image')
                ->where('id', $id)
                ->get('votes')
                ->row('image');
    }

    public function updateSpecifyTopsite($id, $name, $url, $time, $points, $image)
    {
        $update = array(
            'name' => $name,
            'url' => $url,
            'time' => $time,
            'points' => $points,
            'image' => $image,
        );

        $this->db->where('id', $id)
                ->update('votes', $update);

        redirect(base_url('admin/topsites'),'refresh');
    }

    public function getModules()
    {
        return $this->db->select('*')
                ->get('modules')
                ->result();
    }

    public function enableSpecifyModule($id)
    {
        $update = array(
            'status' => '1'
        );

        $this->db->where('id', $id)
                ->update('modules', $update);

        redirect(base_url('admin/modules'),'refresh');
    }

    public function disableSpecifyModule($id)
    {
        $update = array(
            'status' => '0'
        );

        $this->db->where('id', $id)
                ->update('modules', $update);

        redirect(base_url('admin/modules'),'refresh');
    }
}
