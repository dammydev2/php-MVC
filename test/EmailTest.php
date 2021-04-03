<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use app\Services\Admin_Service;

include __DIR__.'../../App/services/admin_service.php';


final class EmailTest extends TestCase
{
    protected $APIController;

    public function setUp(): void
    {
        $this->adminService = new Admin_Service();
    }

    public function testEnsureIsValidEmail()
    {
        $email = 'test1@example.com';
        $this->assertEquals(true, $this->adminService->ensureIsValidEmail($email));
    }
}
