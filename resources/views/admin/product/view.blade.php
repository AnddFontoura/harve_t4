@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h1 id="productName"></h1>
        </div>

        <div class="card-body">
            <p id="productDescription"></p>
        </div>

        <div class="card-footer">
            <h3 id="productPrice"></h3>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        var url = window.location.href;
        var urlArray = url.split('/');
        var productId = urlArray[urlArray.length - 1];
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var request = $.ajax({
            url: "{{ url('api/products/get') }}" + '/' + productId,
            method: "GET",
            dataType: "json"
        });
        request.done(function(data){
            $('#productName').html(data.name);
            $('#productDescription').html(data.description);
            $('#productPrice').html('R$ ' + data.value);

        });
    });
</script>

@endsection