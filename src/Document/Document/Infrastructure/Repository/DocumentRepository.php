<?php
namespace CTIC\Document\Document\Infrastructure\Repository;

use CTIC\Document\Document\Domain\Document;
use CTIC\App\Base\Infrastructure\Repository\EntityRepository;

abstract class DocumentRepository extends EntityRepository
{
    /**
     * @return Document[]
     */
    public function findAllOrderedByName(): array
    {
        $qb = $this->createQueryBuilder('r')
            ->orderBy('r.name', 'ASC')
            ->getQuery();

        return $qb->execute();
    }

    /**
     * @return Document
     *
     * @throws
     */
    public function findOneRandom(): Document
    {
        $qb = $this->createQueryBuilder('r')
            ->orderBy('r.name', 'ASC')
            ->getQuery();

        /** @var Document $document */
        $document = $qb->setMaxResults(1)->getOneOrNullResult();

        return $document;
    }
}