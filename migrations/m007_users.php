<?php

use app\core\Database;

class m007_users {
    public function up()
    {
        $db = new Database();
        $sql = "CREATE TABLE `users` (
            `uid` int NOT NULL,
            `bio` longtext NOT NULL,
            `avatar` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
            `sec_email` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
            `instagram` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
            `twitter` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
            `facebook` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
            KEY `id` (`uid`),
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