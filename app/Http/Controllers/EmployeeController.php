<?php

namespace App\Http\Controllers;
use App\Models\Employee;
use Dotenv\Parser\Value;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use League\CommonMark\Extension\CommonMark\Delimiter\Processor\EmphasisDelimiterProcessor;

use function Pest\Laravel\json;

class EmployeeController extends Controller
{
    public function index(Request $request){

        //SERVER SIDE RENDERING HANDLE FOR data table
        $search = $request->query('search')['value'];
        $draw = $request->query('draw', 1);
        $start = $request->query('start', 0);
        $length = $request->query('length', 10);
        $totalEmployees =   Employee::count();

        $employees = Employee::where('name' , 'like' , "%".$search."%")
                            ->orWhere('position' ,'like' , "%".$search."%")
                            ->orWhere('email', 'like' , "%".$search."%")
                            ->orWhere('address' ,'like' , "%".$search."%")
                            ->orWhere('dob' ,'like' , "%".$search."%")
                            ->orWhere('phone' ,'like' , "%".$search."%");

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

        Employee::create([
            'name'=>$request->name,
            'position'=>$request->position,
            'dob'=>$request->dob,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'address'=>$request->address
        ]);
        return response(200);
    }

    public function update(Request $request , string $id){
        return('admin');
    }

    public function destroy(string $id){
        Employee::where('id',$id)->delete();
        return response(200);
    }
}
