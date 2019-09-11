<?php
namespace CTIC\Document\Invoice\Domain\Fixture;

use CTIC\Document\Invoice\Application\CreateInvoiceExpiration;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use CTIC\Document\Invoice\Domain\Command\InvoiceExpirationCommand;

class InvoiceExpirationFixture extends AbstractFixture
{
    public function load(ObjectManager $manager)
    {
        $invoiceExpirationGeneralCommand = new InvoiceExpirationCommand();
        $invoiceExpirationGeneralCommand->name = 'Contado';
        $invoiceExpiration = CreateInvoiceExpiration::create($invoiceExpirationGeneralCommand);
        $manager->persist($invoiceExpiration);

        $manager->flush();
    }
}