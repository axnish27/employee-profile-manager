<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Employee Manager</title>


        @vite([ 'resources/css/app.css', 'resources/js/app.js', ])
    </head>

    <body class="container.fluid w-100 " style="background-color: whitesmoke">

        <nav class="navbar bg-dark border-bottom border-body w-100 text-light py-0"  data-bs-theme="dark">
            <div class="container">
                <a class="navbar-brand" href="#"> Vista G </a>
                <div class="nav navbar">
                    <a class="nav-link active" aria-current="page" href="{{ route('companys.index') }}">Company</a>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="nav-link">Logout</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
        </nav>

        <main class="container" >
            <h1 class="h1 text-center mt-4" >Manage Employee Profiles</h1>
            <button class="btn btn-primary rounded-circle p-0 mt-2 mb-2 "  data-bs-toggle="modal" data-bs-target="#modal-employee-create"  >
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
                  </svg>
            </button>

            <div class="modal fade" id="modal-employee-create" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <button type="button" id="btn-modal-close" class="btn-close m-2" data-bs-dismiss="modal" aria-label="Close"></button>
                    <h3 class="text-center text-dark">New Employee Details</h3>
                    <div class="modal-body">
                        <form id="createForm">
                            @csrf
                            <input type="text" class=" form-control m-2" name="name" placeholder="Full Name" required>
                            <input type="text" class=" form-control m-2" name="position" placeholder="Position" required>
                            <input type="date" class=" form-control m-2" name="dob" placeholder="DOB" required>
                            <input type="email" class=" form-control m-2" name="email" placeholder="Email" required>
                            <input type="phone" class=" form-control m-2" name="phone" placeholder="Phone" required>
                            <input type="text" class=" form-control m-2" name="address" placeholder="Address" required>
                            <button type="submit" class="btn btn-primary m-2"> Add </button>
                        </form>
                    </div>
                  </div>
                </div>
              </div>
            <table id="myTable" class="table table-striped table-dark table-hover  " style="width: 100%">
            </table>
        </main>

        <script type="module">
            $(function(){
                let table= $('#myTable').DataTable({
                    serverSide: true,
                    processing: true,
                    ajax: {
                        url: 'employee',
                    },
                    columns: [
                        { data: 'name' , title: 'Name' ,},
                        { data: 'position' ,title:'Position' },
                        { data: 'dob', title:'DOB' },
                        { data: 'email' , title:'Email'},
                        { data: 'phone', title:'Phone' },
                        { data: 'address' , title:'Address'},
                        { data: null ,
                            render: function (data, type, row) {
                                return `  <button class="d-inline btn  edit p-0 " id="btn-edit-${row.id}" data-id="${row.id}" >
                                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="dodgerblue" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                                            </svg>
                                          </button>
                                           <button  id="btn-dlt-${row.id}" class="btn p-0 d-inline" data-id="${row.id}" >
                                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="red" class="bi bi-trash" viewBox="0 0 16 16">
                                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                                                <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                                            </svg>
                                        </button> `
                            }
                        },
                    ],
                });

                // Delete Employee
                $('#myTable tbody').on('click', 'button[id^="btn-dlt"]', function (e) {
                    let id = $(this).data('id');
                    deleteEmployee(id)
                    let $button = $(this)
                    table.row($button.parents('tr') ).remove().draw();

                });

                function deleteEmployee(id){
                    axios.delete(`employee/${id}`)
                    .then(function (response){
                        console.log("Delted");
                    });
                }

                //Create Employee Axios
                $('#createForm').submit(function (e) {

                    e.preventDefault();
                    let $data = $('#createForm').serialize()
                    let $dataArray = $('#createForm').serializeArray()
                    axios.post('employee', $data )
                    .then(function (response){
                        $('#createForm').trigger("reset");
                        $('#btn-modal-close').click();
                        table.draw();
                    });
                });
            });
        </script>
    </body>
</html>

