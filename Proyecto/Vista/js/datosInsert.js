

document.getElementById("id_funcion").addEventListener("change",function(){

    var seleccion = document.getElementById("id_funcion")
    var id_funcion_seleccionada = seleccion.value

    // Obtener la información de la función seleccionada
    var hora = document.getElementById("hora" + id_funcion_seleccionada)
    var fecha = document.getElementById("fecha" + id_funcion_seleccionada)
    var cantMax = document.getElementById("cantMax" + id_funcion_seleccionada)
    var cantActual = document.getElementById("cantActual" + id_funcion_seleccionada)

    document.getElementById("hora").value = hora.value
    document.getElementById("fecha").value = fecha.value
    document.getElementById("cant_max").value = cantMax.value
    document.getElementById("cant_actual").value = cantActual.value

    console.log(document.getElementById("hora").value)
    console.log(document.getElementById("fecha").value)
    console.log(document.getElementById("cant_max").value)
    console.log(document.getElementById("cant_actual").value)

})