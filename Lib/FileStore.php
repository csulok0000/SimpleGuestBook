<?php

/**
 * 
 * @author Tibor Csik <csulok0000@gmail.com>
 * @copyright (c) 2014, Tibor Csik
 * @license The MIT License
 */

namespace Csulok\GuestBook;

class FileStore implements StoreInterface {
    
    /**
     *
     * @var string
     */
    protected $path = '';
    
    /**
     *
     * @var SimpleXmlElement
     */
    protected $xml = null;
    
    /**
     *
     * @var String
     */
    protected $fileName = '';
    
    /**
     * 
     * @param string $path
     */
    public function __construct($path) {
        $this->path = $path;
        $this->fileName = $this->path . '/Comments.xml';
        
        if (file_exists($this->fileName)) {
            /**
             * Load existing XML
             */
            $this->xml = simplexml_load_file($this->fileName);
        } else {
            /**
             * Create new XML
             */
            $this->xml = new \SimpleXMLElement('<comments />');
        }
    }
    
    /**
     * 
     */
    public function __destruct() {
        $this->xml->saveXML($this->fileName);
    }

    /**
     * 
     * @param string $nick
     * @param string $email
     * @param string $comment
     * @return int Inserted comment id
     */
    public function addComment($nick, $email, $comment) {
        
        $id = 1;
        if ($this->xml->count() > 0) {
            $id = $this->xml->comment[$this->xml->count() - 1]->id + 1;
        }
        
        $child = $this->xml->addChild('comment');
        
        $child->addChild('id', $id);
        $child->addChild('nick', $this->clear($nick));
        $child->addChild('email', $this->clear($email));
        $child->addChild('comment', $this->clear($comment));
        $child->addChild('createdAt', time());
        
        return $id;
    }
    
    /**
     * 
     * @param int $limit
     * @return array
     */
    public function getLastComments($limit) {
        $data = array();
        $count = $this->xml->count();
        if ($count > 0) {
            for ($i = $count - 1; $i >= 0 && $i > $count - $limit - 1; $i--) {
                $data[] = (array) $this->xml->comment[$i];
            }
        }
        return $data;
    }
    
    /**
     * 
     * @return int
     */
    public function getComments() {
        $data = array();
        for ($i = $this->xml->count() - 1; $i >= 0; $i--) {
            $data[] = (array) $this->xml->comment[$i];
        }
        return $data;
    }
    
    /**
     * 
     * Clearing text by html tags 
     * 
     * @param string $text
     * @return string
     */
    protected function clear($text) {
        $text = strip_tags($text);
        $text = nl2br($text);
        return $text;
    }
}