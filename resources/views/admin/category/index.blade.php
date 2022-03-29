@extends('layouts.app')

@section('content')

<a class="btn btn-success" href="{{ url('admin/category/form') }}">Criar</a>

<div class="card">
    <div class="card-header">
        Categorias
    </div>

    <div class="card-body">
        @if(count($categories) == 0)
        <div class="alert alert-danger">
            Não existem categorias cadastradas
        </div>
        @else
        <table class='table w-100 table-stripped'>
            <thead>
                <tr>
                    <th> ID </th>
                    <th> NAME </th>
                    <th> OPÇÕES </th>
                    <th> DELETAR </th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
                <tr>
                    <td> {{ $category->id }} </td>
                    <td> {{ $category->name }} </td>
                    <td>
                        <a class="btn btn-danger" href="{{ url('admin/category/form/' . $category->id) }}">Editar</a>
                    </td>
                    <td>
                        <button data-pokemon="{{ $category->id }}" class="btn btn-danger btnDelete" href="{{ url('admin/category/delete/' . $category->id) }}">Deletar</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
    </div>

    <div class="card-footer">

    </div>
</div>

<script>
    $('.btnDelete').on('click', function() {
        var categoryId = $(this).data('pokemon');

        Swal.fire({
            title: 'Deseja realmente deletar? ',
            showCancelButton: true,
            confirmButtonText: 'Deletar',
            cancelButtonText: 'Cancelar',
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                var request = $.ajax({
                    url: "{{ url('admin/category/delete') }}",
                    method: "DELETE",
                    data: {
                        id: categoryId
                    },
                    dataType: "json"
                });
            }
            if (result.isDismissed) {
                Swal.fire('Cancelado!', '', 'success')
            }
        })
    })
</script>

@endsection