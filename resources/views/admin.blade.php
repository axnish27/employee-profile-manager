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


        <div class="cards d-flex flex-wrap justify-content-center  mx-auto gap-3">

        </div>


        <script type="module">

            function loadEmployeeData() {
                $.ajax({
                    type: "GET",
                    url: "employee",
                    success: function (response) {
                        const $arrayResponse = JSON.parse(response)
                        $arrayResponse.forEach(employee => {
                            fillCardWithData(employee)

                        });
                    }
                });
            }

            function fillCardWithData($response){

                const $card = $('<div>', { class: 'card w-25 h-25 mt-3' });
                const $cardBody = $('<div>', { class: 'card-body d-flex justify-content-evenly flex-column' });
                const $cardTitle = $('<h4>', { class: 'card-title'}).text($response.title);
                const $cardSubtitle = $('<h5>', { class: 'card-subtitle'}).text($response.position);

                const $dateDiv = $('<div>', { class: 'mt-2'}).text($response.dob);
                const $emailDiv = $('<div>', { class: 'mt-2'}).text($response.email);
                const $phoneDiv = $('<div>', { class: 'mt-2'}).text($response.phone);
                const $addressDiv = $('<div>', { class: 'mt-2 mb-2'}).text($response.address);



                const $editButton = $('<button>', { id:'btn-edit', class: 'btn btn-primary mb-2', text: 'Edit' }).data("id" , $response.id);
                const $deleteButton = $('<button>', { id:'btn-dlt',class: 'btn btn-danger', text: 'Delete' }).data("id" , $response.id);

                $cardBody.append($cardTitle, $cardSubtitle, $dateDiv, $emailDiv, $phoneDiv, $addressDiv, $editButton, $deleteButton);
                $card.append($cardBody);

                $(".cards").append($card);


            }

            $(document).ready(loadEmployeeData);



            $(".cards").on("click", "#btn-edit", function (e) {


            });

            $(".cards").on("click", "#btn-dlt", (e) => deleteEmployee(e));


            function deleteEmployee(e){
                const $id = $(e.target).data('id');
                $.ajax({
                    method: "DELETE",
                    url: "employee/" + $id,
                    
                    success: function (response) {
                        console.log("deleted", response );

                    }
                });
            }


        </script>
    </body>
</html>

