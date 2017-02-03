<?php
  class Entity
  {
    private $name;
    private $id;
    private $values;
  
    function Entity()
    {
      $this->values = array();
    }
  
    function GetName()
    {
      return $this->name;
    }
    
    function SetName($value)
    {
      $this->name = $value;
    }
    
    function GetId()
    {
      return $this->id;
    }
    
    function SetId($value)
    {
      $this->id = $value;
    }  
    
    function GetValues()
    {
      return $this->values;
    }
    
    function SetValues($value)
    {
      $this->values = $value;
    }
    
    function AddValue($value)
    {
      $this->values[] = $value;
    }  
  }
?>