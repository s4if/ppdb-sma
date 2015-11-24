<?php
/**
 * @Entity(repositoryClass="RegistrantRepo") @Table(name="registrants")
*/
class RegistrantEntity
{
    /**
     * @Id @GeneratedValue(strategy="NONE") @Column(type="bigint")
     */
    protected $id; //TODO : Make ID Custom like 121220151 [tgl+pendaftar ke berapa]
    /**
     * @Column(type="string", nullable=FALSE)
     * @var string
     */
    protected $password;
    /**
     * @Column(type="string", nullable=FALSE)
     * @var string
     */
    protected $name;
    /**
     * @Column(type="string", length=10, nullable=FALSE)
     * @var string
     */
    protected $sex;
    /**
     * @Column(type="string", nullable=FALSE)
     * @var string
     */
    protected $previousSchool;
    /**
     * @Column(type="string", nullable=TRUE)
     * @var string
     */
    protected $nisn;
    
    /**
     * @Column(type="string", length=8, nullable=FALSE)
     * @var string
     */
    protected $program;// NOTE: Program tahta/reguler, string sj biar enak
    
    /**
     * @Column(type="datetime", nullable=FALSE)
     * @var DateTime
     */
    protected $registrationTime;
    
    /**
     * @OneToOne(targetEntity="RegistrantDataEntity", mappedBy="registrant", orphanRemoval=true, cascade={"persist"})
     * @var RegistrantDataEntity
     **/
    protected $registrantData;
    
    /**
     * @OneToOne(targetEntity="ParentEntity")
     * @JoinColumn(name="father_id", referencedColumnName="id", nullable=TRUE, onDelete="CASCADE")
     * @var ParentEntity
     **/
    protected $father;
    
    /**
     * @OneToOne(targetEntity="ParentEntity")
     * @JoinColumn(name="mother_id", referencedColumnName="id", nullable=TRUE, onDelete="CASCADE")
     * @var ParentEntity
     **/
    protected $mother;
    
    /**
     * @OneToOne(targetEntity="ParentEntity")
     * @JoinColumn(name="guardian_id", referencedColumnName="id", nullable=TRUE, onDelete="CASCADE")
     * @var ParentEntity
     **/
    protected $guardian;
    
    /**
     * @OneToOne(targetEntity="PaymentEntity", mappedBy="registrant", orphanRemoval=true, cascade={"persist"})
     * @var PaymentEntity
     **/
    protected $paymentData;
    
    /**
     * @Column(type="boolean", length=8, nullable=TRUE)
     * @var bool
     */
    protected $finalized;

    public function getId() {
        return $this->id;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getName() {
        return $this->name;
    }

    public function getSex() {
        return $this->sex;
    }

    public function getPreviousSchool() {
        return $this->previousSchool;
    }

    public function getNisn() {
        return $this->nisn;
    }

    public function getProgram() {
        return $this->program;
    }

    public function getRegistrationTime() {
        return $this->registrationTime;
    }

    public function getRegistrantData() {
        return $this->registrantData;
    }

    public function getFather() {
        return $this->father;
    }

    public function getMother() {
        return $this->mother;
    }

    public function getGuardian() {
        return $this->guardian;
    }
    
    public function getPaymentData() {
        return $this->paymentData;
    }

    public function getFinalized() {
        return $this->finalized;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function setPassword($password) {
        $this->password = $password;
        return $this;
    }

    public function setName($name) {
        $this->name = $name;
        return $this;
    }

    public function setSex($sex) {
        $this->sex = $sex;
        return $this;
    }

    public function setPreviousSchool($previousSchool) {
        $this->previousSchool = $previousSchool;
        return $this;
    }

    public function setNisn($nisn) {
        $this->nisn = $nisn;
        return $this;
    }

    public function setProgram($program) {
        $this->program = $program;
        return $this;
    }

    public function setRegistrationTime(DateTime $registrationTime) {
        $this->registrationTime = $registrationTime;
        return $this;
    }
    
    public function setRegistrantData(RegistrantDataEntity $registrantData) {
        $this->registrantData = $registrantData;
        return $this;
    }

    public function setFather(ParentEntity $father) {
        $this->father = $father;
        return $this;
    }

    public function setMother(ParentEntity $mother) {
        $this->mother = $mother;
        return $this;
    }

    public function setGuardian(ParentEntity $guardian) {
        $this->guardian = $guardian;
        return $this;
    }
    
    public function setPaymentData(PaymentEntity $paymentData) {
        $this->paymentData = $paymentData;
        return $this;
    }
    
    public function setFinalized($finalized) {
        $this->finalized = $finalized;
        return $this;
    }

}