<?php
namespace CTIC\Document\Document\Domain\Command;

use CTIC\App\Base\Domain\Command\CommandInterface;
use CTIC\App\Company\Domain\Company;
use CTIC\App\Irpf\Domain\Irpf;
use CTIC\App\Iva\Domain\Iva;
use CTIC\App\PaymentMethod\Domain\PaymentMethod;
use CTIC\App\Rate\Domain\Rate;
use CTIC\App\RealizationArea\Domain\RealizationArea;
use CTIC\Document\Document\Domain\DocumentSeries;
use CTIC\Document\Document\Domain\DocumentExpiration;

abstract class DocumentCommand implements CommandInterface
{
    /**
     * @var int
     */
    public $id;

    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $businessName;

    /**
     * @var string
     */
    public $identification;

    /**
     * @var string
     */
    public $address;

    /**
     * @var string
     */
    public $postalCode;

    /**
     * @var string
     */
    public $town;

    /**
     * @var string
     */
    public $province;

    /**
     * @var string
     */
    public $country;

    /**
     * @var string
     */
    public $shippingIdentification;

    /**
     * @var string
     */
    public $shippingAddress;

    /**
     * @var string
     */
    public $shippingPostalCode;

    /**
     * @var string
     */
    public $shippingTown;

    /**
     * @var string
     */
    public $shippingProvince;

    /**
     * @var string
     */
    public $shippingCountry;

    /**
     * @var string
     */
    public $bank;

    /**
     * @var string
     */
    public $iban;

    /**
     * @var int
     */
    public $paymentDay1;

    /**
     * @var int
     */
    public $paymentDay2;

    /**
     * @var float
     */
    public $discountSoonPayment;

    /**
     * @var bool
     */
    public $discountDocument;

    /**
     * @var float
     */
    public $discountProduct;

    /**
     * @var float
     */
    public $discountService;

    /**
     * @var bool
     */
    public $alertPriceChanges;

    /**
     * @var int
     */
    public $type;

    /**
     * @var int
     */
    public $dinners;

    /**
     * @var string
     */
    public $gender;

    /**
     * @var \DateTime
     */
    public $birthDate;

    /**
     * @var string
     */
    public $reference;

    /**
     * @var int
     */
    public $periodicity;

    /**
     * @var PaymentMethod
     */
    public $defaultPaymentMethod = null;

    /**
     * @var Rate
     */
    public $defaultRate = null;

    /**
     * @var Iva
     */
    public $defaultIva = null;

    /**
     * @var Irpf
     */
    public $defaultIrpf = null;

    /**
     * @var RealizationArea
     */
    public $defaultRealizationArea = null;

    /**
     * @var DocumentExpiration[]
     */
    public $documentExpiration;

    /**
     * @var DocumentSeries[]
     */
    public $documentSeries;

    /**
     * @var Company
     */
    public $company = null;
}