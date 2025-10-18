<?php

namespace App\Entities;

/**
 * @context7 /codeigniter/entity
 * @description Represents a registrant entity with all related properties
 * @example 
 * $registrant = new RegistrantEntity();
 * $registrant->name = 'John Doe';
 * $registrant->gender = 'L';
 */
class RegistrantEntity
{
    protected $id;
    protected $username;
    protected $regId;
    protected $kode;
    protected $password;
    protected $name;
    protected $gender;
    protected $previousSchool;
    protected $nisn;
    protected $cp;
    protected $program;
    protected $selectionPath;
    protected $relToRegular;
    protected $relToRegularPath;
    protected $registrationTime;
    protected $father_id;
    protected $mother_id;
    protected $guardian_id;
    protected $rapor_id;
    protected $initialCost;
    protected $subscriptionCost;
    protected $landDonation;
    protected $qurban;
    protected $mainParent;
    protected $verified;
    protected $finalized;
    protected $deleted;
    protected $gelombang;
    protected $entryYear;
    protected $createdAt;
    protected $updatedAt;

    /**
     * @context7 /codeigniter/entity/property
     * @description Unique identifier for the registrant
     * @var int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @context7 /codeigniter/entity/property
     * @description Username for login
     * @var string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @context7 /codeigniter/entity/property
     * @description Registration ID
     * @var string
     */
    public function getRegId()
    {
        return $this->regId;
    }

    /**
     * @context7 /codeigniter/entity/property
     * @description Unique payment code
     * @var string
     */
    public function getKode()
    {
        return $this->kode;
    }

    /**
     * @context7 /codeigniter/entity/property
     * @description Hashed password
     * @var string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @context7 /codeigniter/entity/property
     * @description Full name
     * @var string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @context7 /codeigniter/entity/property
     * @description Gender (L/P)
     * @var string
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * @context7 /codeigniter/entity/property
     * @description Previous school
     * @var string
     */
    public function getPreviousSchool()
    {
        return $this->previousSchool;
    }

    /**
     * @context7 /codeigniter/entity/property
     * @description NISN
     * @var string
     */
    public function getNisn()
    {
        return $this->nisn;
    }

    /**
     * @context7 /codeigniter/entity/property
     * @description Contact person
     * @var string
     */
    public function getCp()
    {
        return $this->cp;
    }

    /**
     * @context7 /codeigniter/entity/property
     * @description Study program
     * @var string
     */
    public function getProgram()
    {
        return $this->program;
    }

    /**
     * @context7 /codeigniter/entity/property
     * @description Selection path
     * @var string
     */
    public function getSelectionPath()
    {
        return $this->selectionPath;
    }

    /**
     * @context7 /codeigniter/entity/property
     * @description Relation to regular program
     * @var string
     */
    public function getRelToRegular()
    {
        return $this->relToRegular;
    }

    /**
     * @context7 /codeigniter/entity/property
     * @description Relation to regular path
     * @var string
     */
    public function getRelToRegularPath()
    {
        return $this->relToRegularPath;
    }

    /**
     * @context7 /codeigniter/entity/property
     * @description Registration time
     * @var string
     */
    public function getRegistrationTime()
    {
        return $this->registrationTime;
    }

    /**
     * @context7 /codeigniter/entity/property
     * @description Father ID
     * @var int
     */
    public function getFatherId()
    {
        return $this->father_id;
    }

    /**
     * @context7 /codeigniter/entity/property
     * @description Mother ID
     * @var int
     */
    public function getMotherId()
    {
        return $this->mother_id;
    }

    /**
     * @context7 /codeigniter/entity/property
     * @description Guardian ID
     * @var int
     */
    public function getGuardianId()
    {
        return $this->guardian_id;
    }

    /**
     * @context7 /codeigniter/entity/property
     * @description Rapor ID
     * @var int
     */
    public function getRaporId()
    {
        return $this->rapor_id;
    }

    /**
     * @context7 /codeigniter/entity/property
     * @description Initial cost
     * @var int
     */
    public function getInitialCost()
    {
        return $this->initialCost;
    }

    /**
     * @context7 /codeigniter/entity/property
     * @description Subscription cost
     * @var int
     */
    public function getSubscriptionCost()
    {
        return $this->subscriptionCost;
    }

    /**
     * @context7 /codeigniter/entity/property
     * @description Land donation
     * @var int
     */
    public function getLandDonation()
    {
        return $this->landDonation;
    }

    /**
     * @context7 /codeigniter/entity/property
     * @description Qurban participation
     * @var string
     */
    public function getQurban()
    {
        return $this->qurban;
    }

    /**
     * @context7 /codeigniter/entity/property
     * @description Main parent
     * @var string
     */
    public function getMainParent()
    {
        return $this->mainParent;
    }

    /**
     * @context7 /codeigniter/entity/property
     * @description Verification status
     * @var string
     */
    public function getVerified()
    {
        return $this->verified;
    }

    /**
     * @context7 /codeigniter/entity/property
     * @description Finalization status
     * @var bool
     */
    public function getFinalized()
    {
        return $this->finalized;
    }

    /**
     * @context7 /codeigniter/entity/property
     * @description Deletion status
     * @var bool
     */
    public function getDeleted()
    {
        return $this->deleted;
    }

    /**
     * @context7 /codeigniter/entity/property
     * @description Registration wave
     * @var int
     */
    public function getGelombang()
    {
        return $this->gelombang;
    }

    /**
     * @context7 /codeigniter/entity/property
     * @description Entry year
     * @var int
     */
    public function getEntryYear()
    {
        return $this->entryYear;
    }

    /**
     * @context7 /codeigniter/entity/property
     * @description Creation timestamp
     * @var string
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @context7 /codeigniter/entity/property
     * @description Update timestamp
     * @var string
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    // Setters
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }

    public function setRegId($regId)
    {
        $this->regId = $regId;
        return $this;
    }

    public function setKode($kode)
    {
        $this->kode = $kode;
        return $this;
    }

    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function setGender($gender)
    {
        $this->gender = $gender;
        return $this;
    }

    public function setPreviousSchool($previousSchool)
    {
        $this->previousSchool = $previousSchool;
        return $this;
    }

    public function setNisn($nisn)
    {
        $this->nisn = $nisn;
        return $this;
    }

    public function setCp($cp)
    {
        $this->cp = $cp;
        return $this;
    }

    public function setProgram($program)
    {
        $this->program = $program;
        return $this;
    }

    public function setSelectionPath($selectionPath)
    {
        $this->selectionPath = $selectionPath;
        return $this;
    }

    public function setRelToRegular($relToRegular)
    {
        $this->relToRegular = $relToRegular;
        return $this;
    }

    public function setRelToRegularPath($relToRegularPath)
    {
        $this->relToRegularPath = $relToRegularPath;
        return $this;
    }

    public function setRegistrationTime($registrationTime)
    {
        $this->registrationTime = $registrationTime;
        return $this;
    }

    public function setFatherId($father_id)
    {
        $this->father_id = $father_id;
        return $this;
    }

    public function setMotherId($mother_id)
    {
        $this->mother_id = $mother_id;
        return $this;
    }

    public function setGuardianId($guardian_id)
    {
        $this->guardian_id = $guardian_id;
        return $this;
    }

    public function setRaporId($rapor_id)
    {
        $this->rapor_id = $rapor_id;
        return $this;
    }

    public function setInitialCost($initialCost)
    {
        $this->initialCost = $initialCost;
        return $this;
    }

    public function setSubscriptionCost($subscriptionCost)
    {
        $this->subscriptionCost = $subscriptionCost;
        return $this;
    }

    public function setLandDonation($landDonation)
    {
        $this->landDonation = $landDonation;
        return $this;
    }

    public function setQurban($qurban)
    {
        $this->qurban = $qurban;
        return $this;
    }

    public function setMainParent($mainParent)
    {
        $this->mainParent = $mainParent;
        return $this;
    }

    public function setVerified($verified)
    {
        $this->verified = $verified;
        return $this;
    }

    public function setFinalized($finalized)
    {
        $this->finalized = $finalized;
        return $this;
    }

    public function setDeleted($deleted)
    {
        $this->deleted = $deleted;
        return $this;
    }

    public function setGelombang($gelombang)
    {
        $this->gelombang = $gelombang;
        return $this;
    }

    public function setEntryYear($entryYear)
    {
        $this->entryYear = $entryYear;
        return $this;
    }

    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    /**
     * @context7 /codeigniter/entity/method
     * @description Check if registrant profile is complete
     * @return bool
     */
    public function isComplete()
    {
        return !empty($this->name) && 
               !empty($this->gender) && 
               !empty($this->program) && 
               $this->finalized;
    }

    /**
     * @context7 /codeigniter/entity/method
     * @description Generate registration ID based on program, wave, year, gender, and code
     * @return void
     */
    public function generateRegId()
    {
        $pPref = ($this->program == 'Reguler') ? 'R' : 'K';
        $this->regId = 'G' . $this->gelombang . $pPref 
                . $this->entryYear . $this->gender . ''.$this->kode;
    }
}