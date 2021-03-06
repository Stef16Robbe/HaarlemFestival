<?php 
require_once("Autoloader.php");
class HistoricTicketInfoView
{
	private $HistoricTicketInfoController;
	private $HistoricTicketInfoModel;
	private $PageContentHelper;

	public function __construct($historicTicketInfoController, $historicTicketInfoModel)
	{
		$this->HistoricTicketInfoController = $historicTicketInfoController;
		$this->HistoricTicketInfoModel = $historicTicketInfoModel;
		$this->PageContentHelper = new PageContentHelper();

	}

	//output to html
	public function output(){
		$page = "";
		$page .= $this->Header();
		$page .= $this->Body();
		$page .= $this->Footer();
		return $page;
	}

	private function Header(){
		return $this->HistoricTicketInfoController->GetConfig()->GetHeader("Historic");
	}

	private function Body(){
		$nav = new Nav();
		//Getting all page content of Historic ticket info in an array
		$pageTexts = $this->PageContentHelper->GetPageText("HistoricTicketInfo");
		$pageImages = $this->PageContentHelper->GetPageImage("HistoricHome");
		return $nav->SetNavBar("Historic").
		"<div id='main'>
		<div class='pageCenter'>
			<div class='ticketInfoContainer'>
				<div class='headerContainer'><div class='blackBar3'></div><h2>".current($pageTexts)."</h2><div class='blackBar3'></div></div><br>
				<h5 id='centerAndWide'>".next($pageTexts)."</h5>
					<div class='languageFlags'>
						<img class='languageFlag' src='".current($pageImages)."'><h5 class='languageTxt'>".next($pageTexts)."</h5>
						<img class='languageFlag' src='".next($pageImages)."'><h5 class='languageTxt'>".next($pageTexts)."</h5>
						<img class='languageFlag' src='".next($pageImages)."'><h5 class='languageTxt'>".next($pageTexts)."</h5>
					</div>
				<h5 id='centerAndWide'>".next($pageTexts)."</h5>
					<p class='dates'>	
						".next($pageTexts)."<br> 	
						".next($pageTexts)."<br>		
						".next($pageTexts)."<br>	
						".next($pageTexts)."	
					</p>
					<p class='times'>
						".next($pageTexts)."<br>
						".next($pageTexts)."<br>
						".next($pageTexts)."<br>
						".next($pageTexts)."
					</p>

				<h5 id='centerAndWide'>".next($pageTexts)."</h5>
					<p class='dates'>	
						".next($pageTexts)."<br>
						".next($pageTexts)."<br>
						".next($pageTexts)."	
					</p>
					<p class='times'>
						".next($pageTexts)."<br>
						".next($pageTexts)."<br>
						".next($pageTexts)."
					</p>
			</div>
			<div class='ticketInfoContainer'>
				<div class='headerContainer'><div class='blackBar4'></div><h2>".next($pageTexts)."</h2><div class='blackBar4'></div></div><br>
				<p class='pricesmoreHeader'>
					<br>".next($pageTexts)."<br>
 					".next($pageTexts)."
    			</p>
    			<p id='centerAndWide' class='pricesMoreText'>
					".next($pageTexts)."
    			</p>
    			<p id='centerAndWide' class='pricesMoreText'>
					".next($pageTexts)."
    			</p>
    			<p id='centerAndWide' class='pricesMoreText'>
					<b>".next($pageTexts)."</b><br>
					".next($pageTexts)."
    			</p>

    			<!-- Order now button -->
				<a href='HistoricOrderTickets.php' id='orderNowButton' type='submit' name='histroricOrderTicketsBTN'>".next($pageTexts)."</a>
			</div>
		</div>
		</div>";
	}

	private function Footer(){
		return $this->HistoricTicketInfoController->GetConfig()->SetFooter();
	}
}
?>
