function updateAppointment(id, cc, name, last_name, pet_name, date, status, url) {
    document.getElementById("updateUserId").value = cc;
    document.getElementById("updateUserName").value = name;
    document.getElementById("updateUserLastName").value = last_name;
    document.getElementById("updateUserPetName").value = pet_name;
    document.getElementById("updateMeetingTime").value = date;
    console.log(date)
    document.getElementById("updateForm").action = url+"/"+id;
}

function deleteAppointment(id, cc, name, date, url) {
  document.getElementById("deleteAppointmentID").value = cc;
  document.getElementById("deleteAppointmentName").value = name;
  document.getElementById("deleteAppointmentDate").value = date;
  document.getElementById("deleteForm").action = url+"/"+id;
}

function updateAppointmentDataCheck(params) {
    
}

function saveAppointmentDataCheck(params) {

}
