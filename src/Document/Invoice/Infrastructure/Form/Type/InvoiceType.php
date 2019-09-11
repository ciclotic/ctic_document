<?php

namespace CTIC\Document\Invoice\Infrastructure\Form\Type;

use CTIC\App\Base\Infrastructure\Repository\EntityRepository;
use CTIC\App\Company\Domain\Company;
use CTIC\App\Company\Infrastructure\Repository\CompanyRepository;
use CTIC\App\Base\Infrastructure\Form\Type\AbstractResourceType;
use CTIC\App\Base\Infrastructure\Doctrine\Form\Type\EntityType;
use CTIC\App\Irpf\Domain\Irpf;
use CTIC\App\Irpf\Infrastructure\Repository\IrpfRepository;
use CTIC\App\Iva\Domain\Iva;
use CTIC\App\Iva\Infrastructure\Repository\IvaRepository;
use CTIC\App\PaymentMethod\Domain\PaymentMethod;
use CTIC\App\PaymentMethod\Infrastructure\Repository\PaymentMethodRepository;
use CTIC\App\Permission\Domain\PermissionInterface;
use CTIC\App\Rate\Domain\Rate;
use CTIC\App\Rate\Infrastructure\Repository\RateRepository;
use CTIC\App\RealizationArea\Domain\RealizationArea;
use CTIC\App\RealizationArea\Infrastructure\Repository\RealizationAreaRepository;
use CTIC\App\User\Domain\User;
use CTIC\App\User\Infrastructure\Repository\UserRepository;
use CTIC\Document\Invoice\Domain\Invoice;
use CTIC\Document\Invoice\Domain\InvoiceExpiration;
use CTIC\Document\Invoice\Domain\InvoiceInterface;
use CTIC\Document\Invoice\Infrastructure\Repository\InvoiceRepository;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

final class InvoiceType extends AbstractResourceType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $invoices): void
    {
        $builder
            ->setMethod('POST')
            ->add('name', TextType::class, [
                'label' => 'Nombre fiscal',
            ])
            ->add('businessName', TextType::class, [
                'label' => 'Nombre comercial',
            ])
            ->add('identification', TextType::class, [
                'label' => 'Facturación - CIF / NIF',
            ])
            ->add('address', TextType::class, [
                'label' => 'Facturación - Dirección',
                'required' => false,
            ])
            ->add('postalCode', TextType::class, [
                'label' => 'Facturación - Código Postal',
                'required' => false,
            ])
            ->add('town', TextType::class, [
                'label' => 'Facturación - Población/Ciudad',
                'required' => false,
            ])
            ->add('province', TextType::class, [
                'label' => 'Facturación - Provincia/Estado',
                'required' => false,
            ])
            ->add('country', TextType::class, [
                'label' => 'Facturación - País',
                'required' => false,
            ])
            ->add('shippingIdentification', TextType::class, [
                'label' => 'Entrega - CIF / NIF',
            ])
            ->add('shippingAddress', TextType::class, [
                'label' => 'Entrega - Dirección',
                'required' => false,
            ])
            ->add('shippingPostalCode', TextType::class, [
                'label' => 'Entrega - Código Postal',
                'required' => false,
            ])
            ->add('shippingTown', TextType::class, [
                'label' => 'Entrega - Población/Ciudad',
                'required' => false,
            ])
            ->add('shippingProvince', TextType::class, [
                'label' => 'Entrega - Provincia/Estado',
                'required' => false,
            ])
            ->add('shippingCountry', TextType::class, [
                'label' => 'Entrega - País',
                'required' => false,
            ])
            ->add('bank', TextType::class, [
                'label' => 'Banco',
                'required' => false,
            ])
            ->add('iban', TextType::class, [
                'label' => 'Iban',
                'required' => false,
            ])
            ->add('paymentDay1', NumberType::class, [
                'label' => 'Día de pago 1',
                'required' => false,
            ])
            ->add('paymentDay2', NumberType::class, [
                'label' => 'Día de pago 2',
                'required' => false,
            ])
            ->add('discountSoonPayment', NumberType::class, [
                'label' => 'Descuento pronto pago',
                'required' => false,
            ])
            ->add('discountDocument', ChoiceType::class, [
                'label' => 'Tiene descuento cliente',
                'choices'   => array(
                    'Si'    => 1,
                    'No'    => 0
                ),
                'required' => false,
            ])
            ->add('discountProduct', NumberType::class, [
                'label' => 'Descuento por producto',
                'required' => false,
            ])
            ->add('discountService', NumberType::class, [
                'label' => 'Descuento por servicio',
                'required' => false,
            ])
            ->add('alertPriceChanges', ChoiceType::class, [
                'label' => 'Alertar cambio de precios',
                'choices'   => array(
                    'Si'    => 1,
                    'No'    => 0
                ),
                'required' => false,
            ])
            ->add('type', TextType::class, [
                'label' => 'Tipo',
                'required' => false,
            ])
            ->add('dinners', NumberType::class, [
                'label' => 'Número de comensales',
                'required' => false,
            ])
            ->add('gender', TextType::class, [
                'label' => 'Género',
                'required' => false,
            ])
            ->add('birthDate', DateType::class, [
                'label' => 'Fecha de nacimiento',
                'required' => false,
            ])
            ->add('reference', TextType::class, [
                'label' => 'Referencia',
                'required' => false,
            ])
            ->add('periodicity', TextType::class, [
                'label' => 'Periodicidad',
                'required' => false,
            ])
            ->add('defaultPaymentMethod',  EntityType::class, [
                'label' => 'Método de pago por defecto',
                'class' => PaymentMethod::class,
                'query_builder' => function (PaymentMethodRepository $er) {
                    return $er
                        ->createQueryBuilder('a');
                },
                'choice_label' => 'name',
                'required' => false,
            ])
            ->add('defaultRate',  EntityType::class, [
                'label' => 'Tarifa por defecto',
                'class' => Rate::class,
                'query_builder' => function (RateRepository $er) {
                    return $er
                        ->createQueryBuilder('a');
                },
                'choice_label' => 'name',
                'required' => false,
            ])
            ->add('defaultIva',  EntityType::class, [
                'label' => 'IVA por defecto',
                'class' => Iva::class,
                'query_builder' => function (IvaRepository $er) {
                    return $er
                        ->createQueryBuilder('a');
                },
                'choice_label' => 'name',
                'required' => false,
            ])
            ->add('defaultIrpf',  EntityType::class, [
                'label' => 'IRPF por defecto',
                'class' => Irpf::class,
                'query_builder' => function (IrpfRepository $er) {
                    return $er
                        ->createQueryBuilder('a');
                },
                'choice_label' => 'name',
                'required' => false,
            ])
            ->add('defaultRealizationArea',  EntityType::class, [
                'label' => 'Área de realización por defecto',
                'class' => RealizationArea::class,
                'query_builder' => function (RealizationAreaRepository $er) {
                    return $er
                        ->createQueryBuilder('a');
                },
                'choice_label' => 'name',
                'required' => false,
            ])
            ->add('documentExpiration', EntityType::class, [
                'label'         => 'Vencimiento (Multiselección)',
                'class'         => InvoiceExpiration::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('ec')
                        ->orderBy('ec.name', 'ASC');
                },
                'expanded'      => false,
                'multiple'      => true,
                'choice_label' => 'name'
            ])
            ->add('documentSeries', CollectionType::class, [
                'label'                 => 'Serie',
                'label_attr'            => array(
                    'element'     => 'h5',
                    'label_class' => 'panel-heading',
                    'group_class' => 'panel panel-primary'
                ),
                'prototype_name'        => '__name-invoiceSeries__',
                'entry_type'            => InvoiceSeriesType::class,
                'prototype'             => true,
                'allow_add'             => true,
                'allow_delete'          => true
            ])
            ->add('company',  EntityType::class, [
                'label' => 'Empresa',
                'class' => Company::class,
                'query_builder' => function (CompanyRepository $er) {
                    return $er
                        ->createQueryBuilder('a');
                },
                'choice_label' => 'taxName'
            ])
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix(): string
    {
        return 'ctic_document_invoice';
    }
}
