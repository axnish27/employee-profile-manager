<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Laravel') }}</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    
    <body class="container">
        <h1 class="h1 text-center">Company Manager </h1>
        <a href="{{ route('companys.create')}}" class="btn btn-primary"> Create New Company</a>
        <ul>
            @foreach ($companys as $company)
                <li>
                    <a class="link" aria-current="page" href="{{ route('companys.show' ,  $company->id ) }}">
                        <b>{{ $company->name }}</b>
                    </a>
                    <br>
                    <a href="{{ route('companys.edit' , $company->id) }}" class="btn btn-success  d-inline"> Edit</a>
                    <form action="{{ route('companys.destroy' , $company->id ) }}"
                        method="POST"
                        class="d-inline">
                        @method('DELETE')
                        @csrf
                        <button class="btn btn-danger">Delete</button>
                    </form>
                </li>
             @endforeach
        </ul>
    </body>
</html>
