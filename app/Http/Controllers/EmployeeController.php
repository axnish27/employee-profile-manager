<?php

namespace App\Http\Controllers;

use App\Models\BankAccount;
use App\Models\Company;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Validation\Rule;

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

        $validated = $request->validate([
            'name' => 'required|max:50|',
            'position' => 'required|max:50|',
            'dob' => 'required|date',
            'email' => 'required|unique:employees|email',
            'phone' => 'required|max:13',
             'address' => 'required|max:255',
             'company_id' => 'required',
             'beneficiary_name' => 'required',
             'bank_name' => 'required',
             'bank_branch' => 'required',
             'account_no' => 'required|max:9',
            ]
        );

        $employee = Employee::create([
            'name' => $validated['name'],
            'position' => $validated['position'],
            'dob' => $validated['dob'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'address' => $validated['address'],
            'company_id' => $validated['company_id'],
        ]);

        BankAccount::create([
            'beneficiary_name' => $validated['beneficiary_name'],
            'bank_name' => $validated['bank_name'],
            'branch' => $validated['bank_branch'],
            'account_no' => $validated['account_no'],
            'employee_id' => $employee->id
        ]);

        return response(200);
    }

    public function edit(string $id){
        $employee = Employee::with('bankAccount' , 'company')->where('id',$id)->get();
        return Response::json($employee);
    }


    public function update(Request $request , string $id){

        $validated = $request->validate([
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
            'beneficiary_name' => 'required',
            'bank_name' => 'required',
            'bank_branch' => 'required',
            'account_no' => 'required|max:9',
            'bank_id' => 'required'
        ]);

        Employee::find($id)->update([
            'name' => $validated['name'],
            'position' => $validated['position'],
            'dob' => $validated['dob'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'address' => $validated['address'],
            'company_id' => $validated['company_id'],
        ]);

        BankAccount::find($validated['bank_id'])->update([
            'beneficiary_name' => $validated['beneficiary_name'],
            'bank_name' => $validated['bank_name'],
            'branch' => $validated['bank_branch'],
            'account_no' => $validated['account_no'],
        ]);
        return response(200);
    }

    public function destroy(string $id){
        Employee::where('id',$id)->delete();
        return response(200);
    }
}
