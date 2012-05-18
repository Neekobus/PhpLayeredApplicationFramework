<?php 
require_once(ROOT_DIR . "/basic-blog-engine/ArticleDaoFileSystem.php");

class ArticleListController extends AbstractApplicationController implements ApplicationLayerInterface {

	public function run(DataContainerInterface $applicationData){
		$dao = new ArticleDaoFileSystem('blog/content/');
		$list = new ArticleList();
		$dao->loadAll($list);
		
		$hash = $applicationData->get('request')->get('article');
		$applicationData->get('vars')->set('articles', $list);
	}
		
}