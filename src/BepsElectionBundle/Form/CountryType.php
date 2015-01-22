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
		
	    //delete action does not need any info from the object
	    if($options['action'] == 'delete'){
	        $builder->add('name', 'hidden')
	        ->add('flag', 'hidden');
	    }else{
	        $builder->add('name', 'text')
	        ->add('flag', 'text');
	    
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
		return 'country';
	}

	
	
}