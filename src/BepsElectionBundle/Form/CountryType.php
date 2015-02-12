<?php
// src/BepsElectionBundle/Form/Country.php
namespace BepsElectionBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CountryType extends AbstractType
{

	
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		
	    // delete action does not need any info from the object
	    // 'manage' handles a simple create form   
	    // edit does 
	    
	    switch ($options['action']){
    	    case 'delete':
    	        $builder->add('name', 'hidden')
    	        ->add('flag', 'hidden');
    	        break;
    	    case 'manage':
    	        $builder->add('name', 'text')
    	       ->add('flag', 'text') ;
    	        break;
    	    default : 
    	        $builder->add('name', 'text')
    	        ->add('file', 'file')
    	        ->add('flag', 'text')
    	        ->add('parties', 'collection', array(
    	            'type'         => new PartyType(),
    	            'allow_add'    => true,
    	            'allow_delete' => true,
    	            'by_reference' => false
    	        ))
    	        ;
	    }          
	}


	
	public function setDefaultOptions(OptionsResolverInterface $resolver)
	{
		$resolver->setDefaults(array(
				'data_class' => 'BepsElectionBundle\Entity\Country',
		));
	}
	
	public function getName()
	{
		return 'bepselectionbundle_country';
	}

	
	
}