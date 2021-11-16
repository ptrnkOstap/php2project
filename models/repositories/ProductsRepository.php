<?php

namespace app\models\repositories;

use app\models\entities\Products;
use app\models\Repository;

class ProductsRepository extends Repository
{

    public function getTableName()
    {
        return 'products';
    }

    protected function getEntityClass()
    {
        return Products::class;
    }
}