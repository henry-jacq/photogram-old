<?php

namespace App\Model;

use \Exception;
use App\Core\Database;
use App\Core\Session;
use App\Traits\SQLGetterSetter;

/**
 * Follow users
 */
class Follow
{
    use SQLGetterSetter;
    public $conn;
    public $table;
    public $id;
    public $user_id;
    public $follow_id;

    public function __construct(int $uid, int $follow_id)
    {
        $this->conn = Database::getConnection();
        $this->table = 'follows';
        $this->user_id = $uid;
        $this->follow_id = $follow_id;
        $this->id = md5($this->user_id . '-' . $this->follow_id);

        $query = "SELECT * FROM `$this->table` WHERE `user_id` = '$this->user_id' AND `follower_id` = '$this->follow_id'";

        $result = $this->conn->query($query);
        if ($result->num_rows !== 1) {
            $insert_query = "INSERT INTO `$this->table` (`id`, `user_id`, `follower_id`, `follow`, `timestamp`)
            VALUES ('$this->id', '$this->user_id', '$this->follow_id', 0, now())";
            if (!$this->conn->query($insert_query)) {
                throw new Exception("Unable to insert follow data");
            }
        }
    }

    /**
     * Toggle follow status
     */
    public function toggleFollow()
    {
        if (boolval($this->getFollow()) == true) {
            $this->setFollow(0);
        } else {
            $this->setFollow(1);
        }
    }

    /**
     * Return bool value that the user is following or not.
     */
    public function isFollowing(): bool
    {
        if ($this->getFollow() == 1) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Return a bool value for the user that is following or not
     */
    public static function isUserFollowing(int $uid, int $fid)
    {
        $query = "SELECT `follow` FROM `follows` WHERE `user_id` = '$uid' AND `follower_id` = '$fid'";

        $conn = Database::getConnection();
        $result = $conn->query($query);

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            if ($row['follow'] == 1) {
                return true;
            } else {
                return false;
            }
        }
    }

    /**
     * Return followers count of the user
     */
    public static function getFollowersCount(int $uid)
    {
        $conn = Database::getConnection();
        $query = "SELECT COUNT(`follower_id`) as followers FROM `follows` WHERE `follower_id` = '$uid' AND `follow` = 1";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        return $row['followers'];
    }

    /**
     * Return followings count of the user
     */
    public static function getFollowingCount(int $uid)
    {
        $db = Database::getConnection();
        $sql = "SELECT COUNT(*) as followings FROM `follows` WHERE `follow` = 1 AND `user_id` = '$uid' AND `follow` = 1;";
        $result = $db->query($sql);
        $row = $result->fetch_assoc();
        return $row['followings'];
    }
}