<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Laravel') }}</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body class="container container.fluid w-100 " style="background-color: rgb(249, 249, 249) ">

      <h1 class="h1 text-center">Company Manager </h1>

        <table id="myTable" class="table table-striped table-dark table-hover  " style="width: 100%"> </table>




        {{--
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
        </ul> --}}
        <script type="module">
            $(function () {

              let table= $('#myTable').DataTable({
                    serverSide: true,
                    processing: true,
                    ajax: {
                        url: 'company/draw',
                    },
                    columns: [
                        { data: 'name', title:'Company' },
                        { data: 'branch', title:'Branch'},
                        { data: 'country' , title: 'Country' ,},
                        { data: 'address' , title:'address' },
                        { data: null ,
                            render: function (data, type, row) {
                                return `  <button class="d-inline btn  btn-edit p-0 " id="btn-edit-${row.id}" data-id="${row.id}" data-bs-toggle="modal" data-bs-target=".modal" >
                                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="dodgerblue" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                                            </svg>
                                          </button>
                                           <button class="btn btn-dlt-modal p-0 d-inline" data-id="${row.id}" data-bs-toggle="modal" data-bs-target="#deletConfirmation" >
                                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="red" class="bi bi-trash" viewBox="0 0 16 16">
                                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                                                <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                                            </svg>
                                        </button> `
                            }
                        },
                    ],
                });
            });
        </script>


    </body>
</html>
