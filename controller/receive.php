<?php

require_once('../config/database/db.php');
require_once('../model/producto.php');

$json = file_get_contents('php://input');
$data = json_decode($json, true);

$response = [];
$con = conectar();

switch ($data['action']) {
  case 1:
    guardarProducto($data, $con);
    break;
  case 2:
    $response = listarProductos($con);
    break;
  case 3:
    $response = buscarProducto($con, $data['ID']);
    break;
  case 4:
    $response = actualizarProducto($data, $con);
    break;
  case 5:
    $response = eliminarProducto($con, $data['ID']);
    break;
}

function actualizarProducto($data, $con)
{
  $producto = new Producto(
    $data['ID'],
    $data['nombre'],
    $data['referencia'],
    $data['precio'],
    $data['peso'],
    $data['categoria'],
    $data['stock'],
    ''
  );

  $producto->actualizarProducto($con);
}

function guardarProducto($data, $con)
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
  $producto->guardarProducto($con);
}

function listarProductos($con)
{
  $producto = new Producto(0, '', '', 0, 0, '', 0,'');

  $productos =  $producto->listarProductos($con);

  return $productos;
}

function buscarProducto($con, $id)
{
  $producto = new Producto(0, '', '', 0, 0, '', 0,'');

  $productos = $producto->buscarProducto($con, $id);

  return $productos;
}

function eliminarProducto($con, $id)
{
  $producto = new Producto($id, '', '', 0, 0, '', 0,'');
  $producto->eliminarProducto($con, $id);

  return ['Ok'];
}

echo json_encode($response);
