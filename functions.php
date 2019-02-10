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
function count_tasks($tasks, $proj_name) {
    $task_qty = 0;
    foreach ($tasks as $key => $item) {
        $task_cat = $item['category'];
        if ($task_cat == $proj_name) {
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
?>
