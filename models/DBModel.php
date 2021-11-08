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
//        var_dump(static::getTableName());
        $sql = "INSERT INTO " . static::getTableName();
        $keys = [];
        $values = [];

//        var_dump($this);

        foreach ($this as $key => $value) {
            if ($key === 'id' || $key === 'props') continue;
            array_push($keys, $key);
            array_push($values, $value);
        }
        $sql .= " (`" . implode("`, `", $keys) . "`)"; //добавляем поля таблицы
        $sql .= " VALUES (:" . implode(", :", $keys) . ")"; //
        var_dump($sql);
        var_dump($keys);
        var_dump($values);
        var_dump(array_combine($keys, $values));
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

        $sql = "UPDATE " . static::getTableName() . " SET {$columns} WHERE id=:id";
        Db::getInstance()->execute($sql, $values);
        $values = [];
        echo 'updated';
    }

    public function delete($id = null)
    {
//        var_dump($this->id . '- from delete');
        $prodId = $id ?? $this->id;
        $sql = "DELETE FROM " . static::getTableName() . " WHERE id=:id";
        Db::getInstance()->execute($sql, ['id' => $prodId]);
    }

    public function save()
    {
        if (is_null($this->id)) $this->insert();
        elseif (!empty($this->props)) $this->update();
        else {
            echo 'nothing to insert or update';
        }
    }
}