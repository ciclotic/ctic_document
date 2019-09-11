<?php
namespace CTIC\Document\Document\Application;

use CTIC\App\Base\Application\CreateInterface;
use CTIC\App\Base\Domain\Command\CommandInterface;
use CTIC\App\Base\Domain\EntityInterface;
use CTIC\Document\Document\Domain\Command\DocumentCommand;
use CTIC\Document\Document\Domain\Document;
use CTIC\App\Company\Domain\Company;
use CTIC\Document\Document\Domain\DocumentInterface;
use Doctrine\Common\Collections\ArrayCollection;

abstract class CreateDocument implements CreateDocumentInterface
{
    /**
     * @param CommandInterface|DocumentCommand $command
     * @return EntityInterface|Document
     */
    public static function create(CommandInterface $command): EntityInterface
    {
        $resourceClass = static::getResourceClass();
        /** @var DocumentInterface $document */
        $document = new $resourceClass();
        $document->setId($command->id);
        $document->name = (empty($command->name))? '' : $command->name;
        $document->businessName = (empty($command->businessName))? '' : $command->businessName;
        $document->identification = (empty($command->identification))? '' : $command->identification;
        $document->address = (empty($command->address))? '' : $command->address;
        $document->postalCode = (empty($command->postalCode))? '' : $command->postalCode;
        $document->town = (empty($command->town))? '' : $command->town;
        $document->province = (empty($command->province))? '' : $command->province;
        $document->country = (empty($command->country))? '' : $command->country;
        $document->shippingIdentification = (empty($command->shippingIdentification))? '' : $command->shippingIdentification;
        $document->shippingAddress = (empty($command->shippingAddress))? '' : $command->shippingAddress;
        $document->shippingPostalCode = (empty($command->shippingPostalCode))? '' : $command->shippingPostalCode;
        $document->shippingTown = (empty($command->shippingTown))? '' : $command->shippingTown;
        $document->shippingProvince = (empty($command->shippingProvince))? '' : $command->shippingProvince;
        $document->shippingCountry = (empty($command->shippingCountry))? '' : $command->shippingCountry;
        $document->bank = (empty($command->bank))? '' : $command->bank;
        $document->iban = (empty($command->iban))? '' : $command->iban;
        $document->paymentDay1 = (empty($command->paymentDay1))? 1 : $command->paymentDay1;
        $document->paymentDay2 = (empty($command->paymentDay2))? null : $command->paymentDay2;
        $document->discountSoonPayment = (empty($command->discountSoonPayment))? 0 : $command->discountSoonPayment;
        $document->discountDocument = (empty($command->discountDocument))? false : true;
        $document->discountProduct = (empty($command->discountProduct))? 0 : $command->discountProduct;
        $document->discountService = (empty($command->discountService))? 0 : $command->discountService;
        $document->alertPriceChanges = (empty($command->alertPriceChanges))? false : true;
        $document->type = (empty($command->type))? null : $command->type;
        $document->dinners = (empty($command->dinners))? 0 : $command->dinners;
        $document->gender = (empty($command->gender))? '' : $command->gender;
        $document->birthDate = (empty($command->birthDate))? new \DateTime() : $command->birthDate;
        $document->reference = (empty($command->reference))? '' : $command->reference;
        $document->periodicity = (empty($command->periodicity))? '' : $command->periodicity;
        if (!empty($command->defaultPaymentMethod)) {
            $document->setDefaultPaymentMethod($command->defaultPaymentMethod);
        }
        if (!empty($command->defaultRate)) {
            $document->setDefaultRate($command->defaultRate);
        }
        if (!empty($command->defaultIva)) {
            $document->setDefaultIva($command->defaultIva);
        }
        if (!empty($command->defaultIrpf)) {
            $document->setDefaultIrpf($command->defaultIrpf);
        }
        if (!empty($command->defaultRealizationArea)) {
            $document->setDefaultRealizationArea($command->defaultRealizationArea);
        }
        if (!empty($command->documentSeries)) {
            $document->setDocumentSeries($command->documentSeries);
        }
        if (!empty($command->documentExpiration)) {
            $document->setDocumentExpiration($command->documentExpiration);
        }
        if (!empty($command->company)) {
            $document->setCompany($command->company);
        }

        return $document;
    }
}