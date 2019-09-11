<?php
namespace CTIC\Document\Invoice\Application;

use CTIC\Document\Document\Application\CreateDocument;
use CTIC\Document\Invoice\Domain\Invoice;

class CreateInvoice extends CreateDocument
{
    static public function getResourceClass(): string
    {
        return Invoice::class;
    }
}