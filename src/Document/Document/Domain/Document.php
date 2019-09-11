<?php
namespace CTIC\Document\Document\Domain;

use CTIC\App\Irpf\Domain\Irpf;
use CTIC\App\Iva\Domain\Iva;
use CTIC\App\PaymentMethod\Domain\PaymentMethod;
use CTIC\App\Rate\Domain\Rate;
use CTIC\App\RealizationArea\Domain\RealizationArea;
use Doctrine\Common\Collections\ArrayCollection;
use CTIC\App\Company\Domain\Company;

abstract class Document implements DocumentInterface
{
    public $name;

    public $businessName;

    public $identification;

    public $address;

    public $postalCode;

    public $town;

    public $province;

    public $country;

    public $shippingIdentification;

    public $shippingAddress;

    public $shippingPostalCode;

    public $shippingTown;

    public $shippingProvince;

    public $shippingCountry;

    public $bank;

    public $iban;

    public $paymentDay1;

    public $paymentDay2;

    public $discountSoonPayment;

    public $discountDocument;

    public $discountProduct;

    public $discountService;

    public $alertPriceChanges;

    public $type;

    public $dinners;

    public $gender;

    public $birthDate;

    public $reference;

    public $periodicity;

    protected $defaultPaymentMethod = null;

    protected $defaultRate = null;

    protected $defaultIva = null;

    protected $defaultIrpf = null;

    protected $defaultRealizationArea = null;

    protected $documentExpiration;

    protected $documentSeries;

    protected $company = null;

    /**
     * Document constructor.
     */
    public function __construct()
    {
        $this->documentExpiration = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getBusinessName()
    {
        return $this->businessName;
    }

    /**
     * @return string
     */
    public function getIdentification()
    {
        return $this->identification;
    }

    /**
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @return string
     */
    public function getPostalCode()
    {
        return $this->postalCode;
    }

    /**
     * @return string
     */
    public function getTown()
    {
        return $this->town;
    }

    /**
     * @return string
     */
    public function getProvince()
    {
        return $this->province;
    }

    /**
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @return string
     */
    public function getShippingIdentification()
    {
        return $this->shippingIdentification;
    }

    /**
     * @return string
     */
    public function getShippingAddress()
    {
        return $this->shippingAddress;
    }

    /**
     * @return string
     */
    public function getShippingPostalCode()
    {
        return $this->shippingPostalCode;
    }

    /**
     * @return string
     */
    public function getShippingTown()
    {
        return $this->shippingTown;
    }

    /**
     * @return string
     */
    public function getShippingProvince()
    {
        return $this->shippingProvince;
    }

    /**
     * @return string
     */
    public function getShippingCountry()
    {
        return $this->shippingCountry;
    }

    /**
     * @return string
     */
    public function getBank()
    {
        return $this->bank;
    }

    /**
     * @return string
     */
    public function getIban()
    {
        return $this->iban;
    }

    /**
     * @return int
     */
    public function getPaymentDay1()
    {
        return $this->paymentDay1;
    }

    /**
     * @return int
     */
    public function getPaymentDay2()
    {
        return $this->paymentDay2;
    }

    /**
     * @return float
     */
    public function getDiscountSoonPayment()
    {
        return $this->discountSoonPayment;
    }

    /**
     * @return bool
     */
    public function isDiscountDocument()
    {
        return $this->discountDocument;
    }

    /**
     * @return float
     */
    public function getDiscountProduct()
    {
        return $this->discountProduct;
    }

    /**
     * @return float
     */
    public function getDiscountService()
    {
        return $this->discountService;
    }

    /**
     * @return bool
     */
    public function isAlertPriceChanges()
    {
        return $this->alertPriceChanges;
    }

    /**
     * @return int
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return int
     */
    public function getDinners()
    {
        return $this->dinners;
    }

    /**
     * @return string
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * @return \DateTime
     */
    public function getBirthDate()
    {
        return $this->birthDate;
    }

    /**
     * @return string
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * @return int
     */
    public function getPeriodicity()
    {
        return $this->periodicity;
    }

    /**
     * @return PaymentMethod|null
     */
    public function getDefaultPaymentMethod()
    {
        return $this->defaultPaymentMethod;
    }

    /**
     * @param PaymentMethod $defaultPaymentMethod
     *
     * @return bool
     */
    public function setDefaultPaymentMethod(PaymentMethod $defaultPaymentMethod): bool
    {
        if (get_class($defaultPaymentMethod) != PaymentMethod::class &&
            array_pop(class_parents($defaultPaymentMethod)) != PaymentMethod::class) {
            return false;
        }

        $this->defaultPaymentMethod = $defaultPaymentMethod;

        return true;
    }

    /**
     * @return Rate|null
     */
    public function getDefaultRate()
    {
        return $this->defaultRate;
    }

    /**
     * @param Rate $defaultRate
     *
     * @return bool
     */
    public function setDefaultRate(Rate $defaultRate): bool
    {
        if (get_class($defaultRate) != Rate::class &&
            array_pop(class_parents($defaultRate)) != Rate::class) {
            return false;
        }

        $this->defaultRate = $defaultRate;

        return true;
    }

    /**
     * @return Iva|null
     */
    public function getDefaultIva()
    {
        return $this->defaultIva;
    }

    /**
     * @param Iva $iva
     *
     * @return bool
     */
    public function setDefaultIva(Iva $iva): bool
    {
        if (get_class($iva) != Iva::class &&
            array_pop(class_parents($iva)) != Iva::class) {
            return false;
        }

        $this->defaultIva = $iva;

        return true;
    }

    /**
     * @return Irpf|null
     */
    public function getDefaultIrpf()
    {
        return $this->defaultIrpf;
    }

    /**
     * @param Irpf $irpf
     *
     * @return bool
     */
    public function setDefaultIrpf(Irpf $irpf): bool
    {
        if (get_class($irpf) != Irpf::class &&
            array_pop(class_parents($irpf)) != Irpf::class) {
            return false;
        }

        $this->defaultIrpf = $irpf;

        return true;
    }

    /**
     * @return RealizationArea|null
     */
    public function getDefaultRealizationArea()
    {
        return $this->defaultRealizationArea;
    }

    /**
     * @param RealizationArea $defaultRealizationArea
     *
     * @return bool
     */
    public function setDefaultRealizationArea(RealizationArea $defaultRealizationArea): bool
    {
        if (get_class($defaultRealizationArea) != RealizationArea::class &&
            array_pop(class_parents($defaultRealizationArea)) != RealizationArea::class) {
            return false;
        }

        $this->defaultRealizationArea = $defaultRealizationArea;

        return true;
    }

    /**
     * @return DocumentExpiration[]|ArrayCollection
     */
    public function getDocumentExpiration()
    {
        return $this->documentExpiration;
    }

    /**
     * @param $documentExpiration
     * @return bool
     */
    public function setDocumentExpiration($documentExpiration): bool
    {
        if (get_class($documentExpiration) != ArrayCollection::class) {
            return false;
        }

        $this->documentExpiration = $documentExpiration;

        return true;
    }

    /**
     * @return DocumentSeries[]|ArrayCollection
     */
    public function getDocumentSeries()
    {
        return $this->documentSeries;
    }

    /**
     * @param $documentSeries
     * @return bool
     */
    public function setDocumentSeries($documentSeries): bool
    {
        if (get_class($documentSeries) != ArrayCollection::class) {
            return false;
        }

        $this->documentSeries = $documentSeries;

        return true;
    }

    /**
     * @return Company|null
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * @param Company $company
     *
     * @return bool
     */
    public function setCompany(Company $company): bool
    {
        if (get_class($company) != Company::class &&
            array_pop(class_parents($company)) != Company::class) {
            return false;
        }

        $this->company = $company;

        return true;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return (string) $this->getId();
    }
}