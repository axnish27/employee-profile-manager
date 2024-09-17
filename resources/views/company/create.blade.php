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
        <h1 class="h1 text-center">Create View </h1>
        <form action="{{ route('companys.store') }}"
            method="POST"
            enctype="multipart/form-data">
            @csrf
            <label for="name">Name</label>
            <input type="text" name="name">
            <label for="country"></label>
            <input type="text" name="country">
            <label for="branch">Branch</label>
            <input type="text" name="branch">
            <label for="address">Address</label>
            <input type="text" name="address">
            <button>Submit</button>
        </form>
    </body>
</html>
