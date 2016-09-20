<?php
//设置运行时目录
define('RUNTIME_PATH', './Runtime/');
//设置开发调试模式
define('APP_PATH', true);
//设置组名称
define('APP_NAME', Application);
//设置组目录
define('APP_PATH', './Application/');
//引入ThinkPHP.php入口文件
require('./ThinkPHP/ThinkPHP.php');