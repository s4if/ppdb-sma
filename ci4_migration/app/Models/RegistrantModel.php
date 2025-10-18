<?php

namespace App\Models;

use App\Entities\RegistrantEntity;
use CodeIgniter\Model;

/**
 * @context7 /codeigniter/model
 * @description Model for handling registrant data operations
 * @example 
 * $model = new RegistrantModel();
 * $registrants = $model->findAll();
 * $registrant = $model->find(1);
 */
class RegistrantModel extends Model
{
    protected $table = 'registrants';
    protected $primaryKey = 'id';
    protected $returnType = RegistrantEntity::class;
    protected $useSoftDeletes = true;
    protected $allowedFields = [
        'username', 'reg_id', 'kode', 'password', 'name', 'gender', 
        'previous_school', 'nisn', 'cp', 'program', 'selection_path', 
        'rel_to_regular', 'rel_to_regular_path', 'registration_time', 
        'father_id', 'mother_id', 'guardian_id', 'rapor_id', 
        'initial_cost', 'subscription_cost', 'land_donation', 'qurban', 
        'main_parent', 'verified', 'finalized', 'deleted', 
        'gelombang', 'entry_year'
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted';

    /**
     * @context7 /codeigniter/model/method
     * @description Get registrants by gender
     * @param string $gender
     * @return array
     */
    public function getByGender($gender = null)
    {
        if ($gender) {
            return $this->where('gender', $gender)->findAll();
        }
        return $this->findAll();
    }

    /**
     * @context7 /codeigniter/model/method
     * @description Get registrants by program
     * @param string $program
     * @return array
     */
    public function getByProgram($program = null)
    {
        if ($program) {
            return $this->where('program', $program)->findAll();
        }
        return $this->findAll();
    }

    /**
     * @context7 /codeigniter/model/method
     * @description Get registrants by program and gender
     * @param string $program
     * @param string $gender
     * @return array
     */
    public function getByProgramAndGender($program = null, $gender = null)
    {
        if ($program) {
            $this->where('program', $program);
        }
        if ($gender) {
            $this->where('gender', $gender);
        }
        return $this->findAll();
    }

    /**
     * @context7 /codeigniter/model/method
     * @description Get registrants by selection path
     * @param string $selectionPath
     * @return array
     */
    public function getBySelectionPath($selectionPath = null)
    {
        if ($selectionPath) {
            return $this->where('selection_path', $selectionPath)->findAll();
        }
        return $this->findAll();
    }

    /**
     * @context7 /codeigniter/model/method
     * @description Get registrants by wave (gelombang)
     * @param int $gelombang
     * @return array
     */
    public function getByGelombang($gelombang = null)
    {
        if ($gelombang) {
            return $this->where('gelombang', $gelombang)->findAll();
        }
        return $this->findAll();
    }

    /**
     * @context7 /codeigniter/model/method
     * @description Get registrants by entry year
     * @param int $entryYear
     * @return array
     */
    public function getByEntryYear($entryYear = null)
    {
        if ($entryYear) {
            return $this->where('entry_year', $entryYear)->findAll();
        }
        return $this->findAll();
    }

    /**
     * @context7 /codeigniter/model/method
     * @description Get registrants by username
     * @param string $username
     * @return object|null
     */
    public function getByUsername($username)
    {
        return $this->where('username', $username)->first();
    }

    /**
     * @context7 /codeigniter/model/method
     * @description Get registrants by registration ID
     * @param string $regId
     * @return object|null
     */
    public function getByRegId($regId)
    {
        return $this->where('reg_id', $regId)->first();
    }

    /**
     * @context7 /codeigniter/model/method
     * @description Get registrants by payment code
     * @param string $kode
     * @return object|null
     */
    public function getByKode($kode)
    {
        return $this->where('kode', $kode)->first();
    }

    /**
     * @context7 /codeigniter/model/method
     * @description Get unpaid registrants
     * @return array
     */
    public function getUnpaid()
    {
        return $this->where('verified IS NULL', null, false)
                    ->where('deleted', 0)
                    ->findAll();
    }

    /**
     * @context7 /codeigniter/model/method
     * @description Get incomplete registrants
     * @return array
     */
    public function getIncomplete()
    {
        return $this->where('(father_id IS NULL OR mother_id IS NULL OR main_parent IS NULL)', null, false)
                    ->where('deleted', 0)
                    ->findAll();
    }

    /**
     * @context7 /codeigniter/model/method
     * @description Get completed registrants
     * @return array
     */
    public function getCompleted()
    {
        return $this->where('finalized', 1)
                    ->where('deleted', 0)
                    ->findAll();
    }

    /**
     * @context7 /codeigniter/model/method
     * @description Get count of registrants
     * @param array $filters
     * @return int
     */
    public function getCount($filters = [])
    {
        foreach ($filters as $field => $value) {
            $this->where($field, $value);
        }
        return $this->where('deleted', 0)->countAllResults();
    }

    /**
     * @context7 /codeigniter/model/method
     * @description Generate payment code based on gender
     * @param int $id
     * @param string $gender
     * @return array
     */
    public function generateKode($id, $gender)
    {
        $registrant = $this->find($id);
        if (empty($registrant->getKode())) {
            // Load counter model
            $counterModel = new CounterModel();
            $counter = $counterModel->find(1);
            
            if ($gender == 'P') {
                $counterModel->addFemaleCount();
                $kode = sprintf("%03d", 500 + $counter->getFemaleCount());
            } else {
                $counterModel->addMaleCount();
                $kode = sprintf("%03d", $counter->getMaleCount());
            }
            
            $registrant->setKode($kode);
            $registrant->generateRegId();
            
            $this->save($registrant);
            return ['status' => true, 'kode' => $kode];
        } else {
            return ['status' => true, 'kode' => $registrant->getKode()];
        }
    }

    /**
     * @context7 /codeigniter/model/method
     * @description Get registrant status information
     * @param int $id
     * @return array
     */
    public function getRegistrantStatus($id)
    {
        $registrant = $this->find($id);
        if (!$registrant) {
            return ['status' => 'Not found', 'completed' => false];
        }

        $status = [];
        $allStats = 0;

        // Check registrant data
        $registrantDataModel = new RegistrantDataModel();
        $registrantData = $registrantDataModel->getByRegistrantId($id);
        $status['data'] = $registrantData ? 1 : 0;
        if ($status['data']) $allStats++;

        // Check parent data
        $parentModel = new ParentModel();
        $father = $parentModel->find($registrant->getFatherId());
        $mother = $parentModel->find($registrant->getMotherId());
        $guardian = $parentModel->find($registrant->getGuardianId());
        
        $status['father'] = $father ? 1 : 0;
        if ($status['father']) $allStats++;
        
        $status['mother'] = $mother ? 1 : 0;
        if ($status['mother']) $allStats++;
        
        $status['guardian'] = $guardian ? 1 : 0;

        // Check finalized
        $status['finalized'] = $registrant->getFinalized() ? 1 : 0;
        if ($status['finalized']) $allStats++;

        // Check main parent
        $status['letter'] = $registrant->getMainParent() ? 1 : 0;
        if ($status['letter']) $allStats++;

        // Check payment
        $paymentModel = new PaymentModel();
        $payment = $paymentModel->getByRegistrantId($id);
        $status['payment'] = $payment ? ($payment->getVerified() == 'valid' ? 2 : 1) : 0;

        $status['completed'] = ($allStats >= 5) ? true : false;

        // Generate status string
        if ($status['completed']) {
            if (!$registrant->getFinalized()) {
                $str = 'Data telah lengkap, kurang finalisasi';
            } elseif (is_null($registrant->getVerified())) {
                $str = 'Pendaftaran selesai, menunggu verifikasi pembayaran';
            } elseif ($registrant->getVerified() == 'tidak valid') {
                $str = 'Bukti Pendaftaran Tidak Valid';
            } elseif ($registrant->getFinalized() && ($registrant->getVerified() == 'valid')) {
                $str = 'Pendaftaran telah selesai';
            }
            return ['status' => $str, 'completed' => $status['completed']];
        } elseif ($status['payment'] == 0) {
            $str = "Belum Membayar Biaya Pendaftaran";
            return ['status' => $str, 'completed' => $status['completed']];
        } else {
            $str = 'Data yang kurang : ';
            if ($status['data'] < 1) $str = $str . 'data diri, ';
            if ($status['father'] < 1) $str = $str . 'data ayah, ';
            if ($status['mother'] < 1) $str = $str . 'data ibu, ';
            if ($status['letter'] < 1) $str = $str . 'surat pernyataan, ';
            if ($status['finalized'] < 1) $str = $str . 'Finalisasi, ';
            return ['status' => $str, 'completed' => $status['completed']];
        }
    }
}