<?php

namespace app\models;


class Orders extends Model
{
    public $id;
    public $user_id;
    public $delivery_address;
    public $status_id;
    public $created_at;


    public function __construct($user_id = null,
                                $delivery_address = null,
                                $status_id = null,
                                $created_at = null)
    {
        $this->user_id = $user_id;
        $this->delivery_address = $delivery_address;
        $this->status_id = $status_id;
        $this->created_at = $created_at;
    }


    public static function getTableName()
    {
        return 'orders';
    }


}