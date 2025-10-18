<?php

namespace App\Models;

use App\Entities\CertificateEntity;
use CodeIgniter\Model;

/**
 * @context7 /codeigniter/model
 * @description Model for handling certificate data operations
 * @example 
 * $model = new CertificateModel();
 * $certificates = $model->getByRegistrantId(1);
 */
class CertificateModel extends Model
{
    protected $table = 'certificates';
    protected $primaryKey = 'id';
    protected $returnType = CertificateEntity::class;
    protected $allowedFields = [
        'registrant_id', 'file_name', 'document_type', 'issuer', 
        'note', 'date'
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    /**
     * @context7 /codeigniter/model/method
     * @description Get certificates by registrant ID
     * @param int $registrantId
     * @return array
     */
    public function getByRegistrantId($registrantId)
    {
        return $this->where('registrant_id', $registrantId)->findAll();
    }

    /**
     * @context7 /codeigniter/model/method
     * @description Get certificate by ID
     * @param int $id
     * @return object|null
     */
    public function getById($id)
    {
        return $this->find($id);
    }

    /**
     * @context7 /codeigniter/model/method
     * @description Get all certificates
     * @return array
     */
    public function getAll()
    {
        return $this->findAll();
    }

    /**
     * @context7 /codeigniter/model/method
     * @description Save certificate for a registrant
     * @param int $registrantId
     * @param array $data
     * @return bool
     */
    public function saveForRegistrant($registrantId, $data)
    {
        $data['registrant_id'] = $registrantId;
        return $this->insert($data);
    }

    /**
     * @context7 /codeigniter/model/method
     * @description Update certificate
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function updateCertificate($id, $data)
    {
        return $this->update($id, $data);
    }

    /**
     * @context7 /codeigniter/model/method
     * @description Delete certificate
     * @param int $id
     * @return bool
     */
    public function deleteCertificate($id)
    {
        return $this->delete($id);
    }

    /**
     * @context7 /codeigniter/model/method
     * @description Get certificates with special scheme
     * @return array
     */
    public function getSpecialCertificates()
    {
        // This would return certificates with special schemes or achievements
        return $this->findAll();
    }
}