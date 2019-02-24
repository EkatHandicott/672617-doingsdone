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
    $error = mysqli_connect_error();
    $page_content = include_template('error.php', ['error' => $error]);
} else {
    //SQL-query to get project list for user
    $projects = get_projects($mysqli, $current_user);
    if (!$projects) {
        $error = mysqli_connect_error();
        $page_content = include_template('error.php', ['error' => $error]);
}
    //SQL-query to get task list for user
    $all_tasks = get_tasks($mysqli, $current_user);
    if (!$all_tasks) {
        $error = mysqli_connect_error();
        $page_content = include_template('error.php', ['error' => $error]);
}
// Project-tasks check
if (isset($_GET['id'])) {
    $tasks = get_tasks($mysqli, $current_user, $_GET['id']);
    $page_content = include_template('index.php', [
        'tasks' => $tasks,
        'show_complete_tasks' =>  $show_complete_tasks
        ]);
        if(!$tasks) {
            $error =  "Project " . htmlspecialchars($_GET['id']) . " not found";
            $page_content = include_template('error.php', ['error' => $error]);
            http_response_code(404);
        }
    } else {
        $tasks = $all_tasks;
        $index_content = include_template('index.php', [
            'tasks' => $tasks,
            'show_complete_tasks' =>  $show_complete_tasks
        ]);
    }
}

$page_content = include_template('index.php', [
    'tasks' => $tasks,
    'show_complete_tasks' =>  $show_complete_tasks
    ]);

$layout_content = include_template ('layout.php', [
    'title' => 'Дела в порядке', 
    'content' => $page_content, 
    'tasks' => $tasks,
    'projects' => $projects,
    'user_name' => 'Ekaterina',
    ]);
    echo($layout_content); 

date_default_timezone_set('Australia/Melbourne');
setlocale(LC_ALL, 'en_AU');
?>