<?php

namespace core;

class Model
{
    protected $fieldsArray;
    protected static $primaryKey = 'id';
    protected static $tableName = '';

    public function __construct()
    {
        $this->fieldsArray = [];
    }

    public function __set($name, $value)
    {
        $this->fieldsArray[$name] = $value;
    }

    public function __get($name)
    {
        return $this->fieldsArray[$name];
    }

    public static function deleteById($id)
    {
        Core::get()->db->delete(static::$tableName, [static::$primaryKey => $id]);
    }

    public static function findById($id)
    {
        $arr = Core::get()->db->select(static::$tableName, '*', [static::$primaryKey => $id]);
        if (count($arr) > 0)
            return $arr[0];
        else
            return null;
    }

    public static function findByCondition($conditionAssocArray)
    {
        $arr = Core::get()->db->select(static::$tableName, '*', $conditionAssocArray);
        if (count($arr) > 0) {
            return $arr;
        }
        return null;
    }
    public static function findAll()
    {
        return Core::get()->db->select(static::$tableName, '*');
    }
    public static function sortedSome($orderBy, $direction = 'ASC')
    {
        return Core::get()->db->select(static::$tableName, '*', null, $orderBy, $direction);
    }
    public static function update($id, $data)
    {
        Core::get()->db->update(static::$tableName, $data, [static::$primaryKey => $id]);
    }

    public function save()
    {
        $isInsert = false;
        if (!isset($this->{static::$primaryKey}))
            $isInsert = true;
        else
        {
            $value = $this->{static::$primaryKey};

            if (empty($value))
                $isInsert = true;
        }
        if ($isInsert) {
            Core::get()->db->insert(static::$tableName, $this->fieldsArray);
        } else {
            Core::get()->db->update(static::$tableName, $this->fieldsArray,
                [
                    self::$primaryKey => $this->{static::$primaryKey}
                ]);
        }
    }


}