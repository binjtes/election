<?php

namespace BepsElectionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
/**
 * Country
 *
 * @ORM\Table(name="country")
 * @ORM\Entity(repositoryClass="BepsElectionBundle\Entity\CountryRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Country
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
     * @ORM\Column(name="flag", type="string", length=255)
     */
    private $flag;


    private $file ;
    
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated", type="datetimetz")
     */
    private $updatedAt;
    
    
    
    // temporary name for uploaded file 
    private $tempFilename ;
    
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->parties = new \Doctrine\Common\Collections\ArrayCollection();
        $this->updatedAt = new \Datetime();
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
    
    public function getFile()
    {
        return $this->file;
    }
    
    public function setFile(UploadedFile $file = null)
    {
        $this->file = $file;
       
        $this->updatedAt = new \DateTime();
        
        // for later remove, store the previous file to be deleted 
        dump('setFile previous file is '. $this->flag);
        if(null !== $this->flag){
            $this->tempFilename = $this->flag ;
            $this->flag = null;
        }
    }
    
 
    
    public function getWebPath()
    {
        return $this->getUploadDir().'/'.$this->getId().'.'.$this->getFlag();
    }
    
    /**
     * 
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     * 
     */
    public function preUpload(){
        dump("PreUpdate");
        if(null == $this->file ){
            return ;
        }   
        // the file name is the id of the entity.
        // TODO : improve the sanitization of the filename
        $this->flag = $this->file->getClientOriginalName();
       
        
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
        if(null == $this->file ){
            return ;
        }
        
        // remove the previous image 
        if(null !== $this->tempFilename){
            $oldfile = $this->getUploadRootDir().'/'.$this->tempFilename ;
            if(file_exists($oldfile)){
                unlink($oldfile);
                dump('PostUpdate removed old file ' .$oldfile ) ;
            }
        
        }
        
        dump("PostUpdate name ") ;
        $this->file->move($this->getUploadRootDir(),$this->getId() . '.' . $this->getFlag());
        dump("flag set to : " . $this->getFlag()) ; 
        
    }
    
    /**
     *
     * @ORM\PreRemove()
     *
     */   
    public function preRemoveUpload(){
        dump("PreRemove");
        $this->tempFilename = $this->getUploadRootDir().'/'.$this->getId() . '.' . $this->getFlag() ;
        dump("preremove upload " . $this->tempFilename);
       
    }
    
    /*
     * 
     * @ORM\PostRemove()
     * 
     */
    public function removeUpload(){
        dump("PostRemove");
        if(file_exists($this->tempFilename)){
            unlink($this->tempFilename);
            dump('PostRemove removed temporary file '.$this->tempFilename ) ;
        }
    }
    
    public function getUploadDir(){
        // relative to  /web repository 
        return "uploads/img/countries" ;
    }
    
    public function getUploadRootDir(){
        
        //relative path to the image in the php code..
        return __DIR__.'/../../../web/'.$this->getUploadDir();
    }
    
    
    /**
     * @ORM\OneToMany(targetEntity="BepsElectionBundle\Entity\Party", mappedBy="country",cascade={"persist","remove"}, orphanRemoval=true)
     * @ORM\JoinColumn(nullable=false)
     */
    private $parties ; 
    
    
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
     * @return Country
     */
    public function setName($name)
    {
        $this->name = $name;
        dump("yoyo  ") ;
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
     * Set flag
     *
     * @param string $flag
     * @return Country
     */
    public function setFlag($flag)
    {
        $this->flag = $flag;

        return $this;
    }

    /**
     * Get flag
     *
     * @return string 
     */
    public function getFlag()
    {
        return $this->flag;
    }


    /**
     * Add parties
     *
     * @param \BepsElectionBundle\Entity\Party $parties
     * @return Country
     */
    public function addParty(\BepsElectionBundle\Entity\Party $parties)
    {
        $this->parties[] = $parties;

        return $this;
    }

    /**
     * Remove parties
     *
     * @param \BepsElectionBundle\Entity\Party $parties
     */
    public function removeParty(\BepsElectionBundle\Entity\Party $parties)
    {
        $this->parties->removeElement($parties);
    }

    /**
     * Get parties
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getParties()
    {
        return $this->parties;
    }
    
    /*
     * 
     * default toString method, used in twig
     */
    public function __toString()
    {
        return (string) $this->id;
    }
    
}
