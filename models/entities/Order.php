<?php

namespace app\models\entities;

use app\models\Entity;

class Order extends Entity
{
    public $id;
    public $user_id;
    public $delivery_address;
//    public $status_id;
//    public $created_at;
    public $session;
    public $user_name; // имя
    public $email; //логин / телефон

    /**
     * @param $id
     * @param $user_id
     * @param $delivery_address
//     * @param $status_id
//     * @param $created_at
     * @param $session
     * @param $user_name
     */
    public function __construct($user_name,
                                $delivery_address,
                                $session,
                                $email,
                                $user_id = null,
                                $id = null)
    {
        $this->id = $id;
        $this->user_id = $user_id;
        $this->delivery_address = $delivery_address;
//        $this->status_id = $status_id;
//        $this->created_at = $created_at;
        $this->session = $session;
        $this->user_name = $user_name;
        $this->email = $email;
    }

    public function __isset($name)
    {
        return isset($this->$name);
    }


}