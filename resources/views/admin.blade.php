<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Laravel</title>


        @vite([ 'resources/css/app.css', 'resources/js/app.js'])

    </head>
    <body class="container ">
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

        <div class="cards d-flex flex-wrap justify-content-center  mx-auto gap-3">

        </div>

        <div class="modal fade" id="modal-task-create" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <button type="button" class="btn-close m-2" data-bs-dismiss="modal" aria-label="Close"></button>
                <h3 class="text-center text-dark">Edit Employee</h3>
                <div class="modal-body">
                    {{-- <form
                        action="{{ route('employee' , $project->id) }}"
                        method="POST"
                        enctype="multipart/form-data"
                        class="d-flex justify-content-start flex-column  "
                        >
                        @csrf
                        @method('PUT')

                        <label class="text-start  form-label " for="title">Title</label>
                        <input class="form-control m-2" type="text" name="title" id="title" value="{{ $project->title }} " required >
                        <label class="form-label text-start" for="description">Description</label>
                        <input class="form-control m-2" type="text" name="description" id="description" value="{{ $project->description }}" required >
                        <button class="btn btn-primary align-self-center"> Edit </button>
                </form> --}}
                </div>

              </div>
            </div>
          </div>


        <script type="module">

            $(function(){

                let table ;
                axios.get('employee')
                .then(function (response) {

                    table =  $('#myTable').DataTable({
                        data: response.data,
                        columns: [
                            { data: 'name', title:'name' },
                            { data: 'position' ,title:'posi' },
                            { data: 'dob', title:'dob' },
                            { data: 'email' },
                            { data: 'phone' },
                            { data: 'address' },
                            { data: null },

                        ],
                        columnDefs: [
                            {

                                render: function (data, type, row) {
                                    return `<button id="btn-edit-${row.id}" class="btn btn-primary" data-id="${row.id}" data-bs-toggle="modal" data-bs-target="#modal-task-create">Edit</button>
                                            <button id="btn-dlt-${row.id}" class="btn btn-danger" data-id="${row.id}" >Delete</button>`;
                                },
                                targets: -1,
                            }
                        ]
                    });
                })
                .catch(function (error) {
                    console.log(error);
                })
                .finally(function () {

                });


                        $('#myTable tbody').on('click', 'button[id^="btn-edit"]', function (e) {

                        let id = $(this).data('id');
                            console.log('Edit button clicked, ID:', id);

                        });

                        $('#myTable tbody').on('click', 'button[id^="btn-dlt"]', function (e) {

                            let id = $(this).data('id');
                            deleteEmployee(id)
                            console.log('delete button clicked, ID:', id);

                        });

            // $(document).ready(loadEmployeeData);


            $('#myTable tbody').on('click', '#btn-edit', function (e) {
                let data = e.currentTarget

                console.log(data);

            });




//                     $('#myTable tbody').on('click', 'button[id^="btn-edit"]', function (e) {
//     let dataId = $(this).data('id'); // Get the data-id of the clicked row
//     console.log('Edit button clicked, ID:', dataId);
// });



            $(".cards").on("click", "#btn-dlt", (e) => deleteEmployee(e));


            function deleteEmployee(id){


                axios.delete(`employee/${id}`)
                .then(function (response){
                    if (response.status == 200){
                        window.location.reload();
                    }
                })
                .catch(function (error){

                })
                .finally(function (){

                });
            }

            function deleteEmployee(id){


                axios.delete(`employee/${id}`)
                .then(function (response){
                    if (response.status == 200){
                        window.location.reload();
                    }
                })
                .catch(function (error){

                })
                .finally(function (){

                });
            }

            function editEmployee(id){


                axios.get(`employee/${id}`)
                .then(function (response){
                    if (response.status == 200){
                        fillModal(response)
                    }
                })
                .catch(function (error){

                })
                .finally(function (){

                });
            }

            function fillModal(response){

            }






                // const token = $("meta[name='csrf-token']").attr("content");

                // $.ajax({
                //     type: "POST",
                //     data: {_token: token, id: $id, _method: 'DELETE'},
                //     url: "employee/" + $id,
                //     success: function (response) {
                //         console.log("deleted", response );
                //     }
                // });




            });


        </script>
    </body>
</html>

