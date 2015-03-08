<?php
// src/BepsElectionBundle/Form/Country.php
namespace BepsElectionBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ElectionType extends AbstractType
{

    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $em;

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        
        // delete action does not need any info from the object
        // 'manage' handles a simple create form
        // edit does
        $this->em = $options['em'];
        switch ($options['action']) {
            case 'delete':
                $builder->add('description', 'hidden');
                break;
            default:
                $builder->add('description', 'text')
                    ->add('country', 'entity', array(
                    'class' => "BepsElectionBundle:Country",
                    'property' => 'name'
                ))
                    ->add('election_date', 'date', array(
                    'input' => 'datetime',
                    'widget' => 'choice'
                ))
                    ->add('show_percents', 'checkbox', array(
                    'label' => 'use percents',
                    'data' => true,
                    'required' => false
                ))
                    ->add('show_seats', 'checkbox', array(
                    'label' => 'use seats',
                    'data' => true,
                    'required' => false
                ))
                    ->add('show_participation', 'checkbox', array(
                    'label' => 'show participation',
                    'data' => true,
                    'required' => false
                ))
                    ->add('save', 'submit');
                break;
        }
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setRequired(array(
            'em'
        ));
        
        $resolver->setAllowedTypes(array(
            'em' => 'Doctrine\Common\Persistence\ObjectManager'
        ));
        
        $resolver->setDefaults(array(
            'data_class' => 'BepsElectionBundle\Entity\Election'
        ));
    }

    public function getName()
    {
        return 'bepselectionbundle_election';
    }
}