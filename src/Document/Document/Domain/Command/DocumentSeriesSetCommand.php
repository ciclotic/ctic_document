<?php
namespace CTIC\Document\Document\Domain\Command;

use CTIC\App\Base\Domain\Command\CommandInterface;
use CTIC\App\Company\Domain\Company;

abstract class DocumentSeriesSetCommand implements CommandInterface
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
     * @var Company
     */
    public $company = null;
}