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
            <button id="btn-add-employee" class="btn btn-primary rounded-circle p-0 mt-2 mb-2 "  data-bs-toggle="modal" data-bs-target="#modal-employee"  >
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
                  </svg>
            </button>

            <div class="modal fade " id="modal-employee" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div id="validation-errors-create" style="display: none;" role="alert"></div>
                <div class="modal-dialog modal-dialog-centered ">
                  <div class="modal-content ">
                    <button type="button" id="btn-modal-close" class="btn-close m-2" data-bs-dismiss="modal" aria-label="Close"></button>
                    <h3 class="text-center text-dark m-0" id="form-title">New Employee Details</h3>
                    <div class="modal-body m-0">
                        <form id="form-create" class="form-modal">
                            @csrf

                            <label class="form-label m-2 fw-bold">Personal Details</label>
                            <input type="text" class=" form-control m-2" name="name" placeholder="Full Name" required>
                            <input type="text" class=" form-control m-2" name="position" placeholder="Position" required>
                            <input type="date" class=" form-control m-2" name="dob" placeholder="DOB" required>
                            <input type="email" class=" form-control m-2" name="email" placeholder="Email" required>
                            <input type="phone" class=" form-control m-2" name="phone" placeholder="Phone" required>
                            <input type="text" class=" form-control m-2" name="address" placeholder="Address" required>

                            <label class="form-label m-2 fw-bold" >Company Details</label>
                            <select id="select-create" name="company_id" class="form-select form-control m-2 " aria-label="Default select example">
                                <option value="" disabled selected>Company</option>
                            </select>
                            <input type="text" class=" form-control m-2" id="company-branch" name="company_branch" placeholder="Branch" required disabled>

                            <label class="form-label m-2 fw-bold" >Bank Details</label>
                            <input type="text" class=" form-control m-2"  name="beneficiary_name" placeholder="Beneficiary Name" required>
                            <input type="text" class=" form-control m-2" name="bank_name" placeholder="Bank Name" required>
                            <input type="phone" class=" form-control m-2" name="bank_branch" placeholder="Branch" required>
                            <input type="number" class=" form-control m-2" name="account_no" placeholder="Account No" required>

                            <button type="submit" class="btn btn-primary m-2"> New Employee </button>
                        </form>
                    </div>
                  </div>
                </div>
              </div>

              <div class="modal fade edit " id="modal-employee-edit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div id="validation-errors-edit" style="display: none;" class=" position-absolute top-0 end-0  w-25" role="alert"></div>
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                    <button type="button" id="btn-modal-close-edit" class="btn-close m-2" data-bs-dismiss="modal" aria-label="Close"></button>
                    <h3 class="text-center text-dark m-0"   id="form-title">Edit Employee</h3>
                    <div class="modal-body">
                        <form id="form-edit" class="form-modal">
                            @csrf
                            <label class="form-label m-2 fw-bold">Personal Details</label>
                            <input type="text" class=" form-control m-2 " id="name" name="name" placeholder="Full Name" required>
                            <input type="text" class=" form-control m-2" id="position" name="position" placeholder="Position" required>
                            <input type="date" class=" form-control m-2" id="dob" name="dob" placeholder="DOB" required>
                            <input type="email" class=" form-control m-2" id="email" name="email" placeholder="Email" required>
                            <input type="phone" class=" form-control m-2" id="phone" name="phone" placeholder="Phone" required>
                            <input type="text" class=" form-control m-2" id="address" name="address" placeholder="Address" required>

                            <label class="form-label m-2 fw-bold" >Company Details</label>
                            <select class="form-select form-control m-2" id="select-edit" name="company_id" aria-label="Default select example"></select>
                            <input type="text" class=" form-control m-2" id="company-branch-edit" name="company_branch" placeholder="Branch" required disabled>

                            <label class="form-label m-2 fw-bold" >Bank Details</label>
                            <input type="hidden" name="bank_id" id="bank-id">
                            <input type="text" class=" form-control m-2" id="beneficiary-name" name="beneficiary_name" required>
                            <input type="text" class=" form-control m-2" id="bank-name" name="bank_name" placeholder="Bank Name" required>
                            <input type="phone" class=" form-control m-2" id="bank-branch" name="bank_branch" placeholder="Branch" required>
                            <input type="number" class=" form-control m-2" id="account-no" name="account_no" placeholder="Account No" required>

                            <button type="submit" class="btn btn-primary m-2"> Add </button>
                        </form>
                    </div>
                  </div>
                </div>
              </div>

            <table id="myTable" class="table table-striped table-dark table-hover  " style="width: 100%"></table>
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
                        { data: 'company.name', title:'Company' },
                        { data: 'company.branch', title:'Branch'},
                        { data: 'name' , title: 'Name' ,},
                        { data: 'position' ,title:'Position' },
                        { data: 'dob', title:'DOB' },
                        { data: 'email' , title:'Email'},
                        { data: 'phone', title:'Phone' },
                        { data: 'address' , title:'Address'},
                        { data: 'bank_account.account_no', title:'Bank Acc' },
                        { data: null ,
                            render: function (data, type, row) {
                                return `  <button class="d-inline btn  btn-edit p-0 " id="btn-edit-${row.id}" data-id="${row.id}" data-bs-toggle="modal" data-bs-target="#modal-employee-edit" >
                                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="dodgerblue" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                                            </svg>
                                          </button>
                                           <button  id="btn-dlt-${row.id}" class="btn btn-dlt p-0 d-inline" data-id="${row.id}" >
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
                $('#myTable tbody').on('click', '.btn-dlt', function (e) {
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
                $('#btn-add-employee').click(function (e) {
                    axios.get('employee/create')
                    .then(function (response){
                        const companies = response.data
                        const select = $('#select-create')
                        companies.forEach(company => {
                            select.append(`<option value="${company.id}" class="create-option" data-branch="${company.branch}">${company.name}</option>`)
                        });
                    });
                });

                //Store Employee Axios
                $('#form-create').submit(function (e) {
                    e.preventDefault();
                    let $data = $('#form-create').serialize()

                    axios.post('employee', $data )
                    .then(function (response){
                        $('#form-create').trigger("reset");
                        $('#btn-modal-close').click();
                        table.draw();
                    })
                    .catch(function (response){
                        displayError(response , "create")
                    });
                });

                //Edit Employee
                let id = null
                $('#myTable tbody').on('click', '.btn-edit', function (e) {
                    id =  table.row( $(this).parents('tr') ).data().id;
                    axios.get(`employee/${id}`)
                    .then(function (response){
                        const data = response.data[0][0];
                        const companies = response.data[1]
                        const selectOption= $("#select-edit")
                        $('#name').val(data.name)
                        $('#position').val(data.position)
                        $('#dob').val(data.dob)
                        $('#email').val(data.email)
                        $('#phone').val(data.phone)
                        $('#address').val(data.address)
                        selectOption.append(`<option value="${data.company.id}" class="create-option" data-branch="${data.company.branch}" selected>${data.company.name}</option>`)
                        companies.forEach((company) => {
                            selectOption.append(`<option value="${company.id}" class="create-option" data-branch="${company.branch}">${company.name}</option>`)
                        });
                        $("#company-branch-edit").val(data.company.branch)
                        $('#bank-id').val(data.bank_account.id)
                        $('#beneficiary-name').val(data.bank_account.beneficiary_name)
                        $('#bank-name').val(data.bank_account.bank_name)
                        $('#bank-branch').val(data.bank_account.branch)
                        $('#account-no').val(data.bank_account.account_no)
                    });
                });

                $('#form-edit').submit(function(e){
                    e.preventDefault();
                    let dataSubmit = $('#form-edit').serialize()
                    axios.patch(`employee/${id}`, dataSubmit )
                    .then(function (response){
                        $('#form-edit').trigger("reset");
                        $('#btn-modal-close-edit').click();
                        table.draw();
                    })
                    .catch(function (response){
                        displayError(response , "edit")
                    });
                });

                // Clear Forms on Submit
                $('.btn-close').click(function (e) {
                    $('.form-modal').trigger("reset");

                });

                // Set Branch on Selct
                $('#select-create').on('click' , function (e) {
                    const selectedOption = $(this).find(':selected');
                    $('#company-branch-create').val(selectedOption.data('branch'))
                });

                $('#select-edit').on('click' , function (e) {
                    const selectedOption = $(this).find(':selected');
                    $('#company-branch-edit').val(selectedOption.data('branch'))
                });

                // Customer Error Alerts
                function displayError(response , modal){
                    const errors = response.response.data.errors
                    const valErrorDiv = $('#validation-errors-'+ modal)
                    valErrorDiv.empty();
                    for (const field in errors) {
                        errors[field].forEach(error => {
                            const alertDiv = $('<div></div>')
                            alertDiv.addClass("alert alert-danger m-2")
                            alertDiv.text(error);
                            console.log(error);
                            valErrorDiv.append(alertDiv);
                        });
                    }
                    valErrorDiv.fadeIn("slow").delay(5000).fadeOut("slow");
                }
            });
        </script>
    </body>
</html>

