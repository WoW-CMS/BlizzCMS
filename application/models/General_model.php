<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class General_model extends CI_Model {
    
    /**
     * EXPANSION
     *
     * @var [type]
     */
    protected const EXPANSION = 
    [
        1 => [
            'DB' => '0',
            'Nombre' => 'Vanilla',
            'Level' => '60',
        ],

        2 => [
            'DB' => '1',
            'Nombre' => 'The Burning Crusade',
            'Level' => '70'
        ],
        3 => [
            'DB' => '2',
            'Nombre' => 'Wrath of the Lich King',
            'Level' => '80',
        ],
        4 => [
            'DB' => '3',
            'Nombre' => 'Cataclysm',
            'Level' => '85',
        ],
        5 => [
            'DB' => '4',
            'Nombre' => 'Mist of Pandaria',
            'Level' => '90',
        ],
        6 => [
            'DB' => '5',
            'Nombre' => 'Warlords of Draenor',
            'Level' => '100',
        ],
        7 => [
            'DB' => '6',
            'Nombre' => 'Legion',
            'Level' => '110',
        ],
        8 => [
            'DB' => '7',
            'Nombre' => 'Battle of Azeroth',
            'Level' => '120',
        ],
        9 => [
            'DB' => '8',
            'Nombre' => 'ShadowLands',
            'Level' => '60',
        ],
    ];

    /**
     * RACES
     *
     * @var [type]
     */
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
            24 => 'race_panda_neutral',
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

    /**
     * [Description for getTimestamp]
     *
     * @return [type]
     * 
     */
    public function getTimestamp()
    {
        $date = new DateTime();
        return $date->getTimestamp();
    }

    /**
     * [Description for getMaintenance]
     *
     * @return [type]
     * 
     */
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

    /**
     * [Description for getUserInfoGeneral]
     *
     * @param mixed $id
     * 
     * @return [type]
     * 
     */
    public function getUserInfoGeneral($id)
    {
        return $this->db->select('*')->where('id', $id)->get('users');
    }

    /**
     * [Description for getCharDPTotal]
     *
     * @param mixed $id
     * 
     * @return [type]
     * 
     */
    public function getCharDPTotal($id)
    {
        $qq = $this->db->select('dp')->where('id', $id)->get('users');

        if ($qq->num_rows())
            return $qq->row('dp');
        else
            return '0';
    }

    /**
     * [Description for getCharVPTotal]
     *
     * @param mixed $id
     * 
     * @return [type]
     * 
     */
    public function getCharVPTotal($id)
    {
        $qq = $this->db->select('vp')->where('id', $id)->get('users');

        if ($qq->num_rows())
            return $qq->row('vp');
        else
            return '0';
    }

    /**
     * [Description for getEmulatorAction]
     *
     * @return [type]
     * 
     */
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

    /**
     * [Description for getExpansionAction]
     *
     * @return [type]
     * 
     */
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

    /**
     * [Description for getExpansionName]
     *
     * @return [type]
     * 
     */
    public function getExpansionName()
    {
        $expansion = $this->config->item('expansion');

        if (empty($expansion)) {
            return false;
        }
                
        return self::EXPANSION[$expansion]['Nombre'];
    }

    /**
     * [Description for getMaxLevel]
     *
     * @return [type]
     * 
     */
    public function getMaxLevel()
    {
        $expansion = $this->config->item('expansion');

        if (empty($expansion)) {
            return false;
        }
                
        return self::EXPANSION[$expansion]['Level'];
    }

    /**
     * [Description for getRealExpansionDB]
     *
     * @return [type]
     * 
     */
    public function getRealExpansionDB()
    {
        $expansion = $this->config->item('expansion');

        if (empty($expansion)) {
            return false;
        }
                
        return self::EXPANSION[$expansion]['DB'];
        
    }

    /**
     * [Description for getRaceName]
     *
     * @param int $race
     * 
     * @return [type]
     * 
     */
    public function getRaceName(int $race)
    {
        if (empty($race)) {
            return false;
        }
        
        return self::RACES['text'][$race];
    }

    /**
     * [Description for getRaceIcon]
     *
     * @param int $race
     * 
     * @return [type]
     * 
     */
    public function getRaceIcon(int $race)
    {
        if (empty($race)) {
            return false;
        }
        
        return self::RACES['icon'][$race];
    }

    /**
     * [Description for getClassIcon]
     *
     * @param mixed $race
     * 
     * @return [type]
     * 
     */
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

    /**
     * [Description for getFaction]
     *
     * @param mixed $race
     * 
     * @return [type]
     * 
     */
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

    /**
     * [Description for getClassName]
     *
     * @param mixed $class
     * 
     * @return [type]
     * 
     */
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

    /**
     * [Description for getGender]
     *
     * @param mixed $gender
     * 
     * @return [type]
     * 
     */
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

    /**
     * [Description for getSpecifyZone]
     *
     * @param mixed $zoneid
     * 
     * @return [type]
     * 
     */
    public function getSpecifyZone($zoneid)
    {
        $qq = $this->db->select('zone_name')->where('id', $zoneid)->get('zones');

        if($qq->num_rows())
            return $qq->row('zone_name');
        else
            return 'Unknown Zone';
    }

    /**
     * [Description for moneyConversor]
     *
     * @param mixed $amount
     * 
     * @return [type]
     * 
     */
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

    /**
     * [Description for timeConversor]
     *
     * @param mixed $time
     * 
     * @return [type]
     * 
     */
    public function timeConversor($time)
    {
        $dateF = new DateTime('@0');
        $dateT = new DateTime("@$time");
        return $dateF->diff($dateT)->format('%aD %hH %iM %sS');
    }

    /**
     * [Description for tinyEditor]
     *
     * @param mixed $rank
     * 
     * @return [type]
     * 
     */
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

    /**
     * [Description for smtpSendEmail]
     *
     * @param mixed $to
     * @param mixed $subject
     * @param mixed $message
     * 
     * @return [type]
     * 
     */
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

    /**
     * [Description for getMenu]
     *
     * @return [type]
     * 
     */
    public function getMenu()
    {
        return $this->db->select('*')->get('menu');
    }

    /**
     * [Description for getMenuChild]
     *
     * @param mixed $id
     * 
     * @return [type]
     * 
     */
    public function getMenuChild($id)
    {
        return $this->db->select('*')->where('child', $id)->get('menu');
    }
}
