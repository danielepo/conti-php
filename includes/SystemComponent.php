<?php

class SystemComponent 
{

	var $settings;
	
	function getSettings()
	{
		//System Variables
		$settings['siteDir']='c:/VolumeD/www/test';
		
		// Database variables
		$settings['dbhost'] = 'localhost';
		$settings['dbport'] = 3306;
		$settings['dbusername'] = 'conti';
		$settings['dbpassword'] = 'conti';
		$settings['dbname'] = 'conti';

		return $settings;
	}
}
