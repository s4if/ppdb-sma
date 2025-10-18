<?php

namespace App\Entities;

/**
 * @context7 /codeigniter/entity
 * @description Represents payment data entity
 * @example 
 * $payment = new PaymentEntity();
 * $payment->amount = 500000;
 * $payment->paymentDate = '2024-01-01';
 */
class PaymentEntity
{
    protected $id;
    protected $registrant_id;
    protected $paymentDate;
    protected $amount;
    protected $verificationDate;
    protected $verified;
    protected $message;
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
     * @description Payment date
     * @var string
     */
    public function getPaymentDate()
    {
        return $this->paymentDate;
    }

    /**
     * @context7 /codeigniter/entity/property
     * @description Payment amount
     * @var int
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @context7 /codeigniter/entity/property
     * @description Verification date
     * @var string
     */
    public function getVerificationDate()
    {
        return $this->verificationDate;
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
     * @description Verification message
     * @var string
     */
    public function getMessage()
    {
        return $this->message;
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

    public function setPaymentDate($paymentDate)
    {
        $this->paymentDate = $paymentDate;
        return $this;
    }

    public function setAmount($amount)
    {
        $this->amount = $amount;
        return $this;
    }

    public function setVerificationDate($verificationDate)
    {
        $this->verificationDate = $verificationDate;
        return $this;
    }

    public function setVerified($verified)
    {
        $this->verified = $verified;
        return $this;
    }

    public function setMessage($message)
    {
        $this->message = $message;
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