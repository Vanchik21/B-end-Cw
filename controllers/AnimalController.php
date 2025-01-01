<?php

namespace controllers;

use core\Controller;
use models\Animal;
use models\Users;

class AnimalController extends Controller
{
    public function actionIndex()
    {
        $animals = Animal::getAllAnimals();
        return $this->render(null, ['animals' => $animals]);
    }

    public function actionAdd()
    {
        if (!Users::isAdmin()) {
            $this->addErrorMessage('У вас не достатньо прав');
            return $this->redirect('/users/login');
        }

        $model = [
            'name' => '',
            'species' => '',
            'description' => '',
        ];

        if ($this->isPost) {
            $errors = [];
            $model = $_POST;

            if (empty($model['name'])) {
                $errors['name'] = 'Ім`я обов`язково';
            }
            if (empty($model['species'])) {
                $errors['species'] = 'Вид обов`язково';
            }
            if (empty($model['description'])) {
                $errors['description'] = 'Опис обов`язково';
            }
            if (empty($_FILES['file']['name'])) {
                $errors['file'] = 'Фото обов`язково';
            }

            if (count($errors) > 0) {
                return $this->render(null, [
                    'errors' => $errors,
                    'model' => $model
                ]);
            } else {
                try {
                    Animal::addAnimal($model['name'], $model['species'], $model['description'], $_FILES['file']);
                    return $this->redirect('/animal');
                } catch (\Exception $e) {
                    $errors['image'] = $e->getMessage();
                    return $this->render(null, [
                        'errors' => $errors,
                        'model' => $model
                    ]);
                }
            }
        }

        return $this->render(null, ['model' => $model]);
    }

    public function actionDelete($params)
    {
        $id = intval($params[0]);
        $confirm = isset($params[1]) && $params[1] === 'yes';

        if (!Users::isAdmin()) {
            $this->addErrorMessage('У вас не достатньо прав');
            return $this->redirect('/users/login');
        }

        if ($id > 0) {
            $animal = Animal::getAnimalById($id);
            if (!$animal) {
                $this->addErrorMessage('Тварина не знайдена');
                return $this->render();
            }

            if ($confirm) {
                $filePath = 'files/animals/' . $animal['image'];
                if (is_file($filePath)) {
                    unlink($filePath);
                }
                Animal::deleteAnimal($id);
                return $this->redirect('/animal');
            }

            return $this->render(null, ['animal' => $animal]);
        } else {
            $this->addErrorMessage('Неправильний ID');
            return $this->render();
        }
    }

    public function actionEdit($params)
    {
        $id = intval($params[0]);

        if (!Users::isAdmin()) {
            $this->addErrorMessage('У вас не достатньо прав');
            return $this->redirect('/users/login');
        }

        if ($id > 0) {
            $animal = Animal::getAnimalById($id);
            if (!$animal) {
                $this->addErrorMessage('Тварину не знайдено');
                return $this->render();
            }

            if ($this->isPost) {
                $errors = [];
                $model = $_POST;

                if (empty($model['name'])) {
                    $errors['name'] = 'Ім`я обов`язково';
                }
                if (empty($model['species'])) {
                    $errors['species'] = 'Вид обов`язково';
                }
                if (empty($model['description'])) {
                    $errors['description'] = 'Опис обов`язково';
                }

                if (count($errors) > 0) {
                    return $this->render(null, [
                        'errors' => $errors,
                        'model' => $model,
                        'animal' => $animal
                    ]);
                } else {
                    Animal::updateAnimal($id, $model);

                    if (!empty($_FILES['file']['tmp_name'])) {
                        try {
                            Animal::changeImage($id, $_FILES['file']);
                        } catch (\Exception $e) {
                            $errors['image'] = $e->getMessage();
                            return $this->render(null, [
                                'errors' => $errors,
                                'model' => $model,
                                'animal' => $animal
                            ]);
                        }
                    }

                    return $this->redirect('/animal');
                }
            }

            return $this->render(null, [
                'animal' => $animal,
                'model' => $animal
            ]);
        } else {
            $this->addErrorMessage('Неправильний ID');
            return $this->render();
        }
    }
    public function actionView($params)
    {
        $id = intval($params[0]);
        $animals = Animal::getAnimalById($id);
        return $this->render(null, [
            'animals' => [$animals],
        ]);
    }

    public function actionSort($params)
    {
        $field = $params[0];
        $animals = Animal::getSortedAnimals($field);
        return $this->render('views/animal/index.php', ['animals' => $animals]);
    }
}
