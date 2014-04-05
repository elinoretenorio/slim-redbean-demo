<?php
/**
 * Slim+RedBean Demo
 *
 * @author      Elinore Tenorio <elinore.tenorio@gmail.com>
 * @license     MIT
 * @url         http://www.jobskee.com
 */

/*
 * Load the configuration file
 */
require 'config.php';

/*
 * Load all existing controllers
 */
foreach (glob(CONTROLLER_PATH . "*.php") as $controller) {
    require_once $controller;
}

$app->get('(/)', function () use ($app) {
    $app->render('index.php');
});

/*
 * default page controller
 */
$app->get('/:page', function ($page=null) use ($app) {
    $page = R::findOne('pages', ' url=:url ', array(':url'=>$page));
    if ($page && $page->id) {
        $app->render('page.php', array('page'=>$page));
    } else {
        $app->notFound();
    }
});

$app->notFound(function() use ($app) {
    $app->render('404.php');
});

// Run app
$app->run();