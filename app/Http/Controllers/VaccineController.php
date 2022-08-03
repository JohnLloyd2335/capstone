<?php

namespace App\Http\Controllers;

use App\Models\Vaccine;
use App\Models\VaccineCategory;
use Illuminate\Http\Request;

class VaccineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vaccine_categories = VaccineCategory::all();
        $vaccines = Vaccine::with('vaccine_category')->get();
        return view('vaccine', compact('vaccine_categories','vaccines'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'vaccine_category_id' => 'required',
            'vaccine_name' => 'required',
            'doses' => 'required',
            'manufactured_date' => 'required',
            'expiration_date' => 'required',
            'description' => 'required',
        ]);

        if(Vaccine::where('vaccine_name', $request->vaccine_name)->exists()) {
            return redirect()->route('vaccines.index')->with('error','Vaccine Already exist!');
        }else{
            Vaccine::create([
                'vaccine_category_id' => $request->vaccine_category_id,
                'vaccine_name' => $request->vaccine_name,
                'doses' => $request->doses,
                'manufactured_date' => $request->manufactured_date,
                'expiration_date' => $request->expiration_date,
                'description' => $request->description,
    
            ]);
        }

        

        return redirect()->route('vaccines.index')->with('success','Vaccine Added Successfuly!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vaccine  $vaccine
     * @return \Illuminate\Http\Response
     */
    public function show(Vaccine $vaccine)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vaccine  $vaccine
     * @return \Illuminate\Http\Response
     */
    public function edit(Vaccine $vaccine)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vaccine  $vaccine
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vaccine $vaccine)
    {
        $request->validate([
            'vaccine_category_id' => 'required',
            'vaccine_name' => 'required',
            'doses' => 'required',
            'manufactured_date' => 'required',
            'expiration_date' => 'required',
            'description' => 'required',
        ]);

        

        $vaccine->update([
            'vaccine_category_id' => $request->vaccine_category_id,
            'vaccine_name' => $request->vaccine_name,
            'doses' => $request->doses,
            'manufactured_date' => $request->manufactured_date,
            'expiration_date' => $request->expiration_date,
            'description' => $request->description,
        ]);

        return redirect()->route('vaccines.index')->with('success','Vaccine Edited Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vaccine  $vaccine
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vaccine $vaccine)
    {
        $vaccine->delete();

        return redirect()->route('vaccines.index')->with('success','Vaccine Deleted Successfully');
    }
}
