<?php

namespace Grase\RadminBundle\Entity\Radius;

use Doctrine\ORM\EntityRepository;

/**
 * UserRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class UserRepository extends EntityRepository
{
    public function findByGroup($group = null)
    {

        $query = $this->getEntityManager()->createQueryBuilder()
            ->select('u', 'rc', 'ug')
            ->from('GraseRadminBundle:Radius\User', 'u')
            ->leftJoin('u.radiuscheck', 'rc')
            ->leftJoin('u.usergroups', 'ug')
            ->leftJoin('ug.group', 'groups');

        if ($group) {
            $query->where('groups.name = :groupname')
                ->setParameter('groupname', $group);
        }
        return $query->getQuery()->getResult();
    }

}