<?php

$connect = new mysqli('localhost', 'root', 'Charaf2024', 'chef_cuisinier',3307);

if(!$connect){
    echo 'error sur connection !';
};