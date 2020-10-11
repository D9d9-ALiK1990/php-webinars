<?php

namespace App\Data;

use App\Db\Db;
use App\Db\DbExp;

class TasksQueue {
    public static function addTask(string $name_task, string $task, array $params) {
        //        echo "<pre>";var_dump($taskMeta); echo "</pre>";
//        exit;
        
        $taskMeta = explode('::', $task);
        
        $taskClassExist = class_exists($taskMeta[0]);
        $taskMethodExist = method_exists($taskMeta[0], $taskMeta[1]);
        
        if (!$taskClassExist || !$taskMethodExist) {
            return false;
        }
//        $created = new DbExp('NOW');
//        echo "<pre>";var_dump($created); echo "</pre>";
//        exit;

        return Db::insert('tasks_queue', [
            'name_task' => $name_task,
            'task' => $task,
            'params' => json_encode($params),
            'created' => Db::expr('NOW()'),            
        ]);
        
//        echo "<pre>";var_dump($taskClassExist, $taskMethodExist); echo "</pre>";       
      
    }
    
    public static function getById(int $id_task) {
        $query = "SELECT * FROM tasks_queue WHERE id_task = $id_task";
        return Db::fetchRow($query);
    }
    
    public static function getTaskList() {
        $query = "SELECT * FROM tasks_queue ORDER BY created DESC";
        return Db::fetchAll($query);
    }
    
    public static function setStatus(int $id_task, string $status) {
        $availableStatuses = [
            'new',
            'in_work',
            'done',
            'error'
        ];
        if (!in_array($status, $availableStatuses)) {
            die('net takogo statusa, oshibka' . $status . 'for' . $id_task);
        }
        return Db::update('tasks_queue', [
            'status' => $status
        ], 'id_task = ' . $id_task);
        
    }
    
    public static function runById(int $id_task) {
        $task = static::getById($id_task);
        return static::run($task);
    }
    
    public static function run(array $task) {
        $id_task = $task['id_task'] ?? null;
        if (empty($task) || is_null($id_task)) {
            return false;
        }
        $taskAction = $task['task'];
        $taskMeta = explode('::', $taskAction);
//        echo "<pre>";var_dump($taskMeta); echo "</pre>";
//        exit;
        $taskClassExist = class_exists($taskMeta[0]);
        $taskMethodExist = method_exists($taskMeta[0], $taskMeta[1]);
        if (!$taskClassExist || !$taskMethodExist) {
            static::setStatus($id_task, 'error');
            return false;
        }
        $taskParams = json_decode($task['params'], true);
                
        static::setStatus($id_task, 'in_work');
        call_user_func($taskAction, $taskParams);
        static::setStatus($id_task, 'done');
        
        return true;
    }
    
    public static function execute() {
        $query = "SELECT * FROM tasks_queue WHERE status = 'in_work' LIMIT 1";
        $inProcess = Db::fetchRow($query);
        
        if (!empty($inProcess)) {
            return false;
        }
        $query = "SELECT * FROM tasks_queue WHERE status = 'new' LIMIT 1";
        $newTaskProcess = Db::fetchRow($query);
        if (empty($newTaskProcess)) {
            return false;
        }
        return static::run($newTaskProcess);
        
    }
}
