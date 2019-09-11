<?php
namespace CTIC\Document\Document\Domain;

use CTIC\App\Base\Domain\EntityInterface;
use CTIC\App\Base\Domain\IdentifiableInterface;

interface DocumentSeriesInterface extends IdentifiableInterface, EntityInterface
{
    public function getValue(): string;
    public function getAlias(): string;
    public function getDocument();
    public function setDocument(Document $document): bool;
    public function getDocumentSeriesSet();
    public function setDocumentSeriesSet(DocumentSeriesSet $documentSeriesSet): bool;
}