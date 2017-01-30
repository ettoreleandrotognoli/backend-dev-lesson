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

}

interface BookPrinter {

    public function printBook(Book $book);
}

class HTMLBookPrinter {

    public function printBook(Book $book){
        $html = '<span>Author: <b>%s</b></span><span>Title: <b>%s</b></span>';
        echo sprintf($html,$book->getAuthor(),$book->getTitle()),"\n";
    }

}

class PlainTextBookPrinter {
    public function printBook(Book $book){
        $text = 'Author: %s, Title: %s';
        echo sprintf($text,$book->getAuthor(),$book->getTitle()),"\n";
    }
}



$book = new Book('GoF','Design Patterns');
(new HTMLBookPrinter())->printBook($book);
(new PlainTextBookPrinter())->printBook($book);
