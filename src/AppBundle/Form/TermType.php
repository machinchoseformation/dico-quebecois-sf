<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use EWZ\Bundle\RecaptchaBundle\Validator\Constraints\True;


class TermType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', 'email', array(
                'label' => "Votre email",
                'mapped' => false
            ))
            ->add('name', null, array(
                'label' => "Le nouveau terme"
            ))
            ->add('definitions', 'collection', array(
                'allow_add' => true,
                'type' => new DefinitionType(),
            ))
            ->add('examples', 'collection', array(
                'allow_add' => true,
                'type' => new ExampleType()
            ))
            ->add('variations', null, array(
                'label' => 'Variation sur le thème'
            ))
            ->add('pronunciation', null, array(
                'label' => 'Prononciation (libre)'
            ))
            ->add('category', null, array(
                'label' => 'Catégorie'
            ))
            ->add('nature', 'choice', array(
                'choices' => array(
                    'nom commun',
                    'verbe',
                    'abréviation',
                    'abbréviation',
                    'nom propre',
                    'adjectif',
                    'adverbe',
                    'acronyme',
                    'conjonction',
                    'autre',
                )
            ))
            ->add('gender', 'choice', array(
                'label' => 'Genre',
                'choices' => array(
                    'm' => 'Masculin',
                    'f' => 'Féminin',
                    'i' => 'Neutre',
                    'na' => 'NA'
                )
            ))
            ->add('number', 'choice', array(
                'label' => 'Nombre',
                'choices' => array(
                    'singulier',
                    'pluriel',
                    'NA'
                )
            ))
            ->add('origin', null, array(
                'label' => 'Origine du terme, étimologie'
            ))
            ->add('recaptcha', 'ewz_recaptcha', array(
                'mapped'      => false,
                'constraints' => array(
                    new True()
                )
            ))
            ->add('Enregistrer', 'submit', array(
                'attr' => array(
                    'class' => 'btn btn-info'
                )
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Term'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'appbundle_term';
    }
}
