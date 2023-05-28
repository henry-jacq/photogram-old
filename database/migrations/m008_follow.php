<?php

use app\core\Database;

class m008_follow {
    public function up()
    {
        $db = new Database();
        $sql = "CREATE TABLE `follow` (
            `id` int NOT NULL AUTO_INCREMENT,
            `uid` int NOT NULL,
            `follower_id` int NOT NULL,
            `timestamp` timestamp NOT NULL,
            PRIMARY KEY (`id`),
            KEY `uid` (`uid`),
            CONSTRAINT `follow_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `auth` (`id`) ON DELETE CASCADE ON UPDATE SET DEFAULT
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