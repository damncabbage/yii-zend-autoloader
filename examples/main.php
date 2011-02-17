<?php

// This is a sample main Web application, intended to show how
// to use DCZendAutoloader.
//
// Pay specific attention to the lines marked with <----- Arrows.
//
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Zend! The Autoloader',

	'defaultController'=>'site',
	'timezone' => 'Australia/Sydney', // Surf's up.

	// Kick off loading of the log and autoloader components immediately.
	'preload'=>array(
		'log',
		'zendAutoloader', // <------
	),

	// Autoload/Include directories
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'application.vendors.*', // <------ (If you've placed Zend here.)
	),

	// application components
	'components'=>array(

		// Set up the autoloader component <------ (This entire block.)
		'zendAutoloader'=>array(
			// Change this if you've put the class elsewhere.
			'class'=>'ext.components.zend-autoloader.DCZendAutoloader',

			// Optional: provide an absolute path to the non-Yii directory containing the
			// Zend libraries.
			//'basePath'=>realpath(dirname(__FILE__).'/../../../../private/libraries/zf-1.10.2'),
		),


		// The rest below here is default:

		'errorHandler'=>array(
			// use 'site/error' action to display errors
            'errorAction'=>'site/error',
        ),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
			),
		),
		'urlManager'=>array(
			'urlFormat'=>'path',
			'showScriptName'=>false,
		),
		'email'=>array(
			'class'=>'application.extensions.email.Email',
			'delivery'=>'php',
		),
	),
	'params'=>array(),
);
