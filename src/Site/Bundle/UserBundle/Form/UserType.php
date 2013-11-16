<?php

namespace Site\Bundle\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UserType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName')
            ->add('lastName')
            ->add('username')
            ->add(
                'password',
                'repeated',
                array(
                    'type' => 'password',
                    'invalid_message' => 'The password fields must match.',
                    'options' => array('attr' => array('class' => 'password-field')),
                    'required' => true,
                    'first_options'  => array('label' => 'Password'),
                    'second_options' => array('label' => 'Repeat Password'),
                )

            ) 
            ->add(  'created',
                    'datetime',
                    array('required' => false)
            )
            ->add(  'updated',
                    'datetime',
                    array('required' => false)
            )
        ;



        /*
         *
         *
         *
         * $builder->add(    'password',
                            'repeated',
                            array(
                                    'type' => 'password',
                                    'invalid_message' => 'The password fields must match.',
                                    'options' => array('attr' => array('class' => 'password-field')),
                                    'required' => true,
                                    'first_options'  => array('label' => 'Password'),
                                    'second_options' => array('label' => 'Repeat Password'),
                            )
        );*/

    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Site\Bundle\UserBundle\Entity\User'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'site_bundle_userbundle_user';
    }
}
