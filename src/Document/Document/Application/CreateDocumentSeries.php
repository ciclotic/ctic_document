<?php
namespace CTIC\Document\Document\Application;

use CTIC\App\Base\Application\CreateInterface;
use CTIC\App\Base\Domain\Command\CommandInterface;
use CTIC\App\Base\Domain\EntityInterface;
use CTIC\Document\Document\Domain\Command\DocumentSeriesSetCommand;
use CTIC\App\Company\Domain\Company;
use CTIC\Document\Document\Domain\Command\DocumentSeriesCommand;
use CTIC\Document\Document\Domain\DocumentSeries;
use CTIC\Document\Document\Domain\DocumentSeriesSet;

abstract class CreateDocumentSeries implements CreateDocumentSeriesInterface
{
    /**
     * @param CommandInterface|DocumentSeriesCommand $command
     * @return EntityInterface|DocumentSeries
     */
    public static function create(CommandInterface $command): EntityInterface
    {
        $resourceClass = static::getResourceClass();
        /** @var DocumentSeries $documentSeries */
        $documentSeries = new $resourceClass();
        $documentSeries->setId($command->id);
        $documentSeries->value = (empty($command->value))? '' : $command->value;
        $documentSeries->alias = (empty($command->alias))? '' : $command->alias;
        if (!empty($command->document)) {
            $documentSeries->setDocument($command->document);
        }
        if (!empty($command->documentSeriesSet)) {
            $documentSeries->setDocumentSeriesSet($command->documentSeriesSet);
        }

        return $documentSeries;
    }
}