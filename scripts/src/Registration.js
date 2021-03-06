/**
 * Created by Admin on 20/02/17.
 */

$(function() {


    // Get the form.
    var form = $('#ajax-registration');

    // Get the messages div.
    var formMessages = $('#form-messages');

    // Set up an event listener for the contact form.
    $('#ajax-registration').submit(function(e) {
        // Stop the browser from submitting the form.
        //e.preventDefault();

        // Serialize the form data.
        var formData = $(form).serialize();

        // Submit the form using AJAX.
        $.ajax({
            type: 'POST',
            url: $(form).attr('action'),
            data: formData
        })
            .done(function(response) {
                // Make sure that the formMessages div has the 'success' class.
                $(formMessages).removeClass('error');
                $(formMessages).addClass('success');

                // Set the message text.
                $(formMessages).text(response);
                $(formMessages).append('<a href="index.html">Login Here!</a>');


                // Clear the form.
                $('#ajax-registration').trigger('reset');
            })
            .fail(function(data) {
                // Make sure that the formMessages div has the 'error' class.
                $(formMessages).removeClass('success');
                $(formMessages).addClass('error');

                // Set the message text.
                if (data.responseText !== '') {
                    $(formMessages).text(data.responseText);
                } else {
                    $(formMessages).text('Oops! An error occured and your message could not be sent.');
                }
            });
        return false;// using instead of event.preventDefault

    });

});