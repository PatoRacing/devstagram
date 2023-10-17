import Dropzone from "dropzone";
import { drop } from "lodash";

//Dropzone va a buscar un elemento con la clase Dropzone
//Le decimos false para evitar ese comportamiento
Dropzone.autoDiscover = false; 

const dropzone = new Dropzone('#dropzone', {
    dictDefaultMessage: "Sube aquí tu imagen", //Mensaje por default reseteado
    acceptedFiles: ".png, .jpg, .jpeg, .gif", //Archivos permitidos
    addRemoveLinks: true, //Permitir eliminar el archivo subido
    dictRemoveFile: "Borrar Archivo",//Mensaja si queres eliminar el archivo subido
    maxFiles: 1,//Máxima cantidad de archivos a subir
    uploadMultiple: false,//No se puede subir mas de uno a la vez

    init:function() {//Se ejecuta esta funcion una vez ejecutado dropzone
        //Además se ejecuta cuando hay algo valor en el input
        if(document.querySelector('[name="imagen"]').value.trim()) {
            const imagenPublicada = {}
            imagenPublicada.size = 1234;
            imagenPublicada.name = document.querySelector('[name="imagen"]').value;
            this.options.addedfile.call(this, imagenPublicada);
            this.options.thumbnail.call(this, imagenPublicada, `/uploads/${imagenPublicada.name}`)
            imagenPublicada.previewElement.classList.add("dz-success", "dz-complete")
        }
    }
})

//Eventos de dropzone
dropzone.on("success", function(file, response){
    document.querySelector('[name="imagen"]').value =response.imagen;
})
dropzone.on("removedfile", function(){
    document.querySelector('[name="imagen"]').value = "";
})