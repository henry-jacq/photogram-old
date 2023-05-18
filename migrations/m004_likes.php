<?php

use app\core\Database;

class m004_likes {
    public function up()
    {
        $db = new Database();
        $sql = "CREATE TABLE `likes` (
            `id` varchar(32) NOT NULL,
            `uid` int NOT NULL,
            `pid` int NOT NULL,
            `like` int NOT NULL,
            `timestamp` timestamp NOT NULL,
            PRIMARY KEY (`id`),
            KEY `pid` (`pid`),
            CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`pid`) REFERENCES `posts` (`id`) ON DELETE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;";
        $db->prepare($sql);
    }

    public function down()
    {
        $db = new Database();
        $sql = "DROP TABLE `likes`;";
        $db->prepare($sql);
    }
}