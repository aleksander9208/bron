<?php

// This is the configuration for yiic console application.
// Any writable CConsoleApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Заявления',

	// preloading 'log' component
	'preload'=>array('log'),
    'import' => array(
        'application.models.*',
        'application.components.*',
        'application.components.services.*',
    ),

	// application components
	'components'=>array(

        'db' => array(
            'connectionString' => 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME,
            'emulatePrepare' => true,
            'username' => DB_USER,
            'password' => DB_PASS,
            'charset' => 'utf8',
            'tablePrefix' => DB_PREF,
            'enableParamLogging' => true,
            'enableProfiling' => true,
        ),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'profile',
                    'categories' => 'debug',
                    'logFile' => 'debug.log',
                ),
               /* array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'profile',
                    'categories' => 'update',
                    'logFile' => 'update.log',
                ),*/

			),
		),

	),
);
