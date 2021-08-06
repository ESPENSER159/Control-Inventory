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
function copyValues(cuSerial) {
    var copyText = document.getElementById(cuSerial);
    copyText.select();
    copyText.setSelectionRange(0, 50);
    document.execCommand("copy");

    snackbar("Copiado...");
}


// Mostrar Snackbar
function snackbar(textShow) {
    const notify = document.getElementById("snackbar");
    notify.className = 'show';
    notify.innerHTML = textShow;
    setTimeout(() => { notify.classList.remove('show'); }, 3000);
}



// Habilitar o deshabilitar edición de campos.
var activeButton = 0;
function enableEditable(cuPC, serialPC, cuMoni, serialMoni, buttonSave) {
    const inputCUPC = document.getElementById(cuPC);
    const inputSerialPC = document.getElementById(serialPC);
    const inputCUMoni = document.getElementById(cuMoni);
    const inputSerialMoni = document.getElementById(serialMoni);
    const buttonGuardar = document.getElementById(buttonSave);

    const attribute = 'readonly';
    const colorEnable = 'white';
    const colorDisable = '#d6d5d5';

    if(activeButton === 0) {
        inputCUPC.removeAttribute(attribute);
        inputCUPC.style.backgroundColor = colorEnable;
        inputSerialPC.removeAttribute(attribute);
        inputSerialPC.style.backgroundColor = colorEnable;
        inputCUMoni.removeAttribute(attribute);
        inputCUMoni.style.backgroundColor = colorEnable;
        inputSerialMoni.removeAttribute(attribute);
        inputSerialMoni.style.backgroundColor = colorEnable;

        buttonGuardar.style.display = "inline";
        activeButton++;
    } else if(activeButton === 1) {
        inputCUPC.setAttribute(attribute, attribute);
        inputCUPC.style.backgroundColor = colorDisable;
        inputSerialPC.setAttribute(attribute, attribute);
        inputSerialPC.style.backgroundColor = colorDisable;
        inputCUMoni.setAttribute(attribute, attribute);
        inputCUMoni.style.backgroundColor = colorDisable;
        inputSerialMoni.setAttribute(attribute, attribute);
        inputSerialMoni.style.backgroundColor = colorDisable;

        buttonGuardar.style.display = "none";

        activeButton--;
    }

}


// Validaciones boton "Guardar" para el cambio de datos.
function saveChanges(cuPC, serialPC, cuMoni, serialMoni, buttonSave) {
    const inputCUPC = document.getElementById(cuPC);
    const inputSerialPC = document.getElementById(serialPC);
    const inputCUMoni = document.getElementById(cuMoni);
    const inputSerialMoni = document.getElementById(serialMoni);
    const buttonGuardar = document.getElementById(buttonSave);

    inputCUPC.setAttribute('readonly', 'redonly');
    inputCUPC.style.backgroundColor = "#d6d5d5";
    inputSerialPC.setAttribute('readonly', 'redonly');
    inputSerialPC.style.backgroundColor = "#d6d5d5";
    inputCUMoni.setAttribute('readonly', 'redonly');
    inputCUMoni.style.backgroundColor = "#d6d5d5";
    inputSerialMoni.setAttribute('readonly', 'redonly');
    inputSerialMoni.style.backgroundColor = "#d6d5d5";

    buttonGuardar.style.display = "none";

    snackbar("Guardado");
}


// Validar ingreso de datos en el formulario de modificar datos de equipo.
function validarFormModifyDates() {
    const cuTorre = document.forms["modifyDatePosition"]["torreCU"];
    const serialTorre = document.forms["modifyDatePosition"]["torreSerial"];
    const cuMoni = document.forms["modifyDatePosition"]["moniCU"];
    const serialMoni = document.forms["modifyDatePosition"]["moniSerial"];

    // Los campos no pueden ser vaciós.
    if (cuTorre.value == "" || cuTorre.value.length <= 3 || serialTorre.value == "" || serialTorre.value.length <= 3 || cuMoni.value == "" || cuMoni.value.length <= 3 || serialMoni.value == "" || serialMoni.value.length <= 3) {
        snackbar("Los campos no deben ser vacios y no deden ser inferiores a 4 caracteres.");
        return false;
    }else {
        console.log("Datos correctos (por ahora)");
        saveChanges(cuTorre.value, serialTorre.value, cuMoni.value, serialMoni.value, buttonSave.value);
    }
}