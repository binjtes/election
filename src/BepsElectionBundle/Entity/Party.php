<?php

namespace BepsElectionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
/**
 * Party
 *
 * @ORM\Table(name="party")
 * @ORM\Entity(repositoryClass="BepsElectionBundle\Entity\PartyRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Party
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="shortName", type="string", length=55)
     */
    private $shortName;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated", type="datetimetz")
     */
    private $updatedAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="datetimetz")
     */
    private $createdAt;

    /**
     * @var string
     *
     * @ORM\Column(name="logo", type="string", nullable = true , length=255)
     */
    private $logo;

    /**
     * @var string
     *
     * @ORM\Column(name="webcolor", type="string", nullable = true , length=6)
     */
    private $webcolor;
    
    
    /**
     * @var string
     *
     * @ORM\Column(name="leader", type="string",nullable = true ,  length=255)
     */
    private $leader;

    /**
     * @var string
     *
     * @ORM\Column(name="leaderImage", type="string", nullable = true , length=255)
     */
    private $leaderImage;

    /**
     * @ORM\ManyToOne(targetEntity="BepsElectionBundle\Entity\Country",inversedBy="parties")
     * @ORM\JoinColumn(nullable=false, referencedColumnName="id", onDelete="CASCADE")
     */   
    private $country ;
    
    
    /*
     * properties  for uploading files
     * 
     */
    private $logofile ;
    // to remove the previous uploaded logo reference.
    private $logotemp ;
    
    private $leaderfile ;
    private $leadertemp ;
    
    
    public function __construct()
    {
        $this->updatedAt = new \Datetime();
    
    }

    /**
     * Get Logofile
     *
     * @return UploadedFile
     */
    public function getLogofile(){
        
        return $this->logofile ;
    }
    
    
    /**
     * Set Logofile
     *
    * @param UploadedFile $logofile 
     */    
    public function setLogofile(UploadedFile $logofile = null){
        
        $this->logofile = $logofile ;
        
        // will trigger LifeCycleCallbacks
        if($logofile){
            $this->updatedAt = new \DateTime ;
        }
        
        if(null !== $this->logo){
            $this->logotemp = $this->logo;
            $this->logo = null;
        }
        
    }
    /**
     * Get leaderfile
     *
     * @return UploadedFile
     */
    public function getLeaderfile(){
    
        return $this->leaderfile ;
    }
    
    
    /**
     * Set Logofile
     *
     * @param UploadedFile $logofile
     */
    public function setLeaderfile(UploadedFile $leaderfile = null){
    
        $this->leaderfile = $leaderfile ;
    
        // will trigger LifeCycleCallbacks
        if($leaderfile){
            $this->updatedAt = new \DateTime ;
        }
    
        if(null !== $this->leaderImage){
            $this->leadertemp = $this->leaderImage;
            $this->leaderImage = null;
        }
    
    }    

     /**
      *
      * @ORM\PrePersist()
      * @ORM\PreUpdate()
      *
      */    
     public function preUpload(){
         dump("PreUpdate Prepersist");
         $this->updatedAt = new \DateTime();
         $this->createdAt = new \DateTime();
         if(null === $this->logofile && null === $this->leaderfile){
             return ;
         }
         // the file name is the id of the entity .
        // TODO : improve the sanitization of the filename 
        if($this->logofile){
            $this->logo = $this->logofile->getClientOriginalName();
        }
        if($this->leaderfile){
            $this->leaderImage = $this->leaderfile->getClientOriginalName();
        }
        
     
     }     
     public function getUploadDir(){
         // relative to  /web repository
         return "uploads/img/parties" ;
     }
     
     public function getUploadRootDir(){
     
         //relative path to the image in the php code..
         return __DIR__.'/../../../web/'.$this->getUploadDir();
     }
     
     public function getWebPathLogo()
     {
         if(!$this->getLogo()){
             return ;
         }
         return $this->getUploadDir().'/'.$this->getId().'.'.$this->getLogo();
     }
     
     
     public function getWebPathLeaderImg()
     {
         if(!$this->getLeaderImage()){
             return ;
         }
         return $this->getUploadDir().'/'.$this->getId().'.'.$this->getLeaderImage();
     }
     
     
     /**
      *
      * @ORM\PostPersist()
      * @ORM\PostUpdate()
      *
      */
     public function upload(){
         // if there is no uploaded file , do nothing .
         dump("PostUpdate");
         if(null === $this->logofile  && null === $this->leaderfile){
             return ;
         }
     
         // remove the previous image
         if($this->logotemp){
             $oldfile = $this->getUploadRootDir().'/'.$this->logotemp ;
             if(file_exists($oldfile)){
                 unlink($oldfile);
                 dump('PostUpdate removed old file ' .$oldfile ) ;
             }
         }
         if($this->leadertemp){
             $oldfile = $this->getUploadRootDir().'/'.$this->leadertemp ;
             if(file_exists($oldfile)){
                 unlink($oldfile);
                 dump('PostUpdate removed old file ' .$oldfile ) ;
             }             
         }
         if($this->logofile){
             dump("PostUpdate name ") ;
             $this->logofile->move($this->getUploadRootDir(),$this->getId() . '.' . $this->getLogo());
             dump("logo set to : " . $this->getLogo()) ;
         }
         
         if($this->leaderfile){
             dump("PostUpdate name ") ;
             $this->leaderfile->move($this->getUploadRootDir(),$this->getId() . '.' . $this->getLeaderImage());
             dump("leader image set to : " . $this->getLeaderImage()) ;
         }
         
     }     
     
     /**
      *
      * @ORM\PreRemove()
      *
      */
     public function preRemoveUpload(){
         dump("PreRemove");
         $this->logotemp = $this->getUploadRootDir().'/'.$this->getId() . '.' . $this->getLogo() ;
         $this->leadertemp = $this->getUploadRootDir().'/'.$this->getId() . '.' . $this->getLeaderImage() ;
         dump("preremove upload " . $this->logotemp);
         dump("preremove upload " . $this->leadertemp);
          
     }
     
     /*
      *
      * @ORM\PostRemove()
      *
      */
     public function removeUpload(){
         dump("PostRemove");
         if(file_exists($this->logotemp)){
             unlink($this->logotemp);
             dump('PostRemove removed temporary file '.$this->logotemp ) ;
         }
         if(file_exists($this->leadertemp)){
             unlink($this->leadertemp);
             dump('PostRemove removed temporary file '.$this->leadertemp ) ;
         }
     }    
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Party
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set shortName
     *
     * @param string $shortName
     * @return Party
     */
    public function setShortName($shortName)
    {
        $this->shortName = $shortName;

        return $this;
    }

    /**
     * Get shortName
     *
     * @return string 
     */
    public function getShortName()
    {
        return $this->shortName;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return Party
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Party
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set logo
     *
     * @param string $logo
     * @return Party
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;

        return $this;
    }

    /**
     * Get logo
     *
     * @return string 
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * Set leader
     *
     * @param string $leader
     * @return Party
     */
    public function setLeader($leader)
    {
        $this->leader = $leader;

        return $this;
    }

    /**
     * Get leader
     *
     * @return string 
     */
    public function getLeader()
    {
        return $this->leader;
    }

    /**
     * Set leaderImage
     *
     * @param string $leaderImage
     * @return Party
     */
    public function setLeaderImage($leaderImage)
    {
        $this->leaderImage = $leaderImage;

        return $this;
    }

    /**
     * Get leaderImage
     *
     * @return string 
     */
    public function getLeaderImage()
    {
        return $this->leaderImage;
    }

    

    
    /**
     * Set country
     *
     * @param \BepsElectionBundle\Entity\Country $country
     * @return Party
     */
    public function setCountry(\BepsElectionBundle\Entity\Country $country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return \BepsElectionBundle\Entity\Country 
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set webcolor
     *
     * @param string $webcolor
     * @return Party
     */
    public function setWebcolor($webcolor)
    {
        $this->webcolor = $webcolor;

        return $this;
    }

    /**
     * Get webcolor
     *
     * @return string 
     */
    public function getWebcolor()
    {
        return $this->webcolor;
    }
}
