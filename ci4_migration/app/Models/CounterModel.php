<?php

namespace App\Models;

use App\Entities\CounterEntity;
use CodeIgniter\Model;

/**
 * @context7 /codeigniter/model
 * @description Model for handling counter data operations
 * @example 
 * $model = new CounterModel();
 * $counter = $model->find(1);
 * $model->addMaleCount();
 */
class CounterModel extends Model
{
    protected $table = 'counter';
    protected $primaryKey = 'id';
    protected $returnType = CounterEntity::class;
    protected $allowedFields = [
        'date', 'male_count', 'female_count'
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    /**
     * @context7 /codeigniter/model/method
     * @description Get counter by ID
     * @param int $id
     * @return object|null
     */
    public function getById($id)
    {
        return $this->find($id);
    }

    /**
     * @context7 /codeigniter/model/method
     * @description Get counter by date
     * @param string $date
     * @return object|null
     */
    public function getByDate($date)
    {
        return $this->where('date', $date)->first();
    }

    /**
     * @context7 /codeigniter/model/method
     * @description Increment male count
     * @return bool
     */
    public function addMaleCount()
    {
        $counter = $this->find(1);
        
        if (!$counter) {
            // Create counter if it doesn't exist
            $counter = new CounterEntity();
            $counter->setId(1);
            $counter->setDate(date('Y-m-d'));
            $counter->setMaleCount(1);
            $counter->setFemaleCount(0);
            return $this->insert($counter);
        } else {
            // Update existing counter
            $counter->addMaleCount();
            return $this->save($counter);
        }
    }

    /**
     * @context7 /codeigniter/model/method
     * @description Increment female count
     * @return bool
     */
    public function addFemaleCount()
    {
        $counter = $this->find(1);
        
        if (!$counter) {
            // Create counter if it doesn't exist
            $counter = new CounterEntity();
            $counter->setId(1);
            $counter->setDate(date('Y-m-d'));
            $counter->setMaleCount(0);
            $counter->setFemaleCount(1);
            return $this->insert($counter);
        } else {
            // Update existing counter
            $counter->addFemaleCount();
            return $this->save($counter);
        }
    }

    /**
     * @context7 /codeigniter/model/method
     * @description Get total count
     * @return int
     */
    public function getTotalCount()
    {
        $counter = $this->find(1);
        
        if (!$counter) {
            return 0;
        }
        
        return $counter->getTotalCount();
    }

    /**
     * @context7 /codeigniter/model/method
     * @description Get male count
     * @return int
     */
    public function getMaleCount()
    {
        $counter = $this->find(1);
        
        if (!$counter) {
            return 0;
        }
        
        return $counter->getMaleCount();
    }

    /**
     * @context7 /codeigniter/model/method
     * @description Get female count
     * @return int
     */
    public function getFemaleCount()
    {
        $counter = $this->find(1);
        
        if (!$counter) {
            return 0;
        }
        
        return $counter->getFemaleCount();
    }
}