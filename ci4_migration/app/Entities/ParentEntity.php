<?php

namespace App\Entities;

/**
 * @context7 /codeigniter/entity
 * @description Represents a parent/guardian entity with all related properties
 * @example 
 * $parent = new ParentEntity();
 * $parent->name = 'John Doe';
 * $parent->type = 'father';
 */
class ParentEntity
{
    protected $id;
    protected $type;
    protected $name;
    protected $status;
    protected $birthPlace;
    protected $birthDate;
    protected $street;
    protected $RT;
    protected $RW;
    protected $village;
    protected $district;
    protected $city;
    protected $province;
    protected $postalCode;
    protected $contact;
    protected $relation;
    protected $nationality;
    protected $religion;
    protected $educationLevel;
    protected $job;
    protected $position;
    protected $company;
    protected $income;
    protected $burdenCount;
    protected $createdAt;
    protected $updatedAt;

    /**
     * @context7 /codeigniter/entity/property
     * @description Unique identifier for the parent
     * @var int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @context7 /codeigniter/entity/property
     * @description Parent type (father, mother, guardian)
     * @var string
     */
    public function getType()
    {
        return $this->type;
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
     * @description Status (Hidup, Cerai, Almarhum)
     * @var string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @context7 /codeigniter/entity/property
     * @description Birth place
     * @var string
     */
    public function getBirthPlace()
    {
        return $this->birthPlace;
    }

    /**
     * @context7 /codeigniter/entity/property
     * @description Birth date
     * @var string
     */
    public function getBirthDate()
    {
        return $this->birthDate;
    }

    /**
     * @context7 /codeigniter/entity/property
     * @description Street address
     * @var string
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * @context7 /codeigniter/entity/property
     * @description RT number
     * @var int
     */
    public function getRT()
    {
        return $this->RT;
    }

    /**
     * @context7 /codeigniter/entity/property
     * @description RW number
     * @var int
     */
    public function getRW()
    {
        return $this->RW;
    }

    /**
     * @context7 /codeigniter/entity/property
     * @description Village
     * @var string
     */
    public function getVillage()
    {
        return $this->village;
    }

    /**
     * @context7 /codeigniter/entity/property
     * @description District
     * @var string
     */
    public function getDistrict()
    {
        return $this->district;
    }

    /**
     * @context7 /codeigniter/entity/property
     * @description City
     * @var string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @context7 /codeigniter/entity/property
     * @description Province
     * @var string
     */
    public function getProvince()
    {
        return $this->province;
    }

    /**
     * @context7 /codeigniter/entity/property
     * @description Postal code
     * @var string
     */
    public function getPostalCode()
    {
        return $this->postalCode;
    }

    /**
     * @context7 /codeigniter/entity/property
     * @description Contact number
     * @var string
     */
    public function getContact()
    {
        return $this->contact;
    }

    /**
     * @context7 /codeigniter/entity/property
     * @description Relation to registrant
     * @var string
     */
    public function getRelation()
    {
        return $this->relation;
    }

    /**
     * @context7 /codeigniter/entity/property
     * @description Nationality
     * @var string
     */
    public function getNationality()
    {
        return $this->nationality;
    }

    /**
     * @context7 /codeigniter/entity/property
     * @description Religion
     * @var string
     */
    public function getReligion()
    {
        return $this->religion;
    }

    /**
     * @context7 /codeigniter/entity/property
     * @description Education level
     * @var string
     */
    public function getEducationLevel()
    {
        return $this->educationLevel;
    }

    /**
     * @context7 /codeigniter/entity/property
     * @description Job
     * @var string
     */
    public function getJob()
    {
        return $this->job;
    }

    /**
     * @context7 /codeigniter/entity/property
     * @description Position
     * @var string
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @context7 /codeigniter/entity/property
     * @description Company
     * @var string
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * @context7 /codeigniter/entity/property
     * @description Income
     * @var string
     */
    public function getIncome()
    {
        return $this->income;
    }

    /**
     * @context7 /codeigniter/entity/property
     * @description Number of dependents
     * @var string
     */
    public function getBurdenCount()
    {
        return $this->burdenCount;
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

    /**
     * @context7 /codeigniter/entity/method
     * @description Get complete address
     * @return string
     */
    public function getAddress()
    {
        $str_RT = (is_null($this->RT)) ? '' : $this->RT;
        $str_RW = (is_null($this->RW)) ? '' : $this->RW;
        $str_address = $this->street . ' RT ' . $str_RT . ' RW ' . $str_RW . ' '
        . $this->village . ', ' . $this->district . ' ' . $this->city . ' ' . $this->province;
        return $str_address;
    }

    // Setters
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    public function setBirthPlace($birthPlace)
    {
        $this->birthPlace = $birthPlace;
        return $this;
    }

    public function setBirthDate($birthDate)
    {
        $this->birthDate = $birthDate;
        return $this;
    }

    public function setStreet($street)
    {
        $this->street = $street;
        return $this;
    }

    public function setRT($RT)
    {
        $this->RT = $RT;
        return $this;
    }

    public function setRW($RW)
    {
        $this->RW = $RW;
        return $this;
    }

    public function setVillage($village)
    {
        $this->village = $village;
        return $this;
    }

    public function setDistrict($district)
    {
        $this->district = $district;
        return $this;
    }

    public function setCity($city)
    {
        $this->city = $city;
        return $this;
    }

    public function setProvince($province)
    {
        $this->province = $province;
        return $this;
    }

    public function setPostalCode($postalCode)
    {
        $this->postalCode = $postalCode;
        return $this;
    }

    public function setContact($contact)
    {
        $this->contact = $contact;
        return $this;
    }

    public function setRelation($relation)
    {
        $this->relation = $relation;
        return $this;
    }

    public function setNationality($nationality)
    {
        $this->nationality = $nationality;
        return $this;
    }

    public function setReligion($religion)
    {
        $this->religion = $religion;
        return $this;
    }

    public function setEducationLevel($educationLevel)
    {
        $this->educationLevel = $educationLevel;
        return $this;
    }

    public function setJob($job)
    {
        $this->job = $job;
        return $this;
    }

    public function setPosition($position)
    {
        $this->position = $position;
        return $this;
    }

    public function setCompany($company)
    {
        $this->company = $company;
        return $this;
    }

    public function setIncome($income)
    {
        $this->income = $income;
        return $this;
    }

    public function setBurdenCount($burdenCount)
    {
        $this->burdenCount = $burdenCount;
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
}