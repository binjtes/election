<?php

namespace BepsElectionBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use BepsElectionBundle\Form\Extension\ImageTypeExtension;

class PartyType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('shortName')
            ->add('logofile', 'file',array('required' => false ,'label'=>'change party logo'))
            ->add('logo', 'hidden',array('required' => false,'label'=>false))
            ->add('webcolor','text', array('required' => false))
            ->add('leader','text', array('required' => false))
            ->add('leaderImage','text', array('required' => false))
          
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BepsElectionBundle\Entity\Party'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'bepselectionbundle_party';
    }
}
