<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Model_Admin;
use App\Core\View;
use \Exception;

class Controller_Auth extends Controller
{

    function __construct()
    {
        $this->model = new Model_Admin();
        $this->view = new View();
    }

    public function action_login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $admin = $this->model::where('email', $_POST['login'])->first();
            if ($admin) {
                $hash = $admin->password; // password_hash("123", PASSWORD_DEFAULT);

                if(password_verify($_POST['password'], $hash)) {

                    if( ! isset($_COOKIE['auth'])) {
                        setcookie('auth', $admin->password, time() + (86400 * 30), "/");
                        header("Location: /");
                        die();
                    }
                }
            }
        }
        $this->view->generate('login_view.php', 'template_view.php' );
    }

    public function action_logout()
    {
        setcookie("auth", "", time() - 3600, "/");
        header("Location: /");
        die();
    }

}