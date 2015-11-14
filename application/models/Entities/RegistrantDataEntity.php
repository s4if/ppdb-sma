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

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;

/**
 * @Entity @Table(name="registrant_data")
*/
class RegistrantDataEntity {
    
    /**
     * @Id @GeneratedValue(strategy="AUTO") @Column(type="integer")
     * @var int
     */
    protected $id;
    
    /**
     * @OneToOne(targetEntity="RegistrantEntity", inversedBy="registrantData", cascade={"persist"})
     **/
    protected $registrant;
    
    /**
     * @Column(type="string", nullable=FALSE)
     * @var string
     */
    protected $birthPlace;
    
    /**
     * @Column(type="date", nullable=FALSE)
     * @var DateTime
     */
    protected $birthDate;
    
    /**
     * @Column(type="string", nullable=FALSE)
     * @var string
     */
    protected $address;
    
    /**
     * @Column(type="string", nullable=FALSE)
     * @var string
     */
    protected $familyCondition; //NOTE : Ini isinya ortu lengkap, yatim, piatu, yatim piatu
    
    /**
     * @Column(type="string", length=4, nullable=FALSE)
     * @var string
     */
    protected $nationality;
    
    /**
     * @Column(type="string", length=10, nullable=FALSE)
     * @var string
     */
    protected $religion;
    
    //TODO: Penyakit Here
    //TODO: saat add data, data siswa juga di-addkan di sini $this->[var]->addRegistrant($this)
    /**
     * @OneToMany(targetEntity="HospitalSheetEntity", mappedBy="registrant", orphanRemoval=true)
     * @JoinColumn(onDelete="CASCADE")
     **/
    protected $hospitalSheets;
    
    //TODO: Kelainan Jasmani Here
    //TODO: saat add data, data siswa juga di-addkan di sini $this->[var]->addRegistrant($this)
    /**
     * @OneToMany(targetEntity="PhysicalAbnormalityEntity", mappedBy="registrant", orphanRemoval=true)
     * @JoinColumn(onDelete="CASCADE")
     **/
    protected $physicalAbnormalities;
    
    /**
     * @Column(type="integer", nullable=FALSE)
     * @var int
     */
    protected $height;
    
    /**
     * @Column(type="integer", nullable=FALSE)
     * @var int
     */
    protected $weight;
    
    /**
     * @Column(type="string", nullable=FALSE)
     * @var string
     */
    protected $stayWith; // NOTE: Tinggal dengan siapa
    
    // TODO: Hobi
    //TODO: saat add data, data siswa juga di-addkan di sini $this->[var]->addRegistrant($this)
    /**
     * @OneToMany(targetEntity="HobbyEntity", mappedBy="registrant", orphanRemoval=true)
     * @JoinColumn(onDelete="CASCADE")
     **/
    protected $hobbies;
    
    // TODO: Prestasi
    //TODO: saat add data, data siswa juga di-addkan di sini $this->[var]->addRegistrant($this)
    /**
     * @OneToMany(targetEntity="AchievementEntity", mappedBy="registrant", orphanRemoval=true)
     * @JoinColumn(onDelete="CASCADE")
     **/
    protected $achievements;
    
    public function __construct() {
        $this->hospitalSheets = new ArrayCollection();
        $this->physicalAbnormalities = new ArrayCollection();
        $this->hobbies = new ArrayCollection();
        $this->achievements = new ArrayCollection();
    }
    
    public function getId() {
        return $this->id;
    }

    public function getRegistrant() {
        return $this->registrant;
    }

    public function getBirthPlace() {
        return $this->birthPlace;
    }

    public function getBirthDate() {
        return $this->birthDate;
    }

    public function getAddress() {
        return $this->address;
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
    
    // Experimental
    // aturan $varVal = ['attr' => 'attributeName', 'val' => 'expectedValue' ]
    public function exist($varName, $varVal = []){
        try{
            if($varVal == []){
                return !$this->$varName->isEmpty();
            } else {
                $criteria = Criteria::create()
                    ->where(Criteria::expr()->eq( $varVal['attr'], $varVal['val']));
                return !$this->$varName->matching($criteria)->isEmpty();
            }
        } catch (Exception $ex) {
            return false;
        }
    }

    public function getHospitalSheets($hs = null) {
        if(is_null($hs)){
            return $this->hospitalSheets;
        } else {
            $criteria = Criteria::create()
                    ->where(Criteria::expr()->eq('hospitalSheet', $hs));
            return $this->hospitalSheets->matching($criteria);
        }
    }

    public function getPhysicalAbnormalities($pa = null) {
        if(is_null($pa)){
            return $this->physicalAbnormalities;
        } else {
            $criteria = Criteria::create()
                    ->where(Criteria::expr()->eq('physicalAbnormalities', $pa));
            return $this->physicalAbnormalities->matching($criteria);
        }
    }
    
    public function getHobbies($hobby = null) {
        if($hobby == null){
            return $this->hobbies;
        } else {
            $criteria = Criteria::create()
                    ->where(Criteria::expr()->eq('hobby', $hobby));
            return $this->hobbies->matching($criteria);
        }
    }

    public function getAchievements($achievement = null) {
        if(is_null($achievement)){
            return $this->achievements;
        } else {
            $criteria = Criteria::create()
                    ->where(Criteria::expr()->eq('achievement', $achievement));
            return $this->achievements->matching($criteria);
        }
    }
    
    public function setId($id) {
        $this->id = $id;
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

    public function setAddress($address) {
        $this->address = $address;
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
    
    public function addHobby(HobbyEntity $hobby){
        $hobby->setRegistrant($this);
        $this->hobbies[] = $hobby;
    }
    
    public function addAchievement(AchievementEntity $achievement){
        $achievement->setRegistrant($this);
        $this->achievements[] = $achievement;
    }
    
    public function addHospitalSheet(HospitalSheetEntity $hospitalSheet){
        $hospitalSheet->setRegistrant($this);
        $this->hospitalSheets[] = $hospitalSheet;
    }
    
    public function addPhysicalAbnormality(PhysicalAbnormalityEntity $physicalAbnormalities){
        $physicalAbnormalities->setRegistrant($this);
        $this->physicalAbnormalities[] = $physicalAbnormalities;
    }
    
    // TODO: Cari Cara untuk Remove
    public function removeHobby(HobbyEntity $hobby){
        $this->hobbies->removeElement($hobby);
        $hobby->setRegistrant(null);
        return $this;
    }
    
    public function removeAchievement(AchievementEntity $achievement){
        $this->achievements->removeElement($achievement);
        $achievement->setRegistrant(null);
        return $this;
    }
    
    public function removeHospitalSheet(HospitalSheetEntity $hospitalSheet){
        $this->hospitalSheet->removeElement($hospitalSheet);
        $hospitalSheet->setRegistrant(null);
        return $this;
    }
    
    public function removePhysicalAbnormality(PhysicalAbnormalityEntity $physicalAbnormalities){
        $this->physicalAbnormalities->removeElement($physicalAbnormalities);
        $physicalAbnormalities->setRegistrant(null);
        return $this;
    }
    
}
