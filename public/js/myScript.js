
$(document).ready(function() {
    $('#dataTables-example').DataTable({
            responsive: true
    });
});

$("div.alert-success").delay(3000).slideUp();

function deleteConfirm (messages) {
    if(window.confirm(messages)) {
        return true;
    }
    return false;
}