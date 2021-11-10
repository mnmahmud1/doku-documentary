$(document).ready(function () {
    $("#memberData").DataTable();
});

function del(page) {
    swal({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover this imaginary file!",
        icon: "warning",
        buttons: ["Cancel", "Delete"],
        dangerMode: true,
    }).then(willDelete => {
        if (willDelete) {
            swal("Successfull", {
                title: "Delete has successfully",
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
