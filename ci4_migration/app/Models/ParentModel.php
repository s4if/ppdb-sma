<?php

namespace App\Models;

use App\Entities\ParentEntity;
use CodeIgniter\Model;

/**
 * @context7 /codeigniter/model
 * @description Model for handling parent/guardian data operations
 * @example 
 * $model = new ParentModel();
 * $parents = $model->findAll();
 * $parent = $model->find(1);
 */
class ParentModel extends Model
{
    protected $table = 'parents';
    protected $primaryKey = 'id';
    protected $returnType = ParentEntity::class;
    protected $allowedFields = [
        'type', 'name', 'status', 'birth_place', 'birth_date', 
        'street', 'RT', 'RW', 'village', 'district', 'city', 
        'province', 'postal_code', 'contact', 'relation', 
        'nationality', 'religion', 'education_level', 'job', 
        'position', 'company', 'income', 'burden_count'
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    /**
     * @context7 /codeigniter/model/method
     * @description Get parents by type
     * @param string $type
     * @return array
     */
    public function getByType($type = null)
    {
        if ($type) {
            return $this->where('type', $type)->findAll();
        }
        return $this->findAll();
    }

    /**
     * @context7 /codeigniter/model/method
     * @description Get parents by registrant ID
     * @param int $registrantId
     * @param array $positions
     * @return array
     */
    public function getByRegistrantId($registrantId, $positions = ['father', 'mother', 'guardian'])
    {
        $registrantModel = new RegistrantModel();
        $registrant = $registrantModel->find($registrantId);
        
        if (!$registrant) {
            return [];
        }
        
        $result = [];
        foreach ($positions as $position) {
            $getter = 'get' . ucfirst($position) . 'Id';
            $parentId = $registrant->$getter();
            
            if ($parentId) {
                $parent = $this->find($parentId);
                if ($parent) {
                    $result[$position] = $parent;
                }
            }
        }
        
        return $result;
    }

    /**
     * @context7 /codeigniter/model/method
     * @description Create or update parent data for a registrant
     * @param int $registrantId
     * @param array $data
     * @param string $position
     * @return bool
     */
    public function saveForRegistrant($registrantId, $data, $position)
    {
        $registrantModel = new RegistrantModel();
        $registrant = $registrantModel->find($registrantId);
        
        if (!$registrant) {
            return false;
        }
        
        // Set the type
        $data['type'] = $position;
        
        // Check if parent already exists
        $getter = 'get' . ucfirst($position) . 'Id';
        $parentId = $registrant->$getter();
        
        if ($parentId) {
            // Update existing parent
            $this->update($parentId, $data);
            return true;
        } else {
            // Create new parent
            $parentId = $this->insert($data);
            
            if ($parentId) {
                // Update registrant with parent ID
                $setter = 'set' . ucfirst($position) . 'Id';
                $registrant->$setter($parentId);
                $registrantModel->save($registrant);
                return true;
            }
        }
        
        return false;
    }

    /**
     * @context7 /codeigniter/model/method
     * @description Get main parent for a registrant
     * @param int $registrantId
     * @return object|null
     */
    public function getMainParent($registrantId)
    {
        $registrantModel = new RegistrantModel();
        $registrant = $registrantModel->find($registrantId);
        
        if (!$registrant || !$registrant->getMainParent()) {
            return null;
        }
        
        $mainParentType = $registrant->getMainParent();
        $getter = 'get' . ucfirst($mainParentType) . 'Id';
        $parentId = $registrant->$getter();
        
        if ($parentId) {
            return $this->find($parentId);
        }
        
        return null;
    }
}