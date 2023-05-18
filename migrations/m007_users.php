<?php

use app\core\Database;

class m007_users {
    public function up()
    {
        $db = new Database();
        $sql = "CREATE TABLE IF NOT EXISTS `users` (
            `id` int NOT NULL,
            `bio` longtext NOT NULL,
            `avatar` varchar(1024) NOT NULL,
            `firstname` text NOT NULL,
            `lastname` text NOT NULL,
            `dob` date NOT NULL,
            `instagram` varchar(1024) DEFAULT NULL,
            `twitter` varchar(1024) DEFAULT NULL,
            `facebook` varchar(1024) DEFAULT NULL,
            KEY `id` (`id`),
            CONSTRAINT `users_ibfk_2` FOREIGN KEY (`id`) REFERENCES `auth` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
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