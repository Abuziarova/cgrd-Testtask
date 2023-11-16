$(document).ready(function () {

    $("#addNews").submit(function (e) {

        e.preventDefault();

        var actionUrl = $(this).attr('action');
        $.ajax({
            type: "POST",
            url: actionUrl,
            data: $(this).serializeArray(),
            success: function (data) {
                if (data.success) {
                    sessionStorage.setItem("successMessage","sdfsdf");
                    window.location.reload()
                }
            }
        });
    });

});