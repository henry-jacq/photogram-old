<?php

namespace libs\app;

// include_once __DIR__ . "/../traits/SQLGetterSetter.trait.php";

use Exception;
use libs\core\Session;
use libs\core\Database;
use libs\traits\SQLGetterSetter;

class Post
{
    use SQLGetterSetter;
    private $conn;
    public $username;
    public $id;
    public $table;

    // Register a post in database and save image in 'uploads' directory
    public static function registerPost($image_tmp, $text)
    {
        if (is_file($image_tmp) and exif_imagetype($image_tmp) !== false) {
            $owner = Session::getUser()->getUsername();
            $image_name = md5($owner.time()) . image_type_to_extension(exif_imagetype($image_tmp));
            $image_path = get_config('upload_path').$image_name;
            if (move_uploaded_file($image_tmp, $image_path)) {
                $image_uri = "/files/$image_name";
                $insert_command = "INSERT INTO `posts` (`post_text`, `multiple_images`,`image_uri`, `like_count`, `uploaded_time`, `owner`) VALUES ('$text', 0, '$image_uri', '0', now(), '$owner')";
                $db = Database::getConnection();
                if ($db->query($insert_command)) {
                    $id = mysqli_insert_id($db);
                    return new Post($id);
                } else {
                    return false;
                }
            }
        } else {
            throw new Exception("Image not uploaded");
        }
    }

    // Delete the post's image from 'uploads' directory
    public function deletePostImage()
    {
        try {
            $image_name = basename($this->getImageUri());
            $image_path = get_config('upload_path').$image_name;
            if (file_exists($image_path)) {
                if (unlink($image_path)) {
                    return true;
                } else {
                    throw new Exception(__CLASS__."::".__FUNCTION__.", can't delete the post image.Image path: $image_path");
                }
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    // It will remove the database entry as well as the image in 'uploads'.
    public function remove_post()
    {
        if (!$this->conn) {
            $this->conn = Database::getConnection();
        }

        try {
            if ($this->deletePostImage()) {
                $sql = "DELETE FROM `$this->table` WHERE `id`=$this->id;";
                if ($this->conn->query($sql)) {
                    return true;
                } else {
                    return false;
                }
            }
        } catch (Exception $e) {
            throw new Exception(__CLASS__."::remove_post, cannot remove the post.");
        }
    }

    // Dump all posts from database
    public static function getAllPosts()
    {
        $db = Database::getConnection();
        $sql = "SELECT * FROM `posts` ORDER BY `uploaded_time` DESC";
        $result = $db->query($sql);
        return iterator_to_array($result);
    }

    // Count all posts from database
    public static function countAllPosts()
    {
        $db = Database::getConnection();
        $sql = "SELECT COUNT(*) as count FROM `posts` ORDER BY `uploaded_time` DESC";
        $result = $db->query($sql);
        return iterator_to_array($result);
    }

    // Dump only the user's posts from database
    public static function getUserPosts($user)
    {
        $db = Database::getConnection();
        $sql = "SELECT * FROM `posts` WHERE `owner` = '$user' ORDER BY `uploaded_time` DESC";
        $result = $db->query($sql);
        return iterator_to_array($result);
    }

    // Count only the user's posts from database
    public static function countUserPosts($user)
    {
        $db = Database::getConnection();
        $sql = "SELECT COUNT(*) as count FROM `posts` WHERE `owner` = '$user' ORDER BY `uploaded_time` DESC";
        $result = $db->query($sql);
        return iterator_to_array($result);
    }

    public function __construct($id)
    {
        if (!$this->conn) {
            $this->conn = Database::getConnection();
        }
        $this->id = $id;
        $this->table = 'posts';
    }
}
