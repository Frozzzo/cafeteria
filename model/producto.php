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

  public function listarProductos($con)
  {
    $productos = [];
    $query = "select
      ID,
      nombre ,
      referencia, 
      precio,
      peso,
      categoria,
      stock,
      fecha_creacion 
    from productos
    where eliminar = 0";

    $productosDB = $con->query($query);

    $productosDB->data_seek(0);

    while ($fila = $productosDB->fetch_assoc())
    {
      $productos[] = $fila;
    }

    return $productos;
  }

  public function buscarProducto($con, $id)
  {
    $producto = [];

    $query = "select
      ID,
      nombre ,
      referencia, 
      precio,
      peso,
      categoria,
      stock,
      fecha_creacion 
    from productos
    where eliminar = 0
    and ID = ".$id."
    ";

    $productoDB = $con->query($query);
    $producto = $productoDB->fetch_assoc();

    return $producto;
  }

  public function actualizarProducto($con)
  {
    $query = "update productos 
      set nombre = '".$this->nombre."',
      referencia = '".$this->referencia."',
      precio = ".$this->precio.",
      peso = ".$this->peso.",
      categoria = '".$this->categoria."',
      stock = ".$this->stock."
    WHERE ID = ".$this->id."
    ";

    $con->query($query);
  }

  public function eliminarProducto($con)
  {
    $query = "update productos 
      set eliminar = 1      
    WHERE ID = ".$this->id."
    ";

    $con->query($query);
  }

  public function venderProducto($con, $vendio)
  {
    $query = "update productos 
      set stock = stock - ".$vendio."
    WHERE ID = ".$this->id."
    ";

    $con->query($query);
  }
}