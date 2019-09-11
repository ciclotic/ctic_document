<?php
declare(strict_types=1);

namespace CTIC\Document\Invoice\Test\Application;

use CTIC\Document\Invoice\Application\CreateInvoice;
use CTIC\Document\Invoice\Domain\Command\InvoiceCommand;
use CTIC\Document\Invoice\Domain\Invoice;
use PHPUnit\Framework\TestCase;

final class CreateInvoiceTest extends TestCase
{
    public function testCreateAssert()
    {
        $invoiceCommandRyu = new InvoiceCommand();
        $invoiceCommandRyu->name = 'ryu';
        $invoiceRyu = CreateInvoice::create($invoiceCommandRyu);

        $this->assertEquals(Invoice::class, get_class($invoiceRyu));
    }
}