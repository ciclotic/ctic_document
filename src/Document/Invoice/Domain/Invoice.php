<?php
namespace CTIC\Document\Invoice\Domain;

use CTIC\App\Base\Domain\IdentifiableTrait;
use CTIC\App\Company\Domain\Company;
use CTIC\App\Irpf\Domain\Irpf;
use CTIC\App\Iva\Domain\Iva;
use CTIC\App\PaymentMethod\Domain\PaymentMethod;
use CTIC\App\Rate\Domain\Rate;
use CTIC\App\RealizationArea\Domain\RealizationArea;
use CTIC\Document\Document\Domain\Document;
use Doctrine\ORM\Mapping as ORM;
use CTIC\Document\Invoice\Domain\Validation\InvoiceValidation;

/**
 * @ORM\Entity(repositoryClass="CTIC\Document\Invoice\Infrastructure\Repository\InvoiceRepository")
 */
class Invoice extends Document implements InvoiceInterface
{
    use IdentifiableTrait;
    use InvoiceValidation;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     *
     * @var string
     */
    public $name;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     *
     * @var string
     */
    public $businessName;

    /**
     * @ORM\Column(type="string", length=50, unique=true)
     *
     * @var string
     */
    public $identification;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     * @var string
     */
    public $address;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     *
     * @var string
     */
    public $postalCode;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     *
     * @var string
     */
    public $town;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     *
     * @var string
     */
    public $province;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     *
     * @var string
     */
    public $country;

    /**
     * @ORM\Column(type="string", length=50, unique=true)
     *
     * @var string
     */
    public $shippingIdentification;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     * @var string
     */
    public $shippingAddress;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     *
     * @var string
     */
    public $shippingPostalCode;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     *
     * @var string
     */
    public $shippingTown;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     *
     * @var string
     */
    public $shippingProvince;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     *
     * @var string
     */
    public $shippingCountry;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     *
     * @var string
     */
    public $bank;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     *
     * @var string
     */
    public $iban;

    /**
     * @ORM\Column(type="integer", nullable=true)
     *
     * @var int
     */
    public $paymentDay1;

    /**
     * @ORM\Column(type="integer", nullable=true)
     *
     * @var int
     */
    public $paymentDay2;

    /**
     * @ORM\Column(type="float", nullable=true)
     *
     * @var float
     */
    public $discountSoonPayment;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     *
     * @var bool
     */
    public $discountDocument;

    /**
     * @ORM\Column(type="float", nullable=true)
     *
     * @var float
     */
    public $discountProduct;

    /**
     * @ORM\Column(type="float", nullable=true)
     *
     * @var float
     */
    public $discountService;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     *
     * @var bool
     */
    public $alertPriceChanges;

    /**
     * @ORM\Column(type="integer", nullable=true)
     *
     * @var int
     */
    public $type;

    /**
     * @ORM\Column(type="integer", nullable=true)
     *
     * @var int
     */
    public $dinners;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     *
     * @var string
     */
    public $gender;

    /**
     * @ORM\Column(type="date", nullable=true)
     *
     * @var \DateTime
     */
    public $birthDate;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     *
     * @var string
     */
    public $reference;

    /**
     * @ORM\Column(type="integer", nullable=true)
     *
     * @var int
     */
    public $periodicity;

    /**
     * @ORM\ManyToOne(targetEntity="CTIC\App\PaymentMethod\Domain\PaymentMethod")
     * @ORM\JoinColumn(name="payment_method_id", referencedColumnName="id", nullable=true)
     *
     * @var PaymentMethod
     */
    protected $defaultPaymentMethod = null;

    /**
     * @ORM\ManyToOne(targetEntity="CTIC\App\Rate\Domain\Rate")
     * @ORM\JoinColumn(name="rate_id", referencedColumnName="id", nullable=true)
     *
     * @var Rate
     */
    protected $defaultRate = null;

    /**
     * @ORM\ManyToOne(targetEntity="CTIC\App\Iva\Domain\Iva")
     * @ORM\JoinColumn(name="iva_id", referencedColumnName="id", nullable=true)
     *
     * @var Iva
     */
    protected $defaultIva = null;

    /**
     * @ORM\ManyToOne(targetEntity="CTIC\App\Irpf\Domain\Irpf")
     * @ORM\JoinColumn(name="iva_id", referencedColumnName="id", nullable=true)
     *
     * @var Irpf
     */
    protected $defaultIrpf = null;

    /**
     * @ORM\ManyToOne(targetEntity="CTIC\App\RealizationArea\Domain\RealizationArea")
     * @ORM\JoinColumn(name="iva_id", referencedColumnName="id", nullable=true)
     *
     * @var RealizationArea
     */
    protected $defaultRealizationArea = null;

    /**
     * @ORM\ManyToMany(targetEntity="CTIC\Document\Invoice\Domain\InvoiceExpiration")
     *
     * @var InvoiceExpiration[]
     */
    protected $documentExpiration;

    /**
     * @ORM\OneToMany(targetEntity="CTIC\Document\Invoice\Domain\InvoiceSeries", mappedBy="document", cascade={"persist", "remove"})
     *
     * @var InvoiceSeries[]
     */
    protected $documentSeries;

    /**
     * @ORM\ManyToOne(targetEntity="CTIC\App\Company\Domain\Company")
     * @ORM\JoinColumn(name="company_id", referencedColumnName="id")
     *
     * @var Company
     */
    protected $company = null;
}