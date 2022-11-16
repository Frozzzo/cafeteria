<?php

class Producto
{
  private $id, $nombre, $referencia, $precio, $peso, $categoria, $stock, $fecha_creacion;

  public function __construct($id, $nombre, $referencia, $precio, $peso, $categoria, $stock, $fecha_creacion)
  {
    $this->id = $id;    
    $this->nombre = $nombre;
    $this->referencia = $referencia;
    $this->precio = $precio;
    $this->peso = $peso;
    $this->categoria = $categoria;
    $this->stock = $stock;
    $this->fecha_creacion = $fecha_creacion;    
  }  

  public function getName()
  {
    return $this->nombre;
  }

  public function getReference()
  {
    return $this->referencia;
  } 

  public function getPrice()
  {
    return $this->precio;
  } 

  public function getWeigth()
  {
    return $this->peso;
  } 

  public function getCategory()
  {
    return $this->categoria;
  } 

  public function getStock()
  {
    return $this->stock;
  } 

  public function getInitDate()
  {
    return $this->fecha_creacion;
  } 

  public function getId()
  {
    return $this->id;
  }

  public function guardarProducto($con)
  {
    $query = "insert into productos(nombre, referencia, precio, peso, categoria, stock)
    values ('".$this->nombre."', '".$this->referencia."', ".$this->precio.", ".$this->peso.", '".$this->categoria."', ".$this->stock.")";

    $con->query($query);
  }
}