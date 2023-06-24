<?php

namespace App\Model;

use \Exception;
use App\Core\Session;
use App\Core\Database;
use App\Model\Post;
use App\Traits\SQLGetterSetter;

class Like
{
    use SQLGetterSetter;
    public $conn;
    public $table;
    public $id;
    public $data;

    public function __construct(Post $post)
    {
        if (!$this->conn) {
            $this->conn = Database::getConnection();
        }
        $this->data = null;
        $this->table = 'likes';
        $post_id = $post->getID();
        $user_id = Session::getUser()->getID();
        $this->id = md5($user_id . "-" . $post_id);

        $query = "SELECT * FROM `likes` WHERE `id` = '$this->id'";

        $result = $this->conn->query($query);
        if ($result->num_rows != 1) {
            $query = "INSERT INTO `likes` (`id`, `uid`, `pid`, `like`, `timestamp`)
            VALUES ('$this->id', '$user_id', '$post_id', 0, now())";
            $result = $this->conn->query($query);
            if (!$result) {
                throw new Exception("Unable to create like entry");
            }
        }
    }

    /**
     * It will toggle the value to either 0 or 1.
     */
    public function toggleLike()
    {
        $liked = $this->getLike();
        if (boolval($liked) == true) {
            $this->setLike(0);
        } else {
            $this->setLike(1);
        }
    }

    /**
     * It returns true. if the post is liked; otherwise, it returns false.
     */
    public function isLiked(): bool
    {
        if ($this->getLike() == 1) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * It will return the total likes of the post
     */
    public static function getLikeCount(int $id): int
    {
        $conn = Database::getConnection();
        $query = "SELECT `like` FROM `likes` WHERE `pid` = '$id'";
        $result = $conn->query($query);
        $like_count = 0;

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $like_count += (int) $row['like'];
            }
            return $like_count;
        } else {
            return 0;
        }
    }

    /**
     * It will returns true, if the user liked the post. Otherwise it returns false
     */
    public static function isUserLiked(int $post_id)
    {
        $user_id = Session::getUser()->getID();
        $post_id = $post_id;
        $query = "SELECT `like` FROM `likes` WHERE `pid` = '$post_id' AND `uid` = '$user_id'";

        $conn = Database::getConnection();
        $result = $conn->query($query);

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            if ($row['like'] == 1){
                return true;
            } else {
                return false;
            }
        }
    }

    /**
     * Count likes from database
     * 
     * If the UID is passed, then the likes count for the UID is returned; otherwise, the total likes count is returned.
     */
    public static function countLikes(int $uid = null)
    {
        $db = Database::getConnection();
        if ($uid == null) {
            $sql = "SELECT COUNT(*) as count FROM `likes` WHERE `like` = 1;";
        } else {
            $sql = "SELECT COUNT(*) as count FROM `likes` WHERE `like` = 1 AND `uid` = '$uid';";
        }
        $result = $db->query($sql);
        return iterator_to_array($result);
    }
}
