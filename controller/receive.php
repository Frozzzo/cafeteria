<?php

require_once('../config/database/db.php');
require_once('../model/producto.php');

$json = file_get_contents('php://input');
$data = json_decode($json, true);

$response = [];

switch ($data['action']) {
  case 1:
    guardarProducto($data);
    break;
  case 2:
    listarProductos();
    break;
}

function guardarProducto($data)
{
  
  $producto = new Producto(
    0,
    $data['nombre'],
    $data['referencia'],
    $data['precio'],
    $data['peso'],
    $data['categoria'],
    $data['stock'],
    ''
  );
  
  $con = conectar();
  
  $producto->guardarProducto($con);
}

function listarProductos()
{
  
}

echo json_encode($response);
