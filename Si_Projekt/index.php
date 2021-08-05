<?php
require_once './elements/header.php';
require_once './functions/functions.php';

$database = new PDO('mysql: host=localhost; dbname=burgers','root','', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));


$nav = ['Menus', 'Burger', 'Snack', 'Salade', 'Dessert'];
$data = get_data($database, 'Burger')
?>


<nav>
    <ul>
        <?php foreach ($nav as $item):
            $key = array_search("$item", $nav)
            ?>
            <li role="presentation" class="<?php if($key == 0) {echo 'active';}?> ">
                <a href="#<?= $key?>" data-toggle="tab"> <?= $item?></a>
            </li>
        <?php endforeach ?>
    </ul>
</nav>
<div class="tab-content">
    <div class="tab-pane active" id="1">
        <div class="row">
            <div class="col-sm-6 col-md-4">
                <div class="thumbnail">
                    <img src="<?= $data['Img']?>" alt="">

                    <div></div>
                    <div class="cation">
                        Menu Classic
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>



