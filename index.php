<?php

/**
 * 
 * @author Tibor Csik <csulok0000@gmail.com>
 * @copyright (c) 2014, Tibor Csik
 * @license The MIT License
 */

namespace Csulok\GuestBook;

/*
 *  Developer Mode
 */
define('DEV_MODE', false);

/*
 *  For developing
 */
if (DEV_MODE) {
    ini_set('display_errors', true);
    error_reporting(E_ALL);
}

/*
 * Load AutoLoder class
 */
require_once('Lib/AutoLoader.php');

/**
 * Initialize autoloader
 */
new AutoLoader();

/**
 * Set output buffering with gzip compressing, and set character encoding
 */
ob_start('ob_gzhandler');
header('Content-Type: text/html; charset=UTF-8');

/**
 * 
 * Create new Instance of GuestBook, and set FileStore for data storing
 */
new GuestBook(new FileStore(__DIR__ . '/Data'), __DIR__ . '/Template');