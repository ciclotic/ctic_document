<?php
namespace CTIC\Document\Invoice\Domain\Fixture;

use CTIC\Document\Invoice\Application\CreateInvoiceSeriesSet;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use CTIC\Document\Invoice\Domain\Command\InvoiceSeriesSetCommand;

class InvoiceSeriesSetFixture extends AbstractFixture
{
    public function load(ObjectManager $manager)
    {
        $invoiceSeriesSetGeneralCommand = new InvoiceSeriesSetCommand();
        $invoiceSeriesSetGeneralCommand->name = 'General';
        $invoiceSeriesSet = CreateInvoiceSeriesSet::create($invoiceSeriesSetGeneralCommand);
        $manager->persist($invoiceSeriesSet);

        $manager->flush();
    }
}