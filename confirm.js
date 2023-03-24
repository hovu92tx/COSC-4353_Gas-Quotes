
function showConfirm() {
    var result = confirm("Are you sure?");
    if (result) {
        // User clicked OK
        window.location.href = "logout_action.php";
    }
}
