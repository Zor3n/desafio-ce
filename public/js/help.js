function updateAppointment(id, cc, name, last_name, pet_name, date, status, url) {
    document.getElementById("updateName").value = name;
    // document.getElementById("txtActualizarDescripcion").value = descripcion;
    // document.getElementById("txtActualizarImagen").value = imagen;
    // document.getElementById("txtActualizarPrecio").value = precio;
    document.getElementById("formActualizar").action = url+"/"+id;
}

function checkUpdateData(params) {
    
}
