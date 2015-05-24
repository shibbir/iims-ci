<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package		CodeIgniter
 * @author		EllisLab Dev Team
 * @copyright	Copyright (c) 2008 - 2014, EllisLab, Inc.
 * @copyright	Copyright (c) 2014 - 2015, British Columbia Institute of Technology (http://bcit.ca/)
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * CodeIgniter CUSTOM Helpers
 *
 * @package		CodeIgniter
 * @subpackage	Helpers
 * @category	Helpers
 * @author		Shibbir Ahmed
 */

// ------------------------------------------------------------------------

function active_url()
{
    $CI =& get_instance();
    return $CI->uri->segment($CI->uri->total_segments());
}

// ------------------------------------------------------------------------

function active_url_class($url_string)
{
    $urls = explode('|', $url_string);

    foreach ($urls as $url)
    {
        if(uri_string() == $url)
        {
            return 'active';
        }
    }
}

/* End of file custom_helper.php */
/* Location: ./system/helpers/custom_helper.php */