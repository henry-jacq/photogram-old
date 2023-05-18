<?php

use app\core\Database;

class m003_posts {
    public function up()
    {
        $db = new Database();
        $sql = "CREATE TABLE IF NOT EXISTS `posts` (
            `id` int NOT NULL AUTO_INCREMENT,
            `post_text` varchar(240) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
            `multiple_images` int NOT NULL DEFAULT '0',
            `image_uri` varchar(1024) NOT NULL,
            `uploaded_time` timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP,
            `owner` varchar(128) NOT NULL,
            PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;";
        $db->prepare($sql);
    }

    public function down()
    {
        $db = new Database;
        $sql = "DROP TABLE `posts`";
        $db->prepare($sql);
    }
}