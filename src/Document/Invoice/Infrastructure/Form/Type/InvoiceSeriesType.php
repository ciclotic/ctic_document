<?php

namespace CTIC\Document\Invoice\Infrastructure\Form\Type;

use CTIC\Document\Invoice\Domain\InvoiceSeries;
use CTIC\Document\Invoice\Infrastructure\Repository\InvoiceSeriesSetRepository;
use Symfony\Component\Form\AbstractType;
use CTIC\App\Base\Infrastructure\Doctrine\Form\Type\EntityType;
use CTIC\Document\Invoice\Domain\InvoiceSeriesSet;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class InvoiceSeriesType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $invoices): void
    {
        $builder
            ->setMethod('POST')
            ->add('id', HiddenType::class)
            ->add('value', TextType::class, [
                'label' => 'Número de serie',
            ])
            ->add('alias', TextType::class, [
                'label' => 'Alias del número de serie',
                'required'  => false
            ])
            ->add('documentSeriesSet',  EntityType::class, [
                'label' => 'Categoría de serie',
                'class' => InvoiceSeriesSet::class,
                'query_builder' => function (InvoiceSeriesSetRepository $er) {
                    return $er
                        ->createQueryBuilder('a');
                },
                'choice_label' => 'name'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => InvoiceSeries::class,
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix(): string
    {
        return 'ctic_document_invoiceseries';
    }
}
