<?php

namespace App\Services;

require_once __DIR__.'../../models/model_admin.php';
use App\Models\Model_Admin;


class Admin_Service
{

    function __construct()
    {
        $this->model = new Model_Admin();
    }

    public function checkAdmin()
    {
        if (isset($_COOKIE['auth'])) {
            $admin = Model_Admin::where('password', $_COOKIE['auth'])->first();
            if ($admin)
                return true;
        }
        return false;
    }

    public function validateRequest()
    {
        $errors = [];
        if (!isset($_POST['name']) || empty($_POST['name']) || strlen($_POST['name']) > 100)
            $errors['name'] = 'name is required';
        if (!isset($_POST['email']) || empty($_POST['email']) || strlen($_POST['email']) > 255)
            $errors['email'] = 'email is required';
        if (!isset($_POST['password']) || empty($_POST['password']))
            $errors['password'] = 'password is required';
        if (!isset($_POST['password_confirmation']) || empty($_POST['password_confirmation']))
            $errors['password_confirmation'] = 'password_confirmation is required';

        if ($_POST['password'] !== $_POST['password_confirmation'])
            $errors['mismatch_password'] = 'password and password_confirmation are not the same';

        $isEmailValid = $this->ensureIsValidEmail($_POST['email']);
        if ($isEmailValid !== true)
            $errors['invalidEmail'] = $isEmailValid;

        $isEmailExist = $this->isEmailExist($_POST['email']);
        if ($isEmailExist !== true)
            $errors['emailExist'] = $isEmailExist;

        return $errors;
    }

    public function ensureIsValidEmail(string $email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return 'email is not a valid email';
        }
        return true;
    }

    public function isEmailExist(string $email)
    {
        $checkExist = $this->model::where('email', $email)->first();
        if ($checkExist) {
            return 'email already exist';
        }
        return true;
    }

    public function addNewUser()
    {
        $newAdmin = new Model_Admin();
        $newAdmin->name = $_POST['name'];
        $newAdmin->email = $_POST['email'];
        $newAdmin->password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $newAdmin->save();
        return $newAdmin;
    }

    public function validateLogin()
    {
        $errors = [];

        if (!isset($_POST['email']) || empty($_POST['email']) || strlen($_POST['email']) > 255)
            $errors['email'] = 'email is required';
        if (!isset($_POST['password']) || empty($_POST['password']))
            $errors['password'] = 'password is required';

        return $errors;
    }
}
