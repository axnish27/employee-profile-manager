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
        $search = $request->query('search');
        $search = $search['value'];
        $draw = $request->query('draw', 1);
        $totalEmployees =   Employee::count();

        if(!$search){

            $start = $request->query('start', 0);
            $length = $request->query('length', 10);
            $order = $request->query('order.0.dir', 'asc');
            $col0DataAttrName = $request->query('columns.0.data', 'name');

            $employees = Employee::orderBy($col0DataAttrName, $order)
                ->skip($start)
                ->take($length)
                ->get();

            $response = [
                'draw' => intval($draw),
                'recordsTotal' => $totalEmployees,
                'recordsFiltered' => $totalEmployees,
                'data' => $employees
            ];

            return Response::json($response);
        }
        else{
            
            $employees = Employee::where('name' , $search)
            ->orWhere('position' ,$search)
            ->orWhere('email' ,$search)
            ->orWhere('address' ,$search)
            ->orWhere('dob' ,$search)
            ->orWhere('phone' ,$search)->get();

            $filteredEmployees = $employees->count();
            $response = [
                'draw' => intval($draw),
                'recordsTotal' => $totalEmployees,
                'recordsFiltered' => $filteredEmployees,
                'data' => $employees
            ];

            return Response::json($response);
        }
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
