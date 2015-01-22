<?php

namespace BepsElectionBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response ;
use Symfony\Component\HttpFoundation\Request;
use BepsElectionBundle\Entity\Country ;
use AppBundle\Entity\RPublishingRule ;
use Braincrafted\Bundle\BootstrapBundle\Session\FlashMessage ;
use BepsElectionBundle\Form\CountryType ;


class ManageController extends Controller
{
	

	
    /**
     * @Route("/manage", name="manage")
     */
    public function indexAction()
    {
    	
    	// By default displays a list of countries and propose insert/update /delete for those .
        
        //add an empty form for adding a missing country
        $country = new Country();
        
        $form = $this->createForm(new CountryType(),$country, array('action'=>'manage'));
         
        $form->handleRequest($this->getRequest());
        // once updated , redirection to index manage page (listing)
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $country = $form->getData();
            $em->persist($country);
            $em->flush();
            $this->get('session')->getFlashBag()->add('notice',   array(
                'alert' => 'success',
                'title' => 'Success!',
                'message' => 'the country has been created'));
             
        }
         
        $countries = $this->getDoctrine()->getRepository('BepsElectionBundle:Country')->findAll();
        return $this->render('BepsElectionBundle:Manage:index.html.twig', array('countries'=>$countries, 'form'=>$form->createView()));
    
    }
    
    

    /**
     * @Route("/manage/edit/{countryid}", name="manage_edit")
     */
    public function editAction($countryid){
        //edit a country : name, some metadata  + TODO parties 
        $country = $this->getDoctrine()->getRepository('BepsElectionBundle:Country')->find($countryid);
        $form = $this->createForm(new CountryType($countryid),  $country); 
        $form->handleRequest($this->getRequest()); 
        if ($form->isValid()) {
        
            $em = $this->getDoctrine()->getManager();
            $country = $form->getData(); 
            $em->flush();
            $this->get('session')->getFlashBag()->add('notice',    array(
                'alert' => 'success',
                'title' => 'updated country',
                'message' => $country->getName()
            ));
        }    
            
    	return $this->render('BepsElectionBundle:Manage:edit.html.twig',array('form' => $form->createView()));
    }
  
    /**
     * @Route("/manage/delete/{countryid}", name="manage_delete")
     */
    public function deleteAction($countryid){
        // delete  a country
        $country = $this->getDoctrine()->getRepository('BepsElectionBundle:Country')->find($countryid); 
        
        if (!$country ) {
            throw $this->createNotFoundException(
                'No country  found for id ' . $countryid
            );
        }
        
        
        
        $form = $this->createFormBuilder($country)
            ->add('confirm', 'checkbox', array('required' => true , 'mapped'=>false))
            ->add('delete', 'submit')
            ->getForm();
           
        $form->handleRequest($this->getRequest());
        
        // just use the POST request system for forms  to delete 
        if ($form->isValid()) {   
            $em = $this->getDoctrine()->getManager();
            
            $em->remove($country);
            $em->flush();
            $this->get('session')->getFlashBag()->add('notice',    array(
                'alert' => 'success',
                'title' => 'country removed',
                'message' => $country->getName() 
            
            ));
            
            return $this->redirect( $this->generateUrl('manage'));
         
        }             
    	
        return $this->render('BepsElectionBundle:Manage:delete.html.twig',array('form' => $form->createView()));
    }
    
}
