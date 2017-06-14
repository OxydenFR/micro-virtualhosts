<?php
namespace controllers;
use micro\orm\DAO;
use Ajax\semantic\html\content\view\HtmlItem;
use Ajax\semantic\html\elements\HtmlButton;
class Hosts extends ControllerBase{
	public function index(){
		$hosts=DAO::getAll("models\Host");
		echo "<h1>Hosts<h1>";
		$semantic=$this->jquery->semantic();
		$clientsItems=$semantic->htmlItems("list-hosts");
		$clientsItems->fromDatabaseObjects($hosts, function($host ){
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