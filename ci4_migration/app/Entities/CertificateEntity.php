<?php

namespace App\Entities;

/**
 * @context7 /codeigniter/entity
 * @description Represents a certificate entity
 * @example 
 * $certificate = new CertificateEntity();
 * $certificate->fileName = 'cert123.png';
 * $certificate->documentType = 'Competition';
 */
class CertificateEntity
{
    protected $id;
    protected $registrant_id;
    protected $fileName;
    protected $documentType;
    protected $issuer;
    protected $note;
    protected $date;
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
     * @description File name
     * @var string
     */
    public function getFileName()
    {
        return $this->fileName;
    }

    /**
     * @context7 /codeigniter/entity/property
     * @description Document type
     * @var string
     */
    public function getDocumentType()
    {
        return $this->documentType;
    }

    /**
     * @context7 /codeigniter/entity/property
     * @description Issuer
     * @var string
     */
    public function getIssuer()
    {
        return $this->issuer;
    }

    /**
     * @context7 /codeigniter/entity/property
     * @description Note
     * @var string
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * @context7 /codeigniter/entity/property
     * @description Certificate date
     * @var string
     */
    public function getDate()
    {
        return $this->date;
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

    public function setRegistrantId($registrant_id)
    {
        $this->registrant_id = $registrant_id;
        return $this;
    }

    public function setFileName($fileName)
    {
        $this->fileName = $fileName;
        return $this;
    }

    public function setDocumentType($documentType)
    {
        $this->documentType = $documentType;
        return $this;
    }

    public function setIssuer($issuer)
    {
        $this->issuer = $issuer;
        return $this;
    }

    public function setNote($note)
    {
        $this->note = $note;
        return $this;
    }

    public function setDate($date)
    {
        $this->date = $date;
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