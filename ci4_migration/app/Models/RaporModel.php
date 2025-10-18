<?php

namespace App\Models;

use App\Entities\RaporEntity;
use CodeIgniter\Model;

/**
 * @context7 /codeigniter/model
 * @description Model for handling rapor (report card) data operations
 * @example 
 * $model = new RaporModel();
 * $rapor = $model->getByRegistrantId(1);
 */
class RaporModel extends Model
{
    protected $table = 'rapor';
    protected $primaryKey = 'id';
    protected $returnType = RaporEntity::class;
    protected $allowedFields = [
        // No specific fields, all rapor fields are dynamic
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    /**
     * @context7 /codeigniter/model/method
     * @description Get rapor by registrant ID
     * @param int $registrantId
     * @return object|null
     */
    public function getByRegistrantId($registrantId)
    {
        $registrantModel = new RegistrantModel();
        $registrant = $registrantModel->find($registrantId);
        
        if (!$registrant || !$registrant->getRaporId()) {
            return null;
        }
        
        return $this->find($registrant->getRaporId());
    }

    /**
     * @context7 /codeigniter/model/method
     * @description Save or update rapor data for a registrant
     * @param int $registrantId
     * @param array $data
     * @return bool
     */
    public function saveForRegistrant($registrantId, $data)
    {
        $registrantModel = new RegistrantModel();
        $registrant = $registrantModel->find($registrantId);
        
        if (!$registrant) {
            return false;
        }
        
        // Check if rapor already exists
        $existingRapor = $this->getByRegistrantId($registrantId);
        
        if ($existingRapor) {
            // Update existing rapor
            foreach ($data as $subject => $semesters) {
                foreach ($semesters as $semester => $values) {
                    foreach ($values as $type => $value) {
                        $existingRapor->set($subject, $type, $semester, $value);
                    }
                }
            }
            $this->save($existingRapor);
            return true;
        } else {
            // Create new rapor
            $rapor = new RaporEntity();
            
            foreach ($data as $subject => $semesters) {
                foreach ($semesters as $semester => $values) {
                    foreach ($values as $type => $value) {
                        $rapor->set($subject, $type, $semester, $value);
                    }
                }
            }
            
            $raporId = $this->insert($rapor);
            
            if ($raporId) {
                // Update registrant with rapor ID
                $registrant->setRaporId($raporId);
                $registrantModel->save($registrant);
                return true;
            }
        }
        
        return false;
    }

    /**
     * @context7 /codeigniter/model/method
     * @description Delete rapor for a registrant
     * @param int $registrantId
     * @return bool
     */
    public function deleteForRegistrant($registrantId)
    {
        $registrantModel = new RegistrantModel();
        $registrant = $registrantModel->find($registrantId);
        
        if (!$registrant || !$registrant->getRaporId()) {
            return false;
        }
        
        $raporId = $registrant->getRaporId();
        
        // Remove rapor ID from registrant
        $registrant->setRaporId(null);
        $registrantModel->save($registrant);
        
        // Delete rapor
        return $this->delete($raporId);
    }
}