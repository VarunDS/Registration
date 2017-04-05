/**
 * Created by Admin on 02/03/17.
 */
$(window).load(function () {
    $(".loader").fadeOut("slow");
});
status_switch_array = [];

$(document).ready(function () {
    var arrayTags_global = [];

    loadForm();
    var table = $('#userTable').DataTable({
        "lengthChange": false,
        "searching": true,
        "processing": true,
        "serverSide": true,

        "dom": '<l<t>ip>',
        "ajax": {
            "url": "ajax_UserFeed_DataTable.php", // json datasource
            "type": "POST",  // method  , by default get
            "data": {
                "arrayTags": function () {
                    var tagValue = [];
                    for (i = 0; i < arrayTags_global.length; i++) {
                        tagValue[i] = arrayTags_global[i];
                    }
                    return tagValue;

                }
            },
            error: function () {

                //table.empty();

                $("#userTable").append('<tbody class="userTable-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                $("#userTable_processing").css("display", "none");

            }
        },
        'columnDefs': [
            {
                'targets': 0,
                'searchable': false,
                'orderable': false,
                'className': 'dt-body-center',
                'render': function (data, type, full, meta) {
                    return '<input type="checkbox" name="id[]" value="' + $('<div/>').text(data).html() + '">';
                }
            },
            {
                'orderable': false,
                'targets': -1,
                "render": function () {

                    return "<td style='width: 115px;'><div class='btn-group'><button type='button' class='btn btn-default glyphicon glyphicon-eye-open'></button>" +
                        "<div class='btn-group'><button type='button' class='btn btn-default glyphicon glyphicon-cog dropdown-toggle' data-toggle='dropdown'>" +
                        "<span class='caret'></span></button>" +
                        "<ul class='dropdown-menu' role='menu' style='white-space: nowrap'>" +
                        "<li><i class='glyphicon glyphicon-pencil' style='padding: 5px;'></i>" +
                        "<span style='padding-left: 2px; white-space: nowrap'>Edit</span></li>" +
                        "<li class='divider'></li>" +
                        "<li><i class='glyphicon glyphicon-trash' style='padding: 5px'></i>" +
                        "<span style='padding-left: 2px; white-space: nowrap'>Delete</span></li>" +
                        "</ul></div></div></td>";
                }
            },


        ],

        order: [[1, 'asc']]
    });

    var roles_table = $('#roles_table').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": "ajax_RoleFeed_DataTable.php", // json datasource
            "type": "POST",  // method  , by default get
            error: function () {
                var role_table = $("#roles_table");
                role_table.append('<tbody class="roles_table-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                role_table.css("display", "none");
            }
        },
        'lengthChange': false,
        "dom": '<l<t>ip>',
        "responsive": true,

        'columnDefs': [
            {
                'targets': 0,
                'searchable': false,
                'orderable': false,
                'className': 'dt-body-center',
                'render': function (data, type, full, meta) {
                    return '<input type="checkbox" id="' + $('<div/>').text(data).html() + '" name="' + meta.row + '" value="' + $('<div/>').text(data).html() + '">';
                }
            },
            {
                'targets': 3,
                'searchable': false,
                'orderable': false,
                'className': 'dt-body-center',
                'render': function (data, type, full, meta) {
                    if (data == 1) {
                        return '<input type="checkbox" name="my-checkbox" checked>';
                    }
                    else {
                        return '<input type="checkbox" name="my-checkbox" >';
                    }
                }

            },
            {
                'orderable': false,
                'targets': -1,
                "render": function (data, type, full, meta) {

                    return '<td style="width:148px; white-space: nowrap"><div class="Toolbar">' +
                        '<div>' +
                        '<div class="btn-group">' +
                        '<button id="ButtonView_' + $('<div/>').text(data).html() + '" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-search"></span></button>' +
                        '</div>' +
                        '</div></td>'


                }
            }
        ],
        "drawCallback": function (settings) {
            $("[name='my-checkbox']").bootstrapSwitch('disabled', true);
        },
        order: [[1, 'asc']]


    });

    $("#roles_table tbody").on("click", 'button', function (e) {
        if (this.id.indexOf("View") >= 0) {
            prepModal(roles_table, this, 'View');
        }
        else if (this.id.indexOf("Update") >= 0) {
            prepModal(roles_table, this, 'Update');
        }


    });


    $('#click_keyword_search').on('click', function () {
        $('#userTable').DataTable().search(
            $('#keyword_search').val()
        ).draw();

    });

    table.on('xhr', function () {
        var json = table.ajax.json();
        if ($('#Filters li').length == 0) {
            for (i = 0; i < json.columns.length; i++) {

                $("#Filters").append('<li id=' + i + ' style="padding-left: 10px; cursor: pointer">' + json.columns[i] + '</li>');

                if (i < json.columns.length - 1) {
                    $("#Filters").append('<li class="divider"></li>');
                }

            }
        }

    });


    $('#example-select-all').on('click', function () {

        if (this.checked == true)
            $("input[type=checkbox]").prop('checked', true).uniform();
        else if (this.checked == false) {
            $("input[type=checkbox]").prop('checked', false).uniform();
        }
        $('ul.art-vmenu li').click(function (e) {
            alert($(this).find("span.t").text());
        });

    });
    var tagsInputSearch = $('#tagsInputSearch');
    var keyword_search = $('#keyword_search');
    $('#Filters').on("click", "li", function () {
        var content = $(this).text();
        tagsInputSearch.tagsinput('add', content);
        tagsInputSearch.tagsinput('refresh');
    });


    $('#Click_Search').on("click", function () {
        var tagsArray = [];
        tagsArray = $("#tagsInputSearch").tagsinput('items');
    });

    tagsInputSearch.on('beforeItemAdd', function (event) {
        var json = table.ajax.json();
        var filters = [];
        for (i = 0; i < json.columns.length; i++) {
            filters.push(json.columns[i]);
        }
        if (filters.indexOf(event.item) == -1) {
            event.cancel = true;
            alert("Filter Not available");
        }
    });

    tagsInputSearch.on('itemAdded', function (event) {
        arrayTags_global.push(event.item);
        var activeId = [];
        toggleElements(arrayTags_global, $('#keyword_search').val());

    });

    tagsInputSearch.on('itemRemoved', function (event) {
        toggleElements(arrayTags_global, keyword_search.val());
        var index = arrayTags_global.indexOf(event.item);
        if (index = -1) {
            arrayTags_global.splice(index, 1);

        }
        toggleElements(arrayTags_global, keyword_search.val());

    });

    keyword_search.on('keyup keydown change', function () {
        toggleElements(arrayTags_global, $('#keyword_search').val());
    });

    $('#remove_filters').on('click', function () {
        $('#tagsInputSearch').tagsinput('removeAll');
        arrayTags_global.length = 0;
        toggleElements(arrayTags_global, $('#keyword_search').val());
    });

    $('#remove_keywords').on('click', function () {
        keyword_search.val("");
        toggleElements(arrayTags_global, keyword_search.val());

    })


});

function prepModal(table, that, operation) {
    if (operation == "View") {
        $('#edit_button').show();
    }

    var data = table.row($(that).parents('tr')).data();
    loadPermissions(data[0]);

    $('#edit').modal('show');
    $('#switch').html('<label for="formGroupExampleInput">Role Status </label>' +
        '<input id="role_status_' + data[0] + '" name="role_status" type="checkbox" class="myClass">');

    if ($('#modal-header:contains("View")').length === 0) {
        $('#modal-header').prepend("View " + data[1]);
    }
    else {
        var modalHeader = $("#modal-header");
        modalHeader.contents().filter(function () {
            return this.nodeType == 3;
        }).remove();
        modalHeader.prepend("View " + data[1]);
    }
    var checkbox_id = data[0];
    var checkbox_name = $('input:checkbox[id=' + checkbox_id + ']').attr('name');
    $('#row_id').val(checkbox_name);
    $('#role_id').val(data[0]);
    $('#role_name').val(data[1]);
    $('#role_desc').val(data[2]);

    var bootstrapSwitchId = $("#role_status_" + data[0]);
    if (data[3] == 1) {
        bootstrapSwitchId.bootstrapSwitch('state', true, true);
        bootstrapSwitchId.bootstrapSwitch('onColor', 'success');
        bootstrapSwitchId.bootstrapSwitch('disabled', true);
        bootstrapSwitchId.on('switchChange.bootstrapSwitch', function (event, state) {
            statusSwitchArrayBuild()
        });
    }
    else {
        bootstrapSwitchId.bootstrapSwitch('state', false, false);
        bootstrapSwitchId.bootstrapSwitch('disabled', true);
        bootstrapSwitchId.on('switchChange.bootstrapSwitch', function (event, state) {
            statusSwitchArrayBuild()
        });
    }
}
function statusSwitchArrayBuild() {

    var element = status_switch_array.filter(function (ele) {
        return ele.element === event.currentTarget.id;

    });
    if (element == null || element == "") {
        status_switch_array.push({element: event.currentTarget.id, state: state});
    }
    else {
        var removeIndex = status_switch_array.map(function (item) {
            return item.element;
        })
            .indexOf(event.currentTarget.id);
        ~removeIndex && status_switch_array.splice(removeIndex, 1);
        status_switch_array.push({element: event.currentTarget.id, state: state});
    }
    $('#submit_button').attr("disabled", false);


}
function toggleElements(tags, searchKeyword) {


    if (tags.length !== 0 || searchKeyword !== "") {
        $('#clear_filters_keywords').fadeIn();
        if (tags.length !== 0) {
            $('#remove_filters').addClass('btn-danger').prop('disabled', false);
        }
        else {
            $('#remove_filters').prop('disabled', true).removeClass('btn-danger');
        }
        if (searchKeyword !== "") {
            $('#remove_keywords').addClass('btn-danger').prop('disabled', false);
        }
        else {
            $('#remove_keywords').prop('disabled', true).removeClass('btn-danger');
        }
    }


    if (tags.length === 0 && searchKeyword === "") {
        $('#remove_filters').prop('disabled', true).removeClass('btn-danger');
        $('#remove_keywords').prop('disabled', true).removeClass('btn-danger');
        $('#clear_filters_keywords').fadeOut();
    }
    $('#userTable').DataTable().search(
        $('#keyword_search').val()
    ).draw();
}
function ajaxCall_UserProf() {

    var request = $.ajax({
        type: 'POST',
        url: 'ajax_UserProfile.php',
        dataType: 'json'
    });
    return request;
}

function loadForm() {
    var request = ajaxCall_UserProf();
    request.error(function () {
        alert("There was a problem");
    });
    request.success(function (data) {
        if (data['notification'] == 1) {
            var user_profile_messages = $('#user_profile_messages');
            user_profile_messages.html('Please check your inbox for details!');
            user_profile_messages.addClass('alert alert-info');
            $('#user_profile :input').prop("disabled", true);
        }
        for (var k in data) {
            $('[name="' + k + '"]').val(data[k]);
        }

    })
}


$(function () {
    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        var target = $(e.target).attr("href");// activated tab
        if (target === "#UserProfile") {
            loadForm();
        }
    })
});

$(function () {
    var user_profile_form = $('#user_profile');
    var user_profile_messages = $('#user_profile_messages');
    var url = 'ajax_UserProfile.edit.php';
    $(user_profile_form).submit(function (event) {
        event.preventDefault();

        var formData = $(user_profile_form).serialize();
        var request = $.ajax({
            type: 'POST',
            url: url,
            data: formData,
            dataType: "json"
        });
        request.success(function (response) {
            if (response['insert_flag'] === 1) {
                $('#user_profile_messages').addClass('alert alert-info');
                $('#user_profile :input').prop("disabled", true);
            }

            $('#user_profile_messages').html(response['response']);

        })
    })


});
