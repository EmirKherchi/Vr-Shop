$(function() {
    $("#contact_form").submit(function(e) {
        e.preventDefault();
        $(".comments").empty();
        var postdata = $("#contact_form").serialize();

        $.ajax({
            type: "POST",
            url: "Php/contact.php",
            data: postdata,
            dataType: "json",
            success: function(result) {
                if (result.isSuccess) {
                    $("#contact_form").append("<p class='thank-you'> Votre message a bien été envoyé</p>");
                    $("#contact_form")[0].reset();
                } else {

                    $("#firstname + .comments").html(result.firstnameError);
                    $("#name + .comments").html(result.nameError);
                    $("#email + .comments").html(result.eadressError);
                    $("#phone + .comments").html(result.phoneError);
                    $("#message + .comments").html(result.messageError);




                }
            }
        });
    });
})