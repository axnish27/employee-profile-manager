<?php

namespace App\Http\Controllers;

use App\Models\BankAccount;
use App\Models\Company;
use App\Models\Employee;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class EmployeeController extends Controller
{
    public function index(Request $request){
        $companies = Company::all();
        return view('admin' , [ 'companies' => $companies]);
    }

    public function draw(Request $request){

          //SERVER SIDE RENDERING HANDLE FOR data table
          $search = $request->query('search')['value'];
          $draw = $request->query('draw', 1);
          $start = $request->query('start', 0);
          $length = $request->query('length', 10);
          $totalEmployees =   Employee::count();

          $employees = Employee::with('bankAccount' , 'company')->where('name' , 'like' , "%".$search."%")
                              ->orWhere('position' ,'like' , "%".$search."%")
                              ->orWhere('email', 'like' , "%".$search."%")
                              ->orWhere('address' ,'like' , "%".$search."%")
                              ->orWhere('dob' ,'like' , "%".$search."%")
                              ->orWhere('phone' ,'like' , "%".$search."%")
                              ->orWhereHas('bankAccount',
                              function ($q) use ($search) {
                                  $q->where('account_no', 'like', "%".$search."%")->select('branch'); })
                              ->orWhereHas('company', function ($q) use ($search) {
                                  $q->where('name', 'like', "%".$search."%"); })
                              ->orWhereHas('company', function ($q) use ($search) {
                                  $q->where('branch', 'like', "%".$search."%"); });

          $filteredEmployees = $search ? $employees->count() : $totalEmployees;
          $employees = $employees->skip($start)
                                  ->take($length)
                                  ->get();

          $response = [
              'draw' => intval($draw),
              'recordsTotal' => intval($totalEmployees),
              'recordsFiltered' => $filteredEmployees,
              'data' => $employees
          ];
          return Response::json($response);
    }


    public function store(Request $request){
        try {
            $employeeValidated = $request->validate([
                'name' => 'required|max:50|',
                'position' => 'required|max:50|',
                'dob' => 'required|date',
                'email' => 'required|unique:employees|email',
                'phone' => 'required|max:13',
                 'address' => 'required|max:255',
                 'company_id' => 'required',
            ]);
            $bankAccValidated = $request->validate([
                'beneficiary_name' => 'required',
                'bank_name' => 'required',
                'branch' => 'required',
                'account_no' => 'required|max:9',
            ]);
        } catch (ValidationException $e) {
            return Response::json($e->errors(), 422);
        }

        $employee = Employee::create($employeeValidated);
        $bankAccValidated['employee_id'] = $employee->id;
        BankAccount::create($bankAccValidated);
        return response(200);

    }

    public function edit(string $id){
        $employee = Employee::with('bankAccount' , 'company')->where('id',$id)->get();
        return Response::json($employee);
    }

    public function update(Request $request , string $id){
        try {
            $employeeValidated = $request->validate([
                'name' => 'required|max:50',
                'position' => 'required|max:50',
                'dob' => 'required|date',
                'email' => [
                    'required',
                    'email',
                    Rule::unique('employees', 'email')->ignore($id),
                ],
                'phone' => 'required|max:13',
                'address' => 'required|max:255',
                'company_id' => 'required',
            ]);

            $bankAccValidated = $request->validate([
                'beneficiary_name' => 'required',
                'bank_name' => 'required',
                'branch' => 'required',
                'account_no' => 'required|max:9',
                'bank_id' => 'required',
            ]);
        } catch (ValidationException $e) {
            return Response::json($e->errors(), 422);
        }

        Employee::find($id)->update( $employeeValidated);

        $bank_id = $bankAccValidated['bank_id'];
        unset($bankAccValidated['bank_id']);
        BankAccount::find($bank_id)->update($bankAccValidated);

        return response(200);
    }

    public function destroy(string $id){
        Employee::where('id',$id)->delete();
        return response(200);
    }
}
