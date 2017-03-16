/**
 * Created by Admin on 09/03/17.
 */
/**
 * Created by Admin on 02/03/17.
 */
$(window).load(function () {
    $(".loader").fadeOut("slow");
});


$(document).ready(function () {
    loadForm();
    var table = $('#userTable').DataTable({
        "lengthChange": false,
        "searching": false,
        "processing": true,
        "serverSide": true,
        "ajax": {
            url: "ajax_UserFeed_DataTable.php", // json datasource
            type: "post",  // method  , by default get
            error: function () {  // error handling
                $(".userTable-error").html("");
                $("#userTable").append('<tbody class="userTable-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                $("#userTable").css("display", "none");


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
                        "<li><i class='glyphicon glyphicon-pencil' style='padding: 10px;'></i>" +
                        "<span style='padding-left: 10px'>Edit</span></li>" +
                        "<li class='divider'></li>" +
                        "<li><i class='glyphicon glyphicon-trash' style='padding: 10px'></i>" +
                        "<span style='padding-left: 10px'>Delete</span></li>" +
                        "</ul></div></div></td>";
                }
            },


        ],

        order: [[1, 'asc']]
    });


    table.on('xhr', function () {
        var json = table.ajax.json();
        for (i = 0; i < json.columns.length; i++) {

            $("#Filters").append('<li id=' + i + ' style="padding-left: 10px; cursor: pointer">' + json.columns[i] + '</li>');

            if (i < json.columns.length - 1) {
                $("#Filters").append('<li class="divider"></li>');
            }

        }
    });


    $('#example-select-all').on('click', function () {

        if (this.checked == true)
            $("input[type=checkbox]").prop('checked', true).uniform();
        else if (this.checked == false) {
            $("input[type=checkbox]").prop('checked', false).uniform();
        }


    })

    $('#Filters').on("click", "li", function() {
        var content=$(this).text();

        $('input[name="filter-value"]').html("<input type='button' value='HEY'>");

    });
});

function ajaxCall_UserProf() {

    var request = $.ajax({
        type: 'POST',
        url: 'ajax_UserProfile.php',
        dataType: 'json',
    })
    return request;
}

function loadForm() {
    var request = ajaxCall_UserProf();
    request.error(function () {
        alert("There was a problem");
    });
    request.success(function (data) {
        if (data['notification'] == 1) {
            $('#user_profile_messages').html('Please check your inbox for details!');
            $('#user_profile_messages').addClass('alert alert-info');
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
})

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


})
