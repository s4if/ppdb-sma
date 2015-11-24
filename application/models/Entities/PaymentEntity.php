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
 * @Entity @Table(name="payment_data")
*/
class PaymentEntity {
    
    /**
     * @Id @GeneratedValue(strategy="AUTO") @Column(type="integer")
     * @var int
     */
    protected $id;
    
    /**
     * @OneToOne(targetEntity="RegistrantEntity", inversedBy="paymentData", cascade={"persist"})
     **/
    protected $registrant;
    
    /**
     * @Column(type="date", nullable=FALSE)
     * @var DateTime
     */
    protected $paymentDate;
    
    /**
     * @Column(type="date", nullable=TRUE)
     * @var DateTime
     */
    protected $verificationDate;
    
    /**
     * @Column(type="string", nullable=true)
     */
    protected $verified;// null = belum, ok = ok, salah = salah
    
    /**
     * @Column(type="string", nullable=true)
     * @var string
     */
    protected $message;
    
    public function getId() {
        return $this->id;
    }

    public function getRegistrant() {
        return $this->registrant;
    }

    public function getPaymentDate() {
        return $this->paymentDate;
    }

    public function getVerificationDate() {
        return $this->verificationDate;
    }

    public function getVerified() {
        return $this->verified;
    }

    public function getMessage() {
        return $this->message;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function setRegistrant($registrant) {
        $this->registrant = $registrant;
        return $this;
    }

    public function setPaymentDate(DateTime $paymentDate) {
        $this->paymentDate = $paymentDate;
        return $this;
    }

    public function setVerificationDate(DateTime $verificationDate) {
        $this->verificationDate = $verificationDate;
        return $this;
    }

    public function setVerified($verified) {
        $this->verified = $verified;
        return $this;
    }

    public function setMessage($message) {
        $this->message = $message;
        return $this;
    }

}
