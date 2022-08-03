<?php

namespace App\Http\Controllers;

use App\Models\Archive;
use App\Models\Immunization;
use Illuminate\Http\Request;
use App\Http\Controllers\ArchiveController;

class RestoreImmunizationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Archive  $archive
     * @return \Illuminate\Http\Response
     */
    public function show(Archive $archive)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Archive  $archive
     * @return \Illuminate\Http\Response
     */
    public function edit(Archive $archive)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Archive  $archive
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Archive $archive)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Archive  $archive
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $request->validate([
            'immunization_id' => 'required',
            'immunization_category_id' => 'required',
            'first_name' => 'required',
            'middle_name' => 'required',
            'last_name' => 'required',
            'date_of_birth' => 'required',
            'sex' => 'required',
            'place_of_birth' => 'required',
            'age' => 'required',
            'address' => 'required',
            'contact_no' => 'required|min:11|max:11',
            'father_full_name' => 'required',
            'mother_full_name' => 'required',
            'height' => 'required',
            'weight' => 'required',
            'vaccine_received' => 'required',
            'doses' => 'required',
            'doses_received' => 'required',
            'first_dose_schedule' => 'required',
            'second_dose_schedule' => 'required',
            'third_dose_schedule' => 'required',
            'remarks' => 'required',
            'date_recorded' => 'required',
            'date_updated' => 'required',
        ]);

        

        Immunization::create([
            'immunization_id' => $request->immunization_id,
            'immunization_category_id' => $request->immunization_category_id,
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'date_of_birth' => $request->date_of_birth,
            'sex' => $request->sex,
            'place_of_birth' => $request->place_of_birth,
            'age' => $request->age,
            'address' => $request->address,
            'contact_no' => $request->contact_no,
            'father_full_name' => $request->father_full_name,
            'mother_full_name' => $request->mother_full_name,
            'height' => $request->height,
            'weight' => $request->weight,
            'vaccine_received' => $request->vaccine_received,
            'doses' => $request->doses,
            'doses_received' => $request->doses_received,
            'first_dose_schedule' => $request->first_dose_schedule,
            'second_dose_schedule' => $request->second_dose_schedule,
            'third_dose_schedule' => $request->third_dose_schedule,
            'remarks' => $request->remarks,
            'created_at' => $request->date_recorded,
            'updated_at' => $request->date_updated,
        ]);

        $archive = Archive::find($id);
        $archive->delete();

        return redirect()->route('archives.index')->with('success','Restore Successfully');

    }
}
