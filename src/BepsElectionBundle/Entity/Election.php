<?php

namespace BepsElectionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Election
 *
 * @ORM\Table(name="election")
 * @ORM\Entity(repositoryClass="BepsElectionBundle\Entity\ElectionRepository")
 */
class Election
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
     * @ORM\ManyToOne(targetEntity="BepsElectionBundle\Entity\Country")
     * @ORM\JoinColumn(nullable=false, referencedColumnName="id")
     */   
    private $country;

    /**
     * @var string
     *
     * @ORM\Column(name="participation_rate", type="decimal", nullable = true)
     */
    private $participationRate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated", type="datetimetz")
     */
    private $updatedAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="election_date", type="datetime")
     */
    private $electionDate;

    /**
     * @ORM\ManyToOne(targetEntity="BepsElectionBundle\Entity\Election", inversedBy="child_elections")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id")
     */
    private $parent;

    /** adjacent list
     * @ORM\OneToMany(targetEntity="Election", mappedBy="parent")
     */
    private $child_elections;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @var integer
     * TODO : set nullable to false, Many2one to implement to users tables.
     * @ORM\Column(name="updatedBy", type="integer",nullable = true)
     */
    private $updatedBy;

    /**
     * @var integer
     *
     * @ORM\Column(name="seats", type="integer",nullable = true)
     */
    private $seats;

    /**
     * @var boolean
     *
     * @ORM\Column(name="show_percents", type="boolean")
     */
    private $showPercents;

    /**
     * @var boolean
     *
     * @ORM\Column(name="show_seats", type="boolean")
     */
    private $showSeats;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createdAt", type="datetimetz")
     */
    private $createdAt;

    /**
     * @var integer
     * TODO : set nullable to false, Many2one to implement to users tables.
     * @ORM\Column(name="createdBy", type="integer",nullable = true)
     */
    private $createdBy;

    /**
     * @var boolean
     *
     * @ORM\Column(name="show_participation", type="boolean")
     */
    private $showParticipation;

    /**
     * @var integer
     * TODO : set nullable to false, Many2one to status table to be defined .
     * @ORM\Column(name="status", type="integer",nullable = true)
     */
    private $status;

    
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->child_elections = new \Doctrine\Common\Collections\ArrayCollection();
        $this->updatedAt = new \Datetime();
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
     * Set country
     *
     * @param \BepsElectionBundle\Entity\Country $country
     * @return Election
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
     * Set participationRate
     *
     * @param string $participationRate
     * @return Election
     */
    public function setParticipationRate($participationRate)
    {
        $this->participationRate = $participationRate;

        return $this;
    }

    /**
     * Get participationRate
     *
     * @return string 
     */
    public function getParticipationRate()
    {
        return $this->participationRate;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return Election
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
     * Set electionDate
     *
     * @param \DateTime $electionDate
     * @return Election
     */
    public function setElectionDate($electionDate)
    {
        $this->electionDate = $electionDate;

        return $this;
    }

    /**
     * Get electionDate
     *
     * @return \DateTime 
     */
    public function getElectionDate()
    {
        return $this->electionDate;
    }

    /**
     * Set parent
     *
     * @param integer $parent
     * @return Election
     */
    public function setParent(\BepsElectionBundle\Entity\Election $election)
    {
        $this->parent = $election;

       
    }
        

    
    
    /**
     * Add child_election
     *
     * @param \BepsElectionBundle\Entity\Election $election
     * @return Election 
     */
    public function addChildElection(\BepsElectionBundle\Entity\Election $election)
    {
        $this->child_elections[] = $election;
    
        return $this;
    }
    
    /**
     * Remove child_election
     *
     * @param \BepsElectionBundle\Entity\Election $election
     */
    public function removeChildElection(\BepsElectionBundle\Entity\Election $election)
    {
        $this->child_elections->removeElement($election); 
    }
    
    
    /**
     * Get child_elections
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getChildElections()
    {
        return $this->child_elections;
    }
    
    
    /**
     * Get parent
     *
     * @return \BepsElectionBundle\Entity\Election
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Election
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set updatedBy
     *
     * @param integer $updatedBy
     * @return Election
     */
    public function setUpdatedBy($updatedBy)
    {
        $this->updatedBy = $updatedBy;

        return $this;
    }

    /**
     * Get updatedBy
     *
     * @return integer 
     */
    public function getUpdatedBy()
    {
        return $this->updatedBy;
    }

    /**
     * Set seats
     *
     * @param integer $seats
     * @return Election
     */
    public function setSeats($seats)
    {
        $this->seats = $seats;

        return $this;
    }

    /**
     * Get seats
     *
     * @return integer 
     */
    public function getSeats()
    {
        return $this->seats;
    }

    /**
     * Set showPercents
     *
     * @param boolean $showPercents
     * @return Election
     */
    public function setShowPercents($showPercents)
    {
        $this->showPercents = $showPercents;

        return $this;
    }

    /**
     * Get showPercents
     *
     * @return boolean 
     */
    public function getShowPercents()
    {
        return $this->showPercents;
    }

    /**
     * Set showSeats
     *
     * @param boolean $showSeats
     * @return Election
     */
    public function setShowSeats($showSeats)
    {
        $this->showSeats = $showSeats;

        return $this;
    }

    /**
     * Get showSeats
     *
     * @return boolean 
     */
    public function getShowSeats()
    {
        return $this->showSeats;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createAt
     * @return Election
     */
    public function setCreatedAt($createAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set createdBy
     *
     * @param integer $createdBy
     * @return Election
     */
    public function setCreatedBy($createdBy)
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    /**
     * Get createdBy
     *
     * @return integer 
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    /**
     * Set showParticipation
     *
     * @param boolean $showParticipation
     * @return Election
     */
    public function setShowParticipation($showParticipation)
    {
        $this->showParticipation = $showParticipation;

        return $this;
    }

    /**
     * Get showParticipation
     *
     * @return boolean 
     */
    public function getShowParticipation()
    {
        return $this->showParticipation;
    }

    /**
     * Set status
     *
     * @param integer $status
     * @return Election
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return integer 
     */
    public function getStatus()
    {
        return $this->status;
    }
}
