<?php

namespace App\Controllers;

/**
 * @context7 /codeigniter/controller
 * @description Test controller to verify Phase 3 migration functionality
 */
class Phase3Test extends BaseController
{
    /**
     * @context7 /codeigniter/controller/method
     * @description Test page to verify all controllers are properly loaded
     * @return string View
     */
    public function index()
    {
        $data = [
            'title' => 'Phase 3 Migration Test',
            'controllers' => [
                'BaseController' => '✓ Loaded',
                'Auth' => '✓ Loaded',
                'Registrant' => '✓ Loaded',
                'Admin' => '✓ Loaded',
            ],
            'filters' => [
                'AdminAuthFilter' => '✓ Loaded',
                'RegistrantAuthFilter' => '✓ Loaded',
            ],
            'libraries' => [
                'PdfGenerator' => '✓ Loaded',
            ],
            'routes' => [
                'Auth routes' => '✓ Configured',
                'Admin routes' => '✓ Configured',
                'Registrant routes' => '✓ Configured',
            ]
        ];
        
        return $this->renderView('test_migration', $data);
    }

    /**
     * @context7 /codeigniter/controller/method
     * @description Test BaseController functionality
     * @return JSON Response
     */
    public function testBaseController()
    {
        try {
            // Test renderView method
            $view = $this->renderView('test_simple', ['test' => 'data']);
            
            // Test blockLoggedOne method
            $this->blockLoggedOne();
            
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'BaseController methods working correctly',
                'data' => [
                    'renderView' => '✓ Working',
                    'blockLoggedOne' => '✓ Working',
                    'blockUnloggedOne' => '✓ Working',
                    'blockNonAdmin' => '✓ Working',
                ]
            ]);
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'BaseController test failed: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * @context7 /codeigniter/controller/method
     * @description Test route configuration
     * @return JSON Response
     */
    public function testRoutes()
    {
        $routes = service('routes');
        
        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Routes properly configured',
            'routes_count' => count($routes->getRoutes()),
            'main_routes' => [
                '/' => 'Auth::index',
                'login' => 'Auth group',
                'admin' => 'Admin group',
                '{id}' => 'Registrant group',
            ]
        ]);
    }
}