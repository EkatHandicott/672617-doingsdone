<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once ('functions.php');
require_once ('data.php');

$page_content = include_template ('index.php', [
	'tasks' => $tasks, 
	'show_complete_tasks' => $show_complete_tasks,
	]);

$layout_content = include_template ('layout.php', [
    'title' => 'Дела в порядке', 
    'content' => $page_content, 
    'projects' => $projects,
    'tasks' => $tasks,
    'user_name' => 'Ekaterina',
    ]);

echo($layout_content); 

date_default_timezone_set('Australia/Melbourne');
setlocale(LC_ALL, 'en_AU');
?>