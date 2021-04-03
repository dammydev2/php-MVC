<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Model_Task;
use App\Core\View;

class Controller_Main extends Controller
{
    function __construct()
    {
        $this->model = new Model_Task();
        $this->view = new View();
    }

    public function action_index()
    {
        $tasks = $this->model;

        $filter = [];
        $filter['order'] = 'name';
        $filter['sort'] = 'asc';
        $filter['page'] = 1;

        $allowed_fields = ['name','email','status'];
        $allowed_sort = ['asc','desc'];
        if ( ! empty($_GET['order']) && ! empty($_GET['sort']) && in_array($_GET['order'], $allowed_fields) && in_array($_GET['sort'], $allowed_sort) ) {
            $tasks = $tasks->orderBy($_GET['order'], $_GET['sort']);
            $filter['order'] = $_GET['order'];
            $filter['sort'] = $_GET['sort'];
        }

        $skip = 0;
        if ( ! empty($_GET['page']) ) {
            $skip = $_GET['page'] * 3 - 3;
            $filter['page'] = $_GET['page'];
        } else $filter['page'] = 1;

        $tasks = $tasks->skip($skip)->take(3)->get();
        $filter['total_items'] = $this->model->count();
        $filter['total_page'] = $filter['total_items'] % 3 + 1;

        $this->view->generate('main_view.php', 'template_view.php', ['tasks' => $tasks, 'filter' => $filter] );
    }

}