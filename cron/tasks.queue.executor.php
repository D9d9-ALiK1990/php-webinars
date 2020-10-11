<?php
use App\TasksQueue;

require_once __DIR__ . '/../config/config.php'; 

TasksQueue::execute();

