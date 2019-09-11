<?php
namespace CTIC\Document\Invoice\Application;

use CTIC\Document\Document\Application\CreateDocumentExpiration;
use CTIC\Document\Invoice\Domain\InvoiceExpiration;

class CreateInvoiceExpiration extends CreateDocumentExpiration
{
    static public function getResourceClass(): string
    {
        return InvoiceExpiration::class;
    }
}