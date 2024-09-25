<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Laravel') }}</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body class="container.fluid w-100 " style="background-color: rgb(249, 249, 249) ">

      <x-nav-bar parent="admin" />

      <main class="container">
        <h1 class="h1 text-center mt-4" >Manage Company Profiles</h1>
        <button id="btn-add-company" class="btn btn-primary rounded-circle p-0 mt-2 mb-2 "  data-bs-toggle="modal" data-bs-target=".modal"  >
            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
              </svg>
        </button>

        <div class="modal fade"  data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div id="validation-errors" style="display: none;" class="position-absolute top-0 end-0  w-25" role="alert"></div>
            <div class="modal-dialog modal-dialog-centered ">
              <div class="modal-content ">
                <button type="button" id="btn-modal-close" class="btn-close m-1" data-bs-dismiss="modal" aria-label="Close"></button>
                <h3 class="text-center text-dark m-0" id="form-title"></h3>
                <div class="modal-body m-0">
                    <form class="form-modal">
                        @csrf
                        <label class="form-label fw-bold">Company Details</label>
                        <input type="text" class=" form-control m-2" id="name" name="name" placeholder="Name" required>
                        <input type="text" class=" form-control m-2" id="branch" name="branch" placeholder="Branch" required>
                        <input type="text" class=" form-control m-2" id="country" name="country" placeholder="Country" required>
                        <input type="text" class=" form-control m-2" id="address" name="address" placeholder="Address" required>
                        <input type="hidden" class=" form-control m-2" id="company_id" name="company_id" required>
                        <input type="hidden" class=" form-control m-2" id="projects" disabled>
                        <input type="hidden" class=" form-control m-2" id="employees" disabled>
                        <button type="submit" class="btn btn-primary m-2" id="btn-submit"></button>
                    </form>
                </div>
              </div>
            </div>
          </div>


          <!-- Delete Modal -->
          <div class="modal fade" id="deletConfirmation" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deletConfirmationLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="deletConfirmationLabel">Are You Sure to Delete the Company?? </h1>
                  <button type="button" class="btn-close btn-close-dlt" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  This Action wil Delete Company and the records related to him Such as Employees and Projects
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                  <button type="button" id="btn-dlt"  class="btn btn-danger btn-dlt">Delete</button>
                </div>
              </div>
            </div>
          </div>

          <table id="myTable" class="table table-striped table-dark table-hover  " style="width: 100%"> </table>
      </main>

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
                    { data: 'address' , title:'Address' },
                    { data: 'employees_count' , title:'Employees' },
                    { data: 'projects_count' , title:'Projects' },
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

            // Delete Company
            $('#myTable tbody').on('click' , '.btn-dlt-modal' ,function (e) {
                $('#btn-dlt').text('Delete').attr('data-id' , table.row($(this).parents('tr')).data().id)
            });

            $('#deletConfirmation .modal-footer').on('click' , '#btn-dlt' , function (e) {
                axios.delete(`companys/${$(this).attr('data-id')}`)
                .then(function (response){
                    console.log("Delted")
                });
                table.draw(false);
                $('.btn-close-dlt').click();
            })

            //Store Company Axios
            $('#btn-add-company').click(function (e) {
              $('.form-modal').attr("id","form-create");
              $('#form-title').text("New Company Details");
              $('#btn-submit').text("Add Company");
            });

            $('.modal-body').on('submit' , '#form-create', function (e){
                e.preventDefault();
                let $data = $('#form-create').serialize()
                axios.post('companys', $data )
                .then(function (response){
                    $('#form-create').trigger("reset");
                    $('#btn-modal-close').click();
                    table.draw();
                })
                .catch(function (response){
                    displayError(response)
                });
            });

            // Clear Forms
            $('.btn-close').click(function (e) {
              $('.form-modal').trigger("reset");
            });

            // Edit Company
            $('#myTable tbody').on('click', '.btn-edit', function (e) {
                $('.form-modal').attr("id","form-edit");
                $('#form-title').text("Edit Company Details");
                $('#btn-submit').text("Update Company");

                var id = table.row( $(this).parents('tr') ).data().id;
                axios.get(`companys/${id}/edit`)
                .then(function (response){
                    const data = response.data;
                    $('#name').val(data.name)
                    $('#branch').val(data.branch)
                    $('#country').val(data.country)
                    $('#address').val(data.address)
                    $('#company_id').val(data.id)
                    $('#projects').val(data.projects_count).prop("type" , "text")
                    $('#employees').val(data.employees_count).prop("type" , "text")
                });
            });

            $('.modal-body').on('submit' , '#form-edit', function (e){
                e.preventDefault();
                let dataSubmit = $('#form-edit').serialize()
                axios.patch(`companys/${id}`, dataSubmit )
                .then(function (response){
                    $('#form-edit').trigger("reset");
                    $('#btn-modal-close').click();
                    table.draw();
                })
                .catch(function (response){
                    displayError(response)
                });
            });

            //Error Alerts
            function displayError(response){
              const errors = response.response.data
              const valErrorDiv = $('#validation-errors')
              valErrorDiv.empty();
              for (const field in errors) {
                errors[field].forEach((error) => {
                          const alertDiv = $('<div></div>')
                          alertDiv.addClass("alert alert-danger m-2")
                          alertDiv.text(error);
                          valErrorDiv.append(alertDiv);
                  });
              }
              valErrorDiv.fadeIn("slow").delay(5000).fadeOut("slow");
            }
        });
      </script>
    </body>
</html>
