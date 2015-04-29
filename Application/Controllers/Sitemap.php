<?php
 
namespace Application\Controllers;

class Sitemap extends \Library\Controller\Controller{

	private $message;

	public function __construct(){
		parent::__construct();
		$this->setLayout('sitemap');
		$this->message 				= new \Library\Message\Message();

	}


	
	public function sitemapAction(){

	
		
		
		if(isset($_POST['btn'])){
			
			
		}




		
		$sitemap 	= new \Library\Sitemap\Sitemap();
		
		//$res=$librarySitemap->getIngredients();


		$this->setDataView(array(
			"message" 		=> $this->message->showMessages(),
			"sitemap" 		=> ($sitemap->strSitemap),
			"sitemaplog" 	=> $sitemap->strLog
			));

	}

	

}