<?php

namespace app\models;

use app\engine\Db;
use app\interfaces\IModel;


abstract class Model implements IModel
{
    protected $shiftedKeys = [];

    public function __set($name, $value)
    {
        array_push($this->shiftedKeys, $name);  //если присвается значение для свойства, ключ этого свойства падает в массив, но чет не работает.
        $this->$name = $value;
    }

    public function __get($name)
    {
        return $this->$name;
    }

    abstract protected static function getTableName();

    public function insert()
    {
        $sql = "INSERT INTO " . static::getTableName();
        $keys = [];
        $values = [];
        foreach ($this as $key => $value) {
            if ($key === 'id') continue;
            array_push($keys, $key);
            array_push($values, $value);
        }
        $sql .= " (`" . implode("`, `", $keys) . "`)"; //добавляем поля таблицы
        $sql .= " VALUES (:" . implode(", :", $keys) . ")"; //
        Db::getInstance()->execute($sql, array_combine($keys, $values));
        $this->id = Db::getInstance()->lastInsertId();
        return $this;
    }

    public function update()
    {
        echo
        $values = [];
        foreach ($this->shiftedKeys as $key) {
            $values[$key] = $this->$key;  // здесь я планировал собрать массив измененных ключей и их значений
        }
//        var_dump($values);
//        $sql = "UPDATE" . static::getTableName() . "SET $values WHERE id=:id";
//        Db::getInstance()->execute($sql, ['id' => $this->id]);
//        $this->shiftedKeys = [];
    }

    public function delete()
    {
//        var_dump($this->id . '- from delete');
        $id = $this->id;
        $sql = "DELETE FROM " . static::getTableName() . " WHERE id=:id";
        Db::getInstance()->execute($sql, ['id' => $id]);
    }

    public static function getOne($id)
    {
        $tableName = static::gettableName();
        $sql = "SELECT * FROM $tableName WHERE id=:id";
        return Db::getInstance()->queryOneObject($sql, ['id' => $id], get_called_class());
    }

    public static function getAll()
    {
        $tableName = static::gettableName();
        $sql = "SELECT * from $tableName";
        return Db::getInstance()->queryAllObject($sql, get_called_class());
    }
}