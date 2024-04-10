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
                        <label>Sexe<span style="color:red;"></span></label>
                        <select class="form-control" name="sexe">
                          <option value="">Selectionner sexe</option>
                          <option {{(old('sexe',$getRecord->sexe) == 'Masculin') ? 'selected' : ''}} value="Masculin">Masculin</option>
                          <option {{(old('sexe',$getRecord->sexe) == 'Féminin') ? 'selected' : ''}} value="Féminin">Feminin</option>
                          <option {{(old('sexe',$getRecord->sexe) == 'Autre') ? 'selected' : ''}} value="Autre">Autres</option>
                        </select>
                      </div>

                      <div class="form-group col-md-6">
                        <label>Téléphone</label>
                        <input type="tel" class="form-control"  name="telephone" value="{{old('telephone',$getRecord->telephone)}}" placeholder="99-99-99-99" pattern="(9[0-9]|7[0-9])-[0-9]{2}-[0-9]{2}-[0-9]{2}">
                        <div style="color: red;"></div>
                      </div> 

                      <div class="form-group col-md-6">
                        <label>Situation Matrimoniale</label>
                        <select class="form-control" name="situation_matrimoniale">
                          <option value="">Selectionner situation</option>
                          <option {{(old('situation_matrimoniale',$getRecord->situation_matrimoniale) == 'Célibataire') ? 'selected' : ''}} value="Célibataire">Célibataire</option>
                          <option {{(old('situation_matrimoniale',$getRecord->situation_matrimoniale) == 'Marié') ? 'selected' : ''}} value="Marié">Marié(é)</option>
                          <option {{(old('situation_matrimoniale',$getRecord->situation_matrimoniale) == 'Veuve') ? 'selected' : ''}} value="Veuve">Veuve</option>
                          <option {{(old('situation_matrimoniale',$getRecord->situation_matrimoniale) == 'Divorcé') ? 'selected' : ''}} value="Divorcé">Divorcé(e)</option>
                        </select>                        
                        <div style="color: red;"></div>
                      </div>    

                      <div class="form-group col-md-6">
                        <label>Adresse<span style="color:red;">*</span></label>
                        <input type="text" name="adresse"  value="{{ old('adresse',$getRecord->adresse) }}" class="form-control">
                        <div style="color: red;"></div>
                      </div>

                      <div class="form-group col-md-6">
                        <label>Dernier diplôme<span style="color:red;">*</span></label>
                        <input type="text" class="form-control" placeholder="dernier diplôme" name="dernier_diplome"  value="{{ old('dernier_diplome',$getRecord->dernier_diplome) }}">
                      </div>   

                      <div class="form-group col-md-6">
                        <label>Grade Universitaire</label>
                        <select class="form-control" name="grade_universitaire">
                          <option value="">Selectionner Grade</option>
                          <option {{(old('grade_universitaire',$getRecord->grade_universitaire) == 'Licence') ? 'selected' : ''}} value= "Licence">Licence </option>
                          <option {{(old('grade_universitaire',$getRecord->grade_universitaire) == 'Master') ? 'selected' : ''}} value= "Master">Master</option>
                          <option {{(old('grade_universitaire',$getRecord->grade_universitaire) == 'Doctorat') ? 'selected' : ''}} value= "Doctorat">Doctorat</option>
                        </select>
                      </div>                  

                    <div class="form-group col-md-12">
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
