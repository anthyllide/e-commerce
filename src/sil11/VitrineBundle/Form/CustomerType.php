<?php

namespace sil11\VitrineBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CustomerType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('last_name', 'text', array('label' => 'Nom'));
        $builder->add('first_name', 'text', array('label' => 'Prénom'));
        $builder->add('mail', 'email', array('label' => 'Adresse mail'));
        $builder->add('password', 'password', array('label' => 'Mot de passe'));
        $builder->add('administrator', 'hidden', array('data' => 'n', 'required' => true));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'sil11\VitrineBundle\Entity\Customer'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'sil11_vitrinebundle_customer';
    }


}
