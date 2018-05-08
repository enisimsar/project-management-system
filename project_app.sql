/*
 Navicat Premium Data Transfer

 Source Server         : project_app
 Source Server Type    : MySQL
 Source Server Version : 50722
 Source Host           : 127.0.0.1:33061
 Source Schema         : project

 Target Server Type    : MySQL
 Target Server Version : 50722
 File Encoding         : 65001

 Date: 08/05/2018 12:10:25
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for admins
-- ----------------------------
DROP TABLE IF EXISTS `admins`;
CREATE TABLE `admins`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `job_title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `admins_email_unique`(`email`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

-- ----------------------------
-- Records of admins
-- ----------------------------
BEGIN;
INSERT INTO `admins` (`id`, `name`, `email`, `job_title`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES (1, 'Enis Simsar', 'enisimsar@gmail.com', 'CEO', '$2y$10$ERQYjBR7PQqBvrLB1th.5uh.rKovUcwzu4LpqGgffHSCqo9P/cZjC', 'J1H2NTMjZzBLLqWAX0WmoClKb6Qur9Vktai4byojLupWKnYSIU4UddWkVHXV', '2018-05-06 21:08:37', '2018-05-06 21:08:37');
COMMIT;

-- ----------------------------
-- Table structure for employee_task
-- ----------------------------
DROP TABLE IF EXISTS `employee_task`;
CREATE TABLE `employee_task`  (
  `employee_id` int(10) UNSIGNED NULL DEFAULT NULL,
  `task_id` int(10) UNSIGNED NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  INDEX `employee_task_employee_id_foreign`(`employee_id`) USING BTREE,
  INDEX `employee_task_task_id_foreign`(`task_id`) USING BTREE,
  CONSTRAINT `employee_task_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `employee_task_task_id_foreign` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

-- ----------------------------
-- Records of employee_task
-- ----------------------------
BEGIN;
INSERT INTO `employee_task` (`employee_id`, `task_id`, `created_at`, `updated_at`) VALUES (1, 1, NULL, NULL), (1, 3, NULL, NULL);
COMMIT;

-- ----------------------------
-- Table structure for employees
-- ----------------------------
DROP TABLE IF EXISTS `employees`;
CREATE TABLE `employees`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

-- ----------------------------
-- Records of employees
-- ----------------------------
BEGIN;
INSERT INTO `employees` (`id`, `name`, `created_at`, `updated_at`) VALUES (1, 'Employee 1', '2018-05-06 21:20:42', '2018-05-06 21:20:42'), (3, 'Employee 3', '2018-05-06 21:21:01', '2018-05-06 21:21:01'), (4, 'Employee 4', '2018-05-06 21:21:11', '2018-05-06 21:21:11'), (5, 'Employee 5', '2018-05-06 21:21:21', '2018-05-06 21:21:21');
COMMIT;

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 17 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

-- ----------------------------
-- Records of migrations
-- ----------------------------
BEGIN;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (1, '2014_10_12_000000_create_project_managers_table', 1), (2, '2014_10_12_100000_create_password_resets_table', 1), (3, '2017_02_25_025103_create_admins_table', 1), (4, '2018_04_18_185257_create_projects_table', 1), (5, '2018_04_18_185815_create_tasks_table', 1), (6, '2018_04_18_185915_create_project_manager_project_table', 1), (7, '2018_04_18_190114_create_employees_table', 1), (8, '2018_04_18_200100_create_employee_task_table', 1), (11, '2018_04_30_155524_add_unique_to_p_m_p_table', 1), (12, '2018_05_05_215839_create_add_project_trigger', 1), (13, '2018_05_05_225839_create_remove_employee', 1), (14, '2018_04_22_215839_create_completed_projects_stored_procedure', 2), (16, '2018_04_22_220741_create_not_completed_projects_stored_procedure', 3);
COMMIT;

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets`  (
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  INDEX `password_resets_email_index`(`email`) USING BTREE,
  INDEX `password_resets_token_index`(`token`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

-- ----------------------------
-- Table structure for project_manager_project
-- ----------------------------
DROP TABLE IF EXISTS `project_manager_project`;
CREATE TABLE `project_manager_project`  (
  `project_manager_id` int(10) UNSIGNED NULL DEFAULT NULL,
  `project_id` int(10) UNSIGNED NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  UNIQUE INDEX `pmp_id`(`project_id`, `project_manager_id`) USING BTREE,
  INDEX `project_manager_project_project_manager_id_foreign`(`project_manager_id`) USING BTREE,
  CONSTRAINT `project_manager_project_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `project_manager_project_project_manager_id_foreign` FOREIGN KEY (`project_manager_id`) REFERENCES `project_managers` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

-- ----------------------------
-- Records of project_manager_project
-- ----------------------------
BEGIN;
INSERT INTO `project_manager_project` (`project_manager_id`, `project_id`, `created_at`, `updated_at`) VALUES (1, 2, NULL, NULL), (1, 5, NULL, NULL), (1, 1, NULL, NULL), (3, 1, NULL, NULL);
COMMIT;

-- ----------------------------
-- Table structure for project_managers
-- ----------------------------
DROP TABLE IF EXISTS `project_managers`;
CREATE TABLE `project_managers`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `project_managers_email_unique`(`email`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

-- ----------------------------
-- Records of project_managers
-- ----------------------------
BEGIN;
INSERT INTO `project_managers` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES (1, 'P. Manager 1', 'pm_1@gmail.com', '$2y$10$U2st/E2.wcTceuPwTpso/OrKsDmNAlqEWMQz5zA.X6XWzQrB/ux8q', 'mgFhg0fndiUphEWjUhRR6jzPQeUxdFEYVAPg9Z8YYwCraIvqgxWdHhlkWAXD', '2018-05-06 21:17:42', '2018-05-06 21:17:42'), (3, 'P. Manager 3', 'pm_3@gmail.com', '$2y$10$FFuqNiZbdIOCm/39bR8H1ev3ymleJrVgQPwS.eNu9ORAPB8BVhzP.', NULL, '2018-05-06 21:21:49', '2018-05-06 21:21:49');
COMMIT;

-- ----------------------------
-- Table structure for projects
-- ----------------------------
DROP TABLE IF EXISTS `projects`;
CREATE TABLE `projects`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `started_at` date NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `completed` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

-- ----------------------------
-- Records of projects
-- ----------------------------
BEGIN;
INSERT INTO `projects` (`id`, `name`, `started_at`, `description`, `completed`, `created_at`, `updated_at`) VALUES (1, 'Legendary Project', '2018-05-01', 'This is a project about labor day.', 0, '2018-05-06 21:17:04', '2018-05-06 21:17:04'), (2, 'Ordinary Project', '2018-05-10', 'Hello! This is an ordinary project.', 1, '2018-05-06 21:19:15', '2018-05-06 21:36:48'), (3, 'Ordinary Project 2', '2018-05-13', 'Again. it is an ordinary project.', 0, '2018-05-06 21:20:25', '2018-05-06 21:20:25'), (5, 'Ordinary Project 4', '2018-05-30', 'Extra ordinary..', 0, '2018-05-06 21:22:34', '2018-05-06 21:23:28');
COMMIT;

-- ----------------------------
-- Table structure for tasks
-- ----------------------------
DROP TABLE IF EXISTS `tasks`;
CREATE TABLE `tasks`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `project_id` int(10) UNSIGNED NOT NULL,
  `name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `started_at` date NOT NULL,
  `duration` int(11) NOT NULL,
  `completed` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `tasks_project_id_foreign`(`project_id`) USING BTREE,
  CONSTRAINT `tasks_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

-- ----------------------------
-- Records of tasks
-- ----------------------------
BEGIN;
INSERT INTO `tasks` (`id`, `project_id`, `name`, `description`, `started_at`, `duration`, `completed`, `created_at`, `updated_at`) VALUES (1, 1, 'Task 1', 'Task 1 !! Yuppii', '2018-05-01', 10, 0, '2018-05-06 21:31:24', '2018-05-06 21:31:24'), (2, 1, 'Task 2', 'Task 2...', '2018-05-02', 3, 0, '2018-05-06 21:34:24', '2018-05-06 21:34:24'), (3, 1, 'Task 3', 'Not in the period!!', '2018-05-13', 2, 0, '2018-05-06 21:35:21', '2018-05-06 21:35:21'), (4, 3, 'Task 4', 'Task 4 description', '2018-05-26', 12, 0, '2018-05-07 20:08:32', '2018-05-07 20:08:32'), (5, 5, 'Task 5', 'Task 5 description', '2018-05-01', 2, 0, '2018-05-07 20:08:32', '2018-05-07 20:08:32');
COMMIT;

-- ----------------------------
-- Procedure structure for completed_projects
-- ----------------------------
DROP PROCEDURE IF EXISTS `completed_projects`;
delimiter ;;
CREATE DEFINER=`project_sql`@`%` PROCEDURE `completed_projects`(IN project_manager_id TEXT)
BEGIN
                IF (project_manager_id = 'ALL') THEN 
                    SELECT * 
                    FROM projects 
                    LEFT JOIN (SELECT project_id, MAX(DATE_ADD(tasks.started_at, INTERVAL tasks.duration DAY)) as ended_at
                        FROM tasks
                        GROUP BY project_id) as agg_project 
                    ON projects.id = agg_project.project_id
                    WHERE agg_project.ended_at < CURDATE(); 
                ELSE 
                    SELECT * 
                    FROM projects 
                    LEFT JOIN (SELECT project_id, MAX(DATE_ADD(tasks.started_at, INTERVAL tasks.duration DAY)) as ended_at
                        FROM tasks
                        GROUP BY project_id) as agg_project 
                    ON projects.id = agg_project.project_id
                    WHERE agg_project.ended_at < CURDATE() 
                    AND projects.id IN (
                        SELECT project_manager_project.project_id FROM project_manager_project 
                        WHERE project_manager_project.project_manager_id = CAST(project_manager_id AS UNSIGNED)
                    );
                END IF;
            END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for not_completed_projects
-- ----------------------------
DROP PROCEDURE IF EXISTS `not_completed_projects`;
delimiter ;;
CREATE DEFINER=`project_sql`@`%` PROCEDURE `not_completed_projects`(IN project_manager_id TEXT)
BEGIN
                IF (project_manager_id = 'ALL') THEN 
                    SELECT * 
                    FROM projects 
                    LEFT JOIN (SELECT project_id, MAX(DATE_ADD(tasks.started_at, INTERVAL tasks.duration DAY)) as ended_at
                        FROM tasks
                        GROUP BY project_id) as agg_project 
                    ON projects.id = agg_project.project_id
                    WHERE agg_project.ended_at >= CURDATE() OR agg_project.ended_at IS NULL;       
                ELSE 
                    SELECT * 
                    FROM projects 
                    LEFT JOIN (SELECT project_id, MAX(DATE_ADD(tasks.started_at, INTERVAL tasks.duration DAY)) as ended_at
                        FROM tasks
                        GROUP BY project_id) as agg_project 
                    ON projects.id = agg_project.project_id
                    WHERE (agg_project.ended_at >= CURDATE() 
                    OR agg_project.ended_at IS NULL) 
                    AND projects.id IN (
                        SELECT project_manager_project.project_id FROM project_manager_project 
                        WHERE project_manager_project.project_manager_id = CAST(project_manager_id AS UNSIGNED)
                    );
                END IF;
            END
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table employees
-- ----------------------------
DROP TRIGGER IF EXISTS `remove_free_relations`;
delimiter ;;
CREATE TRIGGER `remove_free_relations` AFTER DELETE ON `employees` FOR EACH ROW BEGIN
                DELETE FROM employee_task 
                WHERE employee_task.employee_id = OLD.id;
            END
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table projects
-- ----------------------------
DROP TRIGGER IF EXISTS `add_project_to_least_project_pm`;
delimiter ;;
CREATE TRIGGER `add_project_to_least_project_pm` AFTER INSERT ON `projects` FOR EACH ROW BEGIN
                IF EXISTS(SELECT * FROM project_managers) THEN 
                    SELECT project_managers.id
                    FROM project_managers
                    LEFT JOIN project_manager_project 
                    ON project_managers.id = project_manager_project.project_manager_id
                    GROUP BY project_managers.id
                    ORDER BY COUNT(project_manager_project.project_id) ASC
                    LIMIT 1 INTO @pm_id;
                    INSERT INTO project_manager_project
                    (project_id, project_manager_id)
                    VALUES (NEW.id, @pm_id);
                END IF;
            END
;;
delimiter ;

SET FOREIGN_KEY_CHECKS = 1;
