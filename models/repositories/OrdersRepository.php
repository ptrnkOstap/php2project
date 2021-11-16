<?php

namespace app\models\repositories;

use app\engine\App;
use app\models\entities\Order;
use app\models\Repository;

class OrdersRepository extends Repository
{

    protected function getTableName()
    {
        return 'orders';
    }

    protected function getEntityClass()
    {
        return Order::class;
    }

    public function getOrders()
    {
        $sql = "SELECT 
                    o.id order_id,
                    o.user_id,
                    o.delivery_address address,
                    os.description status_id,
                    o.created_at,
                    o.session session_id
                FROM `orders` o INNER JOIN `order_statuses` os ON o.status_id=os.id";

        return App::call()->db->queryAll($sql);
    }


}