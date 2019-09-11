<?php

namespace CTIC\Document\Document\Infrastructure\Controller;

use CTIC\App\Base\Infrastructure\Controller\ResourceController;
use CTIC\Document\Document\Domain\Document;
use CTIC\Document\Document\Domain\DocumentSeries;
use CTIC\App\Base\Domain\EntityInterface;
use CTIC\App\Base\Infrastructure\Request\RequestConfiguration;

abstract class DocumentController extends ResourceController
{
    /**
     * @var DocumentSeries[]|null
     */
    protected $oldDocumentSeries;

    /**
     * @param EntityInterface|Document $resource
     * @param RequestConfiguration $configuration
     */
    protected function completeCreateEntity(EntityInterface $resource, RequestConfiguration $configuration): void
    {
    }

    /**
     * @param EntityInterface|Document $resource
     * @param RequestConfiguration $configuration
     *
     * @throws
     */
    protected function completeUpdateEntity(EntityInterface $resource, RequestConfiguration $configuration): void
    {
    }

    /**
     * @param EntityInterface|Document $resource
     * @param RequestConfiguration $configuration
     */
    protected function prepareEntity(EntityInterface $resource, RequestConfiguration $configuration): void
    {
        // INVOICE SERIES
        $this->oldDocumentSeries = array();
        $documentSeriess = $resource->getDocumentSeries();

        foreach ($documentSeriess as $documentSeries) {
            $this->oldDocumentSeries[] = $documentSeries;
        }
    }

    /**
     * @param EntityInterface|Document $resource
     * @param RequestConfiguration $configuration
     */
    protected function prepareUpdateEntity(EntityInterface $resource, RequestConfiguration $configuration): void
    {
        $this->prepareEntity($resource, $configuration);
    }

    /**
     * @param EntityInterface|Document $resource
     * @param RequestConfiguration $configuration
     */
    protected function prepareCreateEntity(EntityInterface $resource, RequestConfiguration $configuration): void
    {
        $this->prepareEntity($resource, $configuration);
    }

    /**
     * @param EntityInterface|Document $resource
     * @param RequestConfiguration $configuration
     *
     * @throws
     */
    protected function postEntity(EntityInterface $resource, RequestConfiguration $configuration): void
    {
        $nativeData = $configuration->getRequest()->get('ctic_document_document');

        // INVOICE SERIES
        $documentSeriess = $resource->getDocumentSeries();
        $oldDocumentSeriess = $this->oldDocumentSeries;

        /** @var DocumentSeries $documentSeries */
        foreach ($documentSeriess as $documentSeries) {
            foreach ($oldDocumentSeriess as $key => $oldDocumentSeries) {
                if ($documentSeries->getId() == $oldDocumentSeries->getId()) {
                    unset($oldDocumentSeriess[$key]);
                }
            }

            $documentSeries->document = $resource;

            $this->manager->persist($documentSeries);
        }

        foreach ($oldDocumentSeriess as $oldDocumentSeries) {
            $this->manager->remove($oldDocumentSeries);
        }

        $this->manager->flush();
    }

    /**
     * @param EntityInterface|Document $resource
     * @param RequestConfiguration $configuration
     */
    protected function postCreateEntity(EntityInterface $resource, RequestConfiguration $configuration): void
    {
        $this->postEntity($resource, $configuration);
    }

    /**
     * @param EntityInterface|Document $resource
     * @param RequestConfiguration $configuration
     */
    protected function postUpdateEntity(EntityInterface $resource, RequestConfiguration $configuration): void
    {
        $this->postEntity($resource, $configuration);
    }
}