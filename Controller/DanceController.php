<?php
	require_once( "Autoloader.php");
class DanceController 
{
	private $DanceModel;
	private $Session;
	private $Config;

	public function __construct($danceModel){
		$this->Dancemodel = $danceModel;
		$this->Config = Config::getInstance();
		$this->DanceRepository = new DanceRepository;

		$this->Dancemodel->SetArtists($this->DanceRepository->GetArtists());
	}
	
	//get config
	public function GetConfig(){
		return $this->Config;
	}

	public function GetLocation(){
		$locations = $this->DanceRepository->GetLocations();

		$venues="";
		foreach ($locations as $location) {
			$venues.= "<div class='Location'><b>".$location["Name"]."</b><br>".$location["Location"]."</div>";
		}

		return $venues;
	}

	public function GetSpecialTickets(){
		$specials = $this->DanceRepository->Get_AllSpecialEvents();

		$specialTickets="";
		if(count($specials) > 0){

			foreach ($specials as $special) {
				$specialTickets.= "
				<tr>
				<td>".$special["description"]."</td><td>&euro; ".$special["price"]."</td>
				<td><input type='Button' class='AddButton'
				onclick='AddToCart(".$special["ID"].",2,1)' name='' value='Add to cart'></td>
				</tr>";
			}
		}
		else{
			$specialTickets .= "<i style='color:red;'>There are no Sessions</i>";
		}

		return $specialTickets;
	}
	
	Public function SetArtists(){
		$artistslist = "";

		//If Dutch is chosen switch to it.
		if (isset($_SESSION['Language']) && EncryptionHelper::Decrypt($_SESSION['Language']) == 'Dutch') {
			foreach ($this->DanceRepository->GetArtistsNL() as $artist) {
				$artistslist .= "<div class='Artist' data-toggle='modal' data-target='#Artists".$artist["Id"]."'>".$artist["Name"]." <img class='ArtistImage' src='".$artist["ImageName"]."'> </div>";
			}
		}
		//By default we use English.
		else{
			foreach ($this->DanceRepository->GetArtists() as $artist) {
				$artistslist .= "<div class='Artist' data-toggle='modal' data-target='#Artists".$artist["Id"]."'>".$artist["Name"]." <img class='ArtistImage' src='".$artist["ImageName"]."'> </div>";
			}
		}

		return $artistslist;
	}

	public function GetModals(){
		$modals = "";

		//If Dutch is chosen switch to it.
		if (isset($_SESSION['Language']) && EncryptionHelper::Decrypt($_SESSION['Language']) == 'Dutch') {
			foreach ($this->DanceRepository->GetArtistsNL() as $artist) {
				$modals .= $this->GetModal($artist);	
			}
		}
		//By default we use English.
		else{
			foreach ($this->DanceRepository->GetArtists() as $artist) {
				$modals .= $this->GetModal($artist);	
			}
		}
		return $modals;
	}

	public function GetModal($artist){
		return "
		<div class='modal fade' id='Artists".$artist["Id"]."' role='dialog'>
		    <div class='modal-dialog modal-lg ModalWidth'>
		    
		      <!-- Modal content-->
		      <div class='modal-content'>
		        <div class='modal-header'>
		          <h4 class='modal-title'>".$artist["Name"]."</h4>
		          <button type='button' class='close' data-dismiss='modal'>&times;</button>
		        </div>
		        <div class='modal-body ModalHeight'>
		          <div class='ArtistInfo'>
		            <img src='".$artist["ImageName"]."'>
		            Genre: ".$artist["Types"]."
		            <br>
		            <h4>Known for:</h4>
		            ".$this->SetKnownFor($artist["KnownFor"])."
		          </div>
		          <div class='ArtistTickets'>
		            <p>".$artist["About"]."
		            </p>
		            <h4>Optredens:</h4>
		            <table>
		              <tr>	<td class='td'>Location:</td>
		              		<td class='td'>Time</td>
		              		<td class='td'>Price</td>
		              		<td></td>
		              		<td></td>
		              </tr>
		            ".$this->SetTable($artist["Id"])."
		            </table>
		          </div>
		        </div>
		      </div>
		      </div>
		    </div>";
	}

	public function SetTable($artistId){
		$Sessions = $this->DanceRepository->GetEventsByArtist($artistId);
		$tablerows ="";
		if(count($Sessions) > 0){
			foreach ($Sessions as $session) {
				$tablerows.="<tr>
				<td class='td'>".$session["Venue"]."</td>
				<td class='td'>".$session["StartDateTime"]."</td>
				<td class='td'>€".$session["Price"]."</td> <td>
				<td class='td'>
				<input type='Button' class='AddButton'
				onclick='AddToCart(".$session["ID"].",2,1)' name='' value='Add to cart'></td> 
				<td></td>
				</tr>
				<hr>";
			}
		}
		else{
			$tablerows .= "<i style='color:red;'>There are no Sessions</i>";
		}
		return $tablerows;
	}

	public function SetKnownFor($allKnownFor){
		$types = explode(",", $allKnownFor);
		$typelist = "<ul>";
		foreach ($types as $type) {
			$typelist .= " <li>".$type."</li>";
		}
 		$typelist .= "</ul>";
		return $typelist;
	}
}
?>