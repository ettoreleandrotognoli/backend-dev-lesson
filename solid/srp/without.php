<?php

class Book {

    protected $author;
    protected $title;

    public function __construct($author,$title){
        $this->author = $author;
        $this->title = $title;
    }

    public function getAuthor(){
        return $this->author;
    }

    public function getTitle(){
        return $this->title;
    }

    public function printBook($format){
        switch ($format) {
            case 'plain-text':
                $text = 'Author: %s, Title: %s';
                echo sprintf($text,$this->author,$this->title),"\n";
                break;
            case 'html':
                $html = '<span>Author: <b>%s</b></span><span>Title: <b>%s</b></span>';
                echo sprintf($html,$this->author,$this->title),"\n";
                break;
            default:
                throw new Exception(sprintf('Format "%s" is not suportted'));
        }
    }

}

$book = new Book('GoF','Design Patterns');
$book->printBook('html');
$book->printBook('plain-text');