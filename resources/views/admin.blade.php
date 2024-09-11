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

          <table id="myTable" class="table table-striped mt-2" style="width:100%">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Position</th>
                    <th>DOB</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th></th>

                </tr>
            </thead>
            <tbody>
                <tr>

                </tr>
            </tbody>
        </table>

        <div class="cards d-flex flex-wrap justify-content-center  mx-auto gap-3">

        </div>


        <script type="module">

            $(function(){

                loadEmployeeData()

                function loadEmployeeData() {
                    axios.get('employee')
                        .then(function (response) {
                            $('#myTable').DataTable({
                                data: response.data,
                                columns: [
                                    { data: 'name' },
                                    { data: 'position' },
                                    { data: 'dob' },
                                    { data: 'email' },
                                    { data: 'phone' },
                                    { data: 'address' },
                                    { data: null },

                                ],
                                columnDefs: [
                                    {
                                        defaultContent: '<button id="btn-edit" class="btn btn-primary">Edit</button> <button id="btn-dlt" class="btn btn-danger">Delete</button>',
                                        targets: -1
                                    }
                                ]
                            });
                        }) // <-- Corrected this part
                        .catch(function (error) {
                            console.log(error);
                        })
                        .finally(function () {

                        });
}




            // $(document).ready(loadEmployeeData);

            let $table = $('#myTable')
            $table.on('click', 'button', function (e) {
                let data = $table.row(e.target.closest('tr')).data();

                alert(data[0] + "'s salary is: " + data[5]);
            });


            $(".cards").on("click", "#btn-edit", function (e) {
                console.log(e.currentTarget);


            });

            $(".cards").on("click", "#btn-dlt", (e) => deleteEmployee(e));


            function deleteEmployee(e){
                const $id = $(e.target).data('id');

                axios.delete(`employee/${$id}`)
                .then(function (response){
                    if (response.status == 200){

                        alert("Delete Success")
                    }
                })
                .catch(function (error){

                })
                .finally(function (){

                });
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

