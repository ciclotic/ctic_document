<?php
namespace CTIC\Document\Invoice\Domain\Fixture;

use CTIC\App\Company\Infrastructure\Repository\CompanyRepository;
use CTIC\App\Company\Domain\Company;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use CTIC\Document\Invoice\Application\CreateInvoice;
use CTIC\Document\Invoice\Domain\Command\InvoiceCommand;

class InvoiceFixture extends AbstractFixture
{
    public function load(ObjectManager $manager)
    {

    }
}