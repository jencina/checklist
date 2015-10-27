<?php

return array(
    // This path may be different. You can probably get it from `config/main.php`.
    'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
    'name'=>'Cron',

    'preload'=>array('log'),

    'import'=>array(
        'application.components.*',
        'application.models.*'
    ),
    // We'll log cron messages to the separate files
    'components'=>array(
        'log'=>array(
            'class'=>'CLogRouter',
            'routes'=>array(
                array(
                    'class'=>'CFileLogRoute',
                    'logFile'=>'cron.log',
                    'levels'=>'error, warning',
                ),
                array(
                    'class'=>'CFileLogRoute',
                    'logFile'=>'cron_trace.log',
                    'levels'=>'trace',
                ),
            ),
        ),

        // Your DB connection
        'db'=>array(
            'class'=>'CDbConnection',
            'charset' => 'utf8',
            'connectionString'=>'mysql:host=localhost;dbname=checklist',
            'username'=>'root',
            'password'=>'jonathan19'
        ),
    ),
);

