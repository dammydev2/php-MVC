<?php

namespace app\controllers;

use ReallySimpleJWT\Token;
use App\Services\Admin_Service;
use App\Models\Model_Admin;


class Controller_API  
{
    public $adminService, $model;

    function __construct()
    {
        $this->adminService = new Admin_Service();
        $this->model = new Model_Admin();
    }

    public function action_register()
    {
        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $errors = $this->adminService->validateRequest();
            if ($errors) {
                http_response_code(400);
                echo json_encode($errors);
                die();
            }
            $data = $this->adminService->addNewUser();
            http_response_code(201);
            echo json_encode($data);
            die();
        }
    }

    public function action_login()
    {
        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $errors = $this->adminService->validateLogin();
            if ($errors) {
                http_response_code(400);
                echo json_encode($errors);
                die();
            }
            $admin = $this->model::where('email', $_POST['email'])->first();

            if ($admin) {
                $hash = $admin->password; // password_hash("123", PASSWORD_DEFAULT);

                if (password_verify($_POST['password'], $hash)) {


                    $data['cokie'] = setcookie('auth', $admin->password, time() + (86400 * 30), "/");

                    $data['email'] = $_POST['email'];
                    // token is here
                    $userId = $admin->id;
                    $secret = 'sec!ReT423*&';
                    $expiration = time() + 3600;
                    $issuer = 'localhost';

                    $data['token'] = Token::create($userId, $secret, $expiration, $issuer);
                    http_response_code(200);
                    echo json_encode($data);
                    die();
                }
            }
        }
    }

    public function action_logout()
    {
        $this->tokenBlackList();
        http_response_code(200);
        echo json_encode(['message' => 'user logged out']);
        die();
    }

    private static function tokenBlackList()
    {
        $userId = 0;
        $secret = 'sec!ReT423*&';
        $expiration = time() + 3600;
        $issuer = 'localhost';

        $token = Token::create($userId, $secret, $expiration, $issuer);
        return $token;
    }

    public static function action_EnsureIsValidEmail(string $email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return 'email is not a valid email';
        }
        return true;
    }
}
