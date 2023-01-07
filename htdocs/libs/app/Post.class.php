<?php

include_once __DIR__ . "/../traits/SQLGetterSetter.trait.php";

class Post {
    private $conn;
    public $username, $id, $table;

    use SQLGetterSetter;

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

    public function __construct($id){
        if (!$this->conn) {
            $this->conn = Database::getConnection();
        }
        $this->id = $id;
        $this->table = 'posts';
    }
}