<?php

namespace app\models;

use app\engine\Db;


abstract class DBModel extends Model
{
    abstract protected static function getTableName();

    public static function getAll()
    {
        $tableName = static::getTableName();
        $sql = "SELECT * from $tableName";
        return Db::getInstance()->queryAllObject($sql, get_called_class());
    }

    public static function getOne($id)
    {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM $tableName WHERE id=:id";
        return Db::getInstance()->queryOneObject($sql, ['id' => $id], get_called_class());
    }

    public function insert()
    {
        $sql = "INSERT INTO " . static::getTableName();
        $keys = [];
        $values = [];

        foreach ($this as $key => $value) {
            if ($key === 'id' || $key === 'props') continue;
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

        $values = [];
        $columns = [];
        foreach ($this->props as $key) {
            $values["{$key}"] = $this->$key;
            $columns[] .= "`{$key}` = :{$key}";
        }

        $columns = implode(', ', $columns);
        $values['id'] = $this->id;
//        var_dump($columns);
//        var_dump($values);
        $sql = "UPDATE " . static::getTableName() . " SET {$columns} WHERE id=:id";
        Db::getInstance()->execute($sql, $values);
        $values = [];
        return $this;
    }

    public function delete()
    {

        $tableName = static::getTableName();
        $sql = "DELETE FROM {$tableName} WHERE id = :id";
        return Db::getInstance()->execute($sql, ['id' => $this->id]);
    }

    public function save()
    {
        if (is_null($this->id)) $this->insert();
        elseif (!empty($this->props)) $this->update();
        else {
            echo 'nothing to insert or update';
        }
    }

    public static function getCountWhere($name, $value)
    {
        $tableName = static::getTableName();
        $sql = "SELECT count(id) as count FROM {$tableName} WHERE `{$name}`=:value";
        return Db::getInstance()->queryOne($sql, ['value' => $value])['count'];
    }

    public static function getOneWhere($name, $value)
    {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE `{$name}`=:value";
        return Db::getInstance()->queryOneObject($sql, ['value' => $value], static::class);
    }
}