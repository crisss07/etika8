<?php
  // application/hooks/ssl.php
      function redirect_ssl() {
          $CI =& get_instance();
          $class = $CI->router->fetch_class();
          $exclude =  array('client');  // add more controller name to exclude ssl.
          if(!in_array($class,$exclude)) {
              // redirecting to ssl.
			  //var_dump($CI->config->config['base_url']);
			  // substr_compare("http://www.dibek", "http://www.", 0, 11); // 1
			if(substr_compare($CI->config->config['base_url'],"http://", 0, 11)==0)
			{
				$CI->config->config['base_url'] = str_replace('http://', 'https://', $CI->config->config['base_url']);
              
			}
			else
			{
				$CI->config->config['base_url'] = str_replace('http://', 'https://', $CI->config->config['base_url']);
              
			}
			  if ($_SERVER['SERVER_PORT'] != 443) redirect($CI->uri->uri_string());
          } else {
              // redirecting with no ssl.
              $CI->config->config['base_url'] = str_replace('https://', 'http://', $CI->config->config['base_url']);
              if ($_SERVER['SERVER_PORT'] == 443) redirect($CI->uri->uri_string());
          }
      }
    
?>