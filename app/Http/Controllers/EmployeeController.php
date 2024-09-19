<?php

namespace App\Http\Controllers;


use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Validation\Rule;

class EmployeeController extends Controller
{
    public function index(Request $request){

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
                                $q->where('name', 'like', "%".$search."%"); });

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
             'address' => 'required|max:255'
            ]
        );

        Employee::create($validated);
        return response(200);
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
            'address' => 'required|max:255'
        ]);
        Employee::find($id)->update($validated);
        return response(null, 200);
    }

    public function destroy(string $id){
        Employee::where('id',$id)->delete();
        return response(200);
    }
}
