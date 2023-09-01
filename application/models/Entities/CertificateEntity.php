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
     * @Column(type="string", nullable=FALSE)
     *
     * @var string
     */
    protected $fileName;//Nama File

    /**
     * @Column(type="string", nullable=FALSE)
     *
     * @var string
     */
    protected $documentType; // sertifikat lomba atau sertifikat hafalan! 

    /**
     * @Column(type="string", nullable=FALSE, length=115)
     *
     * @var string
     */
    protected $issuer;

    /**
     * @Column(type="string", nullable=FALSE, length=600)
     *
     * @var string
     */
    protected $note;

    /**
     * @Column(type="datetime", nullable=FALSE)
     *
     * @var DateTIme
     */
    protected $date;

    /**
     * @ManyToOne(targetEntity="RegistrantEntity", inversedBy="certificates")
     * @JoinColumn(name="registrant_id", referencedColumnName="id")
     */
    private $registrant;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     *
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getFileName()
    {
        return $this->fileName;
    }

    /**
     * @param string $fileName
     *
     * @return self
     */
    public function setFileName($fileName)
    {
        $this->fileName = $fileName;

        return $this;
    }

    /**
     * @return string
     */
    public function getDocumentType()
    {
        return $this->documentType;
    }

    /**
     * @param string $documentType
     *
     * @return self
     */
    public function setDocumentType($documentType)
    {
        $this->documentType = $documentType;

        return $this;
    }

    /**
     * @return string
     */
    public function getIssuer()
    {
        return $this->issuer;
    }

    /**
     * @param string $issuer
     *
     * @return self
     */
    public function setIssuer($issuer)
    {
        $this->issuer = $issuer;

        return $this;
    }

    /**
     * @return string
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * @param string $note
     *
     * @return self
     */
    public function setNote($note)
    {
        $this->note = $note;

        return $this;
    }

    /**
     * @return Date
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param Date $date
     *
     * @return self
     */
    public function setDate(\DateTime $date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getRegistrant()
    {
        return $this->registrant;
    }

    /**
     * @param mixed $registrant
     *
     * @return self
     */
    public function setRegistrant($registrant)
    {
        $this->registrant = $registrant;

        return $this;
    }
}
