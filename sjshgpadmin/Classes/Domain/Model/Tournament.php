<?php
namespace SJSH\sjshgpadmin\Domain\Model;

class Tournament extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {
 
	 /**
	  *
	  */
	 public function __construct() {
	 }
 
    /**
     * @var int
     */
    public $id;

	 /**
     * @var string
     */
    public $name;
}
?>