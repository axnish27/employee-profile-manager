<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Validation\ValidationException;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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

                        //     ->orWhereHas('projects' ,
                        //     function ($q) use ($search){
                        //     $q->where('account_no', 'like', "%".$search."%")->select('branch');

                        // });

        $filteredCompanys = $search ? $companys->count() : $totalCompanys;
        $companys = $companys->skip($start)
                                ->take($length)
                                ->withCount('projects','employees')->get();



        // $company = Company::find(3);
        // $projects = $company->employees()->count();

        $response = [
            'draw' => intval($draw),
            'recordsTotal' => intval($totalCompanys),
            'recordsFiltered' => $filteredCompanys,
            // 'project' => $projects,
            'data' => $companys

        ];
        return Response::json($response);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
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

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $company = Company::find($id);
        $companyEmployees = $company->employees;
        return view('company.show' , ['companyEmployees' => $companyEmployees , 'company' => $company ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $company = Company::find($id)
        ->withCount('projects' , 'employees')->get();
        return Response::json($company);
    }

    /**
     * Update the specified resource in storage.
     */
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Company::find($id)->delete();
        return redirect(route('companys.index'));
    }
}
