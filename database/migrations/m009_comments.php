<?php

use app\core\Database;

class m009_comments
{
    public function up()
    {
        $db = new Database();
        $sql = "CREATE TABLE `comments` (
            `id` varchar(32) NOT NULL,
            `uid` int NOT NULL,
            `pid` int NOT NULL,
            `comment` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
            `timestamp` timestamp NOT NULL,
            UNIQUE KEY `id` (`id`),
            KEY `uid` (`uid`),
            KEY `pid` (`pid`),
            CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`uid`) REFERENCES `auth` (`id`) ON DELETE CASCADE ON UPDATE SET DEFAULT,
            CONSTRAINT `comments_ibfk_3` FOREIGN KEY (`pid`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE SET DEFAULT
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
