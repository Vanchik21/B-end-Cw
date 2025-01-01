<?php

namespace models;

use core\Model;
/**
 *
 * @param string $title Назва події.
 * @param string $description Опис події.
 * @param string $event_date Дата події.
 * @param string $time Час події.
 * @param array $image Масив з інформацією про завантажене зображення.
 */

class Event extends Model
{
    public static $tableName = 'events';

    public static function addEvent($title, $description, $event_date, $time, $image)
    {
        $event = new Event();
        $event->title = $title;
        $event->description = $description;
        $event->event_date = $event_date;
        $event->time = $time;

        if ($image['error'] === UPLOAD_ERR_OK) {
            $fileName = uniqid() . '_' . basename($image['name']);
            $tmpFilePath = $image['tmp_name'];
            $newPath = "files/events/{$fileName}";
            if (move_uploaded_file($tmpFilePath, $newPath)) {
                $event->image = $fileName;
            } else {
                throw new \Exception('Помилка завантаження файлу');
            }
        } else {
            throw new \Exception('Помилка завантаження файлу');
        }

        $event->save();
    }

    public static function changeImage($id, $newImage)
    {
        $event = self::findById($id);

        if (is_array($event)) {
            $event = (object)$event;
        }

        if ($event) {
            if ($newImage['error'] === UPLOAD_ERR_OK) {
                $fileName = uniqid() . '_' . basename($newImage['name']);
                $tmpFilePath = $newImage['tmp_name'];
                $newPath = "files/events/{$fileName}";
                if (move_uploaded_file($tmpFilePath, $newPath)) {
                    $event->image = $fileName;
                    self::updateEvent($id, ['image' => $fileName]);
                    return $fileName;
                } else {
                    throw new \Exception('Помилка завантаження файлу');
                }
            } else {
                throw new \Exception('Помилка завантаження файлу');
            }
        } else {
            throw new \Exception('Подію не знайдено');
        }
    }

    public static function getEventById($id)
    {
        $row = self::findById($id);
        return $row ? $row : null;
    }

    public static function deleteEvent($id)
    {
        $event = self::getEventById($id);
        if ($event && !empty($event['image'])) {
            $filePath = "files/events/{$event['image']}";
            if (is_file($filePath)) {
                unlink($filePath);
            }
        }

        self::deleteById($id);
    }

    public static function doesEventExist($title): bool
    {
        $result = self::findByCondition(['title' => $title]);
        return !empty($result);
    }

    public static function updateEvent($id, $fields)
    {
        self::update($id, $fields);
    }

    public static function getAllEvents()
    {
        return self::findAll();
    }

    public static function getSortedEvents($orderBy, $direction = 'DESC')
    {
        return self::sortedSome($orderBy, $direction);
    }
}
