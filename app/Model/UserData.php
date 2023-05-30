<?php

namespace App\Model;

use Exception;
use App\Core\Database;
use App\Core\Session;
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

    public function setAvatar(string $image_tmp)
    {
        $image_tmp = $this->escapeString($image_tmp);
        
        if (is_file($image_tmp) and exif_imagetype($image_tmp) !== false) {
            $owner = Session::getUser()->getUsername();
            $image_name = md5($owner.mt_rand(0, 9999)) . image_type_to_extension(exif_imagetype($image_tmp));
            $image_path = APP_STORAGE_PATH . '/avatars/' .$image_name;
            if (move_uploaded_file($image_tmp, $image_path)) {
                $image_uri = "/files/avatars/$image_name";
                $sql = "UPDATE `$this->table` SET `avatar` = '$image_uri' WHERE `uid` = '$this->id';";
                if ($this->conn->query($sql)) {
                    return true;
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
    
    public function getUserAvatar(string $owner)
    {
        $current_user = Session::getUser()->getUsername();
        $url = "https://api.dicebear.com/6.x/shapes/svg?seed=";
        if ($owner !== $current_user) {
            return $url.$owner;
        } else if (!empty($this->getAvatar())) {
            return $this->getAvatar();
        } else {
            return $url.$current_user;
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
        
        $sql = "INSERT INTO `$this->table` (`uid`, `first_name`, `last_name`, `bio`, `job`, `sec_email`, `location`, `twitter`, `instagram`) VALUES ('$this->id', '$fname', '$lname', '$bio', '$job', '$email', '$lc', '$tw', '$ig');";

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

        $sql = "UPDATE `$this->table` SET `first_name` = '$fname', `last_name` = '$lname', `sec_email` = '$email', `job` = '$job', `bio` = '$bio', `location` = '$lc', `twitter` = '$tw', `instagram` = '$ig' WHERE `uid` = '$this->id';";

        try {
            $this->conn->query($sql);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function exists()
    {
        $sql = "SELECT * FROM `$this->table` WHERE `uid` = '$this->id';";

        $result = $this->conn->query($sql);
        if ($result->num_rows == 1) {
            return true;
        } else {
            return false;
        }
    }
}