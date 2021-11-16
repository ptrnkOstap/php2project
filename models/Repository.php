<?php

namespace app\models;

use app\engine\Db;
use app\engine\App;


abstract class Repository
{
    abstract protected function getTableName();

    abstract protected function getEntityClass();

    public function getAll()
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * from {$tableName}";
        return App::call()->db->queryAllObject($sql, $this->getEntityClass());
    }

    public function getOne($id)
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE id=:id";
        return App::call()->db->queryOneObject($sql, ['id' => $id], $this->getEntityClass());
    }

    public function insert(Entity $entity)
    {
        $sql = "INSERT INTO " . $this->getTableName();
        $keys = [];
        $values = [];

        foreach ($entity as $key => $value) {
            if ($key === 'id' || $key === 'props') continue;
            array_push($keys, $key);
            array_push($values, $value);
        }

        $sql .= " (`" . implode("`, `", $keys) . "`)"; //добавляем поля таблицы
        $sql .= " VALUES (:" . implode(", :", $keys) . ")"; //


        App::call()->db->execute($sql, array_combine($keys, $values));
        $entity->id = App::call()->db->lastInsertId();

        return $this;
    }


    public function update(Entity $entity)
    {

        $values = [];
        $columns = [];
        foreach ($entity->props as $key) {
            $values["{$key}"] = $entity->$key;
            $columns[] .= "`{$key}` = :{$key}";
        }

        $columns = implode(', ', $columns);
        $values['id'] = $entity->id;
//        var_dump($columns);
//        var_dump($values);
        $sql = "UPDATE " . $this->getTableName() . " SET {$columns} WHERE id=:id";
        App::call()->db->execute($sql, $values);
        $values = [];
        return $this;
    }

    public function delete(Entity $entity)
    {

        $tableName = $this->getTableName();
        $sql = "DELETE FROM {$tableName} WHERE id = :id";
        return App::call()->db->execute($sql, ['id' => $entity->id]);
    }

    public function save(Entity $entity)
    {
        if (is_null($entity->id)) $this->insert();
        elseif (!empty($this->props)) $this->update();
        else {
            echo 'nothing to insert or update';
        }
    }

    public function getCountWhere($name, $value)
    {
        $tableName = $this->getTableName();
        $sql = "SELECT count(id) as count FROM {$tableName} WHERE `{$name}`=:value";
        return App::call()->db->queryOne($sql, ['value' => $value])['count'];
    }

    public function getOneWhere($name, $value)
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE `{$name}`=:value";
        return App::call()->db->queryOneObject($sql, ['value' => $value], $this->getEntityClass());
    }
}