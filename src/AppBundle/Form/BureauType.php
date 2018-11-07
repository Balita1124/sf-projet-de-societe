<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use AppBundle\Entity\Region;
use AppBundle\Entity\Fokontany;
use AppBundle\Entity\District;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class BureauType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('name', TextType::class)
                ->add('code', TextType::class)
                ->add('fokontany', EntityType::class, array(
                    'class' => Fokontany::class,
                    'choice_label' => 'name',
                ))
                ->add('electeurs', IntegerType::class)
                ->add('votants', IntegerType::class)
                ->add('voix12', IntegerType::class)
                ->add('voix13', IntegerType::class)
                ->add('voix25', IntegerType::class)
                ->add('voixautre', IntegerType::class)
                ->add('voixfotsy', IntegerType::class)
                ->add('voixmaty', IntegerType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => 'AppBundle\Entity\Bureau',
        ]);
    }

}
