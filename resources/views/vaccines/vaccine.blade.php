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
    <button class="btn btn-primary" data-toggle="modal" data-target="#addVaccineModal">Add Vaccine</button>

    

    

    

    <!-- DataTales Example -->
    <div class="card shadow mb-4 mt-3">
        
        <div class="card-header py-3">
            <h5 class="m-0 font-weight-bold text-primary">Vaccines</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Vaccine Name</th>
                            <th>Doses</th>
                            <th>Vaccine Category</th>
                            <th>Manufactured Date</th>
                            <th>Expriation Date</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        
                          @foreach ($vaccines as $vaccine)
                          <tr>
                            <td>{{$vaccine->vaccine_name}}</td>
                            <td>{{$vaccine->doses}}</td>
                            <td>{{$vaccine->vaccine_category->vaccine_category_name}}</td>
                            <td>{{$vaccine->manufactured_date}}</td>
                            <td>{{$vaccine->expiration_date}}</td>
                            <td>{{$vaccine->description}}</td>

                            <td class="d-flex justify-content-around align-items-center">
                              <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editVaccineModal{{ $vaccine->id }}"><i class="fas fa-edit"></i></button>

                              <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteVaccineModal{{ $vaccine->id }}"><i class="fas fa-trash-alt"></i></button>

                              
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

    <!-- Add Vaccine Modal -->
        <div class="modal fade bd-example-modal-lg" id="addVaccineModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Vaccine</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <!-- -->
                  <form action="{{ route('vaccines.store') }}" method="post">
                    @csrf
                    <div class="container-fluid my-2 mx-2">
                        <div class="row">
    
                        <div class="col-md-5">
                            <div class="form-group">
                              <label>Vaccine Category</label>
                              <select class="form-control" aria-label="Default select example" name="vaccine_category_id">
                                <option selected disabled>Select Vaccine Category</option>
                                @foreach ($vaccine_categories as $vaccine_category)
                                    <option value="{{ $vaccine_category->id }}">{{ $vaccine_category->vaccine_category_name }}</option>
                                @endforeach
                              </select>
                            </div>
                          </div>
    
                          <div class="col-md-5">
                            <div class="form-group">
                              <label>Vaccine Name</label>
                              <input type="text" class="form-control" name="vaccine_name" >
                            </div>
                          </div>
    
                          <div class="col-md-2">
                            <div class="form-group">
                              <label>Doses</label>
                              <input type="number" class="form-control" name="doses" >
                            </div>
                          </div>
                          
    
    
    
                        </div>
    
                        <div class="row mt-2">
    
                          <div class="col">
                            <div class="form-group">
                              <label>Manufactured Date</label>
                              @php
                                $maxDate = date('Y-m-d');
                              @endphp
                              <input type="date" class="form-control" name="manufactured_date"  max="{{$maxDate}}">
                            </div>
                          </div>
    
                          <div class="col">
                            <div class="form-group">
                              <label>Expiration Date</label>
                              @php 
                                $minDate = date('Y-m-d');
                              @endphp
                              <input type="date" class="form-control" name="expiration_date"  min="{{$minDate}}">
                            </div>
                          </div>
    
    
                        </div>
    
                        <div class="row mt-2">
                          <div class="col">
                            <div class="form-group">
                              <label for="exampleFormControlTextarea1">Description</label>
                              <textarea class="form-control" id="exampleFormControlTextarea1" rows="5" name="description" style="resize: none;"></textarea>
                            </div>
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
    <!-- Add Vaccine Modal -->

    @foreach ($vaccines as $vaccine)

        <!-- Delete Vaccine Modal -->

        <div class="modal" id="deleteVaccineModal{{ $vaccine->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

              <form action="{{ route('vaccines.destroy', $vaccine) }}" method="POST">
                @csrf
                @method('DELETE')
                  <button type="submit" class="btn btn-danger" >Yes</button>
                </form>
              
              
              </div>
          </div>
          </div>
      </div>
      
  <!-- Delete Vaccine Modal -->

  <!-- Edit Vaccine Modal -->
  <div class="modal fade bd-example-modal-lg" id="editVaccineModal{{ $vaccine->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Vaccine</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
            <!-- -->
          <form action="{{ route('vaccines.update', $vaccine) }}" method="post">
            @method('PUT')
            @csrf
            <div class="container-fluid my-2 mx-2">
                <div class="row">

                <div class="col-md-5">
                    <div class="form-group">
                      <label>Vaccine Category</label>
                      <select class="form-control" aria-label="Default select example" name="vaccine_category_id">
                        <option selected disabled>Select Vaccine Category</option>
                        @foreach ($vaccine_categories as $vaccine_category)
                        <option value="{{ $vaccine_category->id }}" @selected($vaccine_category->id == $vaccine->vaccine_category_id)>{{ $vaccine_category->vaccine_category_name }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>

                  <div class="col-md-5">
                    <div class="form-group">
                      <label>Vaccine Name</label>
                      <input type="text" class="form-control" name="vaccine_name" value="{{ $vaccine->vaccine_name }}" readonly>
                    </div>
                  </div>

                  <div class="col-md-2">
                    <div class="form-group">
                      <label>Doses</label>
                      <input type="number" class="form-control" name="doses" value="{{ $vaccine->doses }}">
                    </div>
                  </div>
                  



                </div>

                <div class="row mt-2">

                  <div class="col">
                    <div class="form-group">
                      <label>Manufactured Date</label>
                      @php
                        $maxDate = date('Y-m-d');
                      @endphp
                      <input type="date" class="form-control" name="manufactured_date"  max="{{$maxDate}}" value="{{ $vaccine->manufactured_date }}">
                    </div>
                  </div>

                  <div class="col">
                    <div class="form-group">
                      <label>Expiration Date</label>
                      @php 
                        $minDate = date('Y-m-d');
                      @endphp
                      <input type="date" class="form-control" name="expiration_date"  min="{{$minDate}}" value="{{ $vaccine->expiration_date }}">
                    </div>
                  </div>


                </div>

                <div class="row mt-2">
                  <div class="col">
                    <div class="form-group">
                      <label for="exampleFormControlTextarea1">Description</label>
                      <textarea class="form-control" id="exampleFormControlTextarea1" rows="5" name="description" style="resize: none;">{{ $vaccine->description}}</textarea>
                    </div>
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
@endforeach

<!-- Modals -->


@endsection
