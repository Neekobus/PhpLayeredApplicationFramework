<?php 

class Article  {
	
	protected $hash;
	protected $title;
	protected $author;
	protected $publicationDate;
	protected $content;
	
	public function getHash(){
		return $this->hash;
	}
	
	public function setHash($hash){
		$this->hash = $hash;
	}
	
	public function getTitle(){
		return $this->title;
	}
	
	public function setTitle($title){
		$this->title = $title;
	}

	public function getAuthor(){
		return $this->author;
	}
	
	public function setAuthor($author){
		$this->author = $author;
	}
	
	public function getPublicationDate(){
		return $this->publicationDate;
	}
	
	public function setPublicationDate(DateTime $publicationDate){
		$this->publicationDate = $publicationDate;
	}
	
	public function getContent(){
		return $this->content;
	}
	
	public function setContent($content){
		$this->content = $content;
	}
}