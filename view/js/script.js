const eliminar = (id) =>
{
  alertify.confirm("¿Estas seguro de eliminar el producto?.",
  function(){
    const url = "/controller/receive.php";
    const data = {ID: id, eliminar: 1, action: 5 };

    postData(url, data).
    then(response => {
      getData();      
      alertify.success('Eliminado');
    }); 
  },
  function(){
    alertify.error('Cancelar');
  });

   
}

const editarProducto = (id) =>
{
  const url = "/controller/receive.php";
  const data = 
  {
    ID: id,
    nombre: document.getElementById('nombre').value,
    referencia: document.getElementById('referencia').value,
    precio: document.getElementById('precio').value,
    peso: document.getElementById('peso').value,
    categoria: document.getElementById('categoria').value,
    stock: document.getElementById('stock').value,
    action: 4
  };  
  
  postData(url, data).
  then(() => {
    cambiarEventosGuardar();
    getData();
    alertify.success('Actualizado');
    let theModal =  bootstrap.Modal.getInstance(document.getElementById('modal'))
    theModal.hide();
  });
}

const cambiarEventosActualizar = (id) =>
{
  document.getElementById('guardarProducto').setAttribute('onclick', `editarProducto(${id})`);  

  document.getElementById('modalTittle').innerText = 'Actualizar producto';
  document.getElementById('guardarProducto').innerText = 'Actualizar';
  document.getElementById('closeModal').addEventListener('click', cambiarEventosGuardar);
}

const cambiarEventosGuardar = () =>
{
  document.getElementById('guardarProducto').setAttribute('onclick', 'construirData()');
  document.getElementById('modalTittle').innerText = 'Crear producto';  
  document.getElementById('guardarProducto').innerText = 'Guardar';

  limpiarCampos();
}

const editar = (id) =>
{
  const url = "/controller/receive.php";
  const data = {action: 3, ID: id};

  postData(url, data)
  .then(response => {
    document.getElementById('nombre').value = response.nombre;
    document.getElementById('referencia').value = response.referencia;
    document.getElementById('precio').value = response.precio;
    document.getElementById('peso').value = response.peso;
    document.getElementById('categoria').value = response.categoria;
    document.getElementById('stock').value = response.stock;

    cambiarEventosActualizar(response.ID);
    
    let theModal = new bootstrap.Modal(document.getElementById('modal'), {backdrop: 'static', keyboard: false});
    theModal.show();
  });
}

const createTable = (data) =>
{
  const cardBody = document.getElementById('cardBody');
  
  let html = '';
  if(data.length == 0)
  {
    html = `
    <div class="text-center">
      <h5 class="card-tittle">Sin productos...</h5>
      <img src="../public/icons/empty-box-svgrepo-com.svg" alt="" height="90">
    </div>
    `;
  }else{
   html = `
    <div class="card-body" id='cardBody'>
      <div class="table-responsive">
      <table class="table">
        <thead>
          <th>Nombre</th>
          <th>Referencia</th>
          <th>Precio</th>
          <th>Peso</th>
          <th>Categoría</th>
          <th>Stock</th>
          <th>Fecha de creación</th>
          <th class="text-center">Acciones</th>
        </thead>
        <tbody>
    `;

    data.forEach(producto => {
      html += `
      <tr>
        <td>${producto.nombre}</td>
        <td>${producto.referencia}</td>
        <td>${producto.precio}</td>
        <td>${producto.peso}</td>
        <td>${producto.categoria}</td>
        <td>${producto.stock}</td>
        <td>${producto.fecha_creacion}</td>
        <td class="text-center">
          <button class="btn" onclick="editar(${producto.ID})">
            <img src="../public/icons/edit-svgrepo-com.svg" alt="" height="40">
          </button>
          <button class="btn" onclick="eliminar(${producto.ID})">
            <img src="../public/icons/delete-svgrepo-com.svg" alt="" height="40">
          </button>
        </td>
      `;
    });
  }  

  cardBody.innerHTML = html;
}

const postData = async (url = '', data = {}) =>  
{    
  const response = await fetch(url, {
      method: 'POST', 
      mode: 'cors', 
      cache: 'no-cache', 
      credentials: 'same-origin', 
      headers: {
      'Content-Type': 'application/json'        
      },
      redirect: 'follow',
      referrerPolicy: 'no-referrer',
      body: JSON.stringify(data)
  });
  return response.json(); 
}

const getData = () =>
{
  const url = "/controller/receive.php";
  const data = {action: 2};

  postData(url, data)
  .then(response => {
    createTable(response);
  });
}

const addEvents = () =>
{  
  getData();
}

const limpiarCampos = () =>
{
  document.getElementById('nombre').value = '';
  document.getElementById('referencia').value = '';
  document.getElementById('precio').value = '';
  document.getElementById('peso').value = '';
  document.getElementById('categoria').value = 'ALIMENTOS';
  document.getElementById('stock').value = '';
}

const construirData = () =>
{
  document.getElementById('guardarProducto').innerText = 'Guardando...';  
  const data = 
  {
    nombre: document.getElementById('nombre').value,
    referencia: document.getElementById('referencia').value,
    precio: document.getElementById('precio').value,
    peso: document.getElementById('peso').value,
    categoria: document.getElementById('categoria').value,
    stock: document.getElementById('stock').value,
    action: 1
  };

  const url = "/controller/receive.php";
  postData(url, data).
  then(response => {
    document.getElementById('guardarProducto').innerText = 'Guardar';
    limpiarCampos();
    getData();

    let theModal =  bootstrap.Modal.getInstance(document.getElementById('modal'))
    theModal.hide();

    alertify.success('Guardado');
  })

}

document.addEventListener('DOMContentLoaded', addEvents);

