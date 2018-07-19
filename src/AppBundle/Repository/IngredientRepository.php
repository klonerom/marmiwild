<?php

namespace AppBundle\Repository;

/**
 * IngredientRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class IngredientRepository extends \Doctrine\ORM\EntityRepository
{
    public function findAllOrderByType()
    {
        return $this->findBy(array(), array('type' => 'ASC'));
    }

}
