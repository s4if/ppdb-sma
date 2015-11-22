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
 * @Entity @Table(name="parents")
*/
class ParentEntity {
    
    /**
     * @Id @GeneratedValue(strategy="AUTO") @Column(type="integer")
     * @var int
     */
    protected $id;
    
    /**
     * @Column(type="string", nullable=FALSE)
     * @var string
     */
    protected $type;
    
    /**
     * @Column(type="string", nullable=FALSE)
     * @var string
     */
    protected $name;
    
    /**
     * @Column(type="string", nullable=FALSE)
     * @var string
     */
    protected $status; //Hidup, Cerai, Almarhum
    
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
     * @Column(type="string", nullable=TRUE)
     * @var string
     */
    protected $address;
    
    /**
     * @Column(type="string", nullable=TRUE)
     * @var string
     */
    protected $contact; // Nomor Telepon
    
    /**
     * @Column(type="string", nullable=FALSE)
     * @var string
     */
    protected $relation; // //Kandung, Tiri, Angkat (ayah & ibu pake radio, tapi wali pake input teks)
    
    /**
     * @Column(type="string", length=4, nullable=FALSE)
     * @var string
     */
    protected $nationality;
    
    /**
     * @Column(type="string", length=10, nullable=FALSE)
     * @var string
     */
    protected $religion; // pake radio
    
    /**
     * @Column(type="string", length=10, nullable=FALSE)
     * @var string
     */
    protected $educationLevel; // tingkat pendidikan, sd, smp .. s3
    
    /**
     * @Column(type="string", nullable=TRUE)
     * @var string
     */
    protected $job;
    
    /**
     * @Column(type="string", nullable=TRUE)
     * @var string
     */
    protected $position;
    
    /**
     * @Column(type="string", nullable=TRUE)
     * @var string
     */
    protected $company;
    
    /**
     * @Column(type="bigint", nullable=TRUE)
     * @var string
     */
    protected $income;
    
    /**
     * @Column(type="integer", nullable=FALSE)
     * @var string
     */
    protected $burdenCount;
    
    public function __construct() {
        // Do something here
    }
    
    public function getName() {
        return $this->name;
    }

    public function getStatus() {
        return $this->status;
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

    public function getContact() {
        return $this->contact;
    }

    public function getRelation() {
        return $this->relation;
    }

    public function getNationality() {
        return $this->nationality;
    }

    public function getReligion() {
        return $this->religion;
    }

    public function getEducationLevel() {
        return $this->educationLevel;
    }

    public function getJob() {
        return $this->job;
    }

    public function getPosition() {
        return $this->position;
    }

    public function getCompany() {
        return $this->company;
    }
    
    public function getIncome() {
        return $this->income;
    }

    public function getBurdenCount() {
        return $this->burdenCount;
    }
    
    public function setType($type) {
        $this->type = $type;
        return $this;
    }

    public function setName($name) {
        $this->name = $name;
        return $this;
    }

    public function setStatus($status) {
        $this->status = $status;
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

    public function setContact($contact) {
        $this->contact = $contact;
        return $this;
    }

    public function setRelation($relation) {
        $this->relation = $relation;
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

    public function setEducationLevel($educationLevel) {
        $this->educationLevel = $educationLevel;
        return $this;
    }

    public function setJob($job) {
        $this->job = $job;
        return $this;
    }

    public function setPosition($position) {
        $this->position = $position;
        return $this;
    }

    public function setCompany($company) {
        $this->company = $company;
        return $this;
    }

    public function setIncome($income) {
        $this->income = $income;
        return $this;
    }

    public function setBurdenCount($burdenCount) {
        $this->burdenCount = $burdenCount;
        return $this;
    }

}
