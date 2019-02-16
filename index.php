<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once ('functions.php');
require_once ('data.php');

// Connecting to database
$mysqli = mysqli_connect('localhost', 'root', '222', 'doingsdone');
mysqli_set_charset($mysqli, 'utf8');

//Output any connection error
if (!$mysqli) {
    echo('Ошибка подключения : ' . mysqli_connect_error());
} else {
    // Getting users id
    $id = mysqli_real_escape_string($mysqli, $_GET['id']);
    $sql = "SELECT name FROM users WHERE id = %s";
    $result = mysqli_query($mysqli, $sql);
    if (!$result) {
        die("MySQL Error:" . mysqli_connect_error());
    }
    else {
        $users = mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    //SQL-query to get project list for user
    $sql = "SELECT title FROM projects WHERE author = %s";
    $result = mysqli_query($mysqli, $sql);
    if (!$result) {
    die("MySQL Error:" . mysqli_connect_error());
    } else {
        $projects = mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    //SQL-query to get task list for user
    $sql =  "SELECT * FROM tasks WHERE author = %s";
    $result = mysqli_query($mysqli, $sql);
    if (!$result) {
    die("MySQL Error:" . mysqli_connect_error());
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