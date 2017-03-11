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
    $('#userTable').DataTable({
        'columnDefs': [
            {
                'orderable': false,
                'targets': 4
            },
            {
                'targets': 0,
                'checkboxes': {
                    'selectRow': true
                }
            }
        ],
        'select': {
            'style': 'multi'
        },
        order: [[1, 'asc']]
    });
    $('#messageTable').DataTable({

        'columnDefs': [
            {
                'orderable': false,
                'targets': 5
            },
            {
                'targets': 0,
                'checkboxes': {
                    'selectRow': true
                }
            }
        ],
        'select': {
            'style': 'multi'
        },
        order: [[1, 'asc']]
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
