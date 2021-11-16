<?php

namespace app\engine;



class Db
{

    private $conection = null;

    public function __construct($driver = null, $host = null, $login = null, $password = null, $database = null, $charset = "utf8")
    {
        $this->config['driver'] = $driver;
        $this->config['host'] = $host;
        $this->config['login'] = $login;
        $this->config['password'] = $password;
        $this->config['database'] = $database;
        $this->config['charset'] = $charset;
    }

    private function getConnection()
    {
        if (is_null($this->conection)) {
            $this->conection = new \PDO($this->prepareDsnString(),
                $this->config['login'],
                $this->config['password']
            );
            $this->conection->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
        }
        return $this->conection;
    }

    private function prepareDsnString()
    {
        return sprintf("%s:host=%s;dbname=%s;charset=%s",
            $this->config['driver'],
            $this->config['host'],
            $this->config['database'],
            $this->config['charset'],
        );
    }

    //SELECT * FROM products WHERE id= :id
    //params=['id'=>1]
    private function query($sql, $params)
    {
        $STH = $this->getConnection()->prepare($sql);
//          $STH->bindValue(':id', 2, \PDO::PARAM_INT);
        $STH->execute($params);
        return $STH;
    }


    public function queryOne($sql, $params = [])
    {
        return $this->query($sql, $params)->fetch();
    }

    public function queryOneObject($sql, $params, $class)
    {
        $STH = $this->query($sql, $params);
        $STH->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, $class);

        return $STH->fetch();
    }

    public function queryAllObject($sql, $class, $params = [])
    {
        $STH = $this->query($sql, $params);
        $STH->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, $class);
        return $STH->fetchAll();
    }

    //select all

    public function queryAll($sql, $params = [])
    {
        return $this->query($sql, $params)->fetchAll();
    }

    public function execute($sql, $params = [])
    {
        return $this->query($sql, $params)->rowCount();
    }

    public function lastInsertId()
    {
        return $this->getConnection()->lastInsertId();
    }

}