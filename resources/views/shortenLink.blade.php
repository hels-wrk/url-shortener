<!DOCTYPE html>
<html>
<head>
    <title>URL-shotener</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" />
</head>
<body>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('URL shotener') }}
        </h2>
    </x-slot>

<div class="container mt-10">

    <div class="card pt-3">
        <div class="card-header">
            <form method="POST" action="{{ route('generate.shorten.link.post') }}">
                @csrf
                <div class="input-group mb-3">
                    <input type="text" name="link" class="form-control" placeholder="Enter your URL" aria-label="Recipient's username" aria-describedby="basic-addon2">
                    <div class="input append ml-3">
                        <button class="btn btn-secondary" type="submit">Get short URL</button>
                    </div>
                </div>
                <div class="row mb-3">
                    <input type="text" onfocus="(this.placeholder='a-z,A-Z,0-9 (max 8 symbols)')" name = "secret" class="form-control col-4 ml-3" placeholder="Secret key" aria-label="Recipient's username" aria-describedby="basic-addon2">
                    <input type="text" onfocus="(this.placeholder='a-z,A-Z,0-9 (max 10 symbols)')" name = "customUrl" class="form-control col-4 ml-4" placeholder="Custom URL" aria-label="Recipient's username" aria-describedby="basic-addon2">
                    <input type="text" onfocus="(this.type='date')" name = "linkLifetime" class="form-control col-3 ml-4" placeholder="URL death date" aria-label="Recipient's username" aria-describedby="basic-addon2">
                </div>
            </form>
        </div>
        <div class="card-body">

            @if (Session::has('success'))
                <div class="alert alert-success">
                    <p>{{ Session::get('success') }}</p>
                </div>
            @endif

            <table class="table table-bordered table-sm">
                <thead>
                <tr>
                    <th>Your link</th>
                    <th>Short link</th>
                </tr>
                </thead>
                <tbody>
                @foreach($shortLinks as $row)
                    <tr>
                        <td>{{ $row->link }}</td>

                        <td class="d-flex justify-content-between">
                            <a href="{{ route('shorten.link', $row->code) }}" target="_blank">{{ route('shorten.link', $row->code) }}</a>
                            <button value="{{$row->code}}" type="button" class="delete btn btn-outline-danger btn-sm">Delete</button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

</x-app-layout>



</body>

</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js">

</script>

<script>

    $('.delete').click(function(event){
        event.preventDefault();

        let _token   = $('meta[name="csrf-token"]').attr('content');
        let shortLink = $(".delete").val();

        $.ajax({
            url: '/delete-shortUrl',
            type: "POST",
            data: {'shortLink': shortLink, "_token" : _token},
            success: function (response) {
                console.log(shortLink)
            },
            error: function(error) {
                console.log(error);
            },
            complete: function() {
                window.location.href = '/dashboard';

            }
        });
    });
</script>


