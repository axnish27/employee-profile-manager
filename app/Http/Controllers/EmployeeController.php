<?php

namespace App\Http\Controllers;
use App\Models\Employee;
use Illuminate\Http\Request;
use League\CommonMark\Extension\CommonMark\Delimiter\Processor\EmphasisDelimiterProcessor;

use function Pest\Laravel\json;

class EmployeeController extends Controller
{
    public function index(){
        $employees = Employee::all()->toJson();
        return response($employees);
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

        return redirect()->route('index');
    }

    public function update(Request $request , string $id){
        return('admin');
    }

    public function destroy(string $id){

        Employee::where('id',$id)->delete();
        return redirect()->route('index');

    }
}
