<?php
namespace SJSH\sjshgpadmin\Domain\Repository; 

use SJSH\sjshgpadmin\Domain\Model;

class PlaceToPointService {
 
    public function Execute() {
		$place[] = $this->CreatePlacePoints(1, 10);
		$place[] = $this->CreatePlacePoints(2, 8);
		$place[] = $this->CreatePlacePoints(3, 6);
		$place[] = $this->CreatePlacePoints(4, 5);
		$place[] = $this->CreatePlacePoints(5, 4);
		$place[] = $this->CreatePlacePoints(6, 3);
		$place[] = $this->CreatePlacePoints(7, 2);
		$place[] = $this->CreatePlacePoints(8, 1);
		
		return $place;
    }
	
	public function GetPoints($place)
	{
		$placePoints = $this->Execute();
		
		foreach($placePoints as $thatPlace)
		{
			if($thatPlace->place == $place)
			{
				return $thatPlace;
			}
		}
		
		return CreatePlacePoints(NULL, 0);
	}
	
	private function CreatePlacePoints($place, $points)
	{
		$placeObject = new \SJSH\sjshgpadmin\Domain\Model\Place_Points();
		$placeObject->place = $place;
		$placeObject->points = $points;
		return $placeObject;
	}
}
?>