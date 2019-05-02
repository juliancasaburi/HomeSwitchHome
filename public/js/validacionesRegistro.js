var isDateValid = false;
var mailExist = true;

function alertMailExiste(){
  document.getElementById('inputEmail').classList.remove("is-valid")
  document.getElementById('inputEmail').classList.add("is-invalid")
  document.getElementById("mailInvalido").textContent="Este mail ya se encuentra en uso."
}

function validarMailExist(){
  var parametros = {
    "mailIngresado" : document.getElementById('inputEmail').value
  };
  $.ajax({
    data: parametros,
    url: 'validarMailBD.php',
    type: 'post',
    success: function(resultado){
      resultado = JSON.parse(resultado)
      alertMailExiste();
      if(resultado['existe']){
        alertMailExiste();
      }else{
        mailExist = false;
        validarRegistro();
      }
    },
    error: function(){
      alert('No pudo conectarse con el servidor')
    }
  });
}

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
