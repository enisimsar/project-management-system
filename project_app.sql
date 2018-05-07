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

 Date: 06/05/2018 23:54:40
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
-- Table structure for employees
-- ----------------------------
DROP TABLE IF EXISTS `employees`;
CREATE TABLE `employees`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 22 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

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
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

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
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

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
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `tasks_project_id_foreign`(`project_id`) USING BTREE,
  CONSTRAINT `tasks_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

-- ----------------------------
-- Procedure structure for completed_projects
-- ----------------------------
DROP PROCEDURE IF EXISTS `completed_projects`;
delimiter ;;
CREATE DEFINER=`project_sql`@`%` PROCEDURE `completed_projects`(IN project_manager_id TEXT)
BEGIN
                IF (project_manager_id = 'ALL') THEN 
                    SELECT * FROM projects WHERE projects.completed = TRUE AND projects.deleted_at is NULL;        
                ELSE 
                    SELECT * FROM projects WHERE
                    projects.id IN (
                        SELECT project_manager_project.project_id FROM project_manager_project 
                        WHERE project_manager_project.project_manager_id = CAST(project_manager_id AS UNSIGNED)
                    ) AND projects.completed = TRUE AND projects.deleted_at is NULL;
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
                    SELECT * FROM projects WHERE projects.completed = FALSE AND projects.deleted_at is NULL;       
                ELSE 
                    SELECT * FROM projects WHERE
                    projects.id IN (
                        SELECT project_manager_project.project_id FROM project_manager_project 
                        WHERE project_manager_project.project_manager_id = CAST(project_manager_id AS UNSIGNED)
                    ) AND projects.completed = FALSE AND projects.deleted_at is NULL;
                END IF;
            END
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table employees
-- ----------------------------
DROP TRIGGER IF EXISTS `remove_free_relations`;
delimiter ;;
CREATE TRIGGER `remove_free_relations` BEFORE DELETE ON `employees` FOR EACH ROW BEGIN
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
