<?php
namespace CTIC\Document\Invoice\Domain;

use CTIC\App\Base\Domain\EntityInterface;
use CTIC\App\Base\Domain\IdentifiableInterface;
use CTIC\App\Company\Domain\Company;
use CTIC\Document\Document\Domain\DocumentExpirationInterface;

interface InvoiceExpirationInterface extends DocumentExpirationInterface
{
}