<?php

/**
 * 
 * @author Tibor Csik <csulok0000@gmail.com>
 * @copyright (c) 2014, Tibor Csik
 * @license The MIT License
 */

namespace Csulok\GuestBook;

class GuestBook {
    
    /**
     * 
     */
    const VERSION = 'v1.0.0.0';
    
    /**
     *
     * @var StoreInterface
     */
    protected $storeEngine = null;
    
    /**
     *
     * @var string
     */
    protected $templateDir = '';
    
    /**
     * 
     * @param StoreInterface $storeEngine File
     * @param string $templateDir
     */
    public function __construct(StoreInterface $storeEngine, $templateDir) {
        $this->storeEngine = $storeEngine;
        $this->templateDir = $templateDir;
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->newComment();
        }
        
        if (isset($_GET['full']) && $_GET['full'] == 1) {
            $this->listAllComments();
        } else {
            $this->listLastComments();
        }
        
    }
    
    /**
     * 
     */
    public function newComment() {
        $nick = isset($_POST['nick']) ? $_POST['nick'] : '';
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        $comment = isset($_POST['comment']) ? $_POST['comment'] : '';
        
        $this->storeEngine->addComment($nick, $email, $comment);
    }
    
    /**
     * 
     */
    public function listLastComments() {
        $this->display($this->storeEngine->getLastComments(10));
    }
    
    /**
     * 
     */
    public function listAllComments() {
        $this->display($this->storeEngine->getComments());
    }
    
    /**
     * 
     * @param array $data
     */
    public function display($data = array()) {
        include($this->templateDir . '/index.php');
    }
    
}