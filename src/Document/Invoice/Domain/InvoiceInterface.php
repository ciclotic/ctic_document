<?php
namespace CTIC\Document\Invoice\Domain;

use CTIC\App\Company\Domain\Company;
use CTIC\App\Irpf\Domain\Irpf;
use CTIC\App\Iva\Domain\Iva;
use CTIC\App\PaymentMethod\Domain\PaymentMethod;
use CTIC\App\Rate\Domain\Rate;
use CTIC\App\RealizationArea\Domain\RealizationArea;
use CTIC\App\User\Domain\User;
use CTIC\App\Base\Domain\EntityInterface;
use CTIC\App\Base\Domain\IdentifiableInterface;
use CTIC\Document\Document\Domain\DocumentInterface;

interface InvoiceInterface extends DocumentInterface
{
}