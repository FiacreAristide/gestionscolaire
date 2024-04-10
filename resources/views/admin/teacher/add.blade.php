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
                      <input type="hidden" name="school_year_id" value="{{ $getActiveYear->id }}">                                  
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
                          <option value="">Selectionner sexe</option>
                          <option value="Masculin">Masculin </option>
                          <option value="Féminin">Féminin</option>
                          <option value="Autre">Autre</option>
                        </select>
                        <div style="color: red;"></div>                        
                      </div>

                      <div class="form-group col-md-6">
                        <label>Date d'intégration<span style="color:red;">*</span></label>
                        <input type="date" class="form-control" required name="date_integration">
                      </div> 

                      <div class="form-group col-md-6">
                        <label>Téléphone</label>
                        <input type="tel" class="form-control" required name="telephone" value="" placeholder="99-99-99-99" pattern="(9[0-9]|7[0-9])-[0-9]{2}-[0-9]{2}-[0-9]{2}">
                        <div style="color: red;"></div>
                      </div> 

                      <div class="form-group col-md-6">
                        <label>Situation Matrimoniale</label>
                        <select class="form-control" name="situation_matrimoniale">
                          <option value="">Selectionner situation</option>
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
                        <input type="text" class="form-control" placeholder="dernier diplôme" name="dernier_diplome" required>
                        <div style="color: red;"></div>
                      </div>   

                      <div class="form-group col-md-6">
                        <label>Grade Universitaire<span style="color:red;">*</span></label>
                        <select class="form-control" required name="grade_universitaire">
                          <option value="">Selectionner grade</option>
                          <option value= "Licence">Licence </option>
                          <option value= "Master">Master</option>
                          <option value= "Doctorat">Doctorat</option>
                        </select>
                      </div>   

                      <div class="form-group col-md-6">
                        <label>Status<span style="color:red;">*</span></label>
                        <select class="form-control" required name="status">
                          <option value=""> Selectionner Status </option>
                          <option value= "0">Active </option>
                          <option value= "1">Inactive</option>
                        </select>
                                               
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
    </div>

    @endsection