<?php

use app\core\Database;

class m008_follow {
    public function up()
    {
        $db = new Database();
        $sql = "CREATE TABLE `follows` (
            `id` varchar(32) NOT NULL,
            `user_id` int NOT NULL,
            `follower_id` int NOT NULL,
            `follow` int NOT NULL,
            `timestamp` timestamp NOT NULL,
            PRIMARY KEY (`id`),
            KEY `uid` (`user_id`),
            KEY `follower_id` (`follower_id`),
            CONSTRAINT `follows_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `auth` (`id`) ON DELETE CASCADE ON UPDATE SET DEFAULT
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;";
        $db->prepare($sql);
    }

    public function down()
    {
        $db = new Database;
        $sql = "DROP TABLE `follow`";
        $db->prepare($sql);
    }
}