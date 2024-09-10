<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
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
            <div class="card w-25 h-25 mt-3 " >
                <div class="card-body d-flex   justify-content-evenly flex-column">
                    <h4 class="card-title">
                        Aanish Ramzan </h4>
                    <h5 class="card-subtitle">Intern </h5>
                    <div class="mt-2">2005-06-07</div>
                    <div class="mt-2">aansh2710@gmail.com</div>
                    <div class="mt-2">+94767762731</div>
                    <div class="mt-2 mb-2">153/7 mullegma ambatenna</div>
                    <button class="btn btn-primary mb-2"> Edit </button>
                    <button class="btn btn-danger"> Delete </button>
                </div>

            </div>
            <div class="card w-25 h-25 mt-3" >
                <div class="card-body d-flex justify-content-evenly flex-column">
                    <h4 class="card-title">
                        Aanish Ramzan </h4>
                    <h5 class="card-subtitle">
                        Intern </h5>
                    <div class="mt-2">2005-06-07</div>
                    <div class="mt-2">aansh2710@gmail.com</div>
                    <div class="mt-2">+94767762731</div>
                    <div class="mt-2 mb-2">153/7 mullegma ambatenna</div>
                    <button class="btn btn-primary mb-2"> Edit </button>
                    <button class="btn btn-danger"> Delete </button>
                </div>

            </div>
            <div class="card w-25 h-25 mt-3" >
                <div class="card-body d-flex justify-content-evenly flex-column">
                    <h4 class="card-title">
                        Aanish Ramzan </h4>
                    <h5 class="card-subtitle">
                        Intern </h5>
                    <div class="mt-2">2005-06-07</div>
                    <div class="mt-2">aansh2710@gmail.com</div>
                    <div class="mt-2">+94767762731</div>
                    <div class="mt-2 mb-2">153/7 mullegma ambatenna</div>
                    <button class="btn btn-primary mb-2"> Edit </button>
                    <button class="btn btn-danger"> Delete </button>
                </div>

            </div>
            <div class="card w-25 h-25 mt-3" >
                <div class="card-body d-flex justify-content-evenly flex-column">
                    <h4 class="card-title">
                        Aanish Ramzan </h4>
                    <h5 class="card-subtitle">
                        Intern </h5>
                    <div class="mt-2">2005-06-07</div>
                    <div class="mt-2">aansh2710@gmail.com</div>
                    <div class="mt-2">+94767762731</div>
                    <div class="mt-2 mb-2">153/7 mullegma ambatenna</div>
                    <button class="btn btn-primary mb-2"> Edit </button>
                    <button class="btn btn-danger"> Delete </button>
                </div>

            </div>
            <div class="card w-25 h-25 mt-3" >
                <div class="card-body d-flex justify-content-evenly flex-column">
                    <h4 class="card-title">
                        Aanish Ramzan </h4>
                    <h5 class="card-subtitle">
                        Intern </h5>
                    <div class="mt-2">2005-06-07</div>
                    <div class="mt-2">aansh2710@gmail.com</div>
                    <div class="mt-2">+94767762731</div>
                    <div class="mt-2 mb-2">153/7 mullegma ambatenna</div>
                    <button class="btn btn-primary mb-2"> Edit </button>
                    <button class="btn btn-danger"> Delete </button>
                </div>

            </div>
            <div class="card w-25 h-25 mt-3" >
                <div class="card-body d-flex justify-content-evenly flex-column">
                    <h4 class="card-title">
                        Aanish Ramzan </h4>
                    <h5 class="card-subtitle">
                        Intern </h5>
                    <div class="mt-2">2005-06-07</div>
                    <div class="mt-2">aansh2710@gmail.com</div>
                    <div class="mt-2">+94767762731</div>
                    <div class="mt-2 mb-2">153/7 mullegma ambatenna</div>
                    <button class="btn btn-primary mb-2"> Edit </button>
                    <button class="btn btn-danger"> Delete </button>
                </div>

            </div>
            <div class="card w-25 h-25 mt-3" >
                <div class="card-body d-flex justify-content-evenly flex-column">
                    <h4 class="card-title">
                        Aanish Ramzan </h4>
                    <h5 class="card-subtitle">
                        Intern </h5>
                    <div class="mt-2">2005-06-07</div>
                    <div class="mt-2">aansh2710@gmail.com</div>
                    <div class="mt-2">+94767762731</div>
                    <div class="mt-2 mb-2">153/7 mullegma ambatenna</div>
                    <button class="btn btn-primary mb-2"> Edit </button>
                    <button class="btn btn-danger"> Delete </button>
                </div>

            </div>
            <div class="card w-25 h-25 mt-3" >
                <div class="card-body d-flex justify-content-evenly flex-column">
                    <h4 class="card-title">
                        Aanish Ramzan </h4>
                    <h5 class="card-subtitle">
                        Intern </h5>
                    <div class="mt-2">2005-06-07</div>
                    <div class="mt-2">aansh2710@gmail.com</div>
                    <div class="mt-2">+94767762731</div>
                    <div class="mt-2 mb-2">153/7 mullegma ambatenna</div>
                    <button class="btn btn-primary mb-2"> Edit </button>
                    <button class="btn btn-danger"> Delete </button>
                </div>

            </div>
            <div class="card w-25 h-25 mt-3" >
                <div class="card-body d-flex justify-content-evenly flex-column">
                    <h4 class="card-title">
                        Aanish Ramzan </h4>
                    <h5 class="card-subtitle">
                        Intern </h5>
                    <div class="mt-2">2005-06-07</div>
                    <div class="mt-2">aansh2710@gmail.com</div>
                    <div class="mt-2">+94767762731</div>
                    <div class="mt-2 mb-2">153/7 mullegma ambatenna</div>
                    <button class="btn btn-primary mb-2"> Edit </button>
                    <button class="btn btn-danger"> Delete </button>
                </div>

            </div>

        </div>

    </body>
</html>

