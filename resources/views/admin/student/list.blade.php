  @extends('layouts.app')
  @section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Liste des étudiants</h1>
            
          </div>

          <div class="col-sm-6" style="text-align: right;">
            <a href="{{url('admin/student/add')}}" class="btn btn-primary">Ajouté un nouvel étudiant</a>
          </div>

        </div>
      </div>
    </section>




    <!-- Main content -->
    <section class="content">

      <div class="container-fluid">
        <div class="row">

          <div class="col-md-12">


           <div class="card">
              
              <div class="card-header">
                <h3 class="card-title">Rechercher un étudiant </h3>
              </div>
                  <form method="get" action="">
                    
                    <div class="card-body">

                      <div class="row">

                      <div class="form-group col-md-3">
                        <label>Nom</label>
                        <input type="text" class="form-control" placeholder="Enter name" name="name"  value="{{ Request::get('name')}}" placeholder="name">
                      </div>


                      <div class="form-group col-md-2">
                        <label>Prenom</label>
                        <input type="text" class="form-control" placeholder="Enter name" name="prenom"  value="{{ Request::get('prenom')}}" placeholder="">
                      </div>

                      <div class="form-group col-md-3">
                        <label>Email</label>
                        <input type="text" class="form-control" placeholder="Enter email" name="email"  value="{{ Request::get('email')}}" placeholder="email">
                      </div>


   

                      <div class="form-group col-md-2">
                        <label>Class</label>
                        <input type="text" class="form-control" placeholder="Class" name="roll_number"  value="{{ Request::get('roll_number')}}" placeholder="Roll Number">
                      </div>                   

                      <div class="form-group col-md-2">
                        <label>Sexe</label>
                        <select class="form-control" name="gender">
                            <option  value="">---Select Gender---</option>
                            <option {{(Request::get('gender') == 'male') ? 'selected' : ''}} value="male">Male </option>
                            <option {{(Request::get('gender') == 'female') ? 'selected' : ''}} value="female">Female</option>
                            <option {{(Request::get('gender') == 'other') ? 'selected' : ''}} value="other">Other</option>
                        </select>
                      </div>


                      <div class="form-group col-md-2">
                        <label>Religion</label>
                        <input type="text" class="form-control" placeholder="Religion" name="religion"  value="{{ Request::get('religion')}}" placeholder="Religion">
                      </div> 


                      <div class="form-group col-md-2">
                        <label>Téléphone</label>
                        <input type="text" class="form-control" placeholder="Mobile Number" name="mobile_number"  value="{{ Request::get('mobile_number')}}" placeholder="Mobile Number">
                      </div>  


                      <div class="form-group col-md-2">
                        <label>Status</label>
                        <select class="form-control" name="gender">
                            <option  value="">---Select Status---</option>
                            <option {{(Request::get('status') == 100) ? 'selected' : ''}} value="100">Active </option>
                            <option {{(Request::get('status') == 1) ? 'selected' : ''}} value="1">Inactive</option>
                        </select>
                      </div>                      

<!--                       <div class="form-group col-md-2">
                        <label>Blood Group</label>
                          <select class="form-control" name="blood_group">
                            <option value="">---Select Group---</option>
                            <option value="o+">O+ </option>
                            <option value="o-">O-</option>
                            <option value="a+">A+</option>
                            <option value="a-">A-</option> <option value="b+">B+</option> <option value="b-">B-</option> <option value="ab">AB</option>
                            <option value="ab-">AB-</option>
                        </select>
                      </div>                                                                 
 -->

                      <div class="form-group col-md-2">
                        <label>Date d'admission</label>
                        <input type="date" class="form-control" placeholder="Enter email" name="date"  value="{{ Request::get('date')}}">
                      </div>

                      <div class="form-group col-md-3">
                        <button class="btn btn-primary" type="submit" style="margin-top: 32px;">Rechercher</button>

                         <a class="btn btn-success" style="margin-top: 32px;" href="{{ url('admin/student/list')}}">Annuler</a>
                      </div>

                    </div>
                    </div>
                  </form>
                </div>


            @include('_message')
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Liste des étudiants  </h3>
              </div>

              <div class="card-body p-0" style="overflow: auto;">
                <table class="table">
                  <thead>
                    <tr>
                      <th>id</th>
                      <th>Nom & Prénoms</th>
                      <th>Classe</th>
                      <th>Domaine</th>
                      <th>Parcours</th>
                      <th>Spécialité</th>
                      <th>Email</th>
                      <th>Date Naissance</th>
                      <th>Lieu de Naissance</th>
                      <th>Pays natal</th>
                      <th>Nationalité</th>
                      <th>Ethnie</th>
                      <th>Prefecture</th>
                      <th>Sexe</th>
                      <th>Situation Matrimoniale</th>
                      <th>Adresse</th>
                      <th>Ville</th>
                      <th>Pays de Résidence</th>
                      <th>Téléphone</th>
                      <th>Boursier</th>
                      <th>Debut de la Bourse</th>
                      <th>Religion</th>
                      <th>Etat Physique</th>
                      <th>Handicap</th>
                      <th>Personne à prévenir</th>
                      <th>Téléphone de la personne</th>
                      <th>Status</th> 
                      <th>Créer le</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($getRecord as $value)

                    <tr>
                      <td>{{ $value->id}}</td>
                      <td>{{ $value->name}} {{ $value->prenom}}</td>
                      <td>{{ $value->class_name}}</td>
                      <td>{{ $value->domain_name}}</td>
                      <td>{{ $value->parcours}}</td>
                      <td>{{ $value->subject_name}}</td>
                      <td>{{ $value->email}}</td>
                        <td>
                         @if(!empty($value->date_naissance))
                          {{ date('d-m-Y', strtotime($value->date_of_birth))}}
                         @endif
                        </td>
                     
                      <td>{{ $value->lieu_naissance}}</td>
                      <td>{{ $value->pays_naissance}}</td>
                      <td>{{ $value->nationalite}}</td>
                      <td>{{ $value->ehtnie}}</td>
                      <td>{{ $value->prefecture}}</td>
                      <td>{{ $value->sexe}}</td>
                      <td>{{ $value->situation_matrimoniale}}</td>
                      <td>{{ $value->adresse}}</td>
                      <td>{{ $value->ville}}</td>
                      <td>{{ $value->pays_residence}}</td>
                      <td>{{ $value->telephone}}</td>
                      <td>{{ $value->boursier}}</td>
                      <td>{{ $value->debut_bourse}}</td>
                      <td>{{ $value->religion}}</td>
                      <td>{{ $value->etatPhys}}</td>
                      <td>{{ $value->handicap}}</td>
                      <td>{{ $value->person_prev}}</td>
                      <td>{{ $value->tel_prev}}</td>
                      <td>{{ ($value->status ==0) ? 'Active' : 'Inactive'}}</td>
                      
                      <td>{{ date('d-m-y h:i', strtotime($value->created_at))}}</td>

                      <td style="min-width: 150px;">
                        <a href="{{ url('admin/student/edit/'.$value->id)}}" class="btn btn-primary btn-sm">Modifier</a>
                        <a href="{{url('admin/student/delete/'.$value->id)}}" class="btn btn-danger btn-sm">Supprimer</a>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>

                <div style="padding: 10px; float: right;">
                 
                </div>
                
              </div>
            </div>
          </div>
      </div>
    </section>
    <!-- /.content -->
  </div>

  @endsection