<?php

/*
 * The MIT License
 *
 * Copyright 2015 s4if.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

/**
 * @Entity @Table(name="registrant_data")
 */
class RegistrantDataEntity {
	/**
	 * @Id @GeneratedValue(strategy="AUTO") @Column(type="integer")
	 *
	 * @var int
	 */
	protected $id;

	/**
	 * @OneToOne(targetEntity="RegistrantEntity", inversedBy="registrantData", cascade={"persist"})
	 **/
	protected $registrant;

	/**
	 * @Column(type="string", nullable=FALSE)
	 *
	 * @var string
	 */
	protected $birthPlace;

	/**
	 * @Column(type="date", nullable=FALSE)
	 *
	 * @var DateTime
	 */
	protected $birthDate;

	/**
	 * @Column(type="string", nullable=TRUE)
	 *
	 * @var string
	 */
	protected $childOrder; // Anak Ke...

	/**
	 * @Column(type="string", nullable=TRUE)
	 *
	 * @var string
	 */
	protected $siblingsCount; // jumlah seaudara kandung

	/**
	 * @Column(type="string", nullable=TRUE)
	 *
	 * @var string
	 */
	protected $street; // Dusun

	/**
	 * @Column(type="integer", nullable=TRUE)
	 *
	 * @var int
	 */
	protected $RT; // RT

	/**
	 * @Column(type="integer", nullable=TRUE)
	 *
	 * @var int
	 */
	protected $RW; // RW

	/**
	 * @Column(type="string", nullable=FALSE)
	 *
	 * @var string
	 */
	protected $village; // Desa

	/**
	 * @Column(type="string", nullable=FALSE)
	 *
	 * @var string
	 */
	protected $district; // Kecamatan

	/**
	 * @Column(type="string", nullable=FALSE)
	 *
	 * @var string
	 */
	protected $city; // Kota

	/**
	 * @Column(type="string", nullable=FALSE)
	 *
	 * @var string
	 */
	protected $province;

	/**
	 * @Column(type="string", nullable=FALSE)
	 *
	 * @var string
	 */
	protected $postalCode;

	/**
	 * @Column(type="string", nullable=FALSE)
	 *
	 * @var string
	 */
	protected $familyCondition; //NOTE : Ini isinya ortu lengkap, yatim, piatu, yatim piatu

	/**
	 * @Column(type="string", length=4, nullable=FALSE)
	 *
	 * @var string
	 */
	protected $nationality;

	/**
	 * @Column(type="string", length=10, nullable=FALSE)
	 *
	 * @var string
	 */
	protected $religion;

	/**
	 * @Column(type="string", length=1024, nullable=true)
	 *
	 * @var string
	 */
	protected $hospitalSheets;

	/**
	 * @Column(type="string", length=1024, nullable=true)
	 *
	 * @var string
	 */
	protected $physicalAbnormalities;

	/**
	 * @Column(type="integer", nullable=FALSE)
	 *
	 * @var int
	 */
	protected $height;

	/**
	 * @Column(type="integer", nullable=FALSE)
	 *
	 * @var int
	 */
	protected $weight;

	/**
	 * @Column(type="string", nullable=FALSE)
	 *
	 * @var string
	 */
	protected $stayWith; // NOTE: Tinggal dengan siapa

	/**
	 * @Column(type="string", length=1024, nullable=true)
	 *
	 * @var string
	 */
	protected $hobbies;

	/**
	 * @Column(type="string", length=1024, nullable=true)
	 *
	 * @var string
	 */
	protected $achievements;

	public function __construct() {
	}

	public function getBirthPlace() {
		return $this->birthPlace;
	}

	public function getBirthDate() {
		return $this->birthDate;
	}

	public function getAddress() {
		$str_RT = (is_null($this->RT)) ? '' : $this->RT;
		$str_RW = (is_null($this->RW)) ? '' : $this->RW;
		$str_address = $this->street . ' RT ' . $str_RT . ' RW ' . $str_RW . ' '
		. $this->village . ', ' . $this->district . ' ' . $this->city . ' ' . $this->province;
		return $str_address;
	}

	public function getStreet() {
		return $this->street;
	}

	public function getRT() {
		return $this->RT;
	}

	public function getRW() {
		return $this->RW;
	}

	public function getVillage() {
		return $this->village;
	}

	public function getDistrict() {
		return $this->district;
	}

	public function getCity() {
		return $this->city;
	}

	public function getProvince() {
		return $this->province;
	}

	public function getPostalCode() {
		return $this->postalCode;
	}

	public function getFamilyCondition() {
		return $this->familyCondition;
	}

	public function getNationality() {
		return $this->nationality;
	}

	public function getReligion() {
		return $this->religion;
	}

	public function getHeight() {
		return $this->height;
	}

	public function getWeight() {
		return $this->weight;
	}
        
	public function getStayWith() {
		return $this->stayWith;
	}

	public function getAchievements($array = true) {
		//ini
		if ($array) {
			$acvArr = explode(';', $this->achievements);
			array_pop($acvArr);

			return $acvArr;
		} else {
			return $this->achievements;
		}
	}

	public function getHospitalSheets($array = true) {
		// ini
		if ($array) {
			$hsArr = explode(';', $this->hospitalSheets);
			array_pop($hsArr);

			return $hsArr;
		} else {
			return $this->hospitalSheets;
		}
	}

	public function getPhysicalAbnormalities($array = true) {
		// ini
		if ($array) {
			$paArr = explode(';', $this->physicalAbnormalities);
			array_pop($paArr);

			return $paArr;
		} else {
			return $this->physicalAbnormalities;
		}
	}

	public function getHobbies($array = true) {
		//ini
		if ($array) {
			$hbArr = explode(';', $this->hobbies);
			array_pop($hbArr);

			return $hbArr;
		} else {
			return $this->hobbies;
		}
	}

	public function getAchievementsCount() {
		$achievementArr = explode(';', $this->achievements);

		return count($achievementArr) - 1;
	}

	public function getHospitalSheetsCount() {
		$hsArr = explode(';', $this->hospitalSheets);

		return count($hsArr) - 1;
	}

	public function getPhysicalAbnormalitiesCount() {
		$pabArr = explode(';', $this->physicalAbnormalities);

		return count($pabArr) - 1;
	}

	public function getHobbiesCount() {
		$hobbiesArr = explode(';', $this->hobbies);

		return count($hobbiesArr) - 1;
	}

        public function getChildOrder() {
            return $this->childOrder;
        }

        public function getSiblingsCount() {
            return $this->siblingsCount;
        }

        public function setChildOrder($childOrder) {
            $this->childOrder = $childOrder;
            return $this;
        }

        public function setSiblingsCount($siblingsCount) {
            $this->siblingsCount = $siblingsCount;
            return $this;
        }
        
	public function setBirthPlace($birthPlace) {
		$this->birthPlace = $birthPlace;

		return $this;
	}

	public function setBirthDate(DateTime $birthDate) {
		$this->birthDate = $birthDate;

		return $this;
	}

	public function setStreet($street) {
		$this->street = $street;

		return $this;
	}

	public function setRT($RT) {
		$this->RT = $RT;

		return $this;
	}

	public function setRW($RW) {
		$this->RW = $RW;

		return $this;
	}

	public function setVillage($village) {
		$this->village = $village;

		return $this;
	}

	public function setDistrict($district) {
		$this->district = $district;

		return $this;
	}

	public function setCity($city) {
		$this->city = $city;

		return $this;
	}

	public function setProvince($province) {
		$this->province = $province;

		return $this;
	}

	public function setPostalCode($postalCode) {
		$this->postalCode = $postalCode;

		return $this;
	}

	public function setFamilyCondition($familyCondition) {
		$this->familyCondition = $familyCondition;

		return $this;
	}

	public function setNationality($nationality) {
		$this->nationality = $nationality;

		return $this;
	}

	public function setReligion($religion) {
		$this->religion = $religion;

		return $this;
	}

	public function setHeight($height) {
		$this->height = $height;

		return $this;
	}

	public function setWeight($weight) {
		$this->weight = $weight;

		return $this;
	}

	public function setRegistrant(RegistrantEntity $registrant) {
		$this->registrant = $registrant;

		return $this;
	}

	public function setStayWith($stayWith) {
		$this->stayWith = $stayWith;

		return $this;
	}

	public function addHobby($hobby) {
		$this->hobbies = $this->hobbies . $hobby . ';';
	}

	public function addAchievement($achievement) {
		$this->achievements = $this->achievements . $achievement . ';';
	}

	public function addHospitalSheet($hospitalSheet) {
		$this->hospitalSheets = $this->hospitalSheets . $hospitalSheet . ';';
	}

	public function addPhysicalAbnormality($physicalAbnormalities) {
		$this->physicalAbnormalities = $this->physicalAbnormalities . $physicalAbnormalities . ';';
	}

	// TODO: Cari Cara untuk Remove
	public function removeHobby() {
		// all
		$this->hobbies = null;

		return $this;
	}

	public function removeAchievement() {
		// all
		$this->achievements = null;

		return $this;
	}

	public function removeHospitalSheet() {
		//  all
		$this->hospitalSheets = null;

		return $this;
	}

	public function removePhysicalAbnormality() {
		// all
		$this->physicalAbnormalities = null;

		return $this;
	}
}
