<?php 
namespace Acme\FindMartialBundle\Extension;

use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\ORM\Id\AbstractIdGenerator;
use Doctrine\ORM\EntityManager;

class IdGenerator extends AbstractIdGenerator {

	private $allocate = 0; //0x10;
	private $currentId = 0;
	private $maxId = 0;
	
	public function generate(EntityManager $em, $entity) {
		if ($this->currentId >= $this->maxId ) {
			$driver = $em->getConnection();
			$query = $driver->query("UPDATE `seq` SET value = (@cur_value := value) + ".($this->allocate));
			$res = $query->execute();
	
			$query = $driver->query("SELECT @cur_value;");
			$query->execute();
			$this->currentId = $query->fetchColumn(0);
			$this->maxId = $this->currentId + $this->allocate;
		} else {
			$this->currentId++;
		}
		
		return $this->currentId;
	}
}