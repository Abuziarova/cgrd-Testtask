$(document).ready(function () {
    $("#addNews").submit(function (e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: '../action/news.php',
            data: $(this).serialize(),
            complete: function (data) {
                window.location.reload()
            }
        });
    });

    $(".delete").click(function (event) {
        const requestData = {
            id: $(event.target).data('newsId'),
            method: 'delete'
        }
        $.ajax({
            type: "POST",
            url: '../action/news.php',
            data: requestData,
            success: function (data) {
                if (data.success) {
                    window.location.reload()
                }
            }
        });
    });
});