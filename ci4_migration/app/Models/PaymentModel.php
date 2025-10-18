<?php

namespace App\Models;

use App\Entities\PaymentEntity;
use CodeIgniter\Model;

/**
 * @context7 /codeigniter/model
 * @description Model for handling payment data operations
 * @example 
 * $model = new PaymentModel();
 * $payment = $model->getByRegistrantId(1);
 */
class PaymentModel extends Model
{
    protected $table = 'payment_data';
    protected $primaryKey = 'id';
    protected $returnType = PaymentEntity::class;
    protected $allowedFields = [
        'registrant_id', 'payment_date', 'amount', 'verification_date', 
        'verified', 'message'
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    /**
     * @context7 /codeigniter/model/method
     * @description Get payment data by registrant ID
     * @param int $registrantId
     * @return object|null
     */
    public function getByRegistrantId($registrantId)
    {
        return $this->where('registrant_id', $registrantId)->first();
    }

    /**
     * @context7 /codeigniter/model/method
     * @description Get all payment data
     * @return array
     */
    public function getAll()
    {
        return $this->findAll();
    }

    /**
     * @context7 /codeigniter/model/method
     * @description Save or update payment data
     * @param int $registrantId
     * @param array $data
     * @return bool
     */
    public function saveForRegistrant($registrantId, $data)
    {
        $existingPayment = $this->getByRegistrantId($registrantId);
        
        $data['registrant_id'] = $registrantId;
        
        if ($existingPayment) {
            return $this->update($existingPayment->getId(), $data);
        } else {
            return $this->insert($data);
        }
    }

    /**
     * @context7 /codeigniter/model/method
     * @description Verify payment
     * @param int $id
     * @param string $status
     * @param string $message
     * @return bool
     */
    public function verifyPayment($id, $status, $message = '')
    {
        $payment = $this->find($id);
        if (!$payment) {
            return false;
        }
        
        $payment->setVerified($status);
        $payment->setVerificationDate(date('Y-m-d'));
        if (!empty($message)) {
            $payment->setMessage($message);
        }
        
        return $this->save($payment);
    }
}