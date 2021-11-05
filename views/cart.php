<h2> Your cart </h2>

<?php if (!is_null($cart)) foreach ($cart as $item): ?>

    <div>
        <h3><a href="/?product&a=SingleProduct&id=<?= $item->id ?>"><?= $item->name ?> </a></h3>
        <p>price: <?= $item->price ?></p>
        <з>quantity: <? $item->quantity ?></з>
        <button>Buy</button>
    </div>
<? endforeach; ?>

//логика вывода списка должна быть такой же как в каталоге

