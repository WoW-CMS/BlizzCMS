<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Website_model extends CI_Model
{
    /**
     * Authentication
     *
     * @param string $username
     * @param string $password
     * @return boolean
     */
    public function authentication($username, $password)
    {
        $accgame  = $this->auth->connect()->where('username', $username)->or_where('email', $username)->get('account')->row();
        $emulator = config_item('emulator');

        if (empty($accgame))
        {
            return false;
        }

        switch ($emulator)
        {
            case 'azeroth':
            case 'trinity':
                $validate = ($accgame->verifier === $this->auth->game_hash($accgame->username, $password, 'srp6', $accgame->salt));
                break;
            case 'cmangos':
                $validate = (strtoupper($accgame->v) === $this->auth->game_hash($accgame->username, $password, 'hex', $accgame->s));
                break;
            case 'old_trinity':
            case 'mangos':
                $validate = hash_equals(strtoupper($accgame->sha_pass_hash), $this->auth->game_hash($accgame->username, $password));
                break;
        }

        if (! isset($validate) || ! $validate)
        {
            return false;
        }

        // if account on website don't exist sync values from game account
        if (! $this->find_user($accgame->id))
        {
            $this->db->insert('users', [
                'id'        => $accgame->id,
                'nickname'  => $accgame->username,
                'username'  => $accgame->username,
                'email'     => $accgame->email,
                'joined_at' => date('Y-m-d H:i:s', $accgame->joindate)
            ]);
        }

        $data = $this->get_user($accgame->id);
        // Set session
        $this->session->set_userdata([
            'id'        => $data->id,
            'nickname'  => $data->nickname,
            'username'  => $data->username,
            'email'     => $data->email,
            'gmlevel'   => $this->auth->get_gmlevel($data->id),
            'logged_in' => TRUE
        ]);

        return true;    
    }

    /**
     * Check if user is logged
     *
     * @return boolean
     */
    public function isLogged()
    {
        if ($this->session->userdata('id') && $this->session->logged_in)
        {
            return true;
        }

        return false;
    }

    /**
     * Get avatar image of specific user
     *
     * @param int|null $id
     * @return boolean
     */
    public function user_avatar($id = null)
    {
        $avatar = $this->get_user($id, 'avatar');

        return $this->db->where('id', $avatar)->get('avatars')->row('image');
    }

    /**
     * Check if user exists
     *
     * @param int $id
     * @return boolean
     */
    public function find_user($id)
    {
        $query = $this->db->where('id', $id)->get('users')->num_rows();

        return ($query == 1);
    }

    /**
     * Get user information
     *
     * @param int|null $id
     * @param string|null $column
     * @return mixed
     */
    public function get_user($id = null, $column = null)
    {
        $id = $id ?? $this->session->userdata('id');

        $query = $this->db->where('id', $id)->get('users')->row();

        if (empty($query))
        {
            return null;
        }

        if (property_exists($query, $column))
        {
            return $query->$column;
        }

        return $query;
    }

    /**
     * Check if username/email exists on pending accounts
     *
     * @param string $username
     * @param string $email
     * @return boolean
     */
    public function pending_unique($username, $email)
    {
        $query = $this->db->query("SELECT * FROM users_tokens WHERE (JSON_EXTRACT(data, '$.username') = ? OR JSON_EXTRACT(data, '$.email') = ?) AND type = 'validation' AND expired_at >= ?", [$username, $email, current_date()]);

        return ($query->num_rows() >= 1);
    }

    /**
     * Generate user token
     *
     * @param int $id
     * @param string $type
     * @param string $expiration
     * @param string $data
     * @return string
     */
    public function generate_token($id, $type, $expiration, $data = '')
    {
        $chooser = bin2hex(random_bytes(16));
        $key     = bin2hex(random_bytes(16));
        $token   = $chooser.'_'.$key;
        $hash    = hash('sha512', $key);

        $this->db->insert('users_tokens', [
            'user_id'    => $id,
            'chooser'    => $chooser,
            'hash'       => $hash,
            'type'       => $type,
            'data'       => $data,
            'created_at' => current_date(),
            'expired_at' => $expiration
        ]);

        return $token;
    }

    /**
     * Verify if token exist and is valid
     *
     * @param string $token
     * @param string $type
     * @return mixed
     */
    public function verify_token($token, $type)
    {
        if (strpos($token, '_') === false)
        {
            return false;
        }

        list($chooser, $validation) = explode('_', $token);
        $validation = hash('sha512', $validation);

        $query = $this->db->where([
            'chooser'       => $chooser,
            'type'          => $type,
            'expired_at >=' => current_date()
        ])->get('users_tokens')->row();

        if (empty($query) || ! hash_equals($query->hash, $validation))
        {
            return false;
        }

        return $query;
    }
}
