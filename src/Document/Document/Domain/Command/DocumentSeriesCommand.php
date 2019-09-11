<?php
namespace CTIC\Document\Document\Domain\Command;

use CTIC\App\Base\Domain\Command\CommandInterface;
use CTIC\Document\Document\Domain\Document;
use CTIC\Document\Document\Domain\DocumentSeriesSet;

abstract class DocumentSeriesCommand implements CommandInterface
{
    /**
     * @var int
     */
    public $id;

    /**
     * @var string
     */
    public $value;

    /**
     * @var string
     */
    public $alias;

    /**
     * @var Document
     */
    public $document = null;

    /**
     * @var DocumentSeriesSet
     */
    public $documentSeriesSet = null;
}