<?php 

require_once("ArticleList.php");

interface ArticleDaoInterface {

	public function loadAll(ArticleList $list);
		
}