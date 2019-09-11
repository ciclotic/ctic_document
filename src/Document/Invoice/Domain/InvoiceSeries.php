<?php
namespace CTIC\Document\Invoice\Domain;

use CTIC\App\Base\Domain\IdentifiableTrait;
use CTIC\Document\Document\Domain\DocumentSeries;
use Doctrine\ORM\Mapping as ORM;
use CTIC\Document\Invoice\Domain\Validation\InvoiceSeriesValidation;

/**
 * @ORM\Entity(repositoryClass="CTIC\Document\Invoice\Infrastructure\Repository\InvoiceSeriesRepository")
 */
class InvoiceSeries extends DocumentSeries implements InvoiceSeriesInterface
{
    use IdentifiableTrait;
    use InvoiceSeriesValidation;

    /**
     * @ORM\Column(type="string", length=25)
     *
     * @var string
     */
    public $value;

    /**
     * @ORM\Column(type="string", length=25, nullable=true)
     *
     * @var string
     */
    public $alias;

    /**
     * @ORM\ManyToOne(targetEntity="CTIC\Document\Invoice\Domain\Invoice", inversedBy="documentSeries")
     * @ORM\JoinColumn(name="invoice_id", referencedColumnName="id")
     *
     * @var Invoice
     */
    public $document = null;

    /**
     * @ORM\ManyToOne(targetEntity="CTIC\Document\Invoice\Domain\InvoiceSeriesSet")
     * @ORM\JoinColumn(name="invoice_series_set_id", referencedColumnName="id")
     *
     * @var InvoiceSeriesSet
     */
    protected $documentSeriesSet = null;
}