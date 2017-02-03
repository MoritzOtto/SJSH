<?php
  class DatabasePi2
  {
   
    function GetFields($eventId)
    {
      $fields = array();
      $sql = "SELECT name FROM tx_sjsheventmanagereav_field f
              inner join tx_sjsheventmanagereav_event_to_field ef on f.uid = ef.idfield
              where ef.idevent  = ".$eventId;
      $do = $GLOBALS['TYPO3_DB']->sql_query($sql);
      
      while($row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($do))      
      {
        $fields[] = $row;
      }
         
      return $fields;
    }
    
    function GetEventName($eventId)
    {
      $sql = "SELECT displayname FROM tx_sjsheventmanagereav_event
              where uid = ".$eventId;
      $do = $GLOBALS['TYPO3_DB']->sql_query($sql);
      
      $row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($do);    
      
      return $row["displayname"];      
    }
    
    function SaveEntity($values, $eventId)
    {
      $sql = "insert into tx_sjsheventmanagereav_entity(name) values('xxxxx')";
      $GLOBALS['TYPO3_DB']->sql_query($sql);
      
      $sql = "select max(uid) as maxId from tx_sjsheventmanagereav_entity";
      $do = $GLOBALS['TYPO3_DB']->sql_query($sql);
      $row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($do);
      $maxId = $row["maxId"];
      
      foreach($values as $v)
      {
        
        $sql = "select ef.uid as id from tx_sjsheventmanagereav_event_to_field ef
                inner join tx_sjsheventmanagereav_field f on f.uid = ef.idfield
                where f.name = '".$v->GetField()."' and ef.idevent = ".$eventId;
        $do = $GLOBALS['TYPO3_DB']->sql_query($sql);
        $row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($do);
        $eTfRelation = $row["id"];
		
        
        $sql = "insert into tx_sjsheventmanagereav_Value(entity, field, value) 
                values(".$maxId.", ".$eTfRelation.", '".$v->GetValue()."')";      
         $GLOBALS['TYPO3_DB']->sql_query($sql);
      }
    }
  }
?>