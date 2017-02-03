<?php
class GetEntityServicePi2
{
   private $databaseObj;
   
   function GetEntityServicePi2($dbObj)
   {
      $this->databaseObj = $dbObj;
   }

  function GetFields($eventId)
  {
     return $this->databaseObj->GetFields($eventId);
  }
  
  function GetEventName($eventId)
  {
      return $this->databaseObj->GetEventName($eventId);
  }
}
?>