<?php

namespace App\Data\Import;

use App\Renderer\Renderer;
use App\Http\Response;
use App\Data\TasksQueue;
use App\Data\Import;

class ImportController {
    
    public function list() {
        Renderer::getSmarty()->display('import/index.tpl');
    }
    
    public function upload() {
        $file = $_FILES['import_file'] ?? null;
        if (is_null($file) || empty($file['name'])) {
            die('fail otsutstvuet');
        }

        //echo "<pre>"; var_dump($file); echo "</pre>";
        $uploadDir = APP_UPLOAD_DIR . '/import';
        $filepath = $uploadDir . '/' . $file['name'];


        if (!file_exists($uploadDir)) {
            mkdir($uploadDir);
        }


        $importFilename = 'i_' . time() . '.' . $file['name'];
        move_uploaded_file($file['tmp_name'], $uploadDir . '/' . $importFilename);

        $filepath = $uploadDir = $uploadDir . '/' . $importFilename;

        $taskName = 'Импорт товаров ' . $importFilename;
        $task = Import::class . '::productsFromFileTask';
        $taskParams = [
                'filename' => $importFilename
            ];


        //echo "<pre>"; var_dump($taskName, $task, $taskParams); echo "</pre>";
        //exit;
        $taskId = TasksQueue::addTask($taskName, $task, $taskParams);

        return $this->redirect('/queue');
    }
}
