<?php

include_once __DIR__ . "/../traits/SQLGetterSetter.trait.php";

class Post {
    private $conn;
    public $username, $id, $table;

    use SQLGetterSetter;

    public static function registerPost($image_tmp, $text){
        if (is_file($image_tmp) and exif_imagetype($image_tmp) !== false) {
            $owner = Session::get('session_UsernameorEmail');
            $image_name = md5($owner.time()) . image_type_to_extension(exif_imagetype($image_tmp));
            $image_path = get_config('upload_path').$image_name;
            if (move_uploaded_file($image_tmp, $image_path)) {
                $image_uri = "/images/$image_name";
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

    public function __construct($id){
        if (!$this->conn) {
            $this->conn = Database::getConnection();
        }
        $this->id = $id;
        $this->table = 'posts';
    }
}