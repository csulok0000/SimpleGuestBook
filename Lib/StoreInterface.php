<?php

/**
 * 
 * @author Tibor Csik <csulok0000@gmail.com>
 * @copyright (c) 2014, Tibor Csik
 * @license The MIT License
 */

namespace Csulok\GuestBook;

Interface StoreInterface {
    
    /**
     * 
     * @param string $nick
     * @param string $email
     * @param string $comment
     * @return int
     */
    public function addComment($nick, $email, $comment);
    
    /**
     * 
     * @param int $limit
     * @return array
     */
    public function getLastComments($limit);
    
    /**
     * 
     * @return array
     */
    public function getComments();
    
}