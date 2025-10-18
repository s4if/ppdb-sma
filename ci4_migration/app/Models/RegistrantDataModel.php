<?php

namespace App\Models;

use App\Entities\RegistrantDataEntity;
use CodeIgniter\Model;

/**
 * @context7 /codeigniter/model
 * @description Model for handling detailed registrant data operations
 * @example 
 * $model = new RegistrantDataModel();
 * $data = $model->getByRegistrantId(1);
 */
class RegistrantDataModel extends Model
{
    protected $table = 'registrant_data';
    protected $primaryKey = 'id';
    protected $returnType = RegistrantDataEntity::class;
    protected $allowedFields = [
        'registrant_id', 'nik', 'nkk', 'nak', 'birth_place', 'birth_date', 
        'blood_type', 'child_order', 'siblings_count', 'street', 'RT', 'RW', 
        'village', 'district', 'city', 'province', 'postal_code', 
        'family_condition', 'nationality', 'religion', 'hospital_sheets', 
        'physical_abnormalities', 'height', 'weight', 'stay_with', 
        'hobbies', 'achievements'
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    /**
     * @context7 /codeigniter/model/method
     * @description Get registrant data by registrant ID
     * @param int $registrantId
     * @return object|null
     */
    public function getByRegistrantId($registrantId)
    {
        return $this->where('registrant_id', $registrantId)->first();
    }

    /**
     * @context7 /codeigniter/model/method
     * @description Save or update registrant data
     * @param int $registrantId
     * @param array $data
     * @return bool
     */
    public function saveForRegistrant($registrantId, $data)
    {
        $existingData = $this->getByRegistrantId($registrantId);
        
        $data['registrant_id'] = $registrantId;
        
        if ($existingData) {
            return $this->update($existingData->getId(), $data);
        } else {
            return $this->insert($data);
        }
    }
}