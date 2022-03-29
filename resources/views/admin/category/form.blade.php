@extends('layouts.app')

@section('content')

    <form class="row" action="{{ url('admin/category/save') }}@if($category)/{{ $category->id }}@endif" method="post">
        @csrf
        <fieldset class="form-group col-8 offset-2">
            <label for="name">
                Nome
            </label>
            <input id="pokemon" onChange="alertOnChange()" value="@if($category){{ $category->name }}@endif" class="form-control mb-3" type="text" name="name" placeholder="Digite seu nome">
            <button id="pokemon2" onClick="alertOnClick()" disabled class="btn @if($category) btn-primary @else btn-success @endif" type="submit">
                @if($category) Atualizar @else Salvar @endif
            </button>
        </fieldset>
    </form>

    <script>
        function alertOnChange(){
            let inputValue = document.getElementById("pokemon").value;

            if (inputValue.length >= 4){
                document.getElementById("pokemon2").disabled = false;
                document.getElementById("pokemon2").classList.remove("btn-success");
                document.getElementById("pokemon2").classList.remove("btn-danger");
                document.getElementById("pokemon2").classList.add("btn-primary");
            } else{
                document.getElementById("pokemon2").disabled = true;
                document.getElementById("pokemon2").classList.remove("btn-success");
                document.getElementById("pokemon2").classList.remove("btn-primary");
                document.getElementById("pokemon2").classList.add("btn-danger");
            }
        }

        function alertOnClick(){
            alert("Funcionou");
        }
    </script>

@endsection