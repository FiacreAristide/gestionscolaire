  @extends('layouts.app')
  @section('content')

  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Liste des étudiants</h1>            
          </div>
          <div class="col-sm-6" style="text-align: right;">
            <a href="{{url('admin/student/add')}}" class="btn btn-primary">Ajouter un nouvel étudiant</a>
          </div>

        </div>
      </div>
    </section>

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
                        <input type="text" class="form-control" placeholder="Nom" name="name"  value="{{ Request::get('name')}}">
                      </div>
                      <div class="form-group col-md-2">
                        <label>Prenom</label>
                        <input type="text" class="form-control" placeholder="Prénom" name="prenom"  value="{{ Request::get('prenom')}}">
                      </div>
                      <div class="form-group col-md-3">
                        <label>Email</label>
                        <input type="text" class="form-control" placeholder="Email" name="email"  value="{{ Request::get('email')}}">
                      </div>
                      <div class="form-group col-md-2">
                        <label>Classe</label>
                        <input type="text" class="form-control" placeholder="Classe" name="class_id"  value="{{ Request::get('class_id')}}">
                      </div>                   
                      <div class="form-group col-md-2">
                        <label>Sexe</label>
                        <select class="form-control" name="gender">
                            <option value="">Selectionner sexe</option>
                            <option {{(Request::get('sexe') == 'Masculin') ? 'selected' : ''}} value="Masculin">Masculin </option>
                            <option {{(Request::get('sexe') == 'Féminin') ? 'selected' : ''}} value="Féminin">Feminin</option>
                            <option {{(Request::get('sexe') == 'Autre') ? 'selected' : ''}} value="Autre">Autres</option>
                        </select>
                      </div>  
                      <div class="form-group col-md-2">
                        <label>Status</label>
                        <select class="form-control" name="gender">
                            <option  value=""> Selectionner Status </option>
                            <option {{(Request::get('status') == 100) ? 'selected' : ''}} value="100">Active </option>
                            <option {{(Request::get('status') == 1) ? 'selected' : ''}} value="1">Inactive</option>
                        </select>
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
                <h3 class="card-title">Liste des étudiants </h3>
                <a class="btn btn-primary" style="float: right;" href="{{ url('admin/student/print_list') }}">Imprimer liste</a>
              </div>
              <div class="card-body p-0" style="overflow: auto;">
                  <table class="table">
                      <thead>
                          <tr>
                              <th>id</th>
                              <th>Matricule</th>
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
                              <th>Ajouté le</th>
                              <th style="text-align: center;">Action</th>
                          </tr>
                      </thead>
                      <tbody>
                          @forelse($getRecord as $value)
                          <tr>
                              <td>{{ $value->id}}</td>
                              <td>{{ $value->matricule }}</td>
                              <td style="min-width:150px;">{{ $value->name}} {{ $value->prenom}}</td>
                              <td style="min-width:150px;">{{ $value->class_name}}</td>
                              <td style="min-width:250px;">{{ $value->domain_name}}</td>
                              <td style="min-width:150px;">{{ $value->parcours}}</td>
                              <td style="min-width:250px;">{{ $value->subject_name}}</td>
                              <td style="min-width:150px;">{{ $value->email}}</td>
                              <td style="min-width:150px;">{{ date('d-m-Y', strtotime($value->date_naissance))}}</td>
                              <td style="min-width:150px;">{{ $value->lieu_naissance}}</td>
                              <td style="min-width:150px;">{{ $value->pays_naissance}}</td>
                              <td style="min-width:150px;">{{ $value->nationalite}}</td>
                              <td style="min-width:150px;">{{ $value->prefecture}}</td>
                              <td style="min-width:150px;">{{ $value->sexe}}</td>
                              <td style="min-width:150px;">{{ $value->situation_matrimoniale}}</td>
                              <td style="min-width:150px;">{{ $value->adresse}}</td>
                              <td style="min-width:150px;">{{ $value->ville}}</td>
                              <td style="min-width:150px;">{{ $value->pays_residence}}</td>
                              <td style="min-width:150px;">{{ $value->telephone}}</td>
                              <td style="min-width:150px;">{{ $value->boursier}}</td>
                              <td style="min-width:150px;">{{ ($value->debut_bourse) ? $value->debut_bourse : 'Non boursier'}}</td>
                              <td style="min-width:150px;">{{ $value->religion}}</td>
                              <td style="min-width:150px;">{{ $value->etatPhys}}</td>
                              <td style="min-width:150px;">{{ $value->handicap}}</td>
                              <td style="min-width:150px;">{{ $value->person_prev}}</td>
                              <td style="min-width:150px;">{{ $value->tel_prev}}</td>
                              <td style="min-width:150px;">{{ ($value->status == 0) ? 'Active' : 'Inactive'}}</td>
                              <td style="min-width:150px;">{{ date('d-m-y h:i', strtotime($value->created_at))}}</td>
                              <td style="min-width: 450px;">
                                  <a href="{{ url('admin/student/edit/'.$value->user_id)}}" class="btn btn-primary" style="width: 100px;">Modifier</a>
                                  <a href="{{url('admin/student/delete/'.$value->user_id)}}" class="btn btn-danger" style="width: 100px;">Supprimer</a>
                                  <a href="{{ url('admin/student/print_card/'.$value->user_id)}}" class="btn btn-success" style="width: 100px;" target="_blank">Carte</a>
                              </td>
                          </tr>
                          @empty
                            <tr style="text-align: center;">
                                <td colspan="100%">Aucun resultat trouvé </td>
                            </tr>
                          @endforelse
                      </tbody>
                  </table>
              </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  @endsection