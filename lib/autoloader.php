<?php

/**
 * 
 * @author Tibor Csik <csulok0000@gmail.com>
 * @copyright (c) 2014, Tibor Csik
 */

namespace Csulok\GuestBook;

if (!define('AUTOLOAD_DIR')) {
    define('AUTOLOAD_DIR', __DIR__);
}

class AutoLoader {
    
    public function __construct() {
        spl_autoload_register(array($this, 'loader'));
    }
    
    public function loader($class) {
        if (strstr($class, __NAMESPACE__)) {
            $lib = AUTOLOAD_DIR . '/' . substr($class, strlen(__NAMESPACE__)) . 'php';
        }
    }
}