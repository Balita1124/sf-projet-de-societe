<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use AppBundle\Entity\Region;
use AppBundle\Entity\Province;
use AppBundle\Entity\District;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;


class PromesseType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class)
            ->add('description', TextareaType::class)
            ->add('date', DateType::class, array(
//                'widget' => 'single_text',
//                'attr' => array('class' => 'js-datepicker'),
                'format' => 'dd MM yyyy',
//                'html5' => false,
            ))
            ->add('province', EntityType::class, array(
                'class' => Province::class,
                'choice_label' => 'name',
            ))
            ->add('region', EntityType::class, array(
                'class' => Region::class,
                'choice_label' => 'name',
            ))
            ->add('district', EntityType::class, array(
                'class' => District::class,
                'choice_label' => 'name',
            ))//            ->add('submit', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'AppBundle\Entity\Promesse',
        ]);
    }
}