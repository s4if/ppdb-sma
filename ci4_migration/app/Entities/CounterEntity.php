<?php

namespace App\Entities;

/**
 * @context7 /codeigniter/entity
 * @description Represents a counter entity for tracking registration numbers
 * @example 
 * $counter = new CounterEntity();
 * $counter->addMaleCount();
 * $counter->addFemaleCount();
 */
class CounterEntity
{
    protected $id;
    protected $date;
    protected $maleCount;
    protected $femaleCount;
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
     * @description Counter date
     * @var string
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @context7 /codeigniter/entity/property
     * @description Male count
     * @var int
     */
    public function getMaleCount()
    {
        return $this->maleCount ?? 0;
    }

    /**
     * @context7 /codeigniter/entity/property
     * @description Female count
     * @var int
     */
    public function getFemaleCount()
    {
        return $this->femaleCount ?? 0;
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

    public function setDate($date)
    {
        $this->date = $date;
        return $this;
    }

    public function setMaleCount($maleCount)
    {
        $this->maleCount = $maleCount;
        return $this;
    }

    public function setFemaleCount($femaleCount)
    {
        $this->femaleCount = $femaleCount;
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

    /**
     * @context7 /codeigniter/entity/method
     * @description Increment male count
     * @return self
     */
    public function addMaleCount()
    {
        if (is_null($this->maleCount)) {
            $this->maleCount = 1;
        } else {
            $this->maleCount = $this->maleCount + 1;
        }
        return $this;
    }

    /**
     * @context7 /codeigniter/entity/method
     * @description Increment female count
     * @return self
     */
    public function addFemaleCount()
    {
        if (is_null($this->femaleCount)) {
            $this->femaleCount = 1;
        } else {
            $this->femaleCount = $this->femaleCount + 1;
        }
        return $this;
    }

    /**
     * @context7 /codeigniter/entity/method
     * @description Get total count
     * @return int
     */
    public function getTotalCount()
    {
        return $this->getMaleCount() + $this->getFemaleCount();
    }
}