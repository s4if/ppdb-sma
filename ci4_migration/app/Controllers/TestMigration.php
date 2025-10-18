<?php

namespace App\Controllers;

use App\Models\RegistrantModel;
use App\Models\ParentModel;
use App\Models\RegistrantDataModel;
use App\Models\PaymentModel;
use App\Models\AdminModel;
use App\Models\CounterModel;
use App\Models\RaporModel;
use App\Models\CertificateModel;
use CodeIgniter\Controller;

/**
 * @context7 /codeigniter/controller
 * @description Controller for testing migration and data operations
 * @example 
 * // Run tests at http://localhost:8080/testmigration
 */
class TestMigration extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Migration Test Results',
            'results' => $this->runTests()
        ];

        return view('test_migration', $data);
    }

    /**
     * @context7 /codeigniter/controller/method
     * @description Run all tests
     * @return array
     */
    private function runTests()
    {
        $results = [];

        // Test 1: Create admin
        $results['create_admin'] = $this->testCreateAdmin();
        
        // Test 2: Create registrant
        $results['create_registrant'] = $this->testCreateRegistrant();
        
        // Test 3: Create parent data
        $results['create_parent'] = $this->testCreateParent();
        
        // Test 4: Create registrant detailed data
        $results['create_registrant_data'] = $this->testCreateRegistrantData();
        
        // Test 5: Create payment data
        $results['create_payment'] = $this->testCreatePayment();
        
        // Test 6: Create rapor data
        $results['create_rapor'] = $this->testCreateRapor();
        
        // Test 7: Create certificate
        $results['create_certificate'] = $this->testCreateCertificate();
        
        // Test 8: Test counter operations
        $results['counter_operations'] = $this->testCounterOperations();
        
        // Test 9: Test data retrieval
        $results['data_retrieval'] = $this->testDataRetrieval();
        
        // Test 10: Test data updates
        $results['data_updates'] = $this->testDataUpdates();

        return $results;
    }

    /**
     * @context7 /codeigniter/controller/method
     * @description Test creating an admin
     * @return array
     */
    private function testCreateAdmin()
    {
        try {
            $adminModel = new AdminModel();
            
            // Create admin
            $data = [
                'username' => 'test_admin',
                'password' => 'password123',
                'root' => 1
            ];
            
            $result = $adminModel->createAdmin($data);
            
            // Verify admin was created
            $admin = $adminModel->find('test_admin');
            
            return [
                'status' => $result && $admin ? 'success' : 'failed',
                'message' => $result && $admin ? 'Admin created successfully' : 'Failed to create admin',
                'data' => $admin ? $admin->getUsername() : null
            ];
        } catch (\Exception $e) {
            return [
                'status' => 'error',
                'message' => $e->getMessage(),
                'data' => null
            ];
        }
    }

    /**
     * @context7 /codeigniter/controller/method
     * @description Test creating a registrant
     * @return array
     */
    private function testCreateRegistrant()
    {
        try {
            $registrantModel = new RegistrantModel();
            
            // Create registrant
            $data = [
                'username' => 'test_registrant',
                'password' => password_hash('password123', PASSWORD_BCRYPT),
                'name' => 'Test Registrant',
                'gender' => 'L',
                'previous_school' => 'Test School',
                'nisn' => '1234567890',
                'cp' => '08123456789',
                'program' => 'IPA Reguler',
                'selection_path' => 'Jalur Reguler',
                'registration_time' => date('Y-m-d H:i:s'),
                'gelombang' => 1,
                'entry_year' => 2024,
                'deleted' => 0
            ];
            
            $registrantId = $registrantModel->insert($data);
            
            // Generate kode
            $registrantModel->generateKode($registrantId, 'L');
            
            // Verify registrant was created
            $registrant = $registrantModel->find($registrantId);
            
            return [
                'status' => $registrant ? 'success' : 'failed',
                'message' => $registrant ? 'Registrant created successfully' : 'Failed to create registrant',
                'data' => $registrant ? [
                    'id' => $registrant->getId(),
                    'username' => $registrant->getUsername(),
                    'reg_id' => $registrant->getRegId(),
                    'kode' => $registrant->getKode()
                ] : null
            ];
        } catch (\Exception $e) {
            return [
                'status' => 'error',
                'message' => $e->getMessage(),
                'data' => null
            ];
        }
    }

    /**
     * @context7 /codeigniter/controller/method
     * @description Test creating parent data
     * @return array
     */
    private function testCreateParent()
    {
        try {
            $registrantModel = new RegistrantModel();
            $parentModel = new ParentModel();
            
            // Get the test registrant
            $registrant = $registrantModel->where('username', 'test_registrant')->first();
            
            if (!$registrant) {
                return [
                    'status' => 'failed',
                    'message' => 'Test registrant not found',
                    'data' => null
                ];
            }
            
            // Create father data
            $fatherData = [
                'name' => 'Test Father',
                'status' => 'Hidup',
                'birth_place' => 'Jakarta',
                'birth_date' => '1980-01-01',
                'street' => 'Test Street',
                'village' => 'Test Village',
                'district' => 'Test District',
                'city' => 'Test City',
                'province' => 'Test Province',
                'postal_code' => '12345',
                'contact' => '08123456789',
                'relation' => 'Kandung',
                'nationality' => 'WNI',
                'religion' => 'Islam',
                'education_level' => 'S1',
                'job' => 'Test Job',
                'income' => '10000000'
            ];
            
            $result = $parentModel->saveForRegistrant($registrant->getId(), $fatherData, 'father');
            
            // Verify parent was created
            $parents = $parentModel->getByRegistrantId($registrant->getId(), ['father']);
            
            return [
                'status' => $result && !empty($parents) ? 'success' : 'failed',
                'message' => $result && !empty($parents) ? 'Parent created successfully' : 'Failed to create parent',
                'data' => !empty($parents) ? $parents['father']->getName() : null
            ];
        } catch (\Exception $e) {
            return [
                'status' => 'error',
                'message' => $e->getMessage(),
                'data' => null
            ];
        }
    }

    /**
     * @context7 /codeigniter/controller/method
     * @description Test creating registrant detailed data
     * @return array
     */
    private function testCreateRegistrantData()
    {
        try {
            $registrantModel = new RegistrantModel();
            $registrantDataModel = new RegistrantDataModel();
            
            // Get the test registrant
            $registrant = $registrantModel->where('username', 'test_registrant')->first();
            
            if (!$registrant) {
                return [
                    'status' => 'failed',
                    'message' => 'Test registrant not found',
                    'data' => null
                ];
            }
            
            // Create registrant detailed data
            $data = [
                'nik' => '1234567890123456',
                'nkk' => '1234567890123456',
                'nak' => '1234567890123456',
                'birth_place' => 'Jakarta',
                'birth_date' => '2005-01-01',
                'blood_type' => 'A',
                'child_order' => '1',
                'siblings_count' => '2',
                'street' => 'Test Street',
                'village' => 'Test Village',
                'district' => 'Test District',
                'city' => 'Test City',
                'province' => 'Test Province',
                'postal_code' => '12345',
                'family_condition' => 'Orang tua lengkap',
                'nationality' => 'WNI',
                'religion' => 'Islam',
                'height' => '170',
                'weight' => '60',
                'stay_with' => 'Orang tua'
            ];
            
            $result = $registrantDataModel->saveForRegistrant($registrant->getId(), $data);
            
            // Verify data was created
            $registrantData = $registrantDataModel->getByRegistrantId($registrant->getId());
            
            return [
                'status' => $result && $registrantData ? 'success' : 'failed',
                'message' => $result && $registrantData ? 'Registrant data created successfully' : 'Failed to create registrant data',
                'data' => $registrantData ? $registrantData->getNik() : null
            ];
        } catch (\Exception $e) {
            return [
                'status' => 'error',
                'message' => $e->getMessage(),
                'data' => null
            ];
        }
    }

    /**
     * @context7 /codeigniter/controller/method
     * @description Test creating payment data
     * @return array
     */
    private function testCreatePayment()
    {
        try {
            $registrantModel = new RegistrantModel();
            $paymentModel = new PaymentModel();
            
            // Get the test registrant
            $registrant = $registrantModel->where('username', 'test_registrant')->first();
            
            if (!$registrant) {
                return [
                    'status' => 'failed',
                    'message' => 'Test registrant not found',
                    'data' => null
                ];
            }
            
            // Create payment data
            $data = [
                'payment_date' => date('Y-m-d'),
                'amount' => 500000,
                'verified' => null
            ];
            
            $result = $paymentModel->saveForRegistrant($registrant->getId(), $data);
            
            // Verify payment was created
            $payment = $paymentModel->getByRegistrantId($registrant->getId());
            
            return [
                'status' => $result && $payment ? 'success' : 'failed',
                'message' => $result && $payment ? 'Payment created successfully' : 'Failed to create payment',
                'data' => $payment ? $payment->getAmount() : null
            ];
        } catch (\Exception $e) {
            return [
                'status' => 'error',
                'message' => $e->getMessage(),
                'data' => null
            ];
        }
    }

    /**
     * @context7 /codeigniter/controller/method
     * @description Test creating rapor data
     * @return array
     */
    private function testCreateRapor()
    {
        try {
            $registrantModel = new RegistrantModel();
            $raporModel = new RaporModel();
            
            // Get the test registrant
            $registrant = $registrantModel->where('username', 'test_registrant')->first();
            
            if (!$registrant) {
                return [
                    'status' => 'failed',
                    'message' => 'Test registrant not found',
                    'data' => null
                ];
            }
            
            // Create rapor data
            $data = [
                'mtk' => [
                    1 => [
                        'nilai' => 85,
                        'kkm' => 75
                    ],
                    2 => [
                        'nilai' => 80,
                        'kkm' => 75
                    ]
                ],
                'ipa' => [
                    1 => [
                        'nilai' => 90,
                        'kkm' => 75
                    ],
                    2 => [
                        'nilai' => 85,
                        'kkm' => 75
                    ]
                ]
            ];
            
            $result = $raporModel->saveForRegistrant($registrant->getId(), $data);
            
            // Verify rapor was created
            $rapor = $raporModel->getByRegistrantId($registrant->getId());
            
            return [
                'status' => $result && $rapor ? 'success' : 'failed',
                'message' => $result && $rapor ? 'Rapor created successfully' : 'Failed to create rapor',
                'data' => $rapor ? $rapor->getAll() : null
            ];
        } catch (\Exception $e) {
            return [
                'status' => 'error',
                'message' => $e->getMessage(),
                'data' => null
            ];
        }
    }

    /**
     * @context7 /codeigniter/controller/method
     * @description Test creating a certificate
     * @return array
     */
    private function testCreateCertificate()
    {
        try {
            $registrantModel = new RegistrantModel();
            $certificateModel = new CertificateModel();
            
            // Get the test registrant
            $registrant = $registrantModel->where('username', 'test_registrant')->first();
            
            if (!$registrant) {
                return [
                    'status' => 'failed',
                    'message' => 'Test registrant not found',
                    'data' => null
                ];
            }
            
            // Create certificate
            $data = [
                'file_name' => 'test_certificate.png',
                'document_type' => 'Competition',
                'issuer' => 'Test Organization',
                'note' => 'Test certificate',
                'date' => date('Y-m-d')
            ];
            
            $result = $certificateModel->saveForRegistrant($registrant->getId(), $data);
            
            // Verify certificate was created
            $certificates = $certificateModel->getByRegistrantId($registrant->getId());
            
            return [
                'status' => $result && !empty($certificates) ? 'success' : 'failed',
                'message' => $result && !empty($certificates) ? 'Certificate created successfully' : 'Failed to create certificate',
                'data' => !empty($certificates) ? $certificates[0]->getDocumentType() : null
            ];
        } catch (\Exception $e) {
            return [
                'status' => 'error',
                'message' => $e->getMessage(),
                'data' => null
            ];
        }
    }

    /**
     * @context7 /codeigniter/controller/method
     * @description Test counter operations
     * @return array
     */
    private function testCounterOperations()
    {
        try {
            $counterModel = new CounterModel();
            
            // Get initial counts
            $initialMaleCount = $counterModel->getMaleCount();
            $initialFemaleCount = $counterModel->getFemaleCount();
            
            // Increment counts
            $counterModel->addMaleCount();
            $counterModel->addFemaleCount();
            
            // Get new counts
            $newMaleCount = $counterModel->getMaleCount();
            $newFemaleCount = $counterModel->getFemaleCount();
            
            return [
                'status' => ($newMaleCount > $initialMaleCount && $newFemaleCount > $initialFemaleCount) ? 'success' : 'failed',
                'message' => ($newMaleCount > $initialMaleCount && $newFemaleCount > $initialFemaleCount) ? 'Counter operations successful' : 'Failed counter operations',
                'data' => [
                    'initial_male' => $initialMaleCount,
                    'new_male' => $newMaleCount,
                    'initial_female' => $initialFemaleCount,
                    'new_female' => $newFemaleCount
                ]
            ];
        } catch (\Exception $e) {
            return [
                'status' => 'error',
                'message' => $e->getMessage(),
                'data' => null
            ];
        }
    }

    /**
     * @context7 /codeigniter/controller/method
     * @description Test data retrieval
     * @return array
     */
    private function testDataRetrieval()
    {
        try {
            $registrantModel = new RegistrantModel();
            
            // Get registrant by username
            $registrant = $registrantModel->getByUsername('test_registrant');
            
            // Get registrant status
            $status = $registrantModel->getRegistrantStatus($registrant->getId());
            
            return [
                'status' => $registrant ? 'success' : 'failed',
                'message' => $registrant ? 'Data retrieval successful' : 'Failed to retrieve data',
                'data' => $registrant ? [
                    'name' => $registrant->getName(),
                    'status' => $status['status'],
                    'completed' => $status['completed']
                ] : null
            ];
        } catch (\Exception $e) {
            return [
                'status' => 'error',
                'message' => $e->getMessage(),
                'data' => null
            ];
        }
    }

    /**
     * @context7 /codeigniter/controller/method
     * @description Test data updates
     * @return array
     */
    private function testDataUpdates()
    {
        try {
            $registrantModel = new RegistrantModel();
            $paymentModel = new PaymentModel();
            
            // Get registrant
            $registrant = $registrantModel->getByUsername('test_registrant');
            
            if (!$registrant) {
                return [
                    'status' => 'failed',
                    'message' => 'Test registrant not found',
                    'data' => null
                ];
            }
            
            // Update registrant
            $registrant->setName('Updated Test Registrant');
            $result1 = $registrantModel->save($registrant);
            
            // Verify payment and update
            $payment = $paymentModel->getByRegistrantId($registrant->getId());
            $result2 = false;
            if ($payment) {
                $result2 = $paymentModel->verifyPayment($payment->getId(), 'valid', 'Payment verified');
            }
            
            return [
                'status' => ($result1 && $result2) ? 'success' : 'failed',
                'message' => ($result1 && $result2) ? 'Data updates successful' : 'Failed to update data',
                'data' => [
                    'registrant_updated' => $result1,
                    'payment_verified' => $result2
                ]
            ];
        } catch (\Exception $e) {
            return [
                'status' => 'error',
                'message' => $e->getMessage(),
                'data' => null
            ];
        }
    }
}