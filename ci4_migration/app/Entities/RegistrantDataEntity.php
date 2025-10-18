<?php

namespace App\Entities;

/**
 * @context7 /codeigniter/entity
 * @description Represents detailed registrant data entity
 * @example 
 * $data = new RegistrantDataEntity();
 * $data->nik = '1234567890123456';
 * $data->birthPlace = 'Jakarta';
 */
class RegistrantDataEntity
{
    protected $id;
    protected $registrant_id;
    protected $nik;
    protected $nkk;
    protected $nak;
    protected $birthPlace;
    protected $birthDate;
    protected $bloodType;
    protected $childOrder;
    protected $siblingsCount;
    protected $street;
    protected $RT;
    protected $RW;
    protected $village;
    protected $district;
    protected $city;
    protected $province;
    protected $postalCode;
    protected $familyCondition;
    protected $nationality;
    protected $religion;
    protected $hospitalSheets;
    protected $physicalAbnormalities;
    protected $height;
    protected $weight;
    protected $stayWith;
    protected $hobbies;
    protected $achievements;
    protected $createdAt;
    protected $updatedAt;

    /**
     * @context7 /codeigniter/entity/property
     * @description Unique identifier
     * @var int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @context7 /codeigniter/entity/property
     * @description Registrant ID
     * @var int
     */
    public function getRegistrantId()
    {
        return $this->registrant_id;
    }

    /**
     * @context7 /codeigniter/entity/property
     * @description NIK number
     * @var string
     */
    public function getNik()
    {
        return $this->nik;
    }

    /**
     * @context7 /codeigniter/entity/property
     * @description NKK number
     * @var string
     */
    public function getNkk()
    {
        return $this->nkk;
    }

    /**
     * @context7 /codeigniter/entity/property
     * @description NAK number
     * @var string
     */
    public function getNak()
    {
        return $this->nak;
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
     * @description Blood type
     * @var string
     */
    public function getBloodType()
    {
        return $this->bloodType;
    }

    /**
     * @context7 /codeigniter/entity/property
     * @description Child order
     * @var string
     */
    public function getChildOrder()
    {
        return $this->childOrder;
    }

    /**
     * @context7 /codeigniter/entity/property
     * @description Number of siblings
     * @var string
     */
    public function getSiblingsCount()
    {
        return $this->siblingsCount;
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
     * @description Family condition
     * @var string
     */
    public function getFamilyCondition()
    {
        return $this->familyCondition;
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
     * @description Hospital sheets
     * @var string
     */
    public function getHospitalSheets()
    {
        return $this->hospitalSheets;
    }

    /**
     * @context7 /codeigniter/entity/property
     * @description Physical abnormalities
     * @var string
     */
    public function getPhysicalAbnormalities()
    {
        return $this->physicalAbnormalities;
    }

    /**
     * @context7 /codeigniter/entity/property
     * @description Height
     * @var int
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * @context7 /codeigniter/entity/property
     * @description Weight
     * @var int
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * @context7 /codeigniter/entity/property
     * @description Living with
     * @var string
     */
    public function getStayWith()
    {
        return $this->stayWith;
    }

    /**
     * @context7 /codeigniter/entity/property
     * @description Hobbies
     * @var string
     */
    public function getHobbies()
    {
        return $this->hobbies;
    }

    /**
     * @context7 /codeigniter/entity/property
     * @description Achievements
     * @var string
     */
    public function getAchievements()
    {
        return $this->achievements;
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

    /**
     * @context7 /codeigniter/entity/method
     * @description Get hobbies as array
     * @return array
     */
    public function getHobbiesArray()
    {
        if (empty($this->hobbies)) {
            return [];
        }
        $hobbiesArr = explode(';', $this->hobbies);
        array_pop($hobbiesArr); // Remove last empty element
        return $hobbiesArr;
    }

    /**
     * @context7 /codeigniter/entity/method
     * @description Get achievements as array
     * @return array
     */
    public function getAchievementsArray()
    {
        if (empty($this->achievements)) {
            return [];
        }
        $acvArr = explode(';', $this->achievements);
        array_pop($acvArr); // Remove last empty element
        return $acvArr;
    }

    /**
     * @context7 /codeigniter/entity/method
     * @description Get hospital sheets as array
     * @return array
     */
    public function getHospitalSheetsArray()
    {
        if (empty($this->hospitalSheets)) {
            return [];
        }
        $hsArr = explode(';', $this->hospitalSheets);
        array_pop($hsArr); // Remove last empty element
        return $hsArr;
    }

    /**
     * @context7 /codeigniter/entity/method
     * @description Get physical abnormalities as array
     * @return array
     */
    public function getPhysicalAbnormalitiesArray()
    {
        if (empty($this->physicalAbnormalities)) {
            return [];
        }
        $paArr = explode(';', $this->physicalAbnormalities);
        array_pop($paArr); // Remove last empty element
        return $paArr;
    }

    // Setters
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function setRegistrantId($registrant_id)
    {
        $this->registrant_id = $registrant_id;
        return $this;
    }

    public function setNik($nik)
    {
        $this->nik = $nik;
        return $this;
    }

    public function setNkk($nkk)
    {
        $this->nkk = $nkk;
        return $this;
    }

    public function setNak($nak)
    {
        $this->nak = $nak;
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

    public function setBloodType($bloodType)
    {
        $this->bloodType = $bloodType;
        return $this;
    }

    public function setChildOrder($childOrder)
    {
        $this->childOrder = $childOrder;
        return $this;
    }

    public function setSiblingsCount($siblingsCount)
    {
        $this->siblingsCount = $siblingsCount;
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

    public function setFamilyCondition($familyCondition)
    {
        $this->familyCondition = $familyCondition;
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

    public function setHospitalSheets($hospitalSheets)
    {
        $this->hospitalSheets = $hospitalSheets;
        return $this;
    }

    public function setPhysicalAbnormalities($physicalAbnormalities)
    {
        $this->physicalAbnormalities = $physicalAbnormalities;
        return $this;
    }

    public function setHeight($height)
    {
        $this->height = $height;
        return $this;
    }

    public function setWeight($weight)
    {
        $this->weight = $weight;
        return $this;
    }

    public function setStayWith($stayWith)
    {
        $this->stayWith = $stayWith;
        return $this;
    }

    public function setHobbies($hobbies)
    {
        $this->hobbies = $hobbies;
        return $this;
    }

    public function setAchievements($achievements)
    {
        $this->achievements = $achievements;
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
     * @description Add hobby to hobbies list
     * @param string $hobby
     * @return void
     */
    public function addHobby($hobby)
    {
        if (empty($this->hobbies)) {
            $this->hobbies = $hobby . ';';
        } else {
            $this->hobbies .= $hobby . ';';
        }
    }

    /**
     * @context7 /codeigniter/entity/method
     * @description Add achievement to achievements list
     * @param string $achievement
     * @return void
     */
    public function addAchievement($achievement)
    {
        if (empty($this->achievements)) {
            $this->achievements = $achievement . ';';
        } else {
            $this->achievements .= $achievement . ';';
        }
    }

    /**
     * @context7 /codeigniter/entity/method
     * @description Add hospital sheet to hospital sheets list
     * @param string $hospitalSheet
     * @return void
     */
    public function addHospitalSheet($hospitalSheet)
    {
        if (empty($this->hospitalSheets)) {
            $this->hospitalSheets = $hospitalSheet . ';';
        } else {
            $this->hospitalSheets .= $hospitalSheet . ';';
        }
    }

    /**
     * @context7 /codeigniter/entity/method
     * @description Add physical abnormality to physical abnormalities list
     * @param string $physicalAbnormality
     * @return void
     */
    public function addPhysicalAbnormality($physicalAbnormality)
    {
        if (empty($this->physicalAbnormalities)) {
            $this->physicalAbnormalities = $physicalAbnormality . ';';
        } else {
            $this->physicalAbnormalities .= $physicalAbnormality . ';';
        }
    }

    /**
     * @context7 /codeigniter/entity/method
     * @description Clear all hobbies
     * @return void
     */
    public function clearHobbies()
    {
        $this->hobbies = null;
    }

    /**
     * @context7 /codeigniter/entity/method
     * @description Clear all achievements
     * @return void
     */
    public function clearAchievements()
    {
        $this->achievements = null;
    }

    /**
     * @context7 /codeigniter/entity/method
     * @description Clear all hospital sheets
     * @return void
     */
    public function clearHospitalSheets()
    {
        $this->hospitalSheets = null;
    }

    /**
     * @context7 /codeigniter/entity/method
     * @description Clear all physical abnormalities
     * @return void
     */
    public function clearPhysicalAbnormalities()
    {
        $this->physicalAbnormalities = null;
    }
}