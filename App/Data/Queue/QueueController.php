<?php

namespace App\Data\Queue;

use App\Controller\AbstractController;
use App\Data\TasksQueue;
use App\Renderer\Renderer;
use App\Http\Response;
use App\Http\Request;

class QueueController extends AbstractController {
    
    
    public function list() {
        $tasks = TasksQueue::getTaskList();

        $smarty = Renderer::getSmarty();
        $smarty->getSmarty()->assign('tasks', $tasks);
        $smarty->getSmarty()->display('queue/list.tpl');
    }
    
    public function run() {
        $id_task = Request::getIntFromGet('id_task');
        TasksQueue::runById($id_task);

        return $this->redirect('/queue');
    }
}
