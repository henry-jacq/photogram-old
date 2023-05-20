<?php

namespace app\models;

use Exception;
use app\core\Session;
use app\core\Database;
use app\traits\SQLGetterSetter;

class Post
{
    use SQLGetterSetter;
    private $conn;
    public $username;
    public $id;
    public $table;

    public function __construct($id)
    {
        if (!$this->conn) {
            $this->conn = Database::getConnection();
        }
        $this->id = $id;
        $this->table = 'posts';
    }

    /**
     * Register the single image for a single post
     */
    private static function registerSinglePost(array|string $image_tmp, string $postText) {
        $image_tmp = $image_tmp[0];
        $db = Database::getConnection();
        $text = mysqli_real_escape_string($db, $postText);
        
        if (is_file($image_tmp) and exif_imagetype($image_tmp) !== false) {
            $owner = Session::getUser()->getUsername();
            $image_name = md5($owner.time()) . image_type_to_extension(exif_imagetype($image_tmp));
            $image_path = APP_POST_UPLOAD_PATH.$image_name;
            if (move_uploaded_file($image_tmp, $image_path)) {
                $image_uri = "/files/$image_name";
                $insert_command = "INSERT INTO `posts` (`post_text`, `multiple_images`,`image_uri`, `uploaded_time`, `owner`) VALUES ('$text', 0, '$image_uri', now(), '$owner')";
                if ($db->query($insert_command)) {
                    $id = mysqli_insert_id($db);
                    return new Post($id);
                } else {
                    return false;
                }
            } else {
                throw new Exception("Can't move the uploaded file");
            }
        } else {
            throw new Exception("Image not uploaded");
        }
    }
    
    /**
     * Register the multiple images for a single post
     */
    private static function registerMultiplePost(array|string $postImage, string $postText) {
        $db = Database::getConnection();
        $owner = Session::getUser()->getUsername();
        $text = mysqli_real_escape_string($db, $postText);
        
        $insert_posts = "INSERT INTO `posts` (`post_text`, `multiple_images`,`image_uri`, `uploaded_time`, `owner`) VALUES ('$text', 1, '0', now(), '$owner')";
        
        if ($db->query($insert_posts)) {
            $pid = mysqli_insert_id($db);
            foreach ($postImage as $image_tmp) {
                $image_name = md5($owner.time()) . image_type_to_extension(exif_imagetype($image_tmp));
                $image_path = APP_POST_UPLOAD_PATH.$image_name;
    
                if (move_uploaded_file($image_tmp, $image_path)) {
                    $image_uri = "/files/$image_name";
                    $insert_multiple = "INSERT INTO `post_images` (`post_id`, `image_uri`) VALUES ('$pid', '$image_uri');";
                    if ($db->query($insert_multiple)) {
                        continue;
                    } else {
                        throw new Exception("Can't insert the query in post_images table!");
                    }
                } else {
                    throw new Exception("Can't move the uploaded file $image_tmp");
                }
            }
        } else {
            throw new Exception("Can't run the main query!");
        }
    }
    
    /**
     * This will create a post for either single or multiple images.
     */
    public static function createPost(array $image, string $text)
    {
        // Get the count of images
        $fileCount = count($image['tmp_name']);
        $image_tmp = $image['tmp_name'];

        if ($fileCount > 1) {
            self::registerMultiplePost($image_tmp, $text);
        } else {
            self::registerSinglePost($image_tmp, $text);
        }
    }

    /**
     * Check if the post has multiple images or not
     */
    public function hasMultipleImages($pid)
    {
        $sql = "SELECT multiple_images FROM posts WHERE id = '$pid'";
        $result = $this->conn->query($sql);
        
        if ($result && $result->num_rows == 1) {
            $row = $result->fetch_assoc();
            return $row['multiple_images'] == 1;
        }
        
        return false;
    }

    /**
     * Get the multiple images of the post 
     */
    public function getMultipleImages($pid)
    {
        $sql = "SELECT image_uri FROM post_images WHERE post_id = '$pid'";
        $result = $this->conn->query($sql);

        $images = [];

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $images[] = $row['image_uri'];
            }
        }

        return $images;
    }
    
    /**
     * Delete the post image from storage 
     */
    private function deletePostImage()
    {
        try {
            $image_name = basename($this->getImageUri());
            $image_path = APP_POST_UPLOAD_PATH.$image_name;
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

    /**
     * It removes the image in storage and the DB entry
     */
    public function deletePost()
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

    /**
     * Dump all posts from database
     */
    public static function getAllPosts()
    {
        $db = Database::getConnection();
        $sql = "SELECT * FROM `posts` ORDER BY `uploaded_time` DESC";
        $result = $db->query($sql);
        return iterator_to_array($result);
    }

    /**
     * Count all posts from database
     */
    public static function countAllPosts()
    {
        $db = Database::getConnection();
        $sql = "SELECT COUNT(*) as count FROM `posts` ORDER BY `uploaded_time` DESC";
        $result = $db->query($sql);
        return iterator_to_array($result);
    }

    /**
     * Dump only the user's posts from database
     */
    public static function getUserPosts($user)
    {
        $db = Database::getConnection();
        $sql = "SELECT * FROM `posts` WHERE `owner` = '$user' ORDER BY `uploaded_time` DESC";
        $result = $db->query($sql);
        return iterator_to_array($result);
    }

    /**
     * Count only the user's posts from database
     */
    public static function countUserPosts($user)
    {
        $db = Database::getConnection();
        $sql = "SELECT COUNT(*) as count FROM `posts` WHERE `owner` = '$user' ORDER BY `uploaded_time` DESC";
        $result = $db->query($sql);
        return iterator_to_array($result);
    }
}
