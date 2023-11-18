$(document).ready(function () {
    $("#addNews").submit(function (e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: '../action/news.php',
            data: $(this).serialize(),
            success: function () {
                window.location.reload()
            }
        });
    });

    $(".delete").click(function () {
        const token = $('input[name="csrf_token"]').val()
        const requestData = {
            id: $(this).data('newsId'), method: 'delete', csrf_token: token
        }
        $.ajax({
            type: "POST",
            url: '../action/news.php',
            data: requestData,
            success: function () {
                window.location.reload()
            }
        });
    });

    $(".edit").click(function () {
        $('h3#form-title').text('Edit News');
        const id = $(this).data('newsId')
        const title = $(this).closest('div.news').find('b.title').text()
        const description = $(this).closest('div.news').find('span.description').text()
        const form = $('form#addNews');
        form.find('input[name=method]').val('edit');
        form.find('input[name=id]').val(id);
        form.find('input[name=title]').val(title);
        form.find('textarea[name=description]').text(description);
        form.find('button').text('Save')
        $('.form-header').find('img').css('display', 'block')
    })

    $("#cancel").click(function () {
        $('h3#form-title').text('Create News');
        const form = $('form#addNews');
        form.find('input[name=method]').val('create');
        form.find('input[name=id]').val(0);
        form.find('input[name=title]').val('');
        form.find('textarea[name=description]').text('');
        form.find('button').text('Create');
        $('.form-header').find('img').css('display', 'none')
    })
});