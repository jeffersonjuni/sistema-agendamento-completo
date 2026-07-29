import Swal from "sweetalert2";

/*
|--------------------------------------------------------------------------
| Toasts Globais
|--------------------------------------------------------------------------
*/

function showToast(icon, message) {
    Swal.fire({
        icon,

        text: message,

        timer: 2500,

        showConfirmButton: false,

        position: "top-end",

        toast: true,
    });
}

window.showSuccess = function (message) {
    showToast("success", message);
};

window.showError = function (message) {
    showToast("error", message);
};

window.showWarning = function (message) {
    showToast("warning", message);
};

window.showInfo = function (message) {
    showToast("info", message);
};

/*
|--------------------------------------------------------------------------
| Confirmações
|--------------------------------------------------------------------------
*/

window.confirmDelete = function (
    event,
    title = "Excluir registro?",
    text = "Essa ação não poderá ser desfeita.",
) {
    event.preventDefault();

    Swal.fire({
        title,

        text,

        icon: "warning",

        showCancelButton: true,

        confirmButtonText: "Excluir",

        cancelButtonText: "Cancelar",

        reverseButtons: true,
    }).then((result) => {
        if (result.isConfirmed) {
            event.target.submit();
        }
    });

    return false;
};
