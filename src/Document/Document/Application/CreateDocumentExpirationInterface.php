<?php
namespace CTIC\Document\Document\Application;

use CTIC\App\Base\Application\CreateInterface;

interface CreateDocumentExpirationInterface extends CreateInterface
{
    static public function getResourceClass(): string;
}