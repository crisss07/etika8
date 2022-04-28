<?php if (!defined('BASEPATH')) exit('No direct script access allowed.');

function force_ssl()
{    
	if (ENVIRONMENT != "development") {
            $CI = & get_instance();
            $root = str_replace('http://', 'https://', $CI->config->config['base_url']);
            $CI->config->config['base_url']=$root;
            $root .='admin.php/';
            $uri = ltrim($CI->uri->uri_string(), '/');
            if ($_SERVER['SERVER_PORT'] != 443) {
                header("Location: " . $root . $uri);
                exit;
            }		
	}
}

function remove_ssl()
{
	if (ENVIRONMENT != "development") {
		$CI =& get_instance();
                $root = str_replace('https://', 'http://', $CI->config->config['base_url']);  
                $CI->config->config['base_url']=$root;
                $root .='admin.php/';
                $uri = ltrim($CI->uri->uri_string(), '/');                
		if ($_SERVER['SERVER_PORT'] != 80) {
                    header("Location: ".$root.$uri);
                    exit;                    
		}
	}
}

/* End of file: ssl_helper.php */