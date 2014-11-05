<?php

namespace Acme\FindMartialBundle\Extension;

use Symfony\Component\Security\Acl\Dbal\MutableAclProvider;


class CustomAclProvider extends MutableAclProvider 
{

	private function _getEntitiesIdsMatchingRoleMaskSql($className, array $roles, $requiredMask)
	{
	    $rolesSql = array();
	    foreach($roles as $role) {
	        $rolesSql[] = 's.identifier = ' . $this->connection->quote($role);
	    }
	    $rolesSql =  '(' . implode(' OR ', $rolesSql) . ')';

        $sql =
<<<SELECTCLAUSE
	        SELECT 
	            oid.object_identifier
	        FROM 
	            {$this->options['entry_table_name']} e
	        JOIN 
	            {$this->options['oid_table_name']} oid ON (
	            oid.id = e.object_identity_id
	        )
	        JOIN {$this->options['sid_table_name']} s ON (
	            s.id = e.security_identity_id
	        )     
	        JOIN {$this->options['class_table_name']} class ON (
	            class.id = e.class_id
	        )
	        WHERE 
	            {$this->connection->getDatabasePlatform()->getIsNotNullExpression('e.object_identity_id')} AND
	            (e.mask & %d) AND
	            $rolesSql AND
	            class.class_type = %s
SELECTCLAUSE;


	    return sprintf(
	        $sql,
	        $requiredMask,
	        $this->connection->quote($className)
	    );

	}


	public function getAllowedEntitiesIds($className, array $roles, $mask, $asString = true)
	{

	    // Check for class-level global permission (its a very similar query to the one
	    // posted above
	    // If there is a class-level grant permission, then do not query object-level
	    /*
	    if ($this->_maskMatchesRoleForClass($className, $roles, $requiredMask)) {
	        return true;
	    } 
	    */        

	    // Query the database for ACE's matching the mask for the given roles
	    $sql = $this->_getEntitiesIdsMatchingRoleMaskSql($className, $roles, $mask);
	    $ids = $this->connection->executeQuery($sql)->fetchAll(\PDO::FETCH_COLUMN);

	    // No ACEs found
	    if (!count($ids)) {
	        return false;
	    }

	    if ($asString) {
	        return implode(',', $ids);
	    }

	    return $ids;
	}

}
