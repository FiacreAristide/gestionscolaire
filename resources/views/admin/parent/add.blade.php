      @extends('layouts.app')

      @section('content')


      <div class="content-wrapper">

        <section class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1>Ajouter un parent</h1>
              </div>
            </div>
          </div>
        </section>

        <section class="content">
          <div class="container-fluid">
            <div class="row">

              <div class="col-md-12">

                <div class="card card-primary">
                  <form method="post" action="" >
                    {{ csrf_field() }}
                    <div class="card-body">
                      <div class="row">
                        <div class="form-group col-md-6">
                          <label>Nom<span style="color:red;">*</span></label>
                          <input type="text" class="form-control" placeholder="Nom" name="name" required value="">
                          <div style="color: red;"></div>
                        </div>

                        <div class="form-group col-md-6">
                          <label>Prénom<span style="color:red;">*</span></label>
                          <input type="text" class="form-control" placeholder="Prénom" name="prenom" required value="">
                          <div style="color: red;"></div>
                        </div>


                        <div class="form-group col-md-6">
                          <label>Sexe<span style="color:red;">*</span></label>
                          <select class="form-control" required name="sexe">
                            <option value="">---Selectionner sexe---</option>
                            <option value="Masculin">Masculin </option>
                            <option value="Féminin">Féminin</option>
                            <option value="Autre">Autre</option>
                          </select>
                          <div style="color: red;"></div>                        
                        </div>


                        <div class="form-group col-md-6">
                          <label>Téléphone</label>
                          <input type="tel" class="form-control" required name="telephone" value="" placeholder="99-99-99-99" pattern="(9[0-9]|7[0-9])-[0-9]{2}-[0-9]{2}-[0-9]{2}">
                          <div style="color: red;"></div>
                        </div> 

                        <div class="form-group col-md-6">
                          <label>Adresse<span style="color:red;">*</span></label>
                          <input type="text" class="form-control" name="adresse" required></textarea>
                          <div style="color: red;"></div>
                        </div>

                        <div class="form-group col-md-6">
                          <label>Occupation<span style="color:red;">*</span></label>
                          <input type="text" class="form-control" placeholder="" name="occupation" required value="">
                          <div style="color: red;"></div>
                        </div>   

                        <div class="form-group col-md-6">
                          <label>Status<span style="color:red;">*</span></label>
                          <select class="form-control" required name="status">
                            <option value="">---Selectionner Status---</option>
                            <option value= "0">Active </option>
                            <option value= "1">Inactive</option>
                          </select>
                          <div style="color: red;"></div>                        
                        </div>                      


                        <div class="form-group col-md-12">
                          <label>Email<span style="color:red;">*</span></label>
                          <input type="email" class="form-control" placeholder="example@gmail.com" name="email" required value="">
                          <div style="color: red;"></div>
                        </div>

                        <div class="form-group col-md-12">
                          <label>Mot de passe<span style="color:red;">*</span></label>
                          <input type="password" class="form-control" placeholder="Mot de passe" name="password" required>
                        </div>


                        <div class="card-footer">
                          <button type="submit" class="btn btn-primary">Soumettre</button>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>

              </div>
            </div>

          </div>
        </section>

      </div>



<!--         <div class="content-wrapper">
        
        <section class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1>Add New Parent</h1>
              </div>
            </div>
          </div>
        </section>

       
        <section class="content">
          <div class="container-fluid">
            <div class="row">
              
              <div class="col-md-12">
                
                <div class="card card-primary">
                  <form method="post" action="" enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <div class="card-body">
                      <div class="row">

                        <div class="form-group col-md-6">
                          <label>First Name<span style="color:red;">*</span></label>
                          <input type="text" class="form-control" placeholder="Enter first name" name="first_name" required value="{{ old('name') }}">

                          <div style="color: red;">{{ $errors->first('name') }}</div>
                        </div>


                        <div class="form-group col-md-6">
                          <label>Last Name<span style="color:red;">*</span></label>
                          <input type="text" class="form-control" placeholder="Enter last name" name="last_name" required value="{{ old('last_name') }}">

                          <div style="color: red;">{{ $errors->first('last_name') }}</div>
                        </div>


                        <div class="form-group col-md-6">
                          <label>Gender<span style="color:red;">*</span></label>
                          <select class="form-control" required name="gender">
                              <option  value="">---Select Gender---</option>
                              <option {{(old('gender') == 'male') ? 'selected' : ''}} value="male">Male </option>
                              <option {{(old('gender') == 'female') ? 'selected' : ''}} value="female">Female</option>
                              <option {{(old('gender') == 'other') ? 'selected' : ''}} value="other">Other</option>
                          </select>

                        <div style="color: red;">{{ $errors->first('gender') }}</div>                        
                        </div>

                        <div class="form-group col-md-6">
                          <label>Occupation</label>
                          <input type="text" class="form-control" placeholder="Occupation" name="occupation" value="{{ old('occupation') }}">

                        <div style="color: red;">{{ $errors->first('occupation') }}</div>                    
                        </div>                  

                        <div class="form-group col-md-6">
                          <label>Mobile Number<span style="color:red;">*</span></label>
                          <input type="text" class="form-control" required placeholder="Enter Religion" name="mobile_number" value="{{ old('mobile_number') }}">

                          <div style="color: red;">{{ $errors->first('mobile_number') }}</div>
                        </div>

                        <div class="form-group col-md-6">
                          <label>Address<span style="color:red;">*</span></label>
                          <input type="text" class="form-control" required placeholder="Address" name="address" value="{{ old('address') }}">

                        <div style="color: red;">{{ $errors->first('address') }}</div>                    
                        </div>                        


                        <div class="form-group col-md-6">
                          <label>Profile Pic</label>
                          <input type="file" class="form-control" placeholder="" name="profile_pic">

                          <div style="color: red;">{{ $errors->first('profile_pic') }}</div>
                        </div>               


                        <div class="form-group col-md-6">
                          <label>Status<span style="color:red;">*</span></label>
                          <select class="form-control" required name="status">
                              <option value="">---Select Status---</option>
                              <option {{(old('status') == 0) ? 'selected' : ''}} value= "0">Active </option>
                              <option {{(old('status') == 1) ? 'selected' : ''}} value= "1">Inactive</option>
                          </select>

                        <div style="color: red;">{{ $errors->first('status') }}</div>                        
                        </div>
                        
                      </div>

                      <div class="form-group">
                        <label>Email<span style="color:red;">*</span></label>
                        <input type="email" class="form-control" placeholder="Enter email" name="email" required value="{{ old('email') }}">

                        <div style="color: red;">{{ $errors->first('email') }}</div>
                      </div>
                      <div class="form-group">
                        <label> Password<span style="color:red;">*</span></label>
                        <input type="password" class="form-control" placeholder="Password" name="password" required>
                      </div>
                    </div>

                    <div class="card-footer">
                      <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                  </form>
                </div>

              </div>
            </div>
            
          </div>
        </section>
        
      </div>
    -->

    @endsection