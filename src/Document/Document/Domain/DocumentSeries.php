<?php
namespace CTIC\Document\Document\Domain;


abstract class DocumentSeries implements DocumentSeriesInterface
{
    public $value;

    public $alias;

    public $document = null;

    protected $documentSeriesSet = null;

    /**
     * @return string
     */
    public function getValue(): string
    {
        return (empty($this->value))? '' : $this->value;
    }

    /**
     * @return string
     */
    public function getAlias(): string
    {
        return (empty($this->alias))? '' : $this->alias;
    }

    /**
     * @return Document|null
     */
    public function getDocument()
    {
        return $this->document;
    }

    /**
     * @param Document $document
     *
     * @return bool
     */
    public function setDocument(Document $document): bool
    {
        if (get_class($document) != Document::class &&
            array_pop(class_parents($document)) != Document::class) {
            return false;
        }

        $this->document = $document;

        return true;
    }

    /**
     * @return DocumentSeriesSet|null
     */
    public function getDocumentSeriesSet()
    {
        return $this->documentSeriesSet;
    }

    /**
     * @param DocumentSeriesSet $documentSeriesSet
     *
     * @return bool
     */
    public function setDocumentSeriesSet(DocumentSeriesSet $documentSeriesSet): bool
    {
        if (get_class($documentSeriesSet) != DocumentSeriesSet::class &&
            array_pop(class_parents($documentSeriesSet)) != DocumentSeriesSet::class) {
            return false;
        }

        $this->documentSeriesSet = $documentSeriesSet;

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