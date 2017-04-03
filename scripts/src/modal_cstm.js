/**
 * Created by Admin on 23/03/17.
 */

permission_switch_status = [];
$(document).ready(function () {

    $('#edit_button').on('click', function () {
        enableModalForm();
    });

    $("#edit").on('hidden.bs.modal', function () {
        var element_ids = $('.glyphicon-minus').map(function (index) {
            return this.id;
        });

        $.each(element_ids, function (key, value) {
            var element = "#" + value;
            var element_selector = $(element);
            if (element_selector.hasClass('glyphicon-minus') == true) {
                element_selector.removeClass('glyphicon-minus');
                element_selector.addClass('glyphicon-plus');
            }
        });
        $('.panel-collapse.in')
            .collapse('hide');
    });

    $("#edit").on('show.bs.modal', function () {
        $("a[href='#details']").click();
    });

    $('#cancel_button').on('click', function () {


        $('.panel-collapse.in')
            .collapse('hide');

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
        submitModal(event, operation,roles_table);
    });

    $("#viewForm :input, textarea").change(function () {
        $("#viewForm").data("changed", true);
        $('#submit_button').attr("disabled", false);

    });


    $("a[href='#details']").on('click', function () {
        var element = $('#detailsPanel');
        modifyPanelGlyphicons(element, 'glyphicon-minus', 'glyphicon-plus');
    });

    $("a[href='#permissions']").on('click', function () {
        var element = $('#permissionsPanel');
        modifyPanelGlyphicons(element, 'glyphicon-minus', 'glyphicon-plus');
    });

    disableModalForm();
});

function modifyPanelGlyphicons(element, addClassName, removeClassName) {

    if (element.hasClass(removeClassName) == true) {
        element.removeClass(removeClassName);
        element.addClass(addClassName);
    }
    else {
        element.addClass(removeClassName);
        element.removeClass(addClassName);

    }
}
function loadPermissions(role_id) {

    $.ajax({
        type: 'POST',
        url: 'ajax_permissionFeed.php',
        data: {
            role_id: role_id,
        },
        dataType: "json",
        success: function (data) {

            $('#permissionsForm').empty();

            var granted_array = [];
            var denied_array = [];
            var found = false;

            for (i = 0; i < data.all_permission.length; i++) {
                for (j = 0; j < data.granted_permission.length; j++) {
                    if (data.all_permission[i].perm_id == data.granted_permission[j].perm_id) {
                        found = true;
                        break;
                    }
                    else {
                        found = false;
                    }
                }
                if (found == true) {
                    granted_array.push(data.all_permission[i])
                }
                else if (found == false) {
                    denied_array.push(data.all_permission[i]);
                }
            }

            $.each(granted_array, function (key, value) {
                var checkbox_id = role_id + "_" + value['perm_id'];
                $('#permissionsForm').append('<div class="row"><div class="col-sm-3 text-center text-success"><label>' + value['perm_desc'] + '</label></div><div class="col-sm-9 pull-left"><input type="checkbox" id="' + checkbox_id + '"></div></div><br>');
                $('#permissionLabel').append('<label>' + value['perm_desc'] + '</label>');
                $('#permissionSwitch').append('<input type="checkbox" id="' + role_id + '_' + value['perm_id'] + '">');
                $('#' + role_id + "_" + value['perm_id']).bootstrapSwitch('state', true, true);
                $('#' + role_id + "_" + value['perm_id']).bootstrapSwitch('onColor', 'success');
                $('#' + role_id + "_" + value['perm_id']).bootstrapSwitch('disabled', true);
                $('#' + role_id + "_" + value['perm_id']).on('switchChange.bootstrapSwitch', function (event, state) {

                    var element = permission_switch_status.filter(function (ele) {
                        return ele.element === event.currentTarget.id;

                    });
                    if (element == null || element == "") {
                        permission_switch_status.push({element: event.currentTarget.id, state: state});
                    }
                    else {
                        var removeIndex = permission_switch_status.map(function (item) {
                            return item.element;
                        })
                            .indexOf(event.currentTarget.id);
                        ~removeIndex && permission_switch_status.splice(removeIndex, 1);
                        permission_switch_status.push({element: event.currentTarget.id, state: state});

                    }

                    $('#submit_button').attr("disabled", false);
                });
            })

            $.each(denied_array, function (key, value) {
                var checkbox_id = role_id + "_" + value['perm_id'];
                $('#permissionsForm').append('<div class="row"><div class="col-sm-3 text-center"><label>' + value['perm_desc'] + '</label></div><div class="col-sm-9 pull-left"><input type="checkbox" id="' + checkbox_id + '"></div></div><br>');
                $('#permissionLabel').append('<label>' + value['perm_desc'] + '</label>');
                $('#permissionSwitch').append('<input type="checkbox" id="' + role_id + '_' + value['perm_id'] + '">');
                $('#' + role_id + "_" + value['perm_id']).bootstrapSwitch('state', false, false);
                $('#' + role_id + "_" + value['perm_id']).bootstrapSwitch('disabled', true);
                $('#' + role_id + "_" + value['perm_id']).on('switchChange.bootstrapSwitch', function (event, state) {
                    permission_switch_status.push({event: event.currentTarget.id, state: state});
                    $('#submit_button').attr("disabled", false);
                });

            })


        },
        error: function (response) {
            //console.log(response);

        }
    })

}
function submitModal(event, operation) {
    var row=$('#row_id');

    if (($("#viewForm").data("changed") || status_swtich_array.length > 0 || permission_switch_status.length > 0)
        && operation === 'update') {
        event.preventDefault();
        var form = $('#viewForm');
        var perm_form = $('#permissionsForm');
        console.log(status_swtich_array);
        console.log(permission_switch_status);

        $.ajax({
            type: 'POST',
            url: 'ajax_RoleFeed_DataTable.php',
            data: {
                operation: operation,
                detailsFormData: form.serialize(),
                status_array: status_swtich_array,
                permissions_array: permission_switch_status,
            },
            dataType: "json",
            success: function (data) {
                alert(data.message);
                $('#roles_table').DataTable().row(row).invalidate().draw();

            },
            error: function (response) {
                console.log(response)
                alert(response.responseText);
                //console.log(response.responseText);
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
    var disabled_switches = $('#permissions').find(':input').prop('disabled', true);
    $.each(disabled_switches, function (key, value) {
        var id_selector = $("#" + value.id);
        id_selector.bootstrapSwitch('disabled', false);
    })
    $("#viewForm :input").attr("disabled", false);
    $('#role_status_' + id).bootstrapSwitch('disabled', false);
}