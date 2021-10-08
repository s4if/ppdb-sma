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
     * @Id @GeneratedValue(strategy="AUTO") @Column(type="bigint")
     */
    protected $id;
    
    /**
     * @Column(type="string", nullable=FALSE, length=115, unique=FALSE)
     *
     * @var string
     */
    protected $scheme;//Program Beasiswa atau Program Prestasi
    
    /**
     * @Column(type="string", nullable=FALSE, length=115, unique=FALSE)
     *
     * @var string
     */
    protected $subject;//Nama Mata Pelajaran
    
    /**
     * @Column(type="integer", nullable=TRUE, unique=FALSE, name="ranking")
     *
     * @var integer
     */
    protected $rank;//peringkat
    
    /**
     * @Column(type="string", nullable=FALSE, length=115, unique=FALSE)
     *
     * @var string
     */
    protected $organizer;//Lembaga
    
    /**
     * @Column(type="datetime", nullable=FALSE)
     *
     * @var DateTime
     */
    protected $startDate;//Tanggal awal OSN
    
    /**
     * @Column(type="datetime", nullable=FALSE)
     *
     * @var DateTime
     */
    protected $endDate;//Tanggal awal OSN
    
    /**
     * @Column(type="string", nullable=FALSE, length=200, unique=FALSE)
     *
     * @var string
     */
    protected $place;//Tempat Pelaksanaan
    
    /**
     * @Column(type="string", nullable=FALSE, length=115, unique=FALSE)
     *
     * @var string
     */
    protected $level;//Tingkat Kejuaraan
    
    /**
     * @Column(type="string", nullable=FALSE, length=115, unique=FALSE)
     *
     * @var string
     */
    protected $fileType;//Tipe  File
    
    /**
     * @Column(type="string", nullable=FALSE, length=115, unique=FALSE)
     *
     * @var string
     */
    protected $fileName;//Nama File
    
    /**
     * @ManyToOne(targetEntity="RegistrantEntity", inversedBy="certificates")
     * @JoinColumn(name="registrant_id", referencedColumnName="id")
     */
    private $registrant;
    public function getId() {
        return $this->id;
    }

    public function getSubject() {
        return $this->subject;
    }

    public function getOrganizer() {
        return $this->organizer;
    }

    public function getStartDate(): DateTime {
        return $this->startDate;
    }

    public function getEndDate(): DateTime {
        return $this->endDate;
    }

    public function getPlace() {
        return $this->place;
    }

    public function getLevel() {
        return $this->level;
    }

    public function getFileName() {
        return $this->fileName;
    }

    public function getRegistrant() {
        return $this->registrant;
    }
    
    public function getFileType() {
        return $this->fileType;
    }

    public function getScheme() {
        return $this->scheme;
    }

    public function getRank() {
        return $this->rank;
    }

    public function setScheme($scheme) {
        $this->scheme = $scheme;
        return $this;
    }

    public function setRank($rank) {
        $this->rank = $rank;
        return $this;
    }
 
    public function setFileType($fileType) {
        $this->fileType = $fileType;
        return $this;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function setSubject($subject) {
        $this->subject = $subject;
        return $this;
    }

    public function setOrganizer($organizer) {
        $this->organizer = $organizer;
        return $this;
    }

    public function setStartDate(DateTime $startDate) {
        $this->startDate = $startDate;
        return $this;
    }

    public function setEndDate(DateTime $endDate) {
        $this->endDate = $endDate;
        return $this;
    }

    public function setPlace($place) {
        $this->place = $place;
        return $this;
    }

    public function setLevel($level) {
        $this->level = $level;
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
