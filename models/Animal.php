<?php

namespace models;

use core\Model;

/**
 * @property int $id ID тварини
 * @property string $name Назва тварини
 * @property string $species Вид тварини
 * @property string $description Опис тварини
 * @property string $image Зображення тварини
 */
class Animal extends Model
{
    public static $tableName = 'animals';

    public static function addAnimal($name, $species, $description, $image)
    {
        $animal = new Animal();
        $animal->name = $name;
        $animal->species = $species;
        $animal->description = $description;

        if ($image['error'] === UPLOAD_ERR_OK) {
            $fileName = uniqid() . '_' . basename($image['name']);
            $tmpFilePath = $image['tmp_name'];
            $newPath = "files/animals/{$fileName}";
            if (move_uploaded_file($tmpFilePath, $newPath)) {
                $animal->image = $fileName;
            } else {
                throw new \Exception('Помилка завантаження файлу');
            }
        } else {
            throw new \Exception('Помилка завантаження файлу');
        }

        $animal->save();
    }

    public static function changeImage($id, $newImage)
    {
        $animal = self::findById($id);

        if (is_array($animal)) {
            $animal = (object)$animal;
        }

        if ($animal) {
            if ($newImage['error'] === UPLOAD_ERR_OK) {
                $fileName = uniqid() . '_' . basename($newImage['name']);
                $tmpFilePath = $newImage['tmp_name'];
                $newPath = "files/animals/{$fileName}";
                if (move_uploaded_file($tmpFilePath, $newPath)) {
                    $animal->image = $fileName;
                    self::updateAnimal($id, ['image' => $fileName]);
                    return $fileName;
                } else {
                    throw new \Exception('Помилка завантаження файлу');
                }
            } else {
                throw new \Exception('Помилка завантаження файлу');
            }
        } else {
            throw new \Exception('Тварину не знайдено');
        }
    }

    public static function getAnimalById($id)
    {
        $row = self::findById($id);
        return $row ? $row : null;
    }

    public static function deleteAnimal($id)
    {
        $animal = self::findById($id);

        if ($animal && isset($animal['image'])) {
            $filePath = "files/animals/{$animal['image']}";
            if (is_file($filePath)) {
                unlink($filePath);
            }
        }

        self::deleteById($id);
    }

    public static function updateAnimal($id, $fields)
    {
        self::update($id, $fields);
    }

    public static function getAllAnimals()
    {
        return self::findAll();
    }

    public static function getSortedAnimals($orderBy, $direction = 'DESC')
    {
        return self::sortedSome($orderBy, $direction);
    }
}
