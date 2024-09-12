<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Employee Manager</title>

        @vite([ 'resources/css/app.css', 'resources/js/app.js', ])

    </head>
    <body class="container.fluid w-100 ">

        <nav class="navbar bg-dark border-bottom border-body w-100 text-light" data-bs-theme="dark">
            <div class="container">
                <a class="navbar-brand" href="#"> Vista G </a>
                <div class="nav navbar">
                    <a class="nav-link active" aria-current="page" href="#">Home</a>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="nav-link">Logout</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
        </nav>

        <main class="container">
            <h1 class="h1 text-center" >Manage Employee Profiles</h1>
            <button class=" btn btn-primary" style="margin-left: 11% " data-bs-toggle="modal" data-bs-target="#modal-employee-create">New Employee</button>
            <div class="modal fade" id="modal-employee-create" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <button type="button" class="btn-close m-2" data-bs-dismiss="modal" aria-label="Close"></button>
                    <h3 class="text-center text-dark">New Employee Details</h3>
                    <div class="modal-body">
                        <form
                            action="{{ route('employee.store') }}"
                            method="POST"
                            enctype="multipart/form-data">
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
            <table id="myTable" class="table table-striped mt-2 " >

            </table>
        </main>

        <script type="module">
            $(function(){
                $('#myTable').DataTable({
                    serverSide: true,
                    processing: true,
                    ajax: {
                        url: 'employee',
                        dataSrc: ''
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
                                return `<button id="btn-edit-${row.id}" class="btn btn-primary" data-id="${row.id}" data-bs-toggle="modal" data-bs-target="#modal-task-create">Edit</button>
                                        <button id="btn-dlt-${row.id}" class="btn btn-danger" data-id="${row.id}" >Delete</button>`;
                            }
                        },
                    ]
                });



                // Delete Employee
                $('#myTable tbody').on('click', 'button[id^="btn-dlt"]', function (e) {
                    let id = $(this).data('id');
                    deleteEmployee(id)
                });

                function deleteEmployee(id){
                    axios.delete(`employee/${id}`)
                    .then(function (response){
                        if (response.status == 200){
                            window.location.reload();
                        }
                    });
                }
            });
        </script>
    </body>
</html>

