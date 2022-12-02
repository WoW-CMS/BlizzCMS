<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pageviews_model extends BS_Model
{
    protected $table = 'pageviews';

    protected $setCreatedField = true;

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
     * Create a pageview log
     *
     * @param string|null $uri
     * @return bool
     */
    public function create($uri = null)
    {
        return $this->insert([
            'ip'        => $this->input->ip_address(),
            'uri'       => $uri ?? $this->uri->uri_string(),
            'platform'  => $this->agent->platform(),
            'browser'   => $this->agent->browser(),
            'is_mobile' => $this->agent->is_mobile() ? 1 : 0
        ]);
    }

    /**
     * Check if a URI is being viewed for the first time
     *
     * @param string|null $uri
     * @return bool
     */
    public function is_first_viewed($uri = null)
    {
        $count = $this->count_all([
            'ip'  => $this->input->ip_address(),
            'uri' => $uri ?? $this->uri->uri_string()
        ]);

        return $count === 1;
    }

    /**
     * Get total unique pageviews for a URI
     *
     * @param string $uri
     * @param string|null $date
     * @param string|null $dateFormat
     * @return int
     */
    public function unique_pageviews($uri, $date = null, $dateFormat = null)
    {
        $date ??= current_date('Y-m');
        $dateFormat ??= '%Y-%m';

        if (! in_array($dateFormat, ['%Y-%m-%d', '%Y-%m', '%Y'], true)) {
            show_error('Not a valid format: ' . $dateFormat);
        }

        $column = 'DATE_FORMAT(created_at, "' . $dateFormat . '") =';

        return $this->db->distinct()
            ->select('ip')
            ->where([
                'uri'   => $uri,
                $column => $date
            ])
            ->get($this->table)
            ->num_rows();
    }
}
