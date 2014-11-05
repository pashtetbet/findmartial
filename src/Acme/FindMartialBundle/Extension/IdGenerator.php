<?php 
namespace Acme\FindMartialBundle\Extension;

use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\ORM\Id\AbstractIdGenerator;
use Doctrine\ORM\EntityManager;

class IdGenerator extends AbstractIdGenerator {

	private $allocate = 1; //0x10;
	private $currentId = 0;
	private $maxId = 0;
	
	public function generate(EntityManager $em, $entity) {
		
		if ($this->currentId >= $this->maxId ) {

			$driver = $em->getConnection();

			$driver->query('UPDATE seq SET value = LAST_INSERT_ID(value)+'.$this->allocate);

			$this->currentId = $driver->fetchColumn('SELECT LAST_INSERT_ID();', array(0), 0);

			$this->maxId = $this->currentId + $this->allocate;

		} else {
			$this->currentId++;
		}
		
		return $this->currentId;
	}
}