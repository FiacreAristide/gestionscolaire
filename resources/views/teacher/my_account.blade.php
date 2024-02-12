      @extends('layouts.app')

      @section('content')

      <div class="content-wrapper">

        <section class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1>Mon compte</h1>
              </div>
            </div>
          </div>
        </section>


        <section class="content">
          <div class="container-fluid">
            <div class="row">

              <div class="col-md-12">
                @include('_message')

                <div class="card card-primary">
                  <form method="post" action="" >
                    {{ csrf_field() }}
                    <div class="card-body">
                      <div class="row">
                        <div class="form-group col-md-6">
                          <label>Nom<span style="color:red;">*</span></label>
                          <input type="text" class="form-control" placeholder="Nom" name="name" value="{{ old('name',$getRecord->name) }}">
                          <div style="color: red;"></div>
                        </div>

                        <div class="form-group col-md-6">
                          <label>Prénom<span style="color:red;">*</span></label>
                          <input type="text" class="form-control" placeholder="Prénom" name="prenom"  value="{{ old('prenom',$getRecord->prenom) }}">
                          <div style="color: red;"></div>
                        </div>


                        <div class="form-group col-md-6">
                          <label>Sexe<span style="color:red;">*</span></label>
                          <select class="form-control"  name="sexe">
                            <option value="">---Selectionner sexe---</option>
                            <option {{(old('sexe',$getRecord->sexe) == 'Masculin') ? 'selected' : ''}} value="Masculin">Masculin </option>
                            <option {{(old('sexe',$getRecord->sexe) == 'Feminin') ? 'selected' : ''}} value="Féminin">Feminin</option>
                            <option {{(old('sexe',$getRecord->sexe) == 'Autres') ? 'selected' : ''}} value="Autres">Autres</option>
                          </select>
                          <div style="color: red;"></div>                        
                        </div>


                        <div class="form-group col-md-6">
                          <label>Téléphone</label>
                          <input type="tel" class="form-control"  name="telephone" value="{{ old('telephone',$getRecord->telephone) }}" placeholder="99-99-99-99" pattern="(9[0-9]|7[0-9])-[0-9]{2}-[0-9]{2}-[0-9]{2}">
                          <div style="color: red;"></div>
                        </div> 

                        <div class="form-group col-md-6">
                          <label>Situation Matrimoniale</label>
                          <select class="form-control" name="situation_matrimoniale">
                            <option value="">---Selectionner situation---</option>
                            <option {{(old('situation_matrimoniale',$getRecord->situation_matrimoniale) == 'Célibataire') ? 'selected' : ''}} value="Célibataire">Célibataire</option>
                            <option {{(old('situation_matrimoniale',$getRecord->situation_matrimoniale) == 'Marié') ? 'selected' : ''}} value="Marié">Marié(é)</option>
                            <option {{(old('situation_matrimoniale',$getRecord->situation_matrimoniale) == 'Veuve') ? 'selected' : ''}} value="Veuve">Veuve</option>
                            <option {{(old('situation_matrimoniale',$getRecord->situation_matrimoniale) == 'Divorcé') ? 'selected' : ''}} value="Divorcé">Divorcé(e)</option>
                          </select>                        
                          <div style="color: red;"></div>
                        </div>   

<!--                         <div class="form-group col-md-6">
                          <label>Profile Pic</label>
                          <input type="file" class="form-control" placeholder="" name="profile_pic">

                          <div style="color: red;">{{ $errors->first('profile_pic') }}</div>
                          @if(!empty($getRecord->getProfile()))
                          <img src="{{ $getRecord->getProfile()}}" style="width:auto; height: 50px;">
                          @endif
                        </div>    -->                       

                        <div class="form-group col-md-6">
                          <label>Adresse<span style="color:red;">*</span></label>
                          <input type="text" class="form-control" name="adresse"  value="{{ old('adresse',$getRecord->adresse) }}"></textarea>
                          <div style="color: red;"></div>
                        </div>

                        <div class="form-group col-md-6">
                          <label>Dernier diplôme<span style="color:red;">*</span></label>
                          <input type="text" class="form-control" placeholder="Votre dernier diplôme" name="dernier_diplome"  value="{{ old('dernier_diplome',$getRecord->dernier_diplome) }}">
                          <div style="color: red;"></div>
                        </div>   

                        <div class="form-group col-md-6">
                          <label>Grade Universitaire<span style="color:red;">*</span></label>
                          <select class="form-control"  name="grade_universitaire">
                            <option value="Non gradé">---Selectionner Grade---</option>
                            <option {{(old('grade_universitaire',$getRecord->grade_universitaire) == 'Licence') ? 'selected' : ''}} value= "Licence">Licence </option>
                            <option {{(old('grade_universitaire',$getRecord->grade_universitaire) == 'Master') ? 'selected' : ''}} value= "Master">Master</option>
                            <option {{(old('grade_universitaire',$getRecord->grade_universitaire) == 'Doctorat') ? 'selected' : ''}} value= "Doctorat">Doctorat</option>
                          </select>
                          <div style="color: red;"></div>                        
                        </div>   


                      </div>

                      <div class="form-group">
                        <label>Email<span style="color:red;">*</span></label>
                        <input type="email" class="form-control" placeholder="Enter email" name="email"  value="{{ old('email',$getRecord->email) }}">

                        <div style="color: red;">{{ $errors->first('email') }}</div>
                      </div>

                      <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Mettre à jour</button>
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

    @endsection


 <!--      <div class="content-wrapper">
        
        <section class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1>My Account</h1>
              </div>
            </div>
          </div>
        </section>

       
        <section class="content">
          <div class="container-fluid">
            <div class="row">
             
              <div class="col-md-12">

                @include('_message')
            
                <div class="card card-primary">
                  <form method="post" action="" enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <div class="card-body">
                      <div class="row">
                        <div class="form-group col-md-6">
                          <label>First Name<span style="color:red;">*</span></label>
                          <input type="text" class="form-control" placeholder="Enter first name" name="name"  value="{{ old('name',$getRecord->name) }}">
                          <div style="color: red;">{{ $errors->first('name') }}</div>
                        </div>


                        <div class="form-group col-md-6">
                          <label>Last Name<span style="color:red;">*</span></label>
                          <input type="text" class="form-control" placeholder="Enter last name" name="last_name"  value="{{ old('last_name',$getRecord->last_name) }}">

                          <div style="color: red;">{{ $errors->first('last_name') }}</div>
                        </div>


                        <div class="form-group col-md-6">
                          <label>Gender<span style="color:red;">*</span></label>
                          <select class="form-control"  name="gender">
                            <option  value="">---Select Gender---</option>
                            <option {{(old('gender',$getRecord->gender) == 'male') ? 'selected' : ''}} value="male">Male </option>
                            <option {{(old('gender',$getRecord->gender) == 'female') ? 'selected' : ''}} value="female">Female</option>
                            <option {{(old('gender',$getRecord->gender) == 'other') ? 'selected' : ''}} value="other">Other</option>
                          </select>

                          <div style="color: red;">{{ $errors->first('gender') }}</div>                        
                        </div>


                        <div class="form-group col-md-6">
                          <label>Birth Day<span style="color:red;">*</span></label>
                          <input type="date" class="form-control" placeholder="Your birthday" name="birth_day"  value="{{ old('birth_day',$getRecord->date_of_birth) }}">

                          <div style="color: red;">{{ $errors->first('date_of_birth') }}</div>                        
                        </div>

                        <div class="form-group col-md-6">
                          <label>Mobile Number</label>
                          <input type="tel" class="form-control"  name="mobile_number" value="{{ old('mobile_number',$getRecord->mobile_number) }}" placeholder="99-99-99-99" pattern="(9[0-9]|7[0-9])-[0-9]{2}-[0-9]{2}-[0-9]{2}">

                          <div style="color: red;">{{ $errors->first('mobile_number') }}</div>
                        </div> 

                        <div class="form-group col-md-6">
                          <label>Martial Status</label>
                          <select class="form-control" name="marital_status">
                            <option  value="">---Select Status---</option>
                            <option {{(old('marital_status', $getRecord->marital_status) == 'celibat') ? 'selected' : ''}} value="Célibataire">Célibataire</option>
                            <option {{(old('marital_status', $getRecord->marital_status) == 'marie') ? 'selected' : ''}} value="Marié">Marié(é)</option>
                            <option {{(old('marital_status', $getRecord->marital_status) == 'veuve') ? 'selected' : ''}} value="Veuve">Veuve</option>
                            <option {{(old('marital_status', $getRecord->marital_status) == 'divorce') ? 'selected' : ''}} value="Divorcé">Divorcé(e)</option>
                          </select>

                          <div style="color: red;">{{ $errors->first('height') }}</div>                        
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
                         <label>Current Address<span style="color:red;">*</span></label>
                         <textarea class="form-control" name="address" >{{old('address',$getRecord->address)}}</textarea>
                         <div style="color: red;">{{ $errors->first('address') }}</div>
                       </div>

                       <div class="form-group col-md-6">
                         <label>Permanent Address</label>
                         <textarea class="form-control" name="permanent_address">{{old('permanent_address',$getRecord->permanent_address)}}</textarea>
                         <div style="color: red;">{{ $errors->first('permanent_address') }}</div>
                       </div>


                       <div class="form-group col-md-6">
                         <label>Qualification</label>
                         <textarea class="form-control" name="qualification">{{old('qualification',$getRecord->qualification)}}</textarea>
                         <div style="color: red;">{{ $errors->first('qualification') }}</div>
                       </div>

                       <div class="form-group col-md-6">
                         <label>Work Experience</label>
                         <textarea class="form-control" name="work_experience">{{old('work_experience',$getRecord->work_experience)}}</textarea>
                         <div style="color: red;">{{ $errors->first('work_experience') }}</div>
                       </div>

                     </div>



                       <div class="form-group">
                        <label>Email<span style="color:red;">*</span></label>
                        <input type="email" class="form-control" placeholder="Enter email" name="email"  value="{{ old('email',$getRecord->email) }}">

                        <div style="color: red;">{{ $errors->first('email') }}</div>
                      </div>


                    </div>

                    <div class="card-footer">
                      <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                  </form>
                </div>

              </div>
            </div>
            
          </div>
        </section>
        
      </div> -->


