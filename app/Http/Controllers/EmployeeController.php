<?php

namespace App\Http\Controllers;
use App\Models\Employee;
use Illuminate\Http\Request;
use League\CommonMark\Extension\CommonMark\Delimiter\Processor\EmphasisDelimiterProcessor;

use function Pest\Laravel\json;

class EmployeeController extends Controller
{
    public function index(){
        return response()->json([
            'name' => 'Abigail',
            'state' => 'CA',
        ]);
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
    }

    public function update(Request $request , string $id){
        return('admin');
    }

    public function destroy(string $id){
        return('admin');
    }
}
