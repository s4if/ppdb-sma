<?php

namespace App\Entities;

/**
 * @context7 /codeigniter/entity
 * @description Represents an admin entity
 * @example 
 * $admin = new AdminEntity();
 * $admin->username = 'admin';
 * $admin->password = password_hash('password', PASSWORD_BCRYPT);
 */
class AdminEntity
{
    protected $username;
    protected $password;
    protected $root;
    protected $createdAt;
    protected $updatedAt;

    /**
     * @context7 /codeigniter/entity/property
     * @description Username
     * @var string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @context7 /codeigniter/entity/property
     * @description Hashed password
     * @var string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @context7 /codeigniter/entity/property
     * @description Root admin status
     * @var bool
     */
    public function getRoot()
    {
        return $this->root;
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
    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }

    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }

    public function setRoot($root)
    {
        $this->root = $root;
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
}