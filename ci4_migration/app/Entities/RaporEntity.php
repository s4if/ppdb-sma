<?php

namespace App\Entities;

/**
 * @context7 /codeigniter/entity
 * @description Represents a rapor (report card) entity
 * @example 
 * $rapor = new RaporEntity();
 * $rapor->set('mtk', 'nilai', 1, 85);
 * $rapor->set('mtk', 'kkm', 1, 75);
 */
class RaporEntity
{
    protected $id;
    protected $createdAt;
    protected $updatedAt;

    // Dynamic properties for all subjects and semesters
    // Will be accessed through magic methods

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
     * @description Magic getter for dynamic properties
     * @param string $key
     * @return mixed
     */
    public function __get($key)
    {
        if (property_exists($this, $key)) {
            return $this->$key;
        }
        return null;
    }

    /**
     * @context7 /codeigniter/entity/method
     * @description Magic setter for dynamic properties
     * @param string $key
     * @param mixed $value
     * @return void
     */
    public function __set($key, $value)
    {
        $this->$key = $value;
    }

    /**
     * @context7 /codeigniter/entity/method
     * @description Get value for specific subject, type, and semester
     * @param string $subject
     * @param string $type
     * @param int $semester
     * @return mixed
     */
    public function get($subject, $type, $semester)
    {
        $property = $type . '_' . $subject . '_' . $semester;
        return $this->$property ?? null;
    }

    /**
     * @context7 /codeigniter/entity/method
     * @description Set value for specific subject, type, and semester
     * @param string $subject
     * @param string $type
     * @param int $semester
     * @param mixed $value
     * @return self
     */
    public function set($subject, $type, $semester, $value)
    {
        $property = $type . '_' . $subject . '_' . $semester;
        $this->$property = $value;
        return $this;
    }

    /**
     * @context7 /codeigniter/entity/method
     * @description Get all rapor data as array
     * @return array
     */
    public function getAll()
    {
        $subjects = ['mtk', 'ipa', 'ips', 'ind', 'ing'];
        $types = ['nilai', 'kkm'];
        $data = [];

        foreach ($subjects as $subject) {
            for ($semester = 1; $semester <= 6; $semester++) {
                foreach ($types as $type) {
                    $data[$semester][$subject][$type] = $this->get($subject, $type, $semester);
                }
            }
        }

        return $data;
    }
}