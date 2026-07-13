import DataTable from "datatables.net";

document.addEventListener("DOMContentLoaded", () => {

    document.querySelectorAll(".datatable").forEach((table) => {

        new DataTable(table, {

            responsive: true,

            pageLength: 10,

            lengthMenu: [10, 25, 50],

            language: {

                search: "",

                searchPlaceholder: "Pesquisar...",

                lengthMenu: "Mostrar _MENU_ registros",

                info: "Mostrando _START_ até _END_ de _TOTAL_ registros",

                infoEmpty: "Nenhum registro encontrado",

                zeroRecords: "Nenhum registro encontrado",

                paginate: {

                    previous: "←",

                    next: "→",

                },

            },

        });

    });

});
