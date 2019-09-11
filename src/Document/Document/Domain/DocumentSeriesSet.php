<?php
namespace CTIC\Document\Document\Domain;

use CTIC\App\Company\Domain\Company;

abstract class DocumentSeriesSet implements DocumentSeriesSetInterface
{
    public $name;

    protected $company = null;

    /**
     * @return string
     */
    public function getName(): string
    {
        return (empty($this->name))? '' : $this->name;
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