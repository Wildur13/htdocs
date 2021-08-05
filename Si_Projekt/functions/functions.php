<?php

function insert_into_database(PDO $pdo, string $cat,
                                        string $name,
                                        string $description,
                                        string $price,
                                        string $img
): void{
    $cat = strtolower($cat);
    $pdo ->exec("INSERT INTO {$cat} SET Name='$name', Description='$description', Price='$price', Img='$img'");
}

function get_data(PDO $pdo, string $cat): array{
    $cat = strtolower($cat);
    $sql = $pdo ->query("SELECT * FROM {$cat}");
    if($sql->rowCount() > 0){
        $data =$sql->fetch();
        return $data;
    }
    return [];
}