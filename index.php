<?php
// change the following paths if necessary
$yii=dirname(__FILE__).'/framework/yii.php';
$autoload=dirname(__FILE__).'/vendor/autoload.php';
$config=dirname(__FILE__).'/protected/config/main.php';
$xlreader1=dirname(__FILE__).'/import-excel/spreadsheet-reader-master/php-excel-reader/excel_reader2.php';
$xlreader2=dirname(__FILE__).'/import-excel/spreadsheet-reader-master/SpreadsheetReader.php';

// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',true);
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);

require_once($autoload);
require_once($yii);
require_once($xlreader1);
require_once($xlreader2);

date_default_timezone_set('Asia/Jakarta');
$app = Yii::createWebApplication($config);
    
$app->run();
