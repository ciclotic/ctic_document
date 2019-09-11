<?php
namespace CTIC\Document\Document\Infrastructure\Repository;

use CTIC\Document\Document\Domain\DocumentSeriesSet;
use CTIC\App\Base\Infrastructure\Repository\EntityRepository;

abstract class DocumentSeriesSetRepository extends EntityRepository
{
    /**
     * @return DocumentSeriesSet[]
     */
    public function findAllOrderedByName(): array
    {
        $qb = $this->createQueryBuilder('r')
            ->orderBy('r.name', 'ASC')
            ->getQuery();

        return $qb->execute();
    }

    /**
     * @return DocumentSeriesSet
     *
     * @throws
     */
    public function findOneRandom(): DocumentSeriesSet
    {
        $qb = $this->createQueryBuilder('r')
            ->orderBy('r.name', 'ASC')
            ->getQuery();

        /** @var DocumentSeriesSet $document */
        $document = $qb->setMaxResults(1)->getOneOrNullResult();

        return $document;
    }
}