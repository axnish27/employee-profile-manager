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

                    <div class="modal fade" id="deletConfirmation" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deletConfirmationLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h1 class="modal-title fs-5" id="deletConfirmationLabel">Are You Sure to Delete the Company Details?? </h1>
                              <button type="button" class="btn-close btn-close-dlt" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              This Action wil Delete Company and the records related to him Such as Projects
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                              <form action="{{ route('companys.destroy' , $company->id ) }}"
                                method="POST"
                                class="d-inline">
                                @method('DELETE')
                                @csrf
                                <button type="button" id="btn-dlt"  class="btn btn-danger btn-dlt">Delete</button>
                             </form>
                            </div>
                          </div>
                        </div>
                      </div>
                    <button class="btn btn-danger btn-dlt-modal p-1 d-inline" data-bs-toggle="modal" data-bs-target="#deletConfirmation" >Delete</button>
                </li>
             @endforeach
        </ul>
    </body>
</html>
