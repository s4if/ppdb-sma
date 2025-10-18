<?php

namespace App\Models;

use App\Entities\AdminEntity;
use CodeIgniter\Model;

/**
 * @context7 /codeigniter/model
 * @description Model for handling admin data operations
 * @example 
 * $model = new AdminModel();
 * $admin = $model->find('admin');
 */
class AdminModel extends Model
{
    protected $table = 'admins';
    protected $primaryKey = 'username';
    protected $returnType = AdminEntity::class;
    protected $allowedFields = [
        'username', 'password', 'root'
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    /**
     * @context7 /codeigniter/model/method
     * @description Get all admins
     * @return array
     */
    public function getAll()
    {
        return $this->findAll();
    }

    /**
     * @context7 /codeigniter/model/method
     * @description Check if admin exists
     * @param string $username
     * @return bool
     */
    public function adminExists($username)
    {
        return $this->where('username', $username)->countAllResults() > 0;
    }

    /**
     * @context7 /codeigniter/model/method
     * @description Verify admin credentials
     * @param string $username
     * @param string $password
     * @return object|null
     */
    public function verifyAdmin($username, $password)
    {
        $admin = $this->where('username', $username)->first();
        
        if ($admin && password_verify($password, $admin->getPassword())) {
            return $admin;
        }
        
        return null;
    }

    /**
     * @context7 /codeigniter/model/method
     * @description Create admin
     * @param array $data
     * @return bool
     */
    public function createAdmin($data)
    {
        if ($this->adminExists($data['username'])) {
            return false;
        }
        
        $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
        return $this->insert($data);
    }

    /**
     * @context7 /codeigniter/model/method
     * @description Update admin
     * @param string $username
     * @param array $data
     * @return bool
     */
    public function updateAdmin($username, $data)
    {
        if (!$this->adminExists($username)) {
            return false;
        }
        
        if (isset($data['password'])) {
            $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
        }
        
        return $this->update($username, $data);
    }

    /**
     * @context7 /codeigniter/model/method
     * @description Delete admin
     * @param string $username
     * @return bool
     */
    public function deleteAdmin($username)
    {
        if (!$this->adminExists($username)) {
            return false;
        }
        
        return $this->delete($username);
    }
}