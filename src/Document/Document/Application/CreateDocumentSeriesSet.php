<?php
namespace CTIC\Document\Document\Application;

use CTIC\App\Base\Application\CreateInterface;
use CTIC\App\Base\Domain\Command\CommandInterface;
use CTIC\App\Base\Domain\EntityInterface;
use CTIC\Document\Document\Domain\Command\DocumentSeriesSetCommand;
use CTIC\App\Company\Domain\Company;
use CTIC\Document\Document\Domain\DocumentSeriesSet;

abstract class CreateDocumentSeriesSet implements CreateDocumentSeriesSetInterface
{
    /**
     * @param CommandInterface|DocumentSeriesSetCommand $command
     * @return EntityInterface|DocumentSeriesSet
     */
    public static function create(CommandInterface $command): EntityInterface
    {
        $resourceClass = static::getResourceClass();
        /** @var DocumentSeriesSet $documentSeriesSet */
        $documentSeriesSet = new $resourceClass();
        $documentSeriesSet->setId($command->id);
        $documentSeriesSet->name = (empty($command->name))? '' : $command->name;
        if (!empty($command->company)) {
            $documentSeriesSet->setCompany($command->company);
        }

        return $documentSeriesSet;
    }
}