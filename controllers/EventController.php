<?php

namespace controllers;

use core\Controller;
use models\Event;
use models\Users;

class EventController extends Controller
{
    public function actionIndex()
    {
        $rows = Event::getAllEvents();
        return $this->render(null, ['rows' => $rows]);
    }

    public function actionAdd()
    {
        if (!Users::isAdmin()) {
            $this->addErrorMessage('У вас не достатньо прав');
            return $this->redirect('/users/login');
        }

        $model = [
            'title' => '',
            'description' => '',
            'event_date' => '',
            'time' => '',
            'image' => ''
        ];

        if ($this->isPost) {
            $errors = [];
            $model = $_POST;

            if (Event::doesEventExist($_POST['title'])) {
                $errors['title'] = "Назва події вже існує";
            }
            if (empty($_POST['title'])) {
                $errors['title'] = 'Заголовок обов`язково';
            }
            if (empty($_POST['description'])) {
                $errors['description'] = 'Опис обов`язково';
            }
            if (empty($_POST['event_date'])) {
                $errors['event_date'] = 'Дата date обов`язково';
            }
            if (empty($_POST['time'])) {
                $errors['time'] = 'Час обов`язково';
            }
            if (empty($_FILES['image']['name'])) {
                $errors['image'] = 'Фото обов`язково';
            }

            if (count($errors) > 0) {
                return $this->render(null, [
                    'errors' => $errors,
                    'model' => $model
                ]);
            } else {
                try {
                    Event::addEvent($_POST['title'], $_POST['description'], $_POST['event_date'], $_POST['time'], $_FILES['image']);
                    return $this->redirect('/event');
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
        $yes = isset($params[1]) && $params[1] === 'yes';

        if (!Users::isAdmin()) {
            $this->addErrorMessage('У вас не достатньо прав');
            return $this->redirect('/users/login');
        }

        if ($id > 0) {
            $event = Event::getEventById($id);
            if (!$event) {
                $this->addErrorMessage('Подію не знайдено');
                return $this->render();
            }

            if ($yes) {
                $filePath = 'files/events/' . $event['image'];
                if (is_file($filePath)) {
                    unlink($filePath);
                }
                Event::deleteEvent($id);
                return $this->redirect('/event');
            }

            return $this->render(null, [
                'event' => $event
            ]);
        } else {
            $this->addErrorMessage('Помилка події ID');
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
            $event = Event::getEventById($id);
            if (!$event) {
                $this->addErrorMessage('Подію не знайдено');
                return $this->render();
            }

            if ($this->isPost) {
                $errors = [];
                $model = $_POST;

                if (empty($model['title'])) {
                    $errors['title'] = 'Заголовок обов`язково';
                }
                if (empty($model['description'])) {
                    $errors['description'] = 'Опис обов`язково';
                }
                if (empty($model['event_date'])) {
                    $errors['event_date'] = 'Дата обов`язково';
                }
                if (empty($model['time'])) {
                    $errors['time'] = 'Час обов`язково';
                }

                if (count($errors) > 0) {
                    return $this->render(null, [
                        'errors' => $errors,
                        'model' => $model,
                        'event' => $event
                    ]);
                } else {
                    Event::updateEvent($id, $model);

                    if (!empty($_FILES['image']['tmp_name'])) {
                        try {
                            Event::changeImage($id, $_FILES['image']);
                        } catch (\Exception $e) {
                            $errors['image'] = $e->getMessage();
                            return $this->render(null, [
                                'errors' => $errors,
                                'model' => $model,
                                'event' => $event
                            ]);
                        }
                    }

                    return $this->redirect('/event');
                }
            }

            return $this->render(null, [
                'event' => $event,
                'model' => $event
            ]);
        } else {
            $this->addErrorMessage('Помлка події ID');
            return $this->render();
        }
    }
    public function actionView($params)
    {
        $id = intval($params[0]);
        $eventsItem = Event::getEventById($id);
        return $this->render(null, [
            'eventsItem' => $eventsItem
        ]);
    }

    public function actionSort($params)
    {
        $field = $params[0];
        $rows = Event::getSortedEvents($field);
        return $this->render('views/event/index.php', ['rows' => $rows]);
    }
}
