var isDateValid = false;

function validarFechaNacimiento(){
  var fecha = (document.getElementById('inputFechaNacimiento').value).split("-")
  if(isDate18orMoreYearsOld(parseInt(fecha[2]),parseInt(fecha[1]),parseInt(fecha[0]))){
    document.getElementById('inputFechaNacimiento').classList.remove("is-invalid")
    document.getElementById('inputFechaNacimiento').classList.add("is-valid")
    isDateValid = true;
  } else {
    document.getElementById('inputFechaNacimiento').classList.remove("is-valid")
    document.getElementById('inputFechaNacimiento').classList.add("is-invalid")
    document.getElementById("fechaInvalida").textContent="Debe ser mayor de 18 años."
    isDateValid = false;
  }
  validarRegistro()
}

function isDate18orMoreYearsOld(day, month, year){
  return new Date(year+18, month-1, day) <= new Date()
}

function validarRegistro(){
  if(isDateValid && acceptTOS.checked == true){
    document.getElementById('buttonCrear').disabled = false
  } else {
    document.getElementById('buttonCrear').disabled = true
  }
}
