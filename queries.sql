USE doingsdone;

-- Adding data into project table
INSERT INTO projects (title, user_id) 
VALUES 
("Входящие", "1"), ("Учеба", "1"), ("Работа", "2"), ("Домашние дела", "1"), ("Авто", "2");

-- Adding data into tasks table
INSERT INTO tasks (date_added, date_completed, status, title, file, due_date, user_id, project_id) 
VALUES
("2019.01.11", "2019.12.01", 0, "Собеседование в IT компании", "interview.psd", "2019.10.02 00:00:00", 1, 3),
("2019.01.11", "2019.03.12", 0, "Выполнить тестовое задание", "task.psd", "2019.12.25 00:00:00", 1, 2),
("2019.01.12", "2019.04.12", 1, "Сделать задание первого раздела", "task2.psd", "2019.12.21 00:00:00", 2, 2),
("2019.01.15", "2019.08.12", 0, "Встреча с другом", "catchup.psd", "2019.12.22 00:00:00", 2, 1),
("2019.01.09", "2019.11.12", 0, "Купить корм для кота", "cat_food.psd", NULL, 1, 4),
("2019.01.19", "2019.12.12", 0, "Заказать пиццу", "pizza.psd", NULL, 2, 4);

-- Adding data into users table
INSERT INTO users (reg_date, name, email, password)
VALUES 
("2018.11.12", "Elena", "elena85@gmail.com", "12345678"),
("2018.11.20", "Dima", "dmitivanov@gamil.com", "pass555");

-- Get list of all projects for 1 user
SELECT title FROM projects
WHERE user_id = "1";

-- Get list of all tasks for 1 project
SELECT title FROM tasks
WHERE project_id = "2";

-- Mark task as completed
UPDATE tasks SET status = "1"
WHERE title = "Купить корм для кота";

-- Update task name
UPDATE tasks SET title = "Встреча с друзьями"
WHERE id = 4;