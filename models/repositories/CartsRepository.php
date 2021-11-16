<?php

namespace app\models\repositories;

use app\engine\App;
use app\models\entities\Carts;
use app\models\Repository;

class CartsRepository extends Repository
{

    protected function getEntityClass()
    {
        return Carts::class;
    }


    public function getCart($session_id)
    {
        $sql = "SELECT 
                    c.id cart_line_id,
                    c.session_id,
                    p.id prod_id,
                    p.name,
                    p.description,
                    p.price,
                    c.quantity quantity
                FROM `carts` c INNER JOIN `products` p ON c.product_id=p.id
                WHERE `session_id` = :session_id";

        return App::call()->db->queryAll($sql, ['session_id' => $session_id]);
    }

    public function getTableName()
    {
        return 'carts';
    }
}