<?php
  class Database
  {
    function GetEventEntities($eventId)
    {
      $entity = array();
      $do = $this->GetEntitySql($eventId);
      while($row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($do))      
      {
        $entity[] = $row;
      }
         
      return $entity;
    }
    
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
    
    function GetEntitySql($eventId)
    {
      $sql = "SELECT e.uid, e.name as playername, f.name as fieldname, v.value FROM tx_sjsheventmanagereav_entity as e 
              inner join tx_sjsheventmanagereav_Value as v on e.uid = v.entity
              inner join tx_sjsheventmanagereav_event_to_field ef on v.field = ef.uid
              inner join tx_sjsheventmanagereav_field f on ef.idfield = f.uid
              where ef.idevent = ".$eventId." order by e.uid";
              

      return $GLOBALS['TYPO3_DB']->sql_query($sql);
    }
    
    function GetEventName($eventId)
    {
      $sql = "SELECT displayname FROM tx_sjsheventmanagereav_event
              where uid = ".$eventId;
      $do = $GLOBALS['TYPO3_DB']->sql_query($sql);
      
      $row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($do);    
      
      return $row["displayname"];      
    }
  }
?>