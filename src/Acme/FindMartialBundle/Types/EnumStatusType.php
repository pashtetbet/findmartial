<?php
namespace Acme\FindMartialBundle\Types;

class EnumStatusType extends EnumType
{
    protected $name = 'enumstaus';
    protected $values = array('active', 'notactive');
}
