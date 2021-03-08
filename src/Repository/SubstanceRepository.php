<?php

declare(strict_types=1);

namespace App\Repository;


use App\Entity\Substance;
use Doctrine\ORM\EntityRepository;

class SubstanceRepository extends EntityRepository
{
    /**
     * @param int $casNumber
     *
     * @return Substance|null
     */
    public function getSubstanceByCASNumber(int $casNumber): ?Substance
    {
        $qb = $this->getEntityManager()->createQueryBuilder();

        $qb->select()
            ->from('substances', 's')
            ->where('s.casNumber = :casNumber')
            ->setParameter('casNumber', $casNumber);

        return $qb->getQuery()->getOneOrNullResult();
    }

    public function getSubstanceByECNumber(int $ecNumber): ?Substance
    {
        $qb = $this->getEntityManager()->createQueryBuilder();

        $qb->select()
            ->from()
            ->where('s.ecNumber = :ecNumber')
            ->setParameter('ecNumber', $ecNumber);

        return $qb->getQuery()->getOneOrNullResult();
    }

    /**
     * @param string $name
     * @param false $asArray
     *
     * @return Substance|array
     */
    public function getSubstancesByName(string $name, $asArray = false): Substance|array
    {
        $qb = $this->getEntityManager()->createQueryBuilder();

        $qb->select('s')
            ->from('substance', 's')
            ->where('s.name LIKE :name')
            ->setParameter('name', $name);

        if($asArray) {
            return $qb->getQuery()->getArrayResult();
        }
        return $qb->getQuery()->getResult();

    }

    /**
     * @param Substance $substance
     *
     * @return array
     */
    public function getRegulationsApplicableToSubstance(Substance $substance): array
    {
        $substanceId = $substance->getId();

        $qb = $this->getEntityManager()->createQueryBuilder();

        //TODO query builder get regulations

        return $qb->getQuery()->getArrayResult();

    }

    /**
     * @param Substance $substance
     *
     * @return array
     */
    public function getArticlesApplicableToSubstance(Substance $substance): array
    {
        $substanceId = $substance->getId();

        $qb = $this->getEntityManager()->createQueryBuilder();

        //TODO query builder get regulations

        return $qb->getQuery()->getArrayResult();
    }
}