function updateAppointment(id, cc, name, last_name, pet_name, date, status, url) {
    document.getElementById("updateUserId").value = cc;
    document.getElementById("updateUserName").value = name;
    document.getElementById("updateUserLastName").value = last_name;
    document.getElementById("updateUserPetName").value = pet_name;
    document.getElementById("updateMeetingTime").value = date;
    console.log(date)
    document.getElementById("updateForm").action = url+"/"+id;
}

function checkUpdateData(params) {
    
}

function saveAppointmentDataCheck(params) {

}

const toastTrigger = document.getElementById('liveToastBtn')
const toastLiveExample = document.getElementById('liveToast')
if (toastTrigger) {
  toastTrigger.addEventListener('click', () => {
    const toast = new bootstrap.Toast(toastLiveExample)

    toast.show()
  })
}