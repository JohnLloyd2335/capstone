@extends('layouts.user_navigation')

@section('content')

<!-- Begin Page Content -->
<div class="container-fluid px-4">

  @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @include('layouts.flash-message')

    <!-- Page Heading -->
    <button class="btn btn-primary" data-toggle="modal" data-target="#addImmunizationModal">Add Immunization</button>

    

    

    

    <!-- DataTales Example -->
    <div class="card shadow mb-4 mt-3">
        
        <div class="card-header py-3">
            <h5 class="m-0 font-weight-bold text-primary">Senior Citizen Immunizations</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Firstname</th>
                            <th>Middlename</th>
                            <th>Lastname</th>
                            
                            <th>Vaccine Received</th>
                            <th>Dose(s)</th>
                            <th>Dose(s) Received</th>
                            <th>Remarks</th>
                            <th>Date Recorded</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        
                           @foreach ($senior_citizen_immunizations as $senior_citizen_immunization)
                          <tr>
                            <td>{{$senior_citizen_immunization->first_name}}</td>
                            <td>{{$senior_citizen_immunization->middle_name}}</td>
                            <td>{{$senior_citizen_immunization->last_name}}</td>
                            <td>{{$senior_citizen_immunization->vaccine_received}}</td>
                            <td>{{$senior_citizen_immunization->doses}}</td>
                            <td>{{$senior_citizen_immunization->doses_received}}</td>
                            <td>{{$senior_citizen_immunization->remarks}}</td>
                            <td>{{$senior_citizen_immunization->created_at}}</td>

                            <td class="d-flex justify-content-around align-items-center">
                              <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#viewImmunizationModal{{ $senior_citizen_immunization->id }}"><i class="fas fa-eye"></i></i></button>
                              <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editImmunizationModal{{ $senior_citizen_immunization->id }}"><i class="fas fa-edit"></i></button>
                              <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteImmunizationModal{{ $senior_citizen_immunization->id }}"><i class="fas fa-trash-alt"></i></button>
                              
                            </td>

                            

                          </tr>
                          @endforeach
                             
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->




<!-- Modals -->

    <!-- Add Immunization Modal -->
        <div class="modal fade bd-example-modal-lg" id="addImmunizationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Immunization</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <!-- -->
                   <form action="{{ route('senior_citizen_immunizations.store') }}" method="post"> 
                    @csrf
                    
                      <div class="container-fluid my-2 mx-2">
                        <h4 class="font-weight-light">Personal Information</h4>
                        <div class="row px-1">
                        <input type="hidden" name="immunization_category_id" value= "5">
                        <div class="col">
                            <div class="form-group">
                              <label>Firstname</label>
                              <input type="text" class="form-control" name="first_name" >
                            </div>
                        </div>
    
                        <div class="col">
                          <div class="form-group">
                            <label>Middlename</label>
                            <input type="text" class="form-control" name="middle_name" >
                          </div>
                        </div>
    
                        <div class="col">
                          <div class="form-group">
                            <label>Lastname</label>
                            <input type="text" class="form-control" name="last_name" >
                          </div>
                        </div>
    
                            
    
                        </div>
    
                        <div class="row px-1">
    
                          <div class="col-md-9">
                            <div class="form-group">
                              <label>Date of Birth</label>
                              @php  
                                $maxDate = date('Y-m-d');
                              @endphp
                              <input type="date" class="form-control" name="date_of_birth"  max=" {{$maxDate}}  ">
                            </div>
                          </div>
    
                          <div class="col-md-3">
                                <div class="form-group">
                                <label>Sex</label>
                                <select class="form-control" aria-label="Default select example" name="sex" >
                                  <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                                </div>
                            </div>
                        </div>
    
                        <div class="row px-1">
    
                          <div class="col-md-8">
                            <div class="form-group">
                              <label>Place of Birth</label>
                              <input type="text" class="form-control" name="place_of_birth" >
                            </div>
                          </div>
    
                          <div class="col-md-4">
                              <div class="form-group">
                                  <label for="exampleFormControlFile1">Age</label>
                                  <div class="wrapper" style="width:200px;height:80px;">
                                    <select name="age" class="form-control" >
                                    
                                      @php 
                                      $i = 60;
                                      while($i < 126):
                                      @endphp
                                      <option value="{{$i}}years old ">{{$i}} years old</option>
                                      @php $i++; endwhile @endphp
                                      
                                    </select>
                                  </div>
                              </div>
                          </div>
    
                        </div>
    
                        <div class="row px-1 mt-4">
    
                           <div class="col-md-9">
                            <div class="form-group">
                              <label>Address</label>
                              <input type="text" class="form-control" name="address" >
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-group">
                              <label>Contact No.</label>
                              <input type="number" class="form-control" name="contact_no" >
                            </div>
                          </div>
    
                        </div>
    
                        <div class="row px-1">
    
                           <div class="col-md-6">
                            <div class="form-group">
                              <label>Father's Name</label>
                              <input type="text" class="form-control" name="father_full_name" >
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label>Mother's Name</label>
                              <input type="text" class="form-control" name="mother_full_name" >
                            </div>
                          </div>
    
                        </div>
    
                        <div class="row px-1">
    
                           <div class="col-md-6">
                            <div class="form-group d-flex align-items-center justify-content-center">
                              <label>Height</label>
                              <input type="text" class="form-control mr-2 ml-2" name="height" >
                              <label>cm</label>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group d-flex align-items-center justify-content-center">
                              <label>Weight</label>
                              <input type="number" class="form-control mr-2 ml-2" name="weight" >
                              <label>kg</label>
                            </div>
                          </div>
    
                        </div>
    
                      </div>
                      <div class="container-fluid my-2 mx-2">
                        <h4 class="font-weight-light">Immunization Details</h4>
                        <div class="row px-1">
    
                        {{-- <div class="col-md-6">
                              <div class="form-group">
                                <label for="">Vaccine Category</label>
                            
                                <select name="immunization_category_id" id="immunization_category_name" class="form-control" >
                                  <option disabled selected>Select Vaccine Category</option>
                                  
                                </select>
                              </div>
                        </div> --}}
    
                            <div class="col-md-12">
                                  <label>Vaccine Name</label>
                                  <select name="vaccine_received" id="vaccine_name" class="form-control"   >
                                    <option disabled selected>Select Vaccine</option>
                                    @foreach ($vaccines as $vaccine)
                                    <option value='{{ $vaccine->vaccine_name }}'>{{ $vaccine->vaccine_name }}</option>
                                    @endforeach
                                  </select>
                                  <input type="hidden" value='1' name="doses_received">
                            </div>
    
                        </div>
    
                        <div class="row px-1">
                          <div class="col">
                            <label>Remarks</label>
                            <textarea name="remarks" class="form-control" style="resize: none;"  rows="5"></textarea>
                          </div>
                        </div>
                      </div> 
    
    
                      
    
                    <!-- -->
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
                </form>
                </div>
            </div>
            </div>
        </div>
    <!-- Edit Vaccine Modal -->

     @foreach($senior_citizen_immunizations as $senior_citizen_immunization) 

        <!-- Delete Immunization Modal -->

        <div class="modal fade" id="deleteImmunizationModal{{ $senior_citizen_immunization->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Delete Vaccine</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
              </div>
              <div class="modal-body text-center">
                 
                <h3 class="font-weight-light">Are you sure you want to delete?</h3>
              </div>
              <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>

               <form action="{{ route('senior_citizen_immunizations.destroy', $senior_citizen_immunization->id) }}" method="POST"> 
                @csrf
                @method('DELETE')

                <input type="hidden" class="form-control" name="immunization_id" value="{{ $senior_citizen_immunization->id }}" required>

                <input type="hidden" class="form-control" name="immunization_category_id" value="{{ $senior_citizen_immunization->immunization_category->id }}" required>

                <input type="hidden" class="form-control" name="first_name" value="{{ $senior_citizen_immunization->first_name }}" required>
                        

                    
                <input type="hidden" class="form-control" name="middle_name" required value="{{ $senior_citizen_immunization->middle_name }}">
              

           
                <input type="hidden" class="form-control" name="last_name" required value="{{ $senior_citizen_immunization->last_name }}">
              

                

            
                  <input type="hidden" class="form-control" name="date_of_birth" required value="{{ $senior_citizen_immunization->date_of_birth }}">
               

              
                    <input type="hidden" class="form-control" name="sex" required value="{{ $senior_citizen_immunization->sex }}">
                   

            
                
                <input type="hidden" class="form-control" name="place_of_birth" required value="{{ $senior_citizen_immunization->place_of_birth }}">
              
                      <input type="hidden" class="form-control" name="age" required value="{{ $senior_citizen_immunization->age }}">
                      
             
                  <input type="hidden" class="form-control" name="address" required value="{{ $senior_citizen_immunization->address }}">
                
                  <input type="hidden" class="form-control" name="contact_no" required value="{{ $senior_citizen_immunization->contact_no }}">
                
            
                  <input type="hidden" class="form-control" name="father_full_name" required value="{{ $senior_citizen_immunization->father_full_name }}">
                
                  <input type="hidden" class="form-control" name="mother_full_name" required  value="{{ $senior_citizen_immunization->mother_full_name }}">
                
                  
                  <input type="hidden" class="form-control mr-2 ml-2" name="height" required value="{{ $senior_citizen_immunization->height }}">
                  
                  <input type="hidden" class="form-control mr-2 ml-2" name="weight" required value="{{ $senior_citizen_immunization->weight }}">
                  
          
                    
                  
                      

                      <input type="hidden" name="vaccine_received" value="{{ $senior_citizen_immunization->vaccine_received }}">
               
                <input type="hidden" name="doses" value="{{ $senior_citizen_immunization->doses }}">
              
                <input type="hidden" name="doses_received" value="{{ $senior_citizen_immunization->doses_received }}">
                <input type="hidden" name="first_dose_schedule" value="{{ $senior_citizen_immunization->first_dose_schedule }}">
                <input type="hidden" name="second_dose_schedule" value="{{ $senior_citizen_immunization->second_dose_schedule }}">
                <input type="hidden" name="third_dose_schedule" value="{{ $senior_citizen_immunization->third_dose_schedule }}">

              
                <input type="hidden"name="remarks" class="form-control" value="{{ $senior_citizen_immunization->remarks }}">

                <input type="hidden" name="date_recorded" class="form-control"  value="{{ $senior_citizen_immunization->created_at }}">

                <input type="hidden" name="date_updated" class="form-control"  value="{{ $senior_citizen_immunization->updated_at }}">  

                  <button type="submit" class="btn btn-danger" >Yes</button>
                </form>
              
              
              </div>
          </div>
          </div>
      </div>
      
  <!-- Delete Immunization Modal -->

  <!-- Edit Immunization Modal -->
  <div class="modal fade bd-example-modal-lg" id="editImmunizationModal{{ $senior_citizen_immunization->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Immunization</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
            <!-- -->
          <form action="{{ route('senior_citizen_immunizations.update', $senior_citizen_immunization->id) }}" method="post">
            @method('PUT')
            @csrf
            <div class="container-fluid my-2 mx-2">
              <h4 class="font-weight-light">Personal Information</h4>
              <div class="row px-1">

              <div class="col">
                  <div class="form-group">
                    <label>Firstname</label>
                    <input type="text" class="form-control" name="first_name" value="{{ $senior_citizen_immunization->first_name }}" >
                  </div>
              </div>

              <div class="col">
                <div class="form-group">
                  <label>Middlename</label>
                  <input type="text" class="form-control" name="middle_name"  value="{{ $senior_citizen_immunization->middle_name }}">
                </div>
              </div>

              <div class="col">
                <div class="form-group">
                  <label>Lastname</label>
                  <input type="text" class="form-control" name="last_name"  value="{{ $senior_citizen_immunization->last_name }}">
                </div>
              </div>

                  

              </div>

              <div class="row px-1">

                 <div class="col-md-8">
                  <div class="form-group">
                    <label>Place of Birth</label>
                    <input type="text" class="form-control" name="place_of_birth"  value="{{ $senior_citizen_immunization->place_of_birth }}">
                  </div>
                </div>

                <div class="col-md-4">
                      <div class="form-group">
                      <label>Sex</label>
                      <select class="form-control" aria-label="Default select example" name="sex" >
                      
                      <option {{ ($senior_citizen_immunization->sex) == 'Male' ? 'selected' : '' }}  value="Male">Male</option>
                      <option {{ ($senior_citizen_immunization->sex) == 'Female' ? 'selected' : '' }}  value="Female">Female</option>

                      </select>
                      </div>
                  </div>
             

              </div>

           <div class="row px-1">

              <div class="col-md-8">
                <div class="form-group">
                  <label>Date of Birth</label>
                  
                  <input type="date" class="form-control" name="date_of_birth"  value="{{ $senior_citizen_immunization->date_of_birth }}">
                </div>
              </div>

              <div class="col-md-4">
                    <div class="form-group">
                        <label for="exampleFormControlFile1">Age</label>
                        <div class="wrapper" style="width:200px;height:80px;" id="test">
                          <select name="age" class="form-control" onfocus='this.size=5;' onblur='this.size=1;' onchange='this.size=1; this.blur();' >
                          <option selected  value="{{ $senior_citizen_immunization->age }}">{{ $senior_citizen_immunization->age }}</option> 
                          
                          @php 
                            $i = 60;
                            while($i < 126):
                          @endphp
                            <option value="@php echo  $i .' months old' @endphp">@php echo $i .'months old' @endphp</option>
                          @php $i++; endwhile @endphp
                          
                          </select>
                          <script>
                            $(document).ready(function() {
                                $("#test").find("option").eq(0).remove();
                            });
                          </script>
                        </div>
                    </div>
                </div>

           </div>
              <div class="row px-1 mt-4">

                 <div class="col-md-9">
                  <div class="form-group">
                    <label>Address</label>
                    <input type="text" class="form-control" name="address"  value="{{ $senior_citizen_immunization->address }}">
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label>Contact No.</label>
                    <input type="number" class="form-control" name="contact_no"  value="{{ $senior_citizen_immunization->contact_no }}">
                  </div>
                </div>

              </div>

              <div class="row px-1">

                 <div class="col-md-6">
                  <div class="form-group">
                    <label>Father's Name</label>
                    <input type="text" class="form-control" name="father_full_name"  value="{{ $senior_citizen_immunization->father_full_name }}">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Mother's Name</label>
                    <input type="text" class="form-control" name="mother_full_name"  value="{{ $senior_citizen_immunization->mother_full_name }}">
                  </div>
                </div>

              </div>

              <div class="row px-1">

                 <div class="col-md-6">
                  <div class="form-group d-flex align-items-center justify-content-center">
                    <label>Height</label>
                    @php  
                    $heightArray = explode(" ",  $senior_citizen_immunization->height);
                    $actualHeight = reset($heightArray); 
                    @endphp
                    <input type="text" class="form-control mr-2 ml-2" name="height"  value="{{ $senior_citizen_immunization->height }}">
                    <label>cm</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group d-flex align-items-center justify-content-center">
                  @php  
                    $weightArray = explode(" ", $senior_citizen_immunization->weight);
                    $actualWeight = intval(reset($weightArray)); 
                    @endphp
                    <label>Weight</label>
                    <input type="number" class="form-control mr-2 ml-2" name="weight"  value="{{$senior_citizen_immunization->height}}">
                    <label>kg</label>
                  </div>
                </div>

              </div>

            </div>
            <div class="container-fluid my-2 mx-2">
              <h4 class="font-weight-light">Immunization Details</h4>
              <div class="row px-1">

              

                  <div class="col-md-6">
                        <label>Vaccine Name</label>
                        <input type="text" name="vaccine_received"  class="form-control" readonly   value="{{ $senior_citizen_immunization->vaccine_received}}">
                          
                  </div>

              </div>

              <div class="row">
                <div class="col">
                  <label>Doses</label>
                  <input type="number" value="{{ $senior_citizen_immunization->doses}}" class="form-control" readonly>
                </div>
                <div class="col">
                  <label>Doses Received</label>
                  <select name="doses_received" class="form-control">
                  
                   
                    @if($senior_citizen_immunization->doses == 1)
                      <option selected value="1">1</option>
                     
                    @elseif($senior_citizen_immunization->doses == 2 && $senior_citizen_immunization->doses_received == 1)
                        <option selected value="1">1</option>
                        <option  value="2">2</option>
                    
                    @elseif($senior_citizen_immunization->doses == 2 && $senior_citizen_immunization->doses_received == 2)
                        
                        <option selected value="2">2</option>
                      
                    @elseif($senior_citizen_immunization->doses == 3 && $senior_citizen_immunization->doses_received == 1)
                        <option selected value="1">1</option>
                        <option  value="2">2</option>
                        <option  value="3">3</option>

                    @elseif($senior_citizen_immunization->doses == 3 && $senior_citizen_immunization->doses_received == 2)
                        <option selected value="2">2</option>
                        <option value="3">3</option>
                    
                    @elseif($senior_citizen_immunization->doses == 3 && $senior_citizen_immunization->doses_received == 3)
                        
                        <option selected value="3">3</option>


                    @endif
                    
                  </select>
                  

                </div>
              </div>

              <div class="row px-1">
                <div class="col">
                  <label>Remarks</label>
                  <textarea name="remarks" class="form-control" style="resize: none;"  rows="5">{{$senior_citizen_immunization->remarks}}</textarea>
                </div>
              </div>
            </div

             -->
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
        </form>
        </div>
    </div>
    </div>
</div> 
<!-- Edit Immunization Modal -->


<!-- View Immunization Modal -->
<div class="modal fade bd-example-modal-lg" id="viewImmunizationModal{{ $senior_citizen_immunization->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
  <div class="modal-content">
      <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">View Immunization</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
      </div>
      <div class="modal-body">
          <!-- -->
        
          
          <div class="container-fluid my-2 mx-2">
            <h4 class="font-weight-light">Personal Information</h4>
            <div class="row px-1">

            <div class="col">
                <div class="form-group">
                  <label>Firstname</label>
                  <input type="text" class="form-control" name="first_name" value="{{ $senior_citizen_immunization->first_name }}"  readonly>
                </div>
            </div>

            <div class="col">
              <div class="form-group">
                <label>Middlename</label>
                <input type="text" class="form-control" name="middle_name"  value="{{ $senior_citizen_immunization->middle_name }}" readonly>
              </div>
            </div>

            <div class="col">
              <div class="form-group">
                <label>Lastname</label>
                <input type="text" class="form-control" name="last_name"  value="{{ $senior_citizen_immunization->last_name }}" readonly>
              </div>
            </div>

                

            </div>

            <div class="row px-1">

              <div class="col-md-8">
                <div class="form-group">
                  <label>Place of Birth</label>
                  <input type="text" class="form-control" name="place_of_birth"  value="{{ $senior_citizen_immunization->place_of_birth }}" readonly>
                </div>
              </div>

              <div class="col-md-4">
                    <div class="form-group">
                      <label>Sex</label>
                      <select class="form-control" aria-label="Default select example" name="sex" readonly>
                      
                      <option>{{ ($senior_citizen_immunization->sex) }}</option>
                      

                      </select>
                    </div>
                </div>
           

            </div>
         

         <div class="row px-1">

            <div class="col-md-8">
              <div class="form-group">
                <label>Date of Birth</label>
                
                <input type="date" class="form-control" name="date_of_birth"  value="{{ $senior_citizen_immunization->date_of_birth }}"readonly>
              </div>
            </div>

            <div class="col-md-4">
                  <div class="form-group">
                      <label for="exampleFormControlFile1">Age</label>
                     
                        <input type="text" name="age" class="form-control" value="{{ $senior_citizen_immunization->age }}"  readonly>
                        
                      
                  </div>
              </div>


         </div>
         
         <div class="row px-1">

            <div class="col-md-6">
              <div class="form-group">
                <label>Address</label>
                <input type="text" class="form-control"  value="{{ $senior_citizen_immunization->address }}" readonly>
              </div>
            </div>

          <div class="col-md-6">
            <div class="form-group">
              <label>Contact No.</label>
              <input type="text" class="form-control"   value="{{ $senior_citizen_immunization->contact_no }}" readonly>
            </div>
          </div>

       </div>
      

            <div class="row px-1">

               <div class="col-md-6">
                <div class="form-group">
                  <label>Father's Name</label>
                  <input type="text" class="form-control" name="father_full_name"  value="{{ $senior_citizen_immunization->father_full_name }}" readonly>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Mother's Name</label>
                  <input type="text" class="form-control" name="mother_full_name"  value="{{ $senior_citizen_immunization->mother_full_name }}" readonly>
                </div>
              </div>

            </div>

            <div class="row px-1">

               <div class="col-md-6">
                <div class="form-group d-flex align-items-center justify-content-center">
                  <label>Height</label>
                  @php  
                  $heightArray = explode(" ",  $senior_citizen_immunization->height);
                  $actualHeight = reset($heightArray); 
                  @endphp
                  <input type="text" class="form-control mr-2 ml-2" name="height"  value="{{ $senior_citizen_immunization->height }}" readonly>
                  <label>cm</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group d-flex align-items-center justify-content-center">
                @php  
                  $weightArray = explode(" ", $senior_citizen_immunization->weight);
                  $actualWeight = intval(reset($weightArray)); 
                  @endphp
                  <label>Weight</label>
                  <input type="number" class="form-control mr-2 ml-2" name="weight"  value="{{$senior_citizen_immunization->height}}" readonly>
                  <label>kg</label>
                </div>
              </div>

            </div>

          </div>
          <div class="container-fluid my-2 mx-2">
            <h4 class="font-weight-light">Immunization Details</h4>
            <div class="row px-1">

            

                <div class="col-md-6">
                      <label>Vaccine Name</label>
                      <input type="text" name="vaccine_received"  class="form-control" readonly   value="{{ $senior_citizen_immunization->vaccine_received}}" >
                        
                </div>

            </div>

            <div class="row">
              <div class="col">
                <label>Doses</label>
                <input type="number" value="{{ $senior_citizen_immunization->doses}}" class="form-control" readonly>
              </div>
              <div class="col">
                <label>Doses Received</label>
                <select name="doses_received" class="form-control" readonly>
                
                 
                  @if($senior_citizen_immunization->doses == 1)
                    <option selected value="1">1</option>
                   
                  @elseif($senior_citizen_immunization->doses == 2 && $senior_citizen_immunization->doses_received == 1)
                      <option selected value="1">1</option>
                      <option  value="2">2</option>
                  
                  @elseif($senior_citizen_immunization->doses == 2 && $senior_citizen_immunization->doses_received == 2)
                      
                      <option selected value="2">2</option>
                    
                  @elseif($senior_citizen_immunization->doses == 3 && $senior_citizen_immunization->doses_received == 1)
                      <option selected value="1">1</option>
                      <option  value="2">2</option>
                      <option  value="3">3</option>

                  @elseif($senior_citizen_immunization->doses == 3 && $senior_citizen_immunization->doses_received == 2)
                      <option selected value="2">2</option>
                      <option value="3">3</option>
                  
                  @elseif($senior_citizen_immunization->doses == 3 && $senior_citizen_immunization->doses_received == 3)
                      
                      <option selected value="3">3</option>


                  @endif
                  
                </select>
                

              </div>
            </div>

            <div class="row px-1">
              <div class="col">
                <label>Remarks</label>
                <textarea name="remarks" class="form-control" style="resize: none;"  rows="5" readonly>{{$senior_citizen_immunization->remarks}}</textarea>
              </div>
            </div>
          </div

           -->
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    
     
      </div>
  </div>
  </div>
</div> 
<!-- View Immunization Modal -->
 @endforeach 

<!-- Modals -->


@endsection
