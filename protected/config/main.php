<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Penilaian Karyawan',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
            
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		/*
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'Enter Your Password Here',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
		*/
	),

	// application components
	'components'=>array(

		'user'=>array(
                    'class'=>'application.components.EWebUser',
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
            
            'db'=>require(dirname(__FILE__).'/database.php'),
            'dbOracle'=>array(
                    'class'=>'ext.oci8Pdo.OciDbConnection',
                    'connectionString' => 'oci:dbname=//192.168.9.92:1521/xe',
                    //'connectionString' => 'oci:dbname=(DESCRIPTION=(ADDRESS_LIST = (ADDRESS = (PROTOCOL = TCP)(HOST = 192.168.9.92)(PORT = 1521)))(CONNECT_DATA=(SID=xe)))',
                    'username' => 'C##MKTAPPS',
                    'password' => 'madajaya',
                'charset' => 'utf8',
                'schemaCachingDuration' => '3600',
                'enableParamLogging' => true,
                'attributes' => array(PDO::ATTR_CASE => PDO::CASE_LOWER),
                'initSQLs' => array(
                    // Oracle behaviour depends on particular NLS* parameter
                    // List actual settings via: select * from NLS_DATABASE_PARAMETERS

                    // example 1: decimal separator: NLS_NUMERIC_CHARACTERS => ".," means, that dot [.] = decimal separator, and comma [,] is for thousands separator
                    // for PHP we must set [NLS_NUMERIC_CHARACTERS => ". "] - applicable to middle european regional settings
                    "ALTER SESSION SET NLS_NUMERIC_CHARACTERS = '. '",

                    // example 2: setting SELECT LIKE ... to be accent and case sensitive mode:
                    'ALTER SESSION SET NLS_COMP=ANSI', 
                    'ALTER SESSION SET NLS_COMP=LINGUISTIC',
                    'ALTER SESSION SET NLS_SORT=GENERIC_BASELETTER',
                    'ALTER SESSION SET NLS_SORT=BINARY_AI',
                ),   
                ),

		// uncomment the following to enable URLs in path-format
		/*
		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		*/

		// database settings are configured in database.php
		//'db'=>require(dirname(__FILE__).'/database.php'),
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>YII_DEBUG ? null : 'site/error',
		),

		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),

	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
                'theme'=>'freearch',
	),
);
