<?php

namespace App\Model;

use \Exception;
use App\Core\Database;
use App\Core\Session;
use Carbon\Carbon;

class Comment
{
    /**
     * Create a new comment
     */
    public static function postComment(int $pid, string $comment)
    {
        $conn = Database::getConnection();
        $comment = mysqli_real_escape_string($conn, $comment);
        $comment = htmlspecialchars($comment);
        $uid = Session::getUser()->getID();
        $id = md5($uid . $pid . microtime() . mt_rand(0, 999999999));

        // If text exists and exceed the character limit
        if (!empty($comment) && strlen($comment) >= 45) {
            throw new Exception('Exceeded the character limit 45');
        }

        $sql = "INSERT INTO `comments` (`id`, `uid`, `pid`, `comment`, `timestamp`) VALUES ('$id', '$uid', '$pid', '$comment', now())";
        if ($conn->query($sql)) {
            return $id;
        } else {
            throw new Exception("Unable to create comment entry");
        }
    }

    /**
     * Delete a comment
     */
    public static function deleteComment(string $comment_id)
    {
        $conn = Database::getConnection();
        $sess_uid = Session::getUser()->getID();

        $sql1 = "SELECT `uid` FROM `comments` WHERE `id` = '$comment_id';";
        $sql = "DELETE FROM `comments` WHERE `id` = '$comment_id'";
        $result = $conn->query($sql1);

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $db_uid = $row['uid'];
            // Check if comment's user ID equals to session user ID
            if ($sess_uid == $db_uid) {
                if ($conn->query($sql)) {
                    return true;
                } else {
                    throw new Exception("Unable to delete comment");
                }
            } else {
                return false;
            }
        } else {
            throw new Exception("Unable to find comment.");
        }
        
    }

    /**
     * Format timestamp for comments.
     */
    protected static function formatTimestamp($timestamp)
    {
        $uploaded_time = Carbon::parse($timestamp);
        $uploaded_time_str = $uploaded_time->diffForHumans(); 
        return $uploaded_time_str;
    }

    /**
     * Fetch comments for the post.
     */
    public static function fetchComments(int $pid)
    {
        $conn = Database::getConnection();
        $sql = "SELECT * FROM `comments` WHERE `pid` = '$pid'  ORDER BY `timestamp` DESC LIMIT 50";
        $result = $conn->query($sql);
        $data = [];

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $commentData = array(
                    'comment_id' => $row['id'],
                    'user_id' => $row['uid'],
                    'comment' => htmlspecialchars_decode($row['comment']),
                    'timestamp' => self::formatTimestamp($row['timestamp'])
                );
                $data[] = $commentData;
            }
        }
        return $data;
    }
}