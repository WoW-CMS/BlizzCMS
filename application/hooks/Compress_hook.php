<?php
/**
 * @author Derek Jones
 * @author Adam Tester
 * @author FauxFaux
 * @copyright Copyright (c) 2008 - 2014, EllisLab, Inc. (https://ellislab.com)
 * @copyright Copyright (c) 2014 - 2019, British Columbia Institute of Technology (https://bcit.ca)
 * @copyright Copyright (c) 2019 - 2022, CodeIgniter Foundation (https://codeigniter.com)
 * @link https://github.com/bcit-ci/CodeIgniter/wiki/Compress-HTML-output
 * @license https://opensource.org/licenses/MIT MIT License
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Compress_hook
{
    private $CI;

    public function __construct()
    {
        $this->CI =& get_instance();
    }

    public function initialize()
    {
        $buffer = $this->CI->output->get_output();

        $pattern = '%# Collapse whitespace everywhere but in blacklisted elements.
            (?>             # Match all whitespans other than single space.
              [^\S ]\s*     # Either one [\t\r\n\f\v] and zero or more ws,
            | \s{2,}        # or two or more consecutive-any-whitespace.
            ) # Note: The remaining regex consumes no text at all...
            (?=             # Ensure we are not in a blacklist tag.
              [^<]*+        # Either zero or more non-"<" {normal*}
              (?:           # Begin {(special normal*)*} construct
                <           # or a < starting a non-blacklist tag.
                (?!/?(?:textarea|pre|script)\b)
                [^<]*+      # more non-"<" {normal*}
              )*+           # Finish "unrolling-the-loop"
              (?:           # Begin alternation group.
                <           # Either a blacklist start tag.
                (?>textarea|pre|script)\b
              | \z          # or end of file.
              )             # End alternation group.
            )  # If we made it here, we are not in a blacklist tag.
            %Six';

        $newBuffer = preg_replace($pattern, '', $buffer);

        if ($newBuffer === null) {
            $newBuffer = $buffer;
        }

        $this->CI->output->set_output($newBuffer);

        $this->CI->output->_display();
    }
}
