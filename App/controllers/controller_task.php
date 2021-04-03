<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Model_Task;
use App\Core\View;
use App\Services\Task_Service;
use App\Services\Admin_Service;
use \Exception;

class Controller_Task extends Controller
{
    public $taskService;
    public $adminService;

    function __construct()
    {
        $this->model = new Model_Task();
        $this->view = new View();
        $this->taskService = new Task_Service();
        $this->adminService = new Admin_Service();
    }

    public function action_add()
    {
        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $errors = $this->taskService->validateTask();
                if ( empty($errors) ) {
                    $this->taskService->createTask();
                    header("Location: /");
                    die();
                }
            } catch (Exception $exception) {
                $errors['exception'] = $exception->getMessage();
            }
        }
        $tasks = $this->model::get();
        $this->view->generate('add_task_view.php', 'template_view.php', ['tasks' => $tasks, 'errors' => $errors] );
    }


    public function action_edit()
    {
        $is_admin = $this->adminService->checkAdmin();
        $task = $this->model::where('id', $_GET['id'])->first();
        if ( ! $task || ! $is_admin) {
            header("Location: /");
            die();
        }
        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $errors = $this->taskService->validateEditTask();
                if ( empty($errors) ) {
                    $this->taskService->editTask($task);
                    header("Location: /");
                    die();
                }
            } catch (Exception $exception) {
                $errors['exception'] = $exception->getMessage();
            }
        }

        $this->view->generate('edit_task_view.php', 'template_view.php', ['task' => $task, 'errors' => $errors] );
    }

    public function action_try()
    {
        echo 'lll';
    }

}