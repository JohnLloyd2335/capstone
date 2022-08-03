<?php

namespace App\Http\Controllers;

use App\Models\Immunization;
use App\Models\Archive;
use App\Models\Vaccine;
use Illuminate\Http\Request;

class SeniorCitizenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vaccines = Vaccine::where('vaccine_category_id','5')->get();
        $senior_citizen_immunizations = Immunization::where('immunization_category_id','5')->with('immunization_category')->get();

        return view('senior_citizen_immunization',compact('vaccines','senior_citizen_immunizations'));
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
            'doses_received' => 'required',
            'remarks' => 'required',
        ]);
        $doses = Vaccine::select('doses')->where('vaccine_name',$request->vaccine_received)->get();
        if($doses->contains('doses','1')){
            $first_dose_schedule = date('Y-m-d');
            $second_dose_schedule = "Not Applicable";
            $third_dose_schedule = "Not Applicable";
            $vaccine_dose = 1;
        }
        elseif($doses->contains('doses','2')){
            $first_dose_schedule = date('Y-m-d');
            $second_dose_schedule = "Set Schedule";
            $third_dose_schedule = "Not Applicable";
            $vaccine_dose = 2;
        }
        elseif($doses->contains('doses','3')){
            $first_dose_schedule = date('Y-m-d');
            $second_dose_schedule = "Set Schedule";
            $third_dose_schedule = "Set Schedule";
            $vaccine_dose = 3;
        }



        Immunization::create([
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
            'doses' => $vaccine_dose,
            'doses_received' => $request->doses_received,
            'first_dose_schedule' => $first_dose_schedule,
            'second_dose_schedule' => $second_dose_schedule,
            'third_dose_schedule' => $third_dose_schedule,
            'remarks' => $request->remarks,
        ]);

        return redirect()->route('senior_citizen_immunizations.index')->with('success','Senior Citizen Immunizations Added Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Immunization  $immunization
     * @return \Illuminate\Http\Response
     */
    public function show(Immunization $immunization)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Immunization  $immunization
     * @return \Illuminate\Http\Response
     */
    public function edit(Immunization $immunization)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Immunization  $immunization
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
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
            'doses_received' => 'required',
            'remarks' => 'required',
        ]);

        $senior_immunization = Immunization::find($id);
        $senior_immunization->update([
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
            'doses_received' => $request->doses_received,
            'remarks' => $request->remarks,
        ]);

        return redirect()->route('senior_citizen_immunizations.index')->with('success','Senior Citizen Immunization Edited Successfuly!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Immunization  $immunization
     * @return \Illuminate\Http\Response
     */
    public function destroy(Immunization $immunization, Request $request, $id)
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

        Archive::create([
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
            'date_recorded' => $request->date_recorded,
            'date_updated' => $request->date_updated,
        ]);

        $senior_immunization = Immunization::find($id);
        $senior_immunization->delete();

        return redirect()->route('senior_citizen_immunizations.index')->with('success','Senior Citizen Immunization Deleted Successfuly!');
    }
}
