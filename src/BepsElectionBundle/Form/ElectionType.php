<?php
// src/BepsElectionBundle/Form/Country.php
namespace BepsElectionBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ElectionType extends AbstractType
{

	
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		
	    // delete action does not need any info from the object
	    // 'manage' handles a simple create form   
	    // edit does 
	    
	    switch ($options['action']){
    	    case 'delete':
    	        $builder->add('description', 'hidden');
    	        break;
    	    case 'manage':
    	        $builder->add('description', 'text') ;
    	        break;
    	    default : 
    	        $builder->add('description', 'text');
    	    
	    }          
	}


	
	public function setDefaultOptions(OptionsResolverInterface $resolver)
	{
		$resolver->setDefaults(array(
				'data_class' => 'BepsElectionBundle\Entity\Election',
		));
	}
	
	public function getName()
	{
		return 'bepselectionbundle_election';
	}

	
	
}