import Swal from "sweetalert2";


window.showAlert = function (type, message) {

    Swal.fire({

        icon: type,

        text: message,

        timer: 2500,

        showConfirmButton: false,

        position: "top-end",

        toast: true,

    });

};

window.confirmDelete = function(event){

    event.preventDefault();


    Swal.fire({

        title: "Excluir serviço?",

        text: "Essa ação não poderá ser desfeita.",

        icon: "warning",

        showCancelButton:true,

        confirmButtonText:"Excluir",

        cancelButtonText:"Cancelar",

    }).then((result)=>{


        if(result.isConfirmed){

            event.target.submit();

        }


    });


    return false;

}
