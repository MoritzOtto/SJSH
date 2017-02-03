<?php
namespace SJSH\sjshgpadmin\Controller;

/** copyright notice **/
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use SJSH\sjshgpadmin\Repository;
use SJSH\sjshgpadmin\Domain\Model;
 
/**
 * The main Controller, managing all the tasks for SjshGpadmin management
 */
class SjshGpadminController extends ActionController{
	
	/**
	 * @var \SJSH\SjshGpAdmin\Repository\PlaceToPointService
	 */
	private $placeToPointService;
	
	/**
	 * @var \SJSH\SjshGpAdmin\Repository\DatabaseServices
	 */
	private $databaseServices;
	
	private $year;
		
	public function __construct() {
		$this->placeToPointService = new \SJSH\sjshgpadmin\Domain\Repository\PlaceToPointService();
		$this->databaseServices = new \SJSH\sjshgpadmin\Domain\Repository\DatabaseServices();
		$this->year = date("Y");
	}
 
    /**
     * initial action, called on a clean request without specified target
     */
    public function indexAction() {
		$aks = $this->databaseServices->getAks();
		$tournaments = $this->databaseServices->getTurnierByYear($this->year);
		
		$place = $this->placeToPointService->Execute();
	
		foreach($place as $p)
		{
			$player = new \SJSH\sjshgpadmin\Domain\Model\Player();
			$player->place = $p->place;
			$players[] = $player; 
		}
		
		 $this->view->assign('aks', $aks);
		 $this->view->assign('place', $place);
		 $this->view->assign('players', $players);
		 $this->view->assign('tournaments', $tournaments);
    }
	
	/**
	* action cform
	* @param array $place 
	* @param array $firstname 
	* @param array $lastname 
	* @param array $club 
	* @param array $ak 
	* @return void
	*/
	public function saveAction(array $place, array $firstname, array $lastname, array $club, array $ak) {
		$i = 0;
		$tournamendb = $this->databaseServices->getTurnierById($this->request->getArgument('tournament'));
				
		foreach($firstname as $name)
		{
			if($name != "" && $lastname[$i] != "")
			{
				$player = new \SJSH\sjshgpadmin\Domain\Model\Player();
				$player->firstname = $name;
				$player->lastname = $lastname[$i];
				$player->club = $club[$i];
				$player->ageclass = $ak[$i];
				$player->place = $place[$i];
								print_r ($player);
				$players[] = $player;
			}
			
			$i++;
		}
		
		foreach($players as $playerObject)
		{
			//Insert club if not exists
			$this->databaseServices->InsertClubIfNotExists($playerObject);
			
			//Insert Player if not exists
			$this->databaseServices->InsertPlayerIfNotExists($playerObject);
			
			//Update club
			$this->databaseServices->UpdateClub($playerObject);
			
			//Insert AgeClassToPlayer
			$this->databaseServices->InsertAgeClassToPlyerIfNotExists($playerObject, $this->year);
			
			//Insert Or Update Points
			$placeObject = $this->placeToPointService->GetPoints($playerObject->place);
			$this->databaseServices->InsertOrUpdatePoints($playerObject, $placeObject, $tournamendb);
		}
	}
}
?>