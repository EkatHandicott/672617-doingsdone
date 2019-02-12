-- Adding data into project table
INSERT INTO projects (name, author) 
VALUES 
("Входящие", 1), ("Учеба", 1), ("Работа", 2), ("Домашние дела", 1), ("Авто", 2);

-- Adding data into tasks table
INSERT INTO tasks (dt_add, dt_compl, status, title, file, dt_due, author, project_id) 
VALUES
("11-01-2019", "12-01-2019", "0", "Собеседование в IT компании", "interview.psd", "10.02.2019 00:00:00", 1, 3),
("11-01-2019", "12-03-2019", "0", "Выполнить тестовое задание", "task.psd", "25.12.2019 00:00:00", 1, 2),
("12-01-2019", "19-02-2019", "1", "Сделать задание первого раздела", "task2.psd", "21.12.2019 00:00:00", 2, 2),
("15-01-2019", "01-06-2019", "0", "Встреча с другом", "catchup.psd", "22.12.2019 00:00:00", 2, 1),
("09-01-2019", "18-04-2019", "0", "Купить корм для кота", "cat_food.psd", NULL, 1, 4),
("19-01-2019", "22-09-2019", "0", "Заказать пиццу", "pizza.psd", NULL, 2, 4);

-- Adding data into users table
INSERT INTO users (dt_reg, name, email, password)
VALUES 
("11-12-2018", "Elena", "elena85@gmail.com", "12345678"),
("20-11-2018", "Dima", "dmitivanov@gamil.com", "pass555");

-- Get list of all projects for 1 user
SELECT name FROM projects
WHERE author = "1";

-- Get list of all tasks for 1 project
SELECT name FROM tasks
WHERE project_id = "2";

-- Mark task as completed
UPDATE tasks SET status = "1"
WHERE name = "Купить корм для кота";

-- Update task name
UPDATE tasks SET name = "Встреча с друзьями"
WHERE id = 4;