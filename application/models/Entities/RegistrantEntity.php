<?php
/**
 * @Entity(repositoryClass="RegistrantRepo") @Table(name="registrants")
*/
class RegistrantEntity
{
    /**
     * @Id @GeneratedValue(strategy="AUTO") @Column(type="integer")
     */
    protected $id;

    /**
     * @Column(type="string", nullable=FALSE, length=15, unique=TRUE)
     *
     * @var string
     */
    protected $username;

    /**
     * @Column(type="string", nullable=TRUE, length=15, unique=TRUE)
     *
     * @var string
     */
    protected $regId; // Nomor pendaftaran

    /**
     * @Column(type="string", length=4, nullable=TRUE, unique=TRUE)
     *
     * @var string
     */
    protected $kode; // Nomor Unik

    /**
     * @Column(type="string", nullable=FALSE)
     *
     * @var string
     */
    protected $password;

    /**
     * @Column(type="string", nullable=FALSE)
     *
     * @var string
     */
    protected $name;

    /**
     * @Column(type="string", length=10, nullable=FALSE)
     *
     * @var string
     */
    protected $gender;

    /**
     * @Column(type="string", nullable=FALSE)
     *
     * @var string
     */
    protected $previousSchool;

    /**
     * @Column(type="string", nullable=TRUE)
     *
     * @var string
     */
    protected $nisn;

    /**
     * @Column(type="string", nullable=TRUE)
     *
     * @var string
     */
    protected $cp; // (8/12/2015 : Diganti No. HP)

    /**
     * @Column(type="string", length=15, nullable=FALSE)
     *
     * @var string
     */
    protected $program; // NOTE: IPA Reguler, IPS Reguler, IPA Tahfidz, IPS Tahfidz
    
    /**
     * @Column(type="string", length=6, nullable=TRUE)
     *
     * @var string
     */
    protected $relToRegular; // semi boolean
    
    /**
     * @Column(type="string", length=6, nullable=TRUE)
     *
     * @var string
     */
    protected $relToIPS; // semi boolean (true/false)

    /**
     * @Column(type="datetime", nullable=FALSE)
     *
     * @var DateTime
     */
    protected $registrationTime;

    /**
     * @OneToOne(targetEntity="RegistrantDataEntity", mappedBy="registrant", orphanRemoval=true, cascade={"persist"})
     *
     * @var RegistrantDataEntity
     **/
    protected $registrantData;

    /**
     * @OneToOne(targetEntity="ParentEntity")
     * @JoinColumn(name="father_id", referencedColumnName="id", nullable=TRUE, onDelete="CASCADE")
     *
     * @var ParentEntity
     **/
    protected $father;

    /**
     * @OneToOne(targetEntity="ParentEntity")
     * @JoinColumn(name="mother_id", referencedColumnName="id", nullable=TRUE, onDelete="CASCADE")
     *
     * @var ParentEntity
     **/
    protected $mother;

    /**
     * @OneToOne(targetEntity="ParentEntity")
     * @JoinColumn(name="guardian_id", referencedColumnName="id", nullable=TRUE, onDelete="CASCADE")
     *
     * @var ParentEntity
     **/
    protected $guardian;

    /**
     * @OneToOne(targetEntity="PaymentEntity", mappedBy="registrant", orphanRemoval=true, cascade={"persist"})
     *
     * @var PaymentEntity
     **/
    protected $paymentData;
    
    /**
     * @OneToOne(targetEntity="RaporEntity", inversedBy="registrant")
     * @JoinColumn(name="rapor_id", referencedColumnName="id")
     */
    private $rapor;

    /**
     * @Column(type="bigint", nullable=TRUE)
     *
     * @var string
     */
    protected $initialCost; // Uang Pangkal

    /**
     * @Column(type="bigint", nullable=TRUE)
     *
     * @var string
     */
    protected $subscriptionCost; // Uang Bulanan
    
    /**
     * @Column(type="bigint", nullable=TRUE)
     *
     * @var string
     */
    protected $landDonation; // Uang Bulanan

    /**
     * @Column(type="boolean", nullable=TRUE)
     *
     * @var string
     */
    protected $boardingKit; // Uang Bulanan

    /**
     * @Column(type="string", nullable=TRUE)
     *
     * @var string
     */
    protected $mainParent;

    /**
     * @Column(type="string", nullable=TRUE)
     *
     * @var bool
     */
    protected $verified; //null = belum, valid  = sudah, tidak valid = salah

    /**
     * @Column(type="boolean", nullable=TRUE)
     *
     * @var bool
     */
    protected $finalized;

    /**
     * @Column(type="boolean", nullable=TRUE)
     *
     * @var bool
     */
    protected $deleted;

    public function getArray($vars = ['id', 'regId', 'name', 'gender', 'previousSchool', 'nisn', 'program', 'deleted', 'registrationTime', 'registrantData',
                'father', 'mother', 'guardian', 'paymentData', 'initialCost', 'subscriptionCost', 'boardingKit', 'landDonation', ])
    {
        $arrData = [];
        foreach ($vars as $var) {
            $strFunct = 'get'.ucfirst($var);
            $arrData [$var] = $this->$strFunct();
        }

        return $arrData;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getRegId()
    {
        return $this->regId;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getGender()
    {
        return $this->gender;
    }

    public function getPreviousSchool()
    {
        return $this->previousSchool;
    }

    public function getNisn()
    {
        return $this->nisn;
    }

    public function getCp()
    {
        return $this->cp;
    }

    public function getProgram()
    {
        return $this->program;
    }

    public function getRegistrationTime()
    {
        return $this->registrationTime;
    }

    public function getRegistrantData()
    {
        return $this->registrantData;
    }

    public function getFather()
    {
        return $this->father;
    }

    public function getMother()
    {
        return $this->mother;
    }

    public function getGuardian()
    {
        return $this->guardian;
    }

    public function getPaymentData()
    {
        return $this->paymentData;
    }

    public function getInitialCost()
    {
        return $this->initialCost;
    }

    public function getSubscriptionCost()
    {
        return $this->subscriptionCost;
    }

    public function getMainParent()
    {
        return $this->mainParent;
    }

    public function getMainParentObj()
    {
        $var = strtolower($this->mainParent);
        $main_parent = null;
        if(is_null($this->$var)){
            $main_parent = $this->father;
        } else {
            $main_parent = $this->$var;
        }
        return $main_parent;
    }

    public function getCompleted()
    {
        $res = (!(empty($this->getFather()) || empty($this->getFather()) ||
                empty($this->getMother()) || empty($this->getSubscriptionCost()) ||
                empty($this->getInitialCost()) || empty($this->getMainParent()) || 
                empty($this->getRegistrantData())));
        return $res;
    }

    public function getDeleted()
    {
        return $this->deleted;
    }

    public function getFinalized()
    {
        return is_null($this->finalized) ? false : $this->finalized;
    }

    public function getKode()
    {
        return $this->kode;
    }
    public function getVerified()
    {
        return $this->verified;
    }
    public function getBoardingKit()
    {
        return (is_null($this->boardingKit)) ? false : $this->boardingKit;
    }
    public function getLandDonation() {
        return $this->landDonation;
    }

    public function getRelToRegular() {
        return $this->relToRegular;
    }

    public function getRelToIPS() {
        return $this->relToIPS;
    }
    
    public function getRapor() {
        return $this->rapor;
    }
    
    public function deleteRapor(){
        $this->rapor = null;
        return $this;
    }

    public function setRapor(RaporEntity $rapor) {
        $this->rapor = $rapor;
        return $this;
    }

    public function setRelToRegular($relToRegular) {
        $this->relToRegular = $relToRegular;
        return $this;
    }

    public function setRelToIPS($relToIPS) {
        $this->relToIPS = $relToIPS;
        return $this;
    }
    
    public function setLandDonation($landDonation) {
        $this->landDonation = $landDonation;
        return $this;
    }

    public function setBoardingKit($boardingKit)
    {
        $this->boardingKit = $boardingKit;

        return $this;
    }

    public function setVerified($verified)
    {
        $this->verified = $verified;

        return $this;
    }

    public function setKode($kode)
    {
        $this->kode = $kode;

        return $this;
    }

    public function setFinalized($finalized)
    {
        if ($finalized) {
            if ($this->getCompleted()) {
                $this->finalized = $finalized;
                $this->setRegId();

                return 1;
            } else {
                return -1;
            }
        } else {
            $this->finalized = false;

            return 0;
        }
    }

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    private function setRegId()
    {
        $prefix = ($this->gender == 'L') ? 'I' : 'A';
        $prefix2 = ($this->program == 'tahfidz') ? 'T' : 'R';
        $this->regId = $prefix.$prefix2.$this->kode;
    }

    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    public function setGender($gender)
    {
        $this->gender = $gender;

        return $this;
    }

    public function setPreviousSchool($previousSchool)
    {
        $this->previousSchool = $previousSchool;

        return $this;
    }

    public function setNisn($nisn)
    {
        $this->nisn = $nisn;

        return $this;
    }

    public function setCp($cp)
    {
        $this->cp = $cp;

        return $this;
    }

    public function setProgram($program)
    {
        $this->program = $program;

        return $this;
    }

    public function setRegistrationTime(DateTime $registrationTime)
    {
        $this->registrationTime = $registrationTime;

        return $this;
    }

    public function setRegistrantData(RegistrantDataEntity $registrantData)
    {
        $this->registrantData = $registrantData;

        return $this;
    }

    public function setFather(ParentEntity $father)
    {
        $this->father = $father;

        return $this;
    }

    public function setMother(ParentEntity $mother)
    {
        $this->mother = $mother;

        return $this;
    }

    public function setGuardian(ParentEntity $guardian)
    {
        $this->guardian = $guardian;

        return $this;
    }

    public function setPaymentData(PaymentEntity $paymentData)
    {
        $this->paymentData = $paymentData;

        return $this;
    }

    public function setInitialCost($initialCost)
    {
        $this->initialCost = $initialCost;

        return $this;
    }

    public function setSubscriptionCost($subscriptionCost)
    {
        $this->subscriptionCost = $subscriptionCost;

        return $this;
    }

    public function setMainParent($mainParent)
    {
        $this->mainParent = $mainParent;

        return $this;
    }

    public function setDeleted($deleted)
    {
        $this->deleted = $deleted;

        return $this;
    }
}
