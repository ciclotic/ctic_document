<?php
namespace CTIC\Document\Document\Infrastructure\Repository;

use CTIC\Document\Document\Domain\DocumentSeries;
use CTIC\App\Base\Infrastructure\Repository\EntityRepository;

abstract class DocumentSeriesRepository extends EntityRepository
{
    /**
     * @return DocumentSeries[]
     */
    public function findAllOrderedByValue(): array
    {
        $qb = $this->createQueryBuilder('r')
            ->orderBy('r.value', 'ASC')
            ->getQuery();

        return $qb->execute();
    }

    /**
     * @return DocumentSeries[]
     */
    public function findAllOrderedByName(): array
    {
        $qb = $this->createQueryBuilder('r')
            ->orderBy('r.value', 'ASC')
            ->getQuery();

        return $qb->execute();
    }

    /**
     * @return DocumentSeries
     *
     * @throws
     */
    public function findOneRandom(): DocumentSeries
    {
        $qb = $this->createQueryBuilder('r')
            ->orderBy('r.value', 'ASC')
            ->getQuery();

        /** @var DocumentSeries $document */
        $document = $qb->setMaxResults(1)->getOneOrNullResult();

        return $document;
    }
}