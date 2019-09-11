<?php

namespace CTIC\Document\Invoice\Infrastructure\Form\Type;

use CTIC\App\Company\Domain\Company;
use CTIC\App\Company\Infrastructure\Repository\CompanyRepository;
use CTIC\App\Base\Infrastructure\Form\Type\AbstractResourceType;
use CTIC\App\Base\Infrastructure\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

final class InvoiceExpirationType extends AbstractResourceType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $invoices): void
    {
        $builder
            ->setMethod('POST')
            ->add('name', TextType::class, [
                'label' => 'Nombre',
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
        return 'ctic_document_invoiceexpiration';
    }
}
