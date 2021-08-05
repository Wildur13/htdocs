<?php
require_once dirname(__DIR__). DIRECTORY_SEPARATOR. './elements/header.php';
require_once dirname(__DIR__). DIRECTORY_SEPARATOR. './functions/functions.php';

$database = new PDO('mysql: host=localhost; dbname=burgers','root','', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

if(sizeof($_POST) != 0){

    $name= $_POST["name"];
    $description= $_POST["description"];
    $price= $_POST["price"];
    $cat= $_POST["categorie"];
    $img = $_POST["img"];
    insert_into_database($database,$cat, $name, $description, $price, $img);
    $result = 'Upload complete';
}

$nav = ['Menu', 'Burger', 'Snack', 'Salade', 'Dessert'];
$result = null;
?>
<div class="row">
    <div class="col-sm-6 col-md-4">
    </div>
    <div class="col-sm-6 col-md-4">
        <form method="post">
            <div class="mb-3">
                <?php if($result) {
                    echo "<div class='alert alert-success text-center'> $result </div>";
                } ?>
                <label for="exampleInputEmail1" class="form-label ">Categorie</label>
                    <select id="disabledSelect" class="form-select" name="categorie">
                        <?php foreach ($nav as $item): ?>
                        <option><?= $item?></option>
                        <?php endforeach;?>
                    </select>
                </div>
            <div class="mb-3">
                <div class="fields">
                    <div class="field name">Name:
                        <input type="text" name="name" placeholder="Name" required>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <div class="fields">
                    <div class="field name">Description:
                        <input type="text" name="description" placeholder="Description" required>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <div class="fields">
                    <div class="field name">Price:
                        <input type="text" name="price" placeholder="Price" required>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <div class="fields">
                    <div class="field name">Img:
                        <input type="text" name="img" placeholder="img-Link" required>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    <div class="col-sm-6 col-md-4">

    </div>
</div>