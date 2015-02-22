<?php

namespace BepsElectionBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response ;
use Symfony\Component\HttpFoundation\Request;
use BepsElectionBundle\Entity\Election ;
use Braincrafted\Bundle\BootstrapBundle\Session\FlashMessage ;
use BepsElectionBundle\Form\ElectionType ;


class ElectionsController extends Controller
{
	

	
    /**
     * @Route("/elections", name="elections")
     */
    public function indexAction()
    {
    	
    	// By default displays a list of elections  and propose insert/update /delete for those .
        
        //add an empty form for adding a missing country
        $election= new Election();
        
        $form = $this->createForm(new ElectionType(),$election, array('action'=>'manage'));
         
        $form->handleRequest($this->getRequest());
        // once updated , redirection to index manage page (listing)
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $election = $form->getData();
            $em->persist($election);
            $em->flush();
            $this->get('session')->getFlashBag()->add('notice',   array(
                'alert' => 'success',
                'title' => 'Success!',
                'message' => 'the election has been created'));
             
        }
         
        $elections = $this->getDoctrine()->getRepository('BepsElectionBundle:Election')->findAll();
        return $this->render('BepsElectionBundle:Elections:index.html.twig', array('elections'=>$elections, 'form'=>$form->createView()));
    
    }
    
    

    /**
     * @Route("/manage/election_edit/{electionid}", name="election_edit")
     */
    public function editAction($electionid){
        dump($this->getRequest());
        
        //edit a country : name, some metadata  + TODO parties 
        $election = $this->getDoctrine()->getRepository('BepsElectionBundle:Election')->find($countryid);
        $form = $this->createForm(new ElectionType($electionid),  $election); 
        $form->handleRequest($this->getRequest()); 
        if ($form->isValid()) {
        
            $em = $this->getDoctrine()->getManager();
            $election = $form->getData(); 
            
            $em->flush();
            $this->get('session')->getFlashBag()->add('notice',    array(
                'alert' => 'success',
                'title' => 'updated country',
                'message' => $country->getName()
            ));
        }    
            
    	return $this->render('BepsElectionBundle:Manage:edit.html.twig',array('form' => $form->createView(), 'election' => $election));
    }
  
    /**
     * @Route("/manage/election_delete/{electionid}", name="election_delete")
     */
    public function deleteAction($electionid){
        // delete  a country
        $election = $this->getDoctrine()->getRepository('BepsElectionBundle:Election')->find($electionid); 
        
        if (!$election ) {
            throw $this->createNotFoundException(
                'No election  found for id ' . $countryid
            );
        }
        
        
        
        $form = $this->createFormBuilder($election)
            ->add('confirm', 'checkbox', array('required' => true , 'mapped'=>false))
            ->add('delete', 'submit')
            ->getForm();
           
        $form->handleRequest($this->getRequest());
        
        // just use the POST request system for forms  to delete 
        if ($form->isValid()) {   
            $em = $this->getDoctrine()->getManager();
            
            $em->remove($election);
            $em->flush();
            $this->get('session')->getFlashBag()->add('notice',    array(
                'alert' => 'success',
                'title' => 'election removed',
                'message' => $election->getName() 
            
            ));
            
            return $this->redirect( $this->generateUrl('elections'));
         
        }             
    	
        return $this->render('BepsElectionBundle:Manage:delete.html.twig',array('form' => $form->createView()));
    }
    
}
