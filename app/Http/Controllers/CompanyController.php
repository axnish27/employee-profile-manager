<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

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

          $filteredCompanys = $search ? $companys->count() : $totalCompanys;
          $companys = $companys->skip($start)
                                  ->take($length)
                                  ->get();

          $response = [
              'draw' => intval($draw),
              'recordsTotal' => intval($totalCompanys),
              'recordsFiltered' => $filteredCompanys,
              'data' => $companys
          ];
          return Response::json($response);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('company.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Company::create([
            'name' => $request->name,
            'country' => $request->country,
            'branch' => $request->branch,
            'address' => $request->address,
        ]);
        return redirect(route('companys.index'));
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
        $company = Company::find($id);
        return view('company.edit' , ['company' => $company] );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Company::find($id)->update([
            'name' => $request->name,
            'country' => $request->country,
            'branch' => $request->branch,
            'address' => $request->address,
        ]);
        return redirect(route('companys.index'));
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
