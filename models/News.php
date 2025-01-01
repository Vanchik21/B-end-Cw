<?php

namespace models;

use core\Model;

/**
 * @property int $id ID новини
 * @property string $title Заголовок новини
 * @property string $content Опис новини
 * @property string $image Фото новини
 */
class News extends Model
{
    public static $tableName = 'news';

    public static function addNews($title, $content, $image)
    {
        $news = new News();
        $news->title = $title;
        $news->content = $content;

        if ($image['error'] === UPLOAD_ERR_OK) {
            $fileName = basename($image['name']);
            $tmpFilePath = $image['tmp_name'];
            $newPath = "files/news/{$fileName}";
            if (move_uploaded_file($tmpFilePath, $newPath)) {
                $news->image = $fileName;
            } else {
                throw new \Exception('Помилка завантаження файлу');
            }
        }

        $news->save();
    }

    public static function changeImage($id, $newImage)
    {
        $news = self::findById($id);

        if (is_array($news)) {
            $news = (object)$news;
        }

        if ($news) {
            if ($newImage['error'] === UPLOAD_ERR_OK) {
                $fileName = basename($newImage['name']);
                $tmpFilePath = $newImage['tmp_name'];
                $newPath = "files/news/{$fileName}";
                if (move_uploaded_file($tmpFilePath, $newPath)) {
                    $news->photo = $fileName;
                    self::updateNews($id, ['image' => $fileName]);
                    return $fileName;
                } else {
                    throw new \Exception('Помилка завантаження файлу');
                }
            } else {
                throw new \Exception('Помилка завантаження файлу');
            }
        } else {
            throw new \Exception('Новину не знайдено');
        }
    }

    public static function getNewsById($id)
    {
        $row = self::findById($id);
        return $row ? $row : null;
    }

    public static function deleteNews($id)
    {
        self::deleteById($id);
    }

    public static function doesNewsExist($title): bool
    {
        $result = self::findByCondition(['title' => $title]);
        return !empty($result);
    }

    public static function updateNews($id, $fields)
    {
        self::update($id, $fields);
    }

    public static function getAllNews()
    {
        return self::findAll();
    }

    public static function getSortedNews($orderBy, $direction = 'DESC')
    {
        return self::sortedSome($orderBy, $direction);
    }
}
