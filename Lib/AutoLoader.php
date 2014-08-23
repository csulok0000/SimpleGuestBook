<?php

/**
 * 
 * @author Tibor Csik <csulok0000@gmail.com>
 * @copyright (c) 2014, Tibor Csik
 * @license The MIT License
 */

namespace Csulok\GuestBook;

if (!defined('AUTOLOAD_DIR')) {
    define('AUTOLOAD_DIR', __DIR__);
}

class AutoLoader {
    
    /**
     * 
     */
    public function __construct() {
        spl_autoload_register(array($this, 'loader'));
    }
    
    /**
     * 
     * @param string $class
     * @return boolean
     */
    public function loader($class) {
        /**
         * Only for Csulok\GuestBook namespace
         */
        if (strstr($class, __NAMESPACE__)) {
            $lib = AUTOLOAD_DIR . '/' . substr($class, strlen(__NAMESPACE__) + 1) . '.php';
            
            if (file_exists($lib)) {
                include_once($lib);
                return true;
            }
            return false;
        }
    }
}