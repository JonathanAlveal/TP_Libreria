

addEventListener("submit",function(e){

    var fechaYhora = document.getElementById("id_funcion")
    var catcha = document.getElementById("catcha")
    var catcha_value = document.getElementById("catcha-value").value

    console.log(catcha)
    console.log(catcha_value)

    if(catcha.value === catcha_value){
        $resultado = true;
    }else{
        $resultado = false
    }

    console.log($resultado)

    if(fechaYhora.value === ""){
        e.preventDefault()
        fechaYhora.classList.add("is-invalid")
        document.getElementById("fechaYhoraNo").textContent = "Por favor, ingrese una fecha"
    }else{
        document.getElementById("fechaYhoraNo").textContent = ""
    }

    if(catcha.value === ""){
        e.preventDefault()
        catcha.classList.add("is-invalid")
        document.getElementById("catchano").textContent = "Por favor, ingrese su respuesta"
    }else if ($resultado == false) {
        e.preventDefault()
        catcha.classList.add("is-invalid")
        document.getElementById("catchano").textContent = "Los datos no coinciden, Ingreselos nuevamente"
    }else{
        document.getElementById("catchano").textContent = ""
    }


})

document.getElementById('id_funcion').addEventListener('input', function(event) {
    // Limpiar clase de validación en el input
    this.classList.remove('is-invalid');
});

document.getElementById('catcha').addEventListener('input', function(event) {
    // Limpiar clase de validación en el input
    this.classList.remove('is-invalid');
});