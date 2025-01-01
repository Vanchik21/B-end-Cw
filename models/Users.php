<?php

namespace models;

use core\Core;
use core\DB;
use core\Model;
/**
 * @property  int $id ID user
 * @property  string $login Логін користувача
 * @property  string $password Пароль користувача
 * @property  string $firstname Ім'я користувача
 * @property  string $lastname Прізвище користувача
 * @property  int $access_level Рівень доступу користувача
 */

class Users extends Model
{
    public static $tableName = 'users';
    public static function FindByLoginAndPassword($login,$password)
    {
        $rows = self::findByCondition(['login'=>$login,'password'=>self::hashPassword($password)]);
        if (!empty($rows))
            return $rows[0];
        else
            return null;
    }
    public static function FindByLogin($login)
    {
        $rows = self::findByCondition(['login'=>$login]);
        if (!empty($rows))
            return $rows[0];
        else
            return null;
    }
    public static function hashPassword($password) {
        return md5($password);
    }
    public static function deleteUser($id)
    {
        self::deleteById($id);
    }
    public static function updatePassword($id, $password)
    {
        $user = self::findById($id);
        if ($user) {
            $user['password'] = self::hashPassword($password);
            self::update($id, ['password' => $user['password']]);
        }
    }

    public static function isUserLogged()
    {
        return !empty(Core::get()->session->get('user'));
    }
    public static function LoginUser($user)
    {
        Core::get()->session->set('user',$user);
    }
    public  static function LogoutUser()
    {
        Core::get()->session->remove('user');
    }
    public static function RegisterUser($login,$password,$lastname,$firstname)
    {
        $user = new Users();
        $user ->login =$login;
        $user ->password=self::hashPassword($password);
        $user ->firstname =$firstname;
        $user ->lastname =$lastname;
        $user->save();
    }
    public static function isAdmin()
    {
        $user = Core::get()->session->get('user');
        if ($user !== null && isset($user['access_level'])) {
            return $user['access_level'] == 2;
        }
        return false;
    }
    public static function getLoggedUserId()
    {
        $user = Core::get()->session->get('user');
        return $user['id'] ?? null;
    }
    public static function getUsernameById($id)
    {
        $user = self::findById($id);
        return $user ? $user['firstname'] . ' ' . $user['lastname'] : 'Невідомий користувач';
    }

}