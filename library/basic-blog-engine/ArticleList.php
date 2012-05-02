<?php 

require_once("Article.php");

class ArticleList {

	protected $list = array();
	protected $articleByHash = array();
	
	public function add(Article $article){
		$this->list[] = $article;
		$this->articleByHash[$article->getHash()] = $article;
	}
	
	public function getList(){
		return $this->list;
	}
	
	public function getByIndex($index){
		return $this->list[$index];
	}
	
	public function getByHash($hash){
		return $this->articleByHash[$hash];
	}
	
	public function size(){
		return count($this->list);
	}
	
}