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
  
}

const addEvents = () =>
{
  document.getElementById('guardarProducto').addEventListener('click', construirData);

}

const limpiarCampos = () =>
{
  document.getElementById('nombre').value = '';
  document.getElementById('referencia').value = '';
  document.getElementById('precio').value = '';
  document.getElementById('peso').value = '';
  document.getElementById('categoria').value = '';
  document.getElementById('stock').value = '';
}

const construirData = (e) =>
{
  e.target.innerText = 'Guardando...';  
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
    e.target.innerText = 'Guardar';
    limpiarCampos();
    
    let theModal =  bootstrap.Modal.getInstance(document.getElementById('modal'))
    theModal.hide();
  })

}

document.addEventListener('DOMContentLoaded', addEvents);

