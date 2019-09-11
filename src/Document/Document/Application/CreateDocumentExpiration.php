<?php
namespace CTIC\Document\Document\Application;

use CTIC\App\Base\Application\CreateInterface;
use CTIC\App\Base\Domain\Command\CommandInterface;
use CTIC\App\Base\Domain\EntityInterface;
use CTIC\Document\Document\Domain\Command\DocumentExpirationCommand;
use CTIC\App\Company\Domain\Company;
use CTIC\Document\Document\Domain\DocumentExpiration;

abstract class CreateDocumentExpiration implements CreateDocumentExpirationInterface
{
    /**
     * @param CommandInterface|DocumentExpirationCommand $command
     * @return EntityInterface|DocumentExpiration
     */
    public static function create(CommandInterface $command): EntityInterface
    {
        $resourceClass = static::getResourceClass();
        /** @var DocumentExpiration $documentExpiration */
        $documentExpiration = new $resourceClass();
        $documentExpiration->setId($command->id);
        $documentExpiration->name = (empty($command->name))? '' : $command->name;
        if (!empty($command->company)) {
            $documentExpiration->setCompany($command->company);
        }

        return $documentExpiration;
    }
}