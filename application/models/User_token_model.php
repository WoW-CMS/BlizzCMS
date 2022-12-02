<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_token_model extends BS_Model
{
    protected $table = 'users_tokens';

    protected $setCreatedField = true;

    /**
     * Tokens
     *
     * @var string
     */
    public const TOKEN_CONFIRMATION = 'confirmation';
    public const TOKEN_PASSWORD     = 'password';
    public const TOKEN_REMEMBER     = 'remember';

    /**
     * Class constructor
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Create a new token
     *
     * @param int $user
     * @param string $type
     * @param string $duration
     * @param array $data
     * @return string
     */
    public function create_token($user, $type, $duration, array $data = [])
    {
        $chooser = bin2hex(random_bytes(16));
        $key     = bin2hex(random_bytes(24));
        $token   = $chooser . '_' . $key;
        $hash    = hash('sha512', $key);

        $this->insert([
            'user_id'    => $user,
            'chooser'    => $chooser,
            'hash'       => $hash,
            'type'       => $type,
            'data'       => json_encode($data),
            'expires_at' => add_timespan('now', $duration)
        ]);

        return $token;
    }

    /**
     * Refresh token
     *
     * @param string $chooser
     * @param string $type
     * @return bool|string
     */
    public function refresh_token($chooser, $type)
    {
        $row = $this->find([
            'chooser' => $chooser,
            'type'    => $type
        ]);

        if (empty($row)) {
            return false;
        }

        $key   = bin2hex(random_bytes(24));
        $token = $chooser . '_' . $key;
        $hash  = hash('sha512', $key);

        $this->update(['hash' => $hash], [
            'user_id' => $row->user_id,
            'chooser' => $chooser,
            'type'    => $type
        ]);

        return $token;
    }

    /**
     * Token verify
     *
     * @param string $token
     * @param string $type
     * @return bool|object
     */
    public function verify_token($token, $type)
    {
        if (strpos($token, '_') === false) {
            return false;
        }

        [$chooser, $validation] = explode('_', $token);

        $validation = hash('sha512', $validation);

        $row = $this->find([
            'chooser'       => $chooser,
            'type'          => $type,
            'expires_at >=' => current_date()
        ]);

        if (empty($row) || ! hash_equals($row->hash, $validation)) {
            return false;
        }

        return $row;
    }

    /**
     * Check if data exists in unconfirmed registers
     *
     * @param string $value
     * @param string $key
     * @return bool
     */
    public function userdata_exists($value, $key = 'username')
    {
        if (! in_array($key, ['nickname', 'username', 'email'], true)) {
            return false;
        }

        $dataColumn = "JSON_EXTRACT(data, '$.{$key}') =";

        $query = $this->db->where([
                $dataColumn     => $value,
                'type'          => self::TOKEN_CONFIRMATION,
                'expires_at >=' => current_date()
            ])
            ->get($this->table)
            ->num_rows();

        return $query >= 1;
    }
}
