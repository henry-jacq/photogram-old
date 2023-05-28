<?php

use app\core\Database;

class m007_users {
    public function up()
    {
        $db = new Database();
        $sql = "CREATE TABLE `users` (
            `id` int NOT NULL AUTO_INCREMENT,
            `uid` int NOT NULL,
            `first_name` tinytext NOT NULL,
            `last_name` tinytext NOT NULL,
            `bio` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
            `job` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
            `avatar` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
            `sec_email` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
            `location` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
            `twitter` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
            `instagram` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
            PRIMARY KEY (`id`),
            UNIQUE KEY `id` (`uid`),
            CONSTRAINT `users_ibfk_3` FOREIGN KEY (`uid`) REFERENCES `auth` (`id`) ON DELETE CASCADE ON UPDATE SET DEFAULT
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;";
        $db->prepare($sql);
    }

    public function down()
    {
        $db = new Database;
        $sql = "DROP TABLE `users`";
        $db->prepare($sql);
    }
}