<?php

class Post {
    private $conn;
    public $username, $id, $table;

    public static function registerPost($image_tmp, $text){
        if (isset($_FILES['post_image'])) {
            $owner = Session::getUser();
            $image_name = md5($owner.time()) . ".jpg"; #TODO: Change ID gen algo
            $image_path = get_config('upload_path').$image_name;
            if (move_uploaded_file($image_tmp, $image_path)) {
                $insert_command = "INSERT INTO `posts` (`post_text`, `image_uri`, `like_count`, `uploaded_time`, `owner`) VALUES ('$text', 'https://i.pinimg.com/236x/80/bc/4f/80bc4fe847d7d9b97379e7d09951c296--headshot-poses-actor-headshots.jpg', '0', now(), '$owner')";
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

    public function __call($name, $arguments) {
        $property = preg_replace("/[^0-9a-zA-Z]/", "", substr($name, 3));
        $property = strtolower(preg_replace('/\B([A-Z])/', '_$1', $property));
        if (substr($name, 0, 3) == "get") {
            return $this->_get_data($property);
        } elseif (substr($name, 0, 3) == "set") {
            return $this->_set_data($property, $arguments[0]);
        } else {
            // This for ease of debugging.
            throw new Exception("Post::__call() -> $name, function is unavailable.");
        }
    }

    public function __construct($id){
        if (!$this->conn) {
            $this->conn = Database::getConnection();
        }
        $this->id = $id;
        $this->table = 'posts';
    }

    // It is used to retrieve data from the database
    private function _get_data($var) {
        // Create a connection, if it doesn't exist
        if (!$this->conn) {
            $this->conn = Database::getConnection();
        }
        // Query to get data from users table
        $sql = "SELECT `$var` FROM `$this->table` WHERE `id` = $this->id";
        $result = $this->conn->query($sql);
        if ($result and $result->num_rows == 1) {
            return $result->fetch_assoc()["$var"];
        } else {
            return null;
        }
    }

    // It used to set the data in the database
    private function _set_data($var, $data) {
        // Create a connection, if it doesn't exist
        if (!$this->conn) {
            $this->conn = Database::getConnection();
        }
        // Query to update the data in users table
        $sql = "UPDATE `$this->table` SET `$var`='$data' WHERE `id`=$this->id;";
        if ($this->conn->query($sql)) {
            return true;
        } else {
            return false;
        }
    }
}