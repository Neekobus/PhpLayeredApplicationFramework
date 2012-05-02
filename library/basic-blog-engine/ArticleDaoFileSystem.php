<?php 

require_once("ArticleDaoInterface.php");

class ArticleDaoFileSystem implements ArticleDaoInterface {

	protected $basePath;

	public function __construct($basePath){
		$this->basePath = $basePath;
	}

	public function loadAll(ArticleList $list){		
		$files = new FilesystemIterator($this->basePath);
		foreach($files as $dir){
			$article = $this->loadOne($dir . '/index.xhtml');

			if ($article != null) {
				$list->add($article);
			}
		}
		
	}
		
	protected function loadOne($file){
		$xml = new SimpleXMLElement($file, 0, true);
		
		if ((string) $xml->head->title == null){
			return null;
		}

		$article = new Article();

		foreach($xml->head->meta as $meta){
			$name = (string) $meta['name'];
			$content = (string) $meta['content'];
			
			switch($name){
				case 'date':
					$article->setPublicationDate(new DateTime($content));
					break;
				case 'author':
					$article->setAuthor($content);
					break;
			}
		}

		$article->setTitle((string) $xml->head->title);
		$article->setHash($this->getHash( $article->getTitle() ));

		$content="";
		foreach($xml->body->children() as $child){
			$content .= $child->asXml();
		}
		
		$article->setContent($content);

		return $article;
	}
	
	protected function getHash($title){
		
		$hash = strtolower($title);
		$hash = strtr($hash, ' ', '-');
		$hash = strtr($hash, 'àáâãäçèéêëìíîïñòóôõöùúûüýÿÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝ', 'aaaaaceeeeiiiinooooouuuuyyAAAAACEEEEIIIINOOOOOUUUUY');
		
		return $hash;
	}
}