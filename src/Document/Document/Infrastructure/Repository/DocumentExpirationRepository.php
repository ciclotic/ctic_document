<?php
namespace CTIC\Document\Document\Infrastructure\Repository;

use CTIC\Document\Document\Domain\DocumentExpiration;
use CTIC\App\Base\Infrastructure\Repository\EntityRepository;

abstract class DocumentExpirationRepository extends EntityRepository
{
    /**
     * @return DocumentExpiration[]
     */
    public function findAllOrderedByName(): array
    {
        $qb = $this->createQueryBuilder('r')
            ->orderBy('r.name', 'ASC')
            ->getQuery();

        return $qb->execute();
    }

    /**
     * @return DocumentExpiration
     *
     * @throws
     */
    public function findOneRandom(): DocumentExpiration
    {
        $qb = $this->createQueryBuilder('r')
            ->orderBy('r.name', 'ASC')
            ->getQuery();

        /** @var DocumentExpiration $document */
        $document = $qb->setMaxResults(1)->getOneOrNullResult();

        return $document;
    }
}