<?php
/**
 * Define environments
 *
 */

// local (http://localhost/jobberbase/public)

// live (http://www.yourjobberbasedomain.com)
$__instances['live'] = array(
	'prefix' => 'ssnunite.com',
	'db_host' => 'alumnirt.db.8799516.hostedresource.com',
	'db_port' => 3306,
	'db_user' => 'alumnirt',
	'db_password' => 'SSNalumni#1',
	'db_name' => 'alumnirt',
	'db_prefix' => '',
	'app_url' => 'http://ssnunite.com/job/',
	// error reporting
	'ini_error_reporting' => E_ALL,
	'ini_display_errors' => 'On',
	// environment setting 1 (use 'local' for localhost/testing OR 'online' for live, production environment)
	'location' => 'online',
	// environment setting 2 (use 'dev' together with 'local' in the previous setting OR 'prod' with 'online')
	'environment' => 'prod',
	//'apache_mod_rewrite', 'iis_url_rewrite' -microsoft URL Rewrite module, 'iis_isapi_rewrite'
	'rewrite_mode' => 'apache_mod_rewrite'
);


// setup current instance
foreach ($__instances as $__instance)
{
	// http requests
	if (isset($_SERVER['HTTP_HOST']))
	{
		$_compare_to = $_SERVER['HTTP_HOST'];
	}

	if (strstr($_compare_to, $__instance['prefix']))
	{
		define('DB_HOST', $__instance['db_host']);
		define('DB_PORT', $__instance['db_port']);
		define('DB_USER', $__instance['db_user']);
		define('DB_PASS', $__instance['db_password']);
		define('DB_NAME', $__instance['db_name']);
		define('DB_PREFIX', $__instance['db_prefix']);

		// values kind of redundant, they indicate wether this is a live/production or dev/testing environment
		define('LOCATION', $__instance['location']);
		define('ENVIRONMENT', $__instance['environment']);
		
		// base url of the app
		define('APP_URL', $__instance['app_url']);
		define('REWRITE_MODE', $__instance['rewrite_mode']);
		// error reporting
		ini_set('error_reporting', $__instance['ini_error_reporting']);
		ini_set('display_errors', $__instance['ini_display_errors']);
		
		break;
	}
}
?>