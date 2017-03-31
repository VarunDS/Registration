/**
 * Created by Admin on 23/03/17.
 */
$(document).ready(function () {

    $('#edit_button').on('click', function () {
        enableModalForm();
    });
    $('#cancel_button').on('click', function () {
        disableModalForm();
    });
    $('#delete_button').on('click', function () {
        $('#delete_modal').modal('show');
        $('#edit').modal('hide');
    });
    $('#no_button').on('click', function () {
        $('#edit').modal('show');

    });
    $('#submit_button').on('click', function (event) {
        var operation = 'update';
        submitModal(event, operation);
    });

    $("#viewForm :input, textarea").change(function () {
        $("#viewForm").data("changed", true);
        $('#submit_button').attr("disabled", false);

    });

    $("a[href='#permissions']").on('click', function () {
        var role_id = $('#role_id').val();
        loadPermissions(role_id);

    });

    disableModalForm();
});


function loadPermissions(role_id) {

    $.ajax({
        type: 'POST',
        url: 'ajax_permissionFeed.php',
        data: {
            role_id: role_id,
        },
        dataType: "json",
        success: function (data) {
            console.log(data);
            $.each(data.granted_permission, function (key, value) {

                $('#'+value['perm_id']).bootstrapSwitch('state', true, true);
                $('#'+value['perm_id']).bootstrapSwitch('disabled', true);
                $('#'+value['perm_id']).on('switchChange.bootstrapSwitch', function (event, state) {
                    alert('Permission change hui hai boss');
                    $('#submit_button').attr("disabled", false);
                });

            });
            var diff = $(data.all_permissions).not(data.granted_permission).get();

            $.each(diff, function (key, value) {
                $('#'+value['perm_id']).bootstrapSwitch('state', false, false);
                $('#'+value['perm_id']).bootstrapSwitch('disabled', true);
                $('#'+value['perm_id']).on('switchChange.bootstrapSwitch', function (event, state) {
                    alert('Permission change hui hai boss');
                    $('#submit_button').attr("disabled", false);
                });
            });

        },
        error: function (response) {
            console.log(response);

        }
    })

}
function submitModal(event, operation) {

    if ($("#viewForm").data("changed") && operation === 'update') {
        event.preventDefault();
        var form = $('#viewForm');
        $.ajax({
            type: 'POST',
            url: 'ajax_RoleFeed_DataTable.php',
            data: {
                operation: operation,
                formData: form.serialize()
            },
            dataType: "json",
            success: function (response) {
                alert("Record(s) Modified.");
                console.log(response.responseText);
            },
            error: function (response) {
                alert("Record(s) Not Modified.");
                console.log(response.responseText);
            }
        })
    }


}
function disableModalForm() {
    var id = $('#role_id').val();
    $('#submit_button').attr("disabled", true);
    $("#viewForm :input[type='text'],textarea").attr("disabled", true);
    $('#role_status_' + id).bootstrapSwitch('disabled', false);
}
function enableModalForm() {
    var id = $('#role_id').val();

    $("#viewForm :input").attr("disabled", false);
    $('#role_status_' + id).bootstrapSwitch('disabled', false);
}