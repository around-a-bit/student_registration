document.addEventListener("DOMContentLoaded", function () {



console.log("Here");
    const url = new URL(window.location.href);

    if (successMessage) {
        console.log(successMessage);
        url.searchParams.delete("success");
        window.history.replaceState({}, document.title, url.pathname + url.search);

        Swal.fire({
            title: "Success!",
            text: successMessage,
            icon: "success",
            confirmButtonText: "OK",
            draggable: true
        });
        successMessage = null;
    }


    if (errorMessage) {
        console.log(errorMessage);
        url.searchParams.delete("error");
        window.history.replaceState({}, document.title, url.pathname + url.search);

        Swal.fire({
            title: "Oops!",
            text: errorMessage,
            icon: "error",
            confirmButtonText: "OK",
            draggable: true,
        });
        errorMessage = null;
    }

    if (deleteMessage) {
        console.log(deleteMessage);
        url.searchParams.delete("delete_message");
        window.history.replaceState({}, document.title, url.pathname + url.search);

        Swal.fire({
            title: "Deleted!",
            text: deleteMessage,
            icon: "success",
            confirmButtonText: "OK",
            draggable: true
        });
        deleteMessage = null;
    }

    if (url.searchParams.has("error")) {
        url.searchParams.delete("error");
        window.history.replaceState({}, document.title, url.pathname + url.search);
    }
});

function alertMessage(event,$message, studentEmail) {
      if($message ==='pay-student'){

    event.preventDefault();

    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: "btn btn-success",
            cancelButton: "btn btn-danger"
        },
        buttonsStyling: false
    });
  
    swalWithBootstrapButtons.fire({
        title: "Are you sure you want to pay?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes",
        cancelButtonText: "Cancel",
        reverseButtons: true
    }).then((result) => {
        console.log(result);
        if (result.isConfirmed) {
            document.getElementById(`student-pay-${studentEmail}`).submit();  // here student email = fees_structure_id
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            swalWithBootstrapButtons.fire({
                title: "Cancelled",
                text: "Payment is not completed!",
                icon: "error"
            });
        }
    });
  }
  if($message ==='delete'){

    event.preventDefault();

    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: "btn btn-success",
            cancelButton: "btn btn-danger"
        },
        buttonsStyling: false
    });
  
    swalWithBootstrapButtons.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes",
        cancelButtonText: "Cancel",
        reverseButtons: true
    }).then((result) => {
        console.log(result);
        if (result.isConfirmed) {
            document.getElementById(`delete-student-${studentEmail}`).submit(); 
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            swalWithBootstrapButtons.fire({
                title: "Cancelled",
                text: "Account is not deleted",
                icon: "error"
            });
        }
    });
  }

  if($message ==='delete-feeHead'){ 

    event.preventDefault();

    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: "btn btn-success",
            cancelButton: "btn btn-danger"
        },
        buttonsStyling: false
    });
  
    swalWithBootstrapButtons.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes",
        cancelButtonText: "Cancel",
        reverseButtons: true
    }).then((result) => {
        console.log(result);
        if (result.isConfirmed) {
            document.getElementById(`admin-fees-head-delete-${studentEmail}`).submit(); // here student email = feeHead id
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            swalWithBootstrapButtons.fire({
                title: "Cancelled",
                text: "Account is not deleted",
                icon: "error"
            });
        }
    });
  }

  if($message === 'signOut'){
    event.preventDefault();

    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: "btn btn-success",
            cancelButton: "btn btn-danger"
        },
        buttonsStyling: false
    });
  
    swalWithBootstrapButtons.fire({
        title: "Are you sure?",
        
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Sign Out",
        cancelButtonText: "Cancel",
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            // If user confirms, submit the form
            document.getElementById("signOut").submit();
        }
    });
  }
}
