<?php

use app\core\Database;

class m005_posts_images {
    public function up()
    {
        $db = new Database();
        $sql = "CREATE TABLE `post_images` (
            `id` int NOT NULL AUTO_INCREMENT,
            `post_id` int NOT NULL,
            `image_uri` varchar(2048) NOT NULL,
            PRIMARY KEY (`id`),
            KEY `post_id` (`post_id`),
            CONSTRAINT `post_images_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE SET DEFAULT
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;";
        $db->prepare($sql);
    }

    public function down()
    {
        $db = new Database();
        $sql = "DROP TABLE `posts_images`";
        $db->prepare($sql);
    }
}