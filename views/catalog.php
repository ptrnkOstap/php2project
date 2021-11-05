
<h2 > Catalog </h2 >

<?php foreach ($catalog as $item): ?>

<div>
    <h3><a href="/?c=product&a=SingleProduct&id=<?=$item->id?>"><?=$item->name ?> </a></h3>
    <p>price: <?=$item->price?></p>
    <button>Buy</button>
</div>
<?endforeach;?>