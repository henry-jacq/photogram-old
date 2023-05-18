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
            CONSTRAINT `post_images_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `post_images` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
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