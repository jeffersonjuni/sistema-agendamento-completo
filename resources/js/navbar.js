const logoutButton =
    document.getElementById("logoutButton");


const logoutModal =
    document.getElementById("logoutModal");


const cancelLogout =
    document.getElementById("cancelLogout");


logoutButton?.addEventListener(
    "click",
    () => {

        logoutModal?.classList.add("active");

    }
);


cancelLogout?.addEventListener(
    "click",
    () => {

        logoutModal?.classList.remove("active");

    }
);


logoutModal?.addEventListener(
    "click",
    (event)=>{

        if(event.target === logoutModal){

            logoutModal.classList.remove("active");

        }

    }
);
