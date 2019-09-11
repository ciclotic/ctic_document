<?php
namespace CTIC\Document\Invoice\Application;

use CTIC\Document\Document\Application\CreateDocumentSeriesSet;
use CTIC\Document\Invoice\Domain\InvoiceSeriesSet;

class CreateInvoiceSeriesSet extends CreateDocumentSeriesSet
{
    static public function getResourceClass(): string
    {
        return InvoiceSeriesSet::class;
    }
}