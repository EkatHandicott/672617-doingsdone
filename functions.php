<?php 

//Function for including templates
function include_template($name, $data) {
    $name = 'templates/' . $name;
    $result = '';

    if (!is_readable($name)) {
        return $result;
    }

    ob_start();
    extract($data);
    require $name;

    $result = ob_get_clean();

    return $result;
}

// To help from XSS attacks
function esc($str) {
	$text = htmlspecialchars($str);
	return $text;
}

// Function for tasks count per project
function count_tasks($tasks, $project_title) {
    $task_qty = 0;
    foreach ($tasks as $task) {
        if ($task['title'] === $project_title) {
            $task_qty++;
        }
    }
    return $task_qty;
} 

// показывать или нет выполненные задачи
$show_complete_tasks = rand(0, 1);

// Count hour difference 
function count_hours($date) {
$cur_date = date("d.m.Y H:i");
$today = strtotime($cur_date);
$task_date = strtotime($date);

$h_diff = ($task_date - $today) / 3600;
return $h_diff;
}

// Get projects
function get_projects($mysqli, $user_id) {
    $sql_projs = 'SELECT id, title FROM projects WHERE user_id = "' . $user_id . '";';
    $result_projs = mysqli_query($mysqli, $sql_projs);
    
    if(!$result_projs) {
    return NULL;
}
    return mysqli_fetch_all($result_projs, MYSQLI_ASSOC);
}

// Get tasks
function get_tasks($mysqli, $user_id, $task_id = NULL) {
    if ($task_id === NULL) {
    $sql_tasks = 'SELECT t. *, p.title AS project_title FROM tasks t
    JOIN projects p
    ON t.project_id = p.id
    WHERE t.user_id = ' . $user_id . ';';
    
    $result_tasks = mysqli_query($mysqli, $sql_tasks);

    if (!$result_tasks) {
        return null;
    }
    return mysqli_fetch_all($result_tasks, MYSQLI_ASSOC);
} else {
    $sql_tasks = 'SELECT t. *, p.title AS project_title
    FROM tasks t
    JOIN projects p 
    ON t.project_id = p.id
    WHERE t.user_id = ' . $user_id . ' AND t.project_id = ' . $task_id . ';';
    $result_tasks = mysqli_query($mysqli, $sql_tasks);
    
    if (!$result_tasks) {
        return null;
    }
    return mysqli_fetch_all($result_tasks, MYSQLI_ASSOC);
}
}
?>