<?php

namespace models;

use core\Model;

/**
 * @property int $id ID коментаря
 * @property int $news_id ID новини
 * @property int $user_id ID користувача
 * @property string $content Текст коментаря
 * @property string $created_at Дата створення коментаря
 */
class Comment extends Model
{
    public static $tableName = 'comments';
    public static function getCommentsByNewsId($news_id)
    {
        $comments = self::findByCondition(['news_id' => $news_id]);

        if ($comments === null) {
            $comments = [];
        }

        foreach ($comments as &$comment) {
            $comment['username'] = Users::getUsernameById($comment['user_id']);
        }

        return $comments;
    }

    public static function addComment($news_id, $user_id, $content)
    {
        $comment = new self();
        $comment->news_id = $news_id;
        $comment->user_id = $user_id;
        $comment->content = $content;
        $comment->save();
    }
    public static function deleteComment($id)
    {
        self::deleteById($id);
    }

    public static function findCommentById($id)
    {
        return self::findById($id);
    }
}