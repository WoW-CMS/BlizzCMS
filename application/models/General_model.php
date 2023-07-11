<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class General_model extends CI_Model
{
    /**
     * Expansions
     *
     * @var array
     */
    public const EXPANSIONS = [
        1 => [
            'db'    => 0,
            'name'  => 'Vanilla',
            'level' => 60
        ],
        2 => [
            'db'    => 1,
            'name'  => 'The Burning Crusade',
            'level' => 70
        ],
        3 => [
            'db'    => 2,
            'name'  => 'Wrath of the Lich King',
            'level' => 80
        ],
        4 => [
            'db'    => 3,
            'name'  => 'Cataclysm',
            'level' => 85
        ],
        5 => [
            'db'    => 4,
            'name'  => 'Mist of Pandaria',
            'level' => 90
        ],
        6 => [
            'db'    => 5,
            'name'  => 'Warlords of Draenor',
            'level' => 100
        ],
        7 => [
            'db'    => 6,
            'name'  => 'Legion',
            'level' => 110
        ],
        8 => [
            'db'    => 7,
            'name'  => 'Battle of Azeroth',
            'level' => '120',
        ],
        9 => [
            'db'    => 8,
            'name'  => 'ShadowLands',
            'level' => 60
        ],
    ];

    /**
     * Races
     *
     * @var array
     */
    public const RACES = [
        'name' => [
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
        'icon' => [
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
     * Classes
     *
     * @var array
     */
    public const CLASSES = [
        'name' => [
            1 => 'class_warrior',
            2 => 'class_paladin',
            3 => 'class_hunter',
            4 => 'class_rogue',
            5 => 'class_priest',
            6 => 'class_dk',
            7 => 'class_shamman',
            8 => 'class_mage',
            9 => 'class_warlock',
            10 => 'class_monk',
            11 => 'class_druid',
            12 => 'class_demonhunter'
        ],
        'icon' => [
            1 => 'warrior.png',
            2 => 'paladin.png',
            3 => 'hunter.png',
            4 => 'rogue.png',
            5 => 'priest.png',
            6 => 'dk.png',
            7 => 'shaman.png',
            8 => 'mage.png',
            9 => 'warlock.png',
            10 => 'monk.png',
            11 => 'druid.png',
            12 => 'demonhunter.png'
        ],
    ];

    public const ALLIANCE_RACES = [1, 3, 4, 7, 11, 22, 25, 30, 32, 34, 37];

    public const HORDE_RACES = [2, 5, 6, 8, 9, 10, 26, 28, 31, 35, 36];

    /**
     * General_model constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Get current timestamp
     *
     * @return int
     */
    public function getTimestamp()
    {
        $date = new DateTime();

        return $date->getTimestamp();
    }

    /**
     * Check if maintenance is enabled
     *
     * @return bool
     */
    public function getMaintenance()
    {
        $mode = config_item('maintenance_mode');

        if ($mode === '0') {
            return true;
        }

        if ($mode === '1' && ! $this->wowauth->isLogged()) {
            return false;
        }

        $userid = $this->session->userdata('wow_sess_id');

        if ($this->wowauth->getRank($userid) >= (int) config_item('mod_access_level')) {
            return true;
        }

        return false;
    }

    /**
     * [Description for getUserInfoGeneral]
     *
     * @param int $id
     * @return [type]
     */
    public function getUserInfoGeneral($id)
    {
        return $this->db->where('id', $id)
            ->get('users');
    }

    /**
     * Get the donation points from an account
     *
     * @param int $id
     * @return int
     */
    public function getCharDPTotal($id)
    {
        $query = $this->db->where('id', $id)
            ->get('users')
            ->row('dp');

        if (! empty($query)) {
            return (int) $query;
        }

        return 0;
    }

    /**
     * Get the voting points from an account
     *
     * @param int $id
     * @return int
     */
    public function getCharVPTotal($id)
    {
        $query = $this->db->where('id', $id)
            ->get('users')
            ->row('vp');

        if (! empty($query)) {
            return (int) $query;
        }

        return 0;
    }

    /**
     * [Description for getExpansionAction]
     *
     * @return [type]
     */
    public function getExpansionAction()
    {
        $expansion = config_item('expansion');

        switch ($expansion) {
            case 1:
            case 2:
            case 3:
            case 4:
            case 5:
                return '1';
            break;
            case 6:
            case 7:
            case 8:
                return '2';
            break;
        }
    }

    /**
     * Get expansion name
     *
     * @return string
     */
    public function getExpansionName()
    {
        $expansion = config_item('expansion');

        if (array_key_exists($expansion, self::EXPANSIONS)) {
            return self::EXPANSIONS[$expansion]['name'];
        }

        return lang('unknown');
    }

    /**
     * Get expansion maximum level
     *
     * @return int
     */
    public function getMaxLevel()
    {
        $expansion = config_item('expansion');

        if (array_key_exists($expansion, self::EXPANSIONS)) {
            return self::EXPANSIONS[$expansion]['level'];
        }

        return 0;
    }

    /**
     * Get real expansion id for DB
     *
     * @return int
     */
    public function getRealExpansionDB()
    {
        $expansion = config_item('expansion');

        if (array_key_exists($expansion, self::EXPANSIONS)) {
            return self::EXPANSIONS[$expansion]['db'];
        }

        return 0;
    }

    /**
     * Get race name
     *
     * @param int $id
     * @return string
     */
    public function getRaceName($id)
    {
        if (array_key_exists($id, self::RACES['name'])) {
            return lang(self::RACES['name'][$id]);
        }

        return lang('unknown');
    }

    /**
     * Get race icon
     *
     * @param int $id
     * @return string
     */
    public function getRaceIcon($id)
    {
        if (array_key_exists($id, self::RACES['icon'])) {
            return self::RACES['icon'][$id];
        }

        return '';
    }

    /**
     * Get class name
     *
     * @param int $id
     * @return string
     */
    public function getClassName($id)
    {
        if (array_key_exists($id, self::CLASSES['name'])) {
            return lang(self::CLASSES['name'][$id]);
        }

        return lang('unknown');
    }

    /**
     * Get class icon
     *
     * @param int $id
     * @return string
     */
    public function getClassIcon($id)
    {
        if (array_key_exists($id, self::CLASSES['icon'])) {
            return self::CLASSES['icon'][$id];
        }

        return '';
    }

    /**
     * Get faction name
     *
     * @param int $race
     * @return string
     */
    public function getFaction($race)
    {
        if (in_array($race, self::ALLIANCE_RACES)) {
            return lang('faction_alliance');
        }

        if (in_array($race, self::HORDE_RACES)) {
            return lang('faction_horde');
        }

        return lang('unknown');
    }

    /**
     * Get gender name
     *
     * @param int $gender
     * @return string
     */
    public function getGender($gender)
    {
        switch ($gender) {
            case 0:
                return lang('gender_male');

            case 1:
                return lang('gender_female');

            default:
                return lang('unknown');
        }
    }

    /**
     * Get zone name
     *
     * @param int $zoneid
     * @return string
     */
    public function getSpecifyZone($zoneid)
    {
        $query = $this->db->where('id', $zoneid)
            ->get('zones')
            ->row('zone_name');

        if (! empty($query)) {
            return $query;
        }

        return lang('unknown');
    }

    /**
     * Convert money amount to gold, silver and copper values
     *
     * @param int $amount
     * @return array
     */
    public function moneyConversor($amount)
    {
        $amount = (string) $amount;
        $length = strlen($amount);

        return [
            'gold'   => $length >= 5 ? (int) substr($amount, 0, -4) : 0,
            'silver' => $length >= 3 ? (int) substr($amount, -4, -2) : 0,
            'copper' => $length >= 1 ? (int) substr($amount, -2) : 0
        ];
    }

    /**
     * Convert timestamp to a time-lapse format
     *
     * @param int $time
     * @return string
     */
    public function timeConversor($timestamp)
    {
        $dateF = new DateTime('@0');
        $dateT = new DateTime('@' . $timestamp);

        return $dateF->diff($dateT)->format('%aD %hH %iM %sS');
    }

    /**
     * [Description for tinyEditor]
     *
     * @param string $rank
     * @return string
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

            case 'User':
                return "<script src=".base_url('assets/core/tinymce/tinymce.min.js')."></script>
                        <script>tinymce.init({selector: '.tinyeditor',element_format : 'html',menubar: false,
                            plugins: ['advlist autolink lists link image charmap textcolor searchreplace fullscreen media paste wordcount emoticons'],
                            toolbar: 'undo redo | fontsizeselect | bold italic strikethrough | forecolor | link emoticons image | alignleft aligncenter alignright alignjustify | bullist numlist | removeformat'});
                        </script>";

            default:
                return '';
        }
    }

    /**
     * Send email through SMTP
     *
     * @param string $to
     * @param string $subject
     * @param mixed $message
     * @return bool
     */
    public function smtpSendEmail($to, $subject, $message)
    {
        $this->load->library('email');

        $this->email->initialize([
            'protocol'    => 'smtp',
            'smtp_host'   => config_item('smtp_host'),
            'smtp_user'   => config_item('smtp_user'),
            'smtp_pass'   => config_item('smtp_pass'),
            'smtp_port'   => config_item('smtp_port'),
            'smtp_crypto' => config_item('smtp_crypto'),
            'mailtype'    => 'html',
            'charset'     => 'utf-8',
            'newline'     => "\r\n"
        ]);

        $this->email->to($to);
        $this->email->from(config_item('email_settings_sender'), config_item('email_settings_sender_name'));
        $this->email->subject($subject);
        $this->email->message($message);

        return $this->email->send();
    }

    /**
     * Get menu
     *
     * @return array
     */
    public function getMenu()
    {
        return $this->db->get('menu')
            ->result();
    }

    /**
     * Get menu childs from menu id
     *
     * @param int $id
     * @return mixed
     */
    public function getMenuChild($id)
    {
        return $this->db->where('child', $id)
            ->get('menu')
            ->result();
    }
}
