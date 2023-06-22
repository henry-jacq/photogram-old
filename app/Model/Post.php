<?php

namespace App\Model;

use Exception;
use App\Core\Session;
use App\Core\Database;
use App\Traits\SQLGetterSetter;

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
            $image_path = APP_STORAGE_PATH. '/posts/' .$image_name;
            if (move_uploaded_file($image_tmp, $image_path)) {
                $image_uri = "/files/posts/$image_name";
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
                $image_name = md5($owner.mt_rand(0, 9999)) . image_type_to_extension(exif_imagetype($image_tmp));
                $image_path = APP_STORAGE_PATH. '/posts/' .$image_name;
                if (move_uploaded_file($image_tmp, $image_path)) {
                    $image_uri = "/files/posts/$image_name";
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

        // If text exists and exceed the character limit
        if (!empty($text) && strlen($text) >= 240) {
            throw new Exception('Exceeded the Text limit 240');
        }

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
     * Deletes the single post image from storage
     */
    private function purgeSingleImage()
    {
        try {
            $image_name = basename($this->getImageUri());
            $image_path = APP_STORAGE_PATH. '/posts/' .$image_name;
            if (file_exists($image_path)) {
                if (unlink($image_path)) {
                    return true;
                } else {
                    throw new Exception(__CLASS__."::".__FUNCTION__.", can't purge single post image. Image path: $image_path");
                }
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * Delete multiple post images from storage
     */
    private function purgeMultipleImages()
    {
        try {
            $sql = "SELECT image_uri FROM post_images WHERE post_id = '$this->id'";
            $result = $this->conn->query($sql);

            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $images[] = basename($row['image_uri']);
                }
            }

            foreach ($images as $image_name) {
                $image_path = APP_STORAGE_PATH. '/posts/' .$image_name;
                if (file_exists($image_path)) {
                    if (unlink($image_path)) {
                        continue;
                    } else {
                        throw new Exception(__CLASS__."::".__FUNCTION__.", can't purge multiple post images. Image path: $image_path");
                    }
                }
            }
            return true;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
    
    /**
     * It removes the image in storage and the DB entry
     */
    public function deleteSinglePostImage()
    {
        if (!$this->conn) {
            $this->conn = Database::getConnection();
        }

        try {
            if ($this->purgeSingleImage()) {
                $sql = "DELETE FROM `$this->table` WHERE `id`=$this->id;";
                if ($this->conn->query($sql)) {
                    return true;
                } else {
                    return false;
                }
            }
        } catch (Exception $e) {
            throw new Exception(__CLASS__."::deleteSinglePostImage, can't remove single post image. Kindly check the storage folder permissions.");
        }
    }

    /**
     * It removes the multiple images in storage and the DB entry
     */
    public function deleteMultiplePostImages()
    {
        if (!$this->conn) {
            $this->conn = Database::getConnection();
        }

        try {
            if ($this->purgeMultipleImages()) {
                $sql = "DELETE FROM `$this->table` WHERE `id`=$this->id;";
                if ($this->conn->query($sql)) {
                    return true;
                } else {
                    return false;
                }
            }
        } catch (Exception $e) {
            throw new Exception(__CLASS__."::deleteMultiplePostImages, can't remove multiple post images.");
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

    /**
     * Get the user job
     */
    public function getUserJob()
    {
        $user_id = $this->getUserId($this->getOwner());
        $sql = "SELECT `id`, `job` FROM `users` WHERE `id` = '$user_id';";
        $conn = Database::getConnection();
        $result = $conn->query($sql);

        if ($result && $result->num_rows == 1) {
            $row = $result->fetch_assoc();
            if ($row['id'] === $user_id && $row['job'] != 'None') {
                return $row['job'];
            }
        } else {
            return false;
        }
    }

    /**
     * Get the user avatar
     */
    public function getAvatar()
    {
        $user_id = $this->getUserId($this->getOwner());
        $url = "https://api.dicebear.com/6.x/shapes/svg?seed=";
        $sql = "SELECT `avatar` FROM `users` WHERE `id` = '$user_id';";
        $result = $this->conn->query($sql);
        if ($result && $result->num_rows == 1) {
            $row = $result->fetch_assoc();
            if (empty($row['avatar']) || is_null($row['avatar'])) {
                return $url.$user_id;
            } else {
                return $row['avatar'];
            }
        } else {
            return $url.$user_id;
        }
    }
}
