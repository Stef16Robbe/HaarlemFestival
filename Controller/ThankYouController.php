<?php
	require_once( "Autoloader.php");
class ThankYouController 
{
	private $IndexModel;
	private $Session;
	private $Config;

	public function __construct($indexModel){
		$this->IndexModel = $indexModel;
		$this->Config = Config::getInstance();
		$Session = new Session;
		$Session->CleanCart();
	}
	
	//get config
	public function GetConfig(){
		return $this->Config;
	}
}
?>