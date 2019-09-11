<?php
namespace CTIC\Document\Invoice\Domain;

use CTIC\App\Base\Domain\IdentifiableTrait;
use CTIC\App\Company\Domain\Company;
use CTIC\Document\Document\Domain\DocumentExpiration;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use CTIC\Document\Invoice\Domain\Validation\InvoiceExpirationValidation;

/**
 * @ApiResource
 * @ORM\Entity(repositoryClass="CTIC\Document\Invoice\Infrastructure\Repository\InvoiceExpirationRepository")
 */
class InvoiceExpiration extends DocumentExpiration implements InvoiceExpirationInterface
{
    use IdentifiableTrait;
    use InvoiceExpirationValidation;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @var string
     */
    public $name;

    /**
     * @ORM\ManyToOne(targetEntity="CTIC\App\Company\Domain\Company")
     * @ORM\JoinColumn(name="company_id", referencedColumnName="id")
     *
     * @var Company
     */
    protected $company = null;
}