<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Validation\ValidationException;

class CompanyController extends Controller
{
    public function index()
    {
        $companys = Company::all();
        return view('company.index', ['companys' => $companys]);
    }

    public function draw(Request $request){
        $search = $request->query('search')['value'];
        $draw = $request->query('draw', 1);
        $start = $request->query('start', 0);
        $length = $request->query('length', 10);
        $totalCompanys =   Company::count();

        $companys = Company::where('name' , 'like' , "%".$search."%")
                            ->orWhere('country' ,'like' , "%".$search."%")
                            ->orWhere('branch', 'like' , "%".$search."%")
                            ->orWhere('address' ,'like' , "%".$search."%");

        $filteredCompanys = $search ? $companys->count() : $totalCompanys;
        $companys = $companys->skip($start)
                                ->take($length)
                                ->withCount('projects','employees')->get();

        $response = [
            'draw' => intval($draw),
            'recordsTotal' => intval($totalCompanys),
            'recordsFiltered' => $filteredCompanys,
            'data' => $companys

        ];
        return Response::json($response);
    }

    public function store(Request $request)
    {
        try{
            $companyValidated = $request->validate([
                'name' => 'required',
                'branch' => 'required',
                'country' => 'required',
                'address' => 'required',

            ]);
        }catch (ValidationException $e) {
            return Response::json($e->errors(), 422);
        }

        Company::create($companyValidated);
        return response(200);
    }

    public function show(string $id)
    {
        $company = Company::find($id);
        $companyEmployees = $company->employees;
        return view('company.show' , ['companyEmployees' => $companyEmployees , 'company' => $company ]);
    }

    public function edit(string $id)
    {
        $company = Company::find($id)
        ->withCount('projects' , 'employees')->get();
        return Response::json($company);
    }

    public function update(Request $request)
    {
        try{
            $companyValidated = $request->validate([
                'name' => 'required',
                'branch' => 'required',
                'country' => 'required',
                'address' => 'required',
                'company_id' => 'required',

            ]);
        }catch (ValidationException $e) {
            return Response::json($e->errors(), 422);
        }

        $company_id = $companyValidated['company_id'];
        unset($companyValidated['company_id']);
        Company::find($company_id)->update($companyValidated);
        return response(200);
    }

    public function destroy(string $id)
    {
        Company::destroy($id);
        return Response::json("Company Deleted Succesfully");
    }
}
