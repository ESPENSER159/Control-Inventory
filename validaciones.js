function validarFormAddPlano() {
    let namePlano = document.forms["formAddDeletePlano"]["nombrePlano"].value;

    // El campo nombre plano no debe ser vacio y debe ser mayor a 4 caracteres.
    if (namePlano == "" || namePlano.length <= 3) {
        alert("El nombre del plano debe ser de al menos 4 caracteres.");
        return false;
    }else {
        // Validar si el nombre ingresado ya existe en la base.
        let namePlanoMinus = namePlano.toLowerCase();
        let cont = 0;
        for (let valor of planos) {

            let converNamePlano = planos[cont].toLowerCase();

            if(namePlanoMinus === converNamePlano) {
                alert("Ya existe un plano con este nombre.")
                return false;
            }
            cont++;
        }
    }
}

// Confirmacion al eliminar un plano
function validarFormDelPlano() {
    var deletePlano = confirm("¿Esta seguro de eliminar el plano?");
    if (deletePlano == true) {
        console.log("Acepto eliminar el plano.");
    } else {
        console.log("Cancelo la operación.");
        return false;
    }
}


// Formulario añadir posiciones

// Form add only one position
function validarFormAddPosition() {
    let namePlano = document.forms["formAddPosition"]["onePosition"].value;

    // El campo nombre plano no debe ser vacio y debe ser mayor a 4 caracteres.
    if (namePlano == "" || namePlano.length <= 3) {
        alert("El nombre de la posición debe ser de al menos 4 caracteres.");
        return false;
    }else {
        // Validar si el nombre ingresado ya existe en la base.
        let namePlanoMinus = namePlano.toLowerCase();
        let cont = 0;
        for (let valor of positions) {

            let converNamePlano = positions[cont].toLowerCase();

            if(namePlanoMinus === converNamePlano) {
                alert("Ya existe una posición con este nombre.");
                return false;
            }
            cont++;
        }
    }
}

// Add more than one position form
function validarFormAddPositions() {
    let nomen = document.forms["formAddPositions"]["nomen"].value;
    let multiPositionInitial = document.forms["formAddPositions"]["multiPositionInitial"].value;
    let multiPositionFinal = document.forms["formAddPositions"]["multiPositionFinal"].value;

    // Los campos no pueden estar vacios.
    if (nomen == "" || multiPositionInitial == "" || multiPositionFinal == "") {
        alert("Los campos no pueden estar vacios.");
        return false;
    } else {
        // Los campos deben ser menores a 6 caracteres. 
        if(multiPositionInitial.length >= 6 || multiPositionFinal.length >= 6) {
            alert("Los campos deben ser menos de 6 caracteres.");
            return false;
        } else if(multiPositionInitial === multiPositionFinal) {
            alert("La posición inicial no puede ser igual a la posición final");
            return false;
        } else if(multiPositionInitial > multiPositionFinal) {
            alert("La posición inicial no puede ser mayor que la posición final");
            return false;
        } else {
            // Validar si el nombre ingresado ya existe en la base.
            let cont = 0;
            for(let i = multiPositionInitial; i < multiPositionFinal; i++) {

                let namePlano = nomen+i;
                let namePlanoMinus = namePlano.toLowerCase();
                
                if(positions.length !== 0) {
                    for (let pos = 0; pos < positions.length; pos++) {
                        console.log("Convert name: "+namePlanoMinus);
                        console.log(positions[pos]);
                        
                        let converNamePosition = positions[pos].toLowerCase();
                        
                        if(namePlanoMinus === converNamePosition) {
                            alert("Ya existe una posición con el nombre "+namePlano);
                            return false;
                        }
                        cont++;
                    }
                }
            }
        }
    }
}


// Form valid delete position
function validarFormDelPosition() {
    let namePos = document.forms["formDelPosition"]["delOnePosition"].value;

    // El campo de nombre de la posicion no puede ser vacio.
    if (namePos === "") {
        alert("El campo no puede ser vacío.");
        return false;
    }else {
        // Validar si la posición existe en el plano.
        let namePosMinus = namePos.toLowerCase();
        let cont = 0;
        for (let valor of positions) {

            let converNamePos = positions[cont].toLowerCase();

            if(namePosMinus !== converNamePos) {
                alert("No existe una posición con el nombre "+namePos+"\nPosicion convertida: "+namePosMinus+"\n"+converNamePos);
                return false;
            }
            cont++;
        }
    }
}

// Mostrar Notificación y copiar valor al portapapeles
function showNotification(cuSerial) {
    var copyText = document.getElementById(cuSerial);
    copyText.select();
    copyText.setSelectionRange(0, 20);
    document.execCommand("copy");
    console.log("Copiado: " + copyText.value);

    const notify = document.getElementById("snackbar");
    notify.className = 'show';
    setTimeout(() => { notify.classList.remove('show'); }, 3000);
}