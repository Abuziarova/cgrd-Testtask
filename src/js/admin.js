$(document).ready(function () {

    $("#addNews").submit(function (e) {

        e.preventDefault();

        const formData = $(this).serializeArray();
        formData.push({name: 'method', value: 'add'})
        var actionUrl = $(this).attr('action');
        $.ajax({
            type: "POST",
            url: actionUrl,
            data: formData,
            success: function (data) {
                if (data.success) {
                    AppendNews(formData)
                }
            },
            error: function () {
                console.log('error');
            }
        });
    });

    function AppendNews(formData) {
        console.log(formData)
    }

});