


addEventListener("submit",function(e){

    var pelicula = document.getElementById("id_peli")
    var cantidad = document.getElementById("cantidad")

    if(pelicula.value === ""){
        e.preventDefault()
        pelicula.classList.add("is-invalid")
        document.getElementById("peliculano").textContent = "Por favor, ingrese una pelicula"
    }else{
        document.getElementById("peliculano").textContent = ""
    }

    if(cantidad.value === ""){
        e.preventDefault()
        cantidad.classList.add("is-invalid")
        document.getElementById("cantidadno").textContent = "Por favor, ingrese un numero"
    }else if ( cantidad.value < 0 ){
        e.preventDefault()
        cantidad.classList.add("is-invalid")
        document.getElementById("cantidadno").textContent = "Por favor, ingrese un numero mayor a 0"
    }

}) 

document.getElementById('id_peli').addEventListener('input', function(event) {
    // Limpiar clase de validación en el input
    this.classList.remove('is-invalid');
});

document.getElementById('cantidad').addEventListener('input', function(event) {
    // Limpiar clase de validación en el input
    this.classList.remove('is-invalid');
});