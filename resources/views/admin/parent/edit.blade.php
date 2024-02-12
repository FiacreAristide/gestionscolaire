      @extends('layouts.app')

      @section('content')


        <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1>Edit Parent</h1>
              </div>
            </div>
          </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="container-fluid">
            <div class="row">
              <!-- left column -->
              <div class="col-md-12">
                <!-- general form elements -->
                <div class="card card-primary">
                  <form method="post" action="" enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <div class="card-body">
                      <div class="row">

                        <div class="form-group col-md-6">
                          <label>First Name<span style="color:red;">*</span></label>
                          <input type="text" class="form-control" placeholder="Enter first name" name="first_name"  value="{{ old('name', $getRecord->name) }}">

                          <div style="color: red;">{{ $errors->first('name') }}</div>
                        </div>


                        <div class="form-group col-md-6">
                          <label>Last Name<span style="color:red;">*</span></label>
                          <input type="text" class="form-control" placeholder="Enter last name" name="last_name" value="{{ old('last_name', $getRecord->last_name) }}">

                          <div style="color: red;">{{ $errors->first('last_name') }}</div>
                        </div>


                        <div class="form-group col-md-6">
                          <label>Gender<span style="color:red;">*</span></label>
                          <select class="form-control"  name="gender">
                              <option  value="">---Select Gender---</option>
                              <option {{(old('gender', $getRecord->gender) == 'male') ? 'selected' : ''}} value="male">Male </option>
                              <option {{(old('gender', $getRecord->gender) == 'female') ? 'selected' : ''}} value="female">Female</option>
                              <option {{(old('gender', $getRecord->gender) == 'other') ? 'selected' : ''}} value="other">Other</option>
                          </select>

                        <div style="color: red;">{{ $errors->first('gender') }}</div>                        
                        </div>

                        <div class="form-group col-md-6">
                          <label>Occupation</label>
                          <input type="text" class="form-control" placeholder="Occupation" name="occupation" value="{{ old('occupation', $getRecord->occupation) }}">

                        <div style="color: red;">{{ $errors->first('occupation') }}</div>                    
                        </div>                  

                        <div class="form-group col-md-6">
                          <label>Mobile Number<span style="color:red;">*</span></label>
                          <input type="text" class="form-control" placeholder="Enter Religion" name="mobile_number" value="{{ old('mobile_number', $getRecord->mobile_number) }}">

                          <div style="color: red;">{{ $errors->first('mobile_number') }}</div>
                        </div>

                        <div class="form-group col-md-6">
                          <label>Address<span style="color:red;"></span></label>
                          <input type="text" class="form-control"  placeholder="Address" name="address" value="{{ old('address', $getRecord->address) }}">

                        <div style="color: red;">{{ $errors->first('address') }}</div>                    
                        </div>                        


                        <div class="form-group col-md-6">
                          <label>Profile Pic</label>
                          <input type="file" class="form-control" placeholder="" name="profile_pic">


                          <div style="color: red;">{{ $errors->first('profile_pic') }}</div>

                          @if(!empty($getRecord->getProfile()))
                            <img src="{{ $getRecord->getProfile()}}" style="width:auto; height: 50px;">
                          @endif
                        </div>               


                        <div class="form-group col-md-6">
                          <label>Status<span style="color:red;"></span></label>
                          <select class="form-control" name="status">
                              <option value="">---Select Status---</option>
                              <option {{(old('status',$getRecord->status ) == 0) ? 'selected' : ''}} value= "0">Active </option>
                              <option {{(old('status',$getRecord->status) == 1) ? 'selected' : ''}} value= "1">Inactive</option>
                          </select>

                        <div style="color: red;">{{ $errors->first('status') }}</div>                        
                        </div>
                        
                      </div>

                      <div class="form-group">
                        <label>Email<span style="color:red;">*</span></label>
                        <input type="email" class="form-control" placeholder="Enter email" name="email"  value="{{ old('email', $getRecord->email) }}">

                        <div style="color: red;">{{ $errors->first('email') }}</div>
                      </div>
                      <div class="form-group">
                        <label> Password<span style="color:red;">*</span></label>
                        <input type="text" class="form-control" placeholder="Password" name="password" >
                        <p>Do you want to change password so please add new password!</p>
                      </div>
                    </div>

                    <div class="card-footer">
                      <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                  </form>
                </div>

              </div>
            </div>
            <!-- /.row -->
          </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
      </div>
     

      @endsection