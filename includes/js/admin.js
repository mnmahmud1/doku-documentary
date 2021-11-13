$(document).ready(function () {
    $("#memberData").DataTable();
});

function alertModal(page, button = "Delete", msg = "Once deleted, you will not be able to recover this imaginary file!") {
    swal({
        title: "Are you sure?",
        text: msg,
        icon: "warning",
        buttons: ["Cancel", button],
        dangerMode: true,
    }).then(willDelete => {
        if (willDelete) {
            swal("Successfull", {
                title: button + " has successfully",
                icon: "success",
                buttons: false,
            });
            window.location.href = page;
        }
    });
}

function importFile(input, button) {
    document.getElementById(button).addEventListener("click", openDialog);

    function openDialog() {
        document.getElementById(input).click();
    }
}
