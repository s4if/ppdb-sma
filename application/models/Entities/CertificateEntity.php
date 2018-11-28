<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CertificateEntity
 *
 * @author s4if
 */

/**
 * @Entity @Table(name="certificates")
*/
class CertificateEntity  {
    /**
     * @Id @GeneratedValue(strategy="NONE") @Column(type="bigint")
     */
    protected $id;
    
    /**
     * @Column(type="string", nullable=FALSE, length=115, unique=TRUE)
     *
     * @var string
     */
    protected $compName;//Nama Kejuaraan
    
    /**
     * @Column(type="string", nullable=FALSE, length=115, unique=TRUE)
     *
     * @var string
     */
    protected $organizerName;//Lembaga
    
    /**
     * @Column(type="datetime", nullable=FALSE)
     *
     * @var DateTime
     */
    protected $compDate;//Tanggal Kejuaraan
    
    /**
     * @Column(type="string", nullable=FALSE, length=115, unique=TRUE)
     *
     * @var string
     */
    protected $compLevel;//Tingkat Kejuaraan
    
    /**
     * @Column(type="string", nullable=FALSE, length=115, unique=TRUE)
     *
     * @var string
     */
    protected $fileName;//Nama Kejuaraan
    
    /**
     * @ManyToOne(targetEntity="RegistrantEntity", inversedBy="certificates")
     * @JoinColumn(name="registrant_id", referencedColumnName="id")
     */
    private $registrant;
    
    public function getId() {
        return $this->id;
    }

    public function getCompName() {
        return $this->compName;
    }

    public function getOrganizerName() {
        return $this->organizerName;
    }

    public function getCompDate(): DateTime {
        return $this->compDate;
    }

    public function getCompLevel() {
        return $this->compLevel;
    }

    public function getFileName() {
        return $this->fileName;
    }

    public function getRegistrant() {
        return $this->registrant;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function setCompName($compName) {
        $this->compName = $compName;
        return $this;
    }

    public function setOrganizerName($organizerName) {
        $this->organizerName = $organizerName;
        return $this;
    }

    public function setCompDate(DateTime $compDate) {
        $this->compDate = $compDate;
        return $this;
    }

    public function setCompLevel($compLevel) {
        $this->compLevel = $compLevel;
        return $this;
    }

    public function setFileName($fileName) {
        $this->fileName = $fileName;
        return $this;
    }

    public function setRegistrant($registrant) {
        $this->registrant = $registrant;
        return $this;
    }

}
