<?php
use Phalcon\DI\FactoryDefault\CLI as CliDI,
    Phalcon\CLI\Console as ConsoleApp;
require_once(__DIR__.'/../vendor/autoload.php');
$di = new CliDI();
define('VERSION', '1.0.0');
define('TERMINAL', 'web');
//require_once(__DIR__.'/../boot.php');
//Using the CLI factory default services container


// Define path to application directory
defined('APPLICATION_PATH')
|| define('APPLICATION_PATH', realpath(dirname(__FILE__)));

/**
 * Register the autoloader and tell it to register the tasks directory
 */
$loader = new \Phalcon\Loader();
$loader->registerDirs(
    array(
        APPLICATION_PATH . '/tasks',
        APPLICATION_PATH . 'models'
    )
);
$loader->registerNamespaces(
    array(
        'app\\tasks' => APPLICATION_PATH . '/tasks/',
        'app\\models' => APPLICATION_PATH . '/models/',
    )
);
$loader->register();

// Load the configuration file (if any)
if(is_readable(APPLICATION_PATH . '/config/config.php')) {
    $config = include APPLICATION_PATH . '/config/config.php';
    $di->set('config', $config);
}

//Create a console application
$console = new ConsoleApp();
$console->setDI($di);

/**
 * 设置config
 */
$di->set('config', function () use ($config) {
    return $config;

});

//$di->set('db', function () use ($config,$di) {
//    return \wl\tools\DbFactory::createDb($config->database);
//});
/**
 * Process the console arguments
 */
$arguments = array();
foreach($argv as $k => $arg) {
    if($k == 1) {
        $arguments['task'] = "app\\tasks\\".$arg;
    } elseif($k == 2) {
        $arguments['action'] = $arg;
    } elseif($k >= 3) {
        $arguments['params'][] = $arg;
    }
}

// define global constants for the current task and action
define('CURRENT_TASK', (isset($argv[1]) ? $argv[1] : null));
define('CURRENT_ACTION', (isset($argv[2]) ? $argv[2] : null));

try {
    // handle incoming arguments
    $console->handle($arguments);
}
catch (\Phalcon\Exception $e) {
    echo $e->getMessage()."\n";
    exit(255);
}