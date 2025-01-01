<?php

namespace controllers;


use core\Controller;
use core\Model;
use models\Users;
use core\Core;

class UsersController extends Controller
{
    public function actionLogin()
    {
        if (Users::isUserLogged())
            return $this->redirect('/');
        if ($this->isPost) {
            $user = Users::FindByLoginAndPassword($this->post->login, $this->post->password);
            if (!empty($user)) {
                Users::LoginUser($user);
                return $this->redirect('/');
            } else {
                $this->addErrorMessage('Помилка логіну або паролю');

            }
        }
        return $this->render();
    }

    public function actionRegister()
    {
        if ($this->isPost) {
            $user = Users::FindByLogin($this->post->login);
            if (!empty($user)) {
                $this->addErrorMessage('Користувач з таким логіном існує');
            }
            if ($this->post->password != $this->post->password2)
                $this->addErrorMessage('Паролі не збігаються');
            if (strlen($this->post->login)===0)
                $this->addErrorMessage('Логін не вказано');
            if (strlen($this->post->password)===0)
                $this->addErrorMessage('Пароль не вказано');
            if (strlen($this->post->password2)===0)
                $this->addErrorMessage('Пароль повторно не  вказано');
            if (strlen($this->post->firstname)===0)
                $this->addErrorMessage('Ім`я не вказано');
            if (strlen($this->post->login)===0)
                $this->addErrorMessage('Прізвище не вказано');
            if (!$this->isErrorMessageExists()){
                Users::RegisterUser($this->post->login,$this->post->password,$this->post->firstname,$this->post->lastname);
                return $this->redirect('/users/registersuccess');
            }
        }
        return $this->render();
    }

    public function actionRegistersuccess()
    {
        return $this->render();
    }
    public function actionLogout()
    {
        Users::LogoutUser();
        return $this->redirect('/users/login');
    }
    public function actionProfile()
    {
        if (Users::isUserLogged()) {
            $user = Core::get()->session->get('user');
            return $this->render(null, ['user' => $user]);
        } else {
            return $this->redirect('/users/login');
        }
    }
    public function actionDelete($params)
    {
        $id = intval($params[0]);
        $confirm = isset($params[1]) && boolval($params[1] === 'yes');
        if (!Users::isUserLogged()) {
            $this->addErrorMessage('Користувач не ввійшов у систему');
            return $this->redirect('/users/login');
        }
        if ($id > 0) {
            $user = Users::findById($id);
            if (!$user) {
                $this->addErrorMessage('Користувача не знайдено');
                return $this->render();
            }
            if ($confirm) {
                Users::deleteUser($id);
                Users::LogoutUser();
                return $this->redirect('/');
            }
            return $this->render(null, ['user' => $user]);
        } else {
            $this->addErrorMessage('Неправильний ID користувача');
            return $this->render();
        }
    }
    public function actionEdit()
    {
        if (!Users::isUserLogged()) {
            return $this->redirect('/users/login');
        }

        if ($this->isPost) {
            $user = Core::get()->session->get('user');
            $newPassword = $this->post->{"new-password"};

            if (strlen($newPassword) === 0) {
                $this->addErrorMessage('Новий пароль не вказано');
            }

            if (!$this->isErrorMessageExists()) {
                Users::updatePassword($user['id'], $newPassword);
                return $this->redirect('/users/profile');
            }
        }

        return $this->render();
    }
}