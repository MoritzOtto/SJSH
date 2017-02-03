<?php
namespace SJSH\sjshgpadmin\Domain\Model;

class Player extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {
 
	 /**
	  *
	  */
	 public function __construct() {
	 }
 
    /**
     * @var string
     */
    public $firstname;
	
	 /**
     * @var string
     */
    public $lastname;
	
	 /**
     * @var string
     */
    public $club;
	
	 /**
     * @var string
     */
    public $ageclass;
	
	 /**
     * @var integer
     */
    public $place;
	
	/**
     * @var integer
     */
    public $tournament;
}
?>