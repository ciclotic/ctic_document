<?php
namespace CTIC\Document\Invoice\Application;

use CTIC\Document\Document\Application\CreateDocumentSeries;
use CTIC\Document\Invoice\Domain\InvoiceSeries;

class CreateInvoiceSeries extends CreateDocumentSeries
{
    static public function getResourceClass(): string
    {
        return InvoiceSeries::class;
    }
}