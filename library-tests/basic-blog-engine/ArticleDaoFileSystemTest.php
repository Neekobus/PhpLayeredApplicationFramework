<?php 

require_once("library/basic-blog-engine/ArticleDaoInterface.php");
require_once("library/basic-blog-engine/ArticleDaoFileSystem.php");

class ArticleDaoFileSystemTest extends PHPUnit_Framework_TestCase {
	
	protected $fileToDel=array();
	protected $dirToDel=array();
	
	public function setUp(){
		//fixtures
		$validContent1 = '<html><head>
		<title>Ceci est un titre</title>
		<meta name="author" content="jeanlouisgalere"/>
		<meta name="date" content="2011-01-02"/>
		</head><body>
		<h1>Art 1 Contenu du body</h1><p>Contenu du body</p></body></html>';
		
		$invalidContent2 = '<html><head>
		<invalid>Ceci est un autre titre</invalid>
		<meta name="author" content="jeanlouisgalere"/>
		<meta name="date" content="2011-02-02"/>
		</head><body>
		<h1>Art 2 Contenu du body</h1><p>Contenu du body</p></body></html>';
		
		$validContent3 = '<html><head>
		<title>Mon super article</title>
		<meta name="author" content="robert smith de the cure"/>
		<meta name="date" content="2010-12-12"/>
		</head><body>
		<h1>Art 3 Contenu</h1><p>Contenu</p><p>Contenu</p><p>Contenu</p><p>Contenu</p></body></html>';
		
		$filesToCreate = array(
			'./tests-articles/2010-10-01/' => $validContent1,
			'./tests-articles/2010-09-11/' => $invalidContent2,
			'./tests-articles/2011-05-01/' => $validContent3,			
		);
		
		foreach($filesToCreate as $dir => $content){
			$this->createFile($dir, $content);
		}
		
		$this->dirToDel[] = './tests-articles';
	}
	
	public function tearDown(){
		foreach($this->fileToDel as $file){
	    	unlink($file);
		}
	
		foreach($this->dirToDel as $dir){
			rmdir($dir);
		}	
	}
	
	protected function createFile($dir, $content){
		if (file_exists($dir)) {
			return;
		}
		
		mkdir($dir, 0777, true);
		file_put_contents($dir . 'index.xhtml', $content);
		
		$this->fileToDel[]=$dir . 'index.xhtml';
		$this->dirToDel[]=$dir;
		
	}
	
	public function testDaoImplementInterface(){
		$dao = new ArticleDaoFileSystem('.');
		$this->assertTrue($dao instanceof ArticleDaoInterface);
	}
	
	public function testDaoLoadValidArticles(){
		$dao  = new ArticleDaoFileSystem('tests-articles');
		$list = new ArticleList();
		
		$dao->loadAll($list);
		
		$this->assertEquals(2, $list->size());
		
		$this->assertArticle($list->getByHash("ceci-est-un-titre"), "ceci-est-un-titre", "Ceci est un titre", "jeanlouisgalere", new DateTime("2011-01-02"), "<h1>Art 1 Contenu du body</h1><p>Contenu du body</p>");
		$this->assertArticle($list->getByHash("mon-super-article"), "mon-super-article", "Mon super article", "robert smith de the cure", new DateTime("2010-12-12"), "<h1>Art 3 Contenu</h1><p>Contenu</p><p>Contenu</p><p>Contenu</p><p>Contenu</p>");
	}
	
	public function assertArticle(Article $article, $hash, $title, $author, $publicationDate, $content){
		$this->assertEquals($article->getHash(), $hash);
		$this->assertEquals($article->getTitle(), $title);
		$this->assertEquals($article->getAuthor(), $author);
		$this->assertEquals($article->getPublicationDate(), $publicationDate);
		$this->assertEquals($article->getContent(), $content);
	}
	
}