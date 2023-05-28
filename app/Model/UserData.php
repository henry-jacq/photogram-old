<?php

namespace App\Model;

use Exception;
use App\Core\Database;
use App\Traits\SQLGetterSetter;

class UserData {

    public $uid;
    public $conn;
    public $id;
    public $table;
    public $username;
    use SQLGetterSetter;
    
    public function __construct(object $user)
    {
        if (!$this->conn) {
            $this->conn = Database::getConnection();
        }
        $this->id = $user->getID();
        $this->table = 'users';
        $this->username = $user->getUsername();
    }

    private function escapeString($value)
    {
        return mysqli_real_escape_string($this->conn, $value);
    }

    private function saveProfile(array|string $image_tmp) {
        $image_tmp = $image_tmp[0];
        $db = $this->conn;
        
        if (is_file($image_tmp) and exif_imagetype($image_tmp) !== false) {
            $owner = $this->username;
            $image_name = md5($owner.time()) . image_type_to_extension(exif_imagetype($image_tmp));
            $image_path = APP_POST_UPLOAD_PATH.$image_name;
            if (move_uploaded_file($image_tmp, $image_path)) {
                $image_uri = "/files/profile/$image_name";
                return $image_uri;
            } else {
                throw new Exception("Can't move the uploaded file");
            }
        } else {
            throw new Exception("Profile not updated");
        }
    }
    
    public function create(string $fname, string $lname, string $email, string $job, string $bio, string $location, string $tw, string $ig)
    {
        $fname = $this->escapeString($fname);
        $lname = $this->escapeString($lname);
        $bio = $this->escapeString($bio);
        $job = $this->escapeString($job);
        $lc = $this->escapeString($location);
        $tw = $this->escapeString($tw);
        $ig = $this->escapeString($ig);
        $email = $this->escapeString($email);
        
        $sql = "INSERT INTO `users` (`uid`, `first_name`, `last_name`, `bio`, `job`, `sec_email`, `location`, `twitter`, `instagram`) VALUES ('$this->id', '$fname', '$lname', '$bio', '$job', '$email', '$lc', '$tw', '$ig');";

        try {
            $this->conn->query($sql);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function update(string $fname, string $lname, string $email, string $job, string $bio, string $location, string $tw, string $ig)
    {
        $fname = $this->escapeString($fname);
        $lname = $this->escapeString($lname);
        $bio = $this->escapeString($bio);
        $job = $this->escapeString($job);
        $lc = $this->escapeString($location);
        $tw = $this->escapeString($tw);
        $ig = $this->escapeString($ig);
        $email = $this->escapeString($email);

        $sql = "UPDATE `users` SET `first_name` = '$fname', `last_name` = '$lname', `sec_email` = '$email', `job` = '$job', `bio` = '$bio', `location` = '$lc', `twitter` = '$tw', `instagram` = '$ig' WHERE `uid` = '$this->id';";

        try {
            $this->conn->query($sql);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function exists()
    {
        $sql = "SELECT * FROM `users` WHERE `uid` = '$this->id';";

        $result = $this->conn->query($sql);
        if ($result->num_rows == 1) {
            return true;
        } else {
            return false;
        }
    }
}