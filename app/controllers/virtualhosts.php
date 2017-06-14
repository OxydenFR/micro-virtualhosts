<?php
namespace controllers;
use micro\orm\DAO;
use Ajax\semantic\html\content\view\HtmlItem;
use Ajax\semantic\html\elements\HtmlButton;
class Virtualhosts extends ControllerBase{
	public function index(){
		$virtualhosts=DAO::getAll("models\Virtualhosts");
		echo "<h1>Virtualhosts<h1>";
		$semantic=$this->jquery->semantic();
		$clientsItems=$semantic->htmlItems("list-virtualhosts");
		$clientsItems->fromDatabaseObjects($virtualhosts, function($virtualhost ){
			$item=new HtmlItem("");
			$item->addImage("public/img/host.png")->setSize("tiny");
			$item->addItemHeaderContent($host->getName(),$host->getIpv4(),new HtmlButton("",""));
			return $item;
		});
		echo $clientsItems;
		#foreach ($hosts as $host){
		#	echo $host->getName()."-"."<br>";
		#}
	}
}