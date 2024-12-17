<?php

$connect = new mysqli('localhost', 'root', 'Charaf2024', 'chef_cuisinier',3307);

// $connect=mysqli_connect('localhost','root','Charaf2024','chef_cuisinier');

if(!$connect){
    echo 'error sur connection !';
};