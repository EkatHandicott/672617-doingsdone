<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once ('functions.php');
require_once ('data.php');

// Connecting to database
$mysqli = mysqli_connect($db['host'], $db['user'], $db['password'], $db['database']);
mysqli_set_charset($mysqli, 'utf8');

$current_user = 1;
//Output any connection error
if (!$mysqli) {
    echo('Ошибка подключения : ' . mysqli_connect_error($mysqli)); 
} else {
    //SQL-query to get project list for user
    $sql = 'SELECT title FROM projects WHERE user_id = "' . $current_user . '";';
    $result = mysqli_query($mysqli, $sql);
    if (!$result) {
    echo("MySQL Error:" . mysqli_error($mysqli));
    } else {
        $projects = mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    //SQL-query to get task list for user
    $sql =  'SELECT * FROM tasks WHERE user_id = "' . $current_user . '";';
    $result = mysqli_query($mysqli, $sql);
    if (!$result) {
    echo("MySQL Error:" . mysqli_error($mysqli));
    } else {
        $tasks = mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
}

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