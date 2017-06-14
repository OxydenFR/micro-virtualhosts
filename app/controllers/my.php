<?php
namespace controllers;
 use libraries\Auth;
use micro\orm\DAO;
use Ajax\semantic\html\content\view\HtmlItem;
use models\Virtualhost;
use models\Server;
 
 /**
 * Controller My
 **/
class My extends ControllerBase{
	
 
    /**
     * Mes services
     * Hosts et virtualhosts de l'utilisateur connect?
     */
    public function index(){
        if(Auth::isAuth()){
        	$user = Auth::getUser();
            $hosts=DAO::getAll("models\Host","idUser=".$user->getId());
           
            $hostsItems=$this->semantic->htmlItems("list-hosts");
            $hostsItems->fromDatabaseObjects($hosts, function($host){
                $item=new HtmlItem("");
                $item->addImage("public/img/host.jpg")->setSize("tiny");
                $item->addItemHeaderContent($host->getName(),$host->getIpv4(),"");
			
                return $item;
				
				
            });
				$bt=$this->jquery->semantic()->htmlButton("bt1","Virtualhosts");
			
            	
            	$idUser=DAO::getAll("models\Host","idUser=".$user->getId());
            	$hostsItems->fromDatabaseObjects($idUser, function($id){
            		$item=new HtmlItem("");
            		$item->addItemHeaderContent($id->getId());

            		$namevirtualhost=DAO::getAll("models\Virtualhost","idUser=".$id->getId());
					
            		
            	
            		
            	$hostsItems=$this->semantic->htmlItems("list-virtualhosts");
            	$hostsItems->fromDatabaseObjects($namevirtualhost, function($namevhost){
            		$item=new HtmlItem("");
            		$item->addImage("public/img/virtualhosts.png")->setSize("tiny");
					
            		$item->addItemHeaderContent($namevhost->getName(),"");
					$server = $namevhost->getServer("models\Virtualhost");
            		echo $namevhost->getServer(), "";
            			
            		return $item;
            		
            		
            		 });});
					 
            	
            	
            
            		
            		
            		
            	$this->jquery->compile($this->view);
            	$this->loadView("My/index.html");
            	
            	
            	
            
        }
            
    } 
}
