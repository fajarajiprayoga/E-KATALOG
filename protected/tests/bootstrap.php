<?php

// change the following paths if necessary
$yiit=dirname(__FILE__).'/../../../yii-1.1.22.bf1d26_2/yii-1.1.22.bf1d26/framework/yiit.php';
$config=dirname(__FILE__).'/../config/test.php';

require_once($yiit);
require_once(dirname(__FILE__).'/WebTestCase.php');

Yii::createWebApplication($config);
