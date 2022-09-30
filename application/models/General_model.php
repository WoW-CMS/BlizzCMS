<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class General_model extends CI_Model {

    protected const RACES = [
        'text' => 
        [
            1 => 'race_human',
            2 => 'race_orc', 
            3 => 'race_dwarf',
            4 => 'race_night_elf',
            5 => 'race_undead',
            6 => 'race_tauren',
            7 => 'race_gnome',
            8 => 'race_troll',
            9 => 'race_goblin',
            10 => 'race_blood_elf',
            11 => 'race_draenei',
            22 => 'race_worgen',
            24 => 'race_panda_neutral'
            25 => 'race_panda_alli',
            26 => 'race_panda_horde',
            27 => 'race_nightborne',
            28 => 'race_highmountain_taure',
            29 => 'race_void_elf',
            30 => 'race_lightforged_draenei',
            34 => 'race_dark_iron_dwarf',
            35 => 'race_vulpera',
            36 => 'race_maghar_orc'
        ],
        'icon' => 
        [
            1 => 'human.jpg',
            2 => 'orc.jpg', 
            3 => 'dwarf.jpg',
            4 => 'night_elf.jpg',
            5 => 'undead.jpg',
            6 => 'tauren.jpg',
            7 => 'gnome.jpg',
            8 => 'troll.jpg',
            9 => 'goblin.jpg',
            10 => 'blood_elf.jpg',
            11 => 'draenei.jpg',
            22 => 'worgen.jpg',
            24 => 'pandaren_male.jpg',
            25 => 'pandaren_male.jpg',
            26 => 'pandaren_male.jpg',
            27 => 'nightborne.png',
            28 => 'highmountain.png',
            29 => 'voidelf.png',
            30 => 'lightforged.png',
            34 => 'irondwarf.png',
            35 => 'vulpera.png',
            36 => 'magharorc.png'
        ],
    ];

    /**
     * General_model constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function getTimestamp()
    {
        $date = new DateTime();
        return $date->getTimestamp();
    }

    public function getMaintenance()
    {
        $config = $this->config->item('maintenance_mode');

        if($config == '1' && !$this->wowauth->isLogged())
        {
            if($this->wowauth->getRank($this->session->userdata('wow_sess_id')) >= config_item('mod_access_level'))
                return true;
            else
                return false;
        }
        else
            return true;
    }

    public function getUserInfoGeneral($id)
    {
        return $this->db->select('*')->where('id', $id)->get('users');
    }

    public function getCharDPTotal($id)
    {
        $qq = $this->db->select('dp')->where('id', $id)->get('users');

        if ($qq->num_rows())
            return $qq->row('dp');
        else
            return '0';
    }

    public function getCharVPTotal($id)
    {
        $qq = $this->db->select('vp')->where('id', $id)->get('users');

        if ($qq->num_rows())
            return $qq->row('vp');
        else
            return '0';
    }

    public function getEmulatorAction()
    {
        $emulator = $this->config->item('emulator_legacy');

        if($emulator == true)
        {
            switch($emulator)
            {
                case true:
                    return "1";
                break;
            }
        }

    }

    public function getExpansionAction()
    {
        $expansion = $this->config->item('expansion');
        switch ($expansion)
        {
            case 1:
            case 2:
            case 3:
            case 4:
            case 5:
                return "1";
            break;
            case 6:
            case 7:
            case 8:
                return "2";
            break;
        }
    }

    public function getExpansionName()
    {
        $expansion = $this->config->item('expansion');
        switch ($expansion)
        {
            case 1:
                return "Vanilla";
                break;
            case 2:
                return "The Burning Crusade";
                break;
            case 3:
                return "Wrath of the Lich King";
                break;
            case 4:
                return "Cataclysm";
                break;
            case 5:
                return "Mist of Pandaria";
                break;
            case 6:
                return "Warlords of Draenor";
                break;
            case 7:
                return "Legion";
                break;
            case 8:
                return "Battle of Azeroth";
                break;
            case 9:
                return "ShadowLands";
                break;
        }
    }

    public function getMaxLevel()
    {
        $expansion = $this->config->item('expansion');
        switch ($expansion)
        {
            case 1:
                return "60";
                break;
            case 2:
                return "70";
                break;
            case 3:
                return "80";
                break;
            case 4:
                return "85";
                break;
            case 5:
                return "90";
                break;
            case 6:
                return "100";
                break;
            case 7:
                return "110";
                break;
            case 8:
                return "120";
                break;
            case 9:
                return "60";
                break;
        }
    }

    public function getRealExpansionDB()
    {
        $expansion = $this->config->item('expansion');
        switch ($expansion)
        {
            case 1:
                return "0";
                break;
            case 2:
                return "1";
                break;
            case 3:
                return "2";
                break;
            case 4:
                return "3";
                break;
            case 5:
                return "4";
                break;
            case 6:
                return "5";
                break;
            case 7:
                return "6";
                break;
            case 8:
                return "7";
                break;
            case 9:
                return "8";
                break;
        }
    }

    public function getRaceName(int $race)
    {
        if (empty($race)) {
            return false;
        }
        
        return self::RACES['text'][$race];
    }

    public function getRaceIcon(int $race)
    {
        if (empty($race)) {
            return false;
        }
        
        return self::RACES['icon'][$race];
    }

    public function getClassIcon($race)
    {
        switch ($race)
        {
            case 1:
                return 'warrior.png';
                break;
            case 2:
                return 'paladin.png';
                break;
            case 3:
                return 'hunter.png';
                break;
            case 4:
                return 'rogue.png';
                break;
            case 5:
                return 'priest.png';
                break;
            case 6:
                return 'dk.png';
                break;
            case 7:
                return 'shaman.png';
                break;
            case 8:
                return 'mage.png';
                break;
            case 9:
                return 'warlock.png';
                break;
            case 10:
                return 'monk.png';
                break;
            case 11:
                return 'druid.png';
                break;
            case 12:
                return 'demonhunter.png';
                break;
        }
    }

    public function getFaction($race)
    {
        switch ($race)
        {
            case '1':
            case '3':
            case '4':
            case '7':
            case '11':
            case '22':
            case '25': // Pandaren alliance
            case '30':
            case '32':
            case '34':
            case '37':
                return 'Alliance';
            break;
            case '2':
            case '5':
            case '6':
            case '8':
            case '9':
            case '10':
            case '26': // Pandaren horde
            case '28':
            case '31':
            case '35': // Vulpera
            case '36':
                return 'Horde';
            break;
        }
    }

    public function getClassName($class)
    {
        switch ($class)
        {
            case 1:
                return $this->lang->line('class_warrior');
                break;
            case 2:
                return $this->lang->line('class_paladin');
                break;
            case 3:
                return $this->lang->line('class_hunter');
                break;
            case 4:
                return $this->lang->line('class_rogue');
                break;
            case 5:
                return $this->lang->line('class_priest');
                break;
            case 6:
                return $this->lang->line('class_dk');
                break;
            case 7:
                return $this->lang->line('class_shamman');
                break;
            case 8:
                return $this->lang->line('class_mage');
                break;
            case 9:
                return $this->lang->line('class_warlock');
                break;
            case 10:
                return $this->lang->line('class_monk');
                break;
            case 11:
                return $this->lang->line('class_druid');
                break;
            case 12:
                return $this->lang->line('class_demonhunter');
                break;
        }
    }

    public function getGender($gender)
    {
        switch ($gender)
        {
            case 0:
                return $this->lang->line('gender_male');
                break;
            case 1:
                return $this->lang->line('gender_female');
                break;
        }
    }

    public function getSpecifyZone($zoneid)
    {
        $qq = $this->db->select('zone_name')->where('id', $zoneid)->get('zones');

        if($qq->num_rows())
            return $qq->row('zone_name');
        else
            return 'Unknown Zone';
    }

    public function moneyConversor($amount)
    {
        $gold = substr($amount, 0, -4);
        $silver = substr($amount, -4, -2);
        $copper = substr($amount, -2);

        if ($gold == 0)
            $gold = 0;

        if ($silver == 0)
            $silver = 0;

        if ($copper == 0)
            $copper = 0;

        $money = array(
            'gold' => $gold,
            'silver' => $silver,
            'copper' => $copper
        );

        return $money;
    }

    public function timeConversor($time)
    {
        $dateF = new DateTime('@0');
        $dateT = new DateTime("@$time");
        return $dateF->diff($dateT)->format('%aD %hH %iM %sS');
    }

    public function tinyEditor($rank)
    {
        switch ($rank) {
            case 'Admin':
                return "<script src=".base_url('assets/core/tinymce/tinymce.min.js')."></script>
                        <script>tinymce.init({selector: '.tinyeditor',element_format : 'html',menubar: true,
                            plugins: ['preview searchreplace autolink directionality visualblocks visualchars fullscreen image link media codesample table charmap hr insertdatetime advlist lists wordcount imagetools textpattern help'],
                            toolbar: 'undo redo | fontsizeselect | bold italic strikethrough | forecolor backcolor | link emoticons image media | alignleft aligncenter alignright alignjustify | bullist numlist | removeformat'});
                        </script>";
                break;
            case 'User':
                return "<script src=".base_url('assets/core/tinymce/tinymce.min.js')."></script>
                        <script>tinymce.init({selector: '.tinyeditor',element_format : 'html',menubar: false,
                            plugins: ['advlist autolink lists link image charmap textcolor searchreplace fullscreen media paste wordcount emoticons'],
                            toolbar: 'undo redo | fontsizeselect | bold italic strikethrough | forecolor | link emoticons image | alignleft aligncenter alignright alignjustify | bullist numlist | removeformat'});
                        </script>";
                break;
        }
    }

    public function smtpSendEmail($to, $subject, $message)
    {
        $this->load->library('email');

        $config = array(
            'protocol'  => 'smtp',
            'smtp_host' => $this->config->item('smtp_host'),
            'smtp_user' => $this->config->item('smtp_user'),
            'smtp_pass' => $this->config->item('smtp_pass'),
            'smtp_port' => $this->config->item('smtp_port'),
            'smtp_crypto' => $this->config->item('smtp_crypto'),
            'mailtype'  => 'html',
            'charset'   => 'utf-8'
        );
        $this->email->initialize($config);
        $this->email->set_mailtype("html");
        $this->email->set_newline("\r\n");

        $this->email->to($to);
        $this->email->from($this->config->item('email_settings_sender'), $this->config->item('email_settings_sender_name'));
        $this->email->subject($subject);
        $this->email->message($message);

        return $this->email->send();
    }

    public function getMenu()
    {
        return $this->db->select('*')->get('menu');
    }

    public function getMenuChild($id)
    {
        return $this->db->select('*')->where('child', $id)->get('menu');
    }
}
