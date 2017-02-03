<?php
class GetEntityService
{
   private $databaseObj;
   
   function GetEntityService($dbObj)
   {
      $this->databaseObj = $dbObj;
   }
   
   function GetEntities($eventId)
   {
      $array = $this->databaseObj->GetEventEntities($eventId);
      $newArray = Array();
      $tempId = 0;
      $currentObject = null;
                  
      foreach($array as $row)
      {
        if($tempId == $row["uid"])
        {
          $valuePair = new Value();
          $valuePair->SetField($row["fieldname"]);
          $valuePair->SetValue($row["value"]);
          $currentObject->AddValue($valuePair);
        }
        else
        {
          $tempId = $row["uid"];
          $entity = new Entity();
          $entity->SetName($row["playername"]);
          $entity->SetId($row["uid"]);
          $valuePair = new Value();
          $valuePair->SetField($row["fieldname"]);
          $valuePair->SetValue($row["value"]);
          $entity->AddValue($valuePair);
          $newArray[] = $entity;
          $currentObject = $entity;
        }
      }
      
      return $newArray;
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