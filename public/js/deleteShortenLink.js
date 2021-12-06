$('.delete').click(function (event) {
    event.preventDefault();

    let _token = $('meta[name="csrf-token"]').attr('content');
    let shortLink = $(".delete").val();

    $.ajax({
        url: '/delete-shortUrl',
        type: "POST",
        data: {'shortLink': shortLink, "_token": _token},
        success: function (response) {
            console.log(shortLink)
        },
        error: function (error) {
            console.log(error);
        },
        complete: function () {
            window.location.href = '/dashboard';
        }
    });
});
