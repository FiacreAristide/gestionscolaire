    @extends('layouts.app')

    @section('content')



    <div class="content-wrapper">

      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Ajouter un enseignant</h1>
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
                        <label>Date d'intégration<span style="color:red;">*</span></label>
                        <input type="date" class="form-control" required placeholder="" name="date_integration" value="">
                        <div style="color: red;"></div>
                      </div> 

                      <div class="form-group col-md-6">
                        <label>Téléphone</label>
                        <input type="tel" class="form-control" required name="telephone" value="" placeholder="99-99-99-99" pattern="(9[0-9]|7[0-9])-[0-9]{2}-[0-9]{2}-[0-9]{2}">
                        <div style="color: red;"></div>
                      </div> 

                      <div class="form-group col-md-6">
                        <label>Situation Matrimoniale</label>
                        <select class="form-control" name="situation_matrimoniale">
                          <option value="">---Selectionner situation---</option>
                          <option value="Célibataire">Célibataire</option>
                          <option value="Marié">Marié(é)</option>
                          <option value="Veuve">Veuve</option>
                          <option value="Divorcé">Divorcé(e)</option>
                        </select>                        
                        <div style="color: red;"></div>
                      </div>    

                      <div class="form-group col-md-6">
                        <label>Adresse<span style="color:red;">*</span></label>
                        <input class="form-control" name="adresse" required></textarea>
                        <div style="color: red;"></div>
                      </div>

                      <div class="form-group col-md-6">
                        <label>Dernier diplôme<span style="color:red;">*</span></label>
                        <input type="text" class="form-control" placeholder="Votre dernier diplôme" name="dernier_diplome" required>
                        <div style="color: red;"></div>
                      </div>   

                      <div class="form-group col-md-6">
                        <label>Grade Universitaire<span style="color:red;">*</span></label>
                        <select class="form-control" required name="grade_universitaire">
                          <option value="">---Selectionner Grade---</option>
                          <option value= "Licence">Licence </option>
                          <option value= "Master">Master</option>
                          <option value= "Doctorat">Doctorat</option>
                        </select>
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


                      <div class="form-group col-md-6">
                        <label>Email<span style="color:red;">*</span></label>
                        <input type="email" class="form-control" placeholder="example@gmail.com" name="email" required value="">
                        <div style="color: red;"></div>
                      </div>

                      <div class="form-group col-md-6">
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


<!--       <section class="content">
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
                        <input type="text" class="form-control" placeholder="Enter first name" name="name" required value="{{ old('name') }}">
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
                        <label>Birth Day<span style="color:red;">*</span></label>
                        <input type="date" class="form-control" placeholder="Your birthday" name="birth_day" required value="{{ old('birth_day') }}">

                      <div style="color: red;">{{ $errors->first('date_of_birth') }}</div>                        
                      </div>

                      <div class="form-group col-md-6">
                        <label>Admission Date<span style="color:red;">*</span></label>
                        <input type="date" class="form-control" required placeholder="Admission Date" name="admission_date" value="{{ old('admission_date') }}">

                        <div style="color: red;">{{ $errors->first('admission_date') }}</div>
                      </div> 
                  


                      <div class="form-group col-md-6">
                        <label>Mobile Number</label>
                        <input type="tel" class="form-control" required name="mobile_number" value="{{ old('mobile_number') }}" placeholder="99-99-99-99" pattern="(9[0-9]|7[0-9])-[0-9]{2}-[0-9]{2}-[0-9]{2}">

                        <div style="color: red;">{{ $errors->first('mobile_number') }}</div>
                      </div> 

                      <div class="form-group col-md-6">
                        <label>Martial Status</label>
                        <select class="form-control" name="marital_status">
                            <option  value="">---Select Status---</option>
                            <option {{(old('marital_status') == 'celibat') ? 'selected' : ''}} value="Célibataire">Célibataire</option>
                            <option {{(old('marital_status') == 'marie') ? 'selected' : ''}} value="Marié">Marié(é)</option>
                            <option {{(old('marital_status') == 'veuve') ? 'selected' : ''}} value="Veuve">Veuve</option>
                            <option {{(old('marital_status') == 'divorce') ? 'selected' : ''}} value="Divorcé">Divorcé(e)</option>
                        </select>

                      <div style="color: red;">{{ $errors->first('height') }}</div>                        
                      </div>  


                      <div class="form-group col-md-6">
                        <label>Profile Pic</label>
                        <input type="file" class="form-control" placeholder="" name="profile_pic">

                        <div style="color: red;">{{ $errors->first('profile_pic') }}</div>
                      </div>                     

					 <div class="form-group col-md-6">
					 	<label>Current Address<span style="color:red;">*</span></label>
					 	<textarea class="form-control" name="address" required>{{old('address')}}</textarea>
					 	<div style="color: red;">{{ $errors->first('address') }}</div>
					 </div>

					 <div class="form-group col-md-6">
					 	<label>Permanent Address</label>
					 	<textarea class="form-control" name="permanent_address">{{old('permanent_address')}}</textarea>
					 	<div style="color: red;">{{ $errors->first('permanent_address') }}</div>
					 </div>


					 <div class="form-group col-md-6">
					 	<label>Qualification</label>
					 	<textarea class="form-control" name="qualification">{{old('qualification')}}</textarea>
					 	<div style="color: red;">{{ $errors->first('qualification') }}</div>
					 </div>

					 <div class="form-group col-md-6">
					 	<label>Work Experience</label>
					 	<textarea class="form-control" name="work_experience">{{old('work_experience')}}</textarea>
					 	<div style="color: red;">{{ $errors->first('work_experience') }}</div>
					 </div>

					 <div class="form-group col-md-6">
					 	<label>Note</label>
					 	<textarea class="form-control" name="note">{{old('note')}}</textarea>
					 	<div style="color: red;">{{ $errors->first('note') }}</div>
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
      </section> -->
      
    </div>


    @endsection