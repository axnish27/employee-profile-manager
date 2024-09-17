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
        <h1 class="h1 text-center mt-5">{{ $company->name }} </h1>

        <div><b>Country</b>: {{ $company->country }}  </div>
        <div><b>Branch</b>: {{ $company->branch }} </div>
        <div><b>Address</b>: {{ $company->address }} </div>

        <h2 class="h2 mt-5">Working Employess</h2>
        @foreach ($companyEmployees as $employee )
            <div><b>{{ $employee->name }}</b></div>
        @endforeach

        <a class="btn btn-primary mt-5" href="{{ url()->previous() }}">Go Back</a>
    </body>
</html>
