  @extends('layouts.app')
  @section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Mon enfant </h1>
          </div>
        </div>
      </div>
    </section>




    <!-- Main content -->
    <section class="content">

      <div class="container-fluid">
        <div class="row">

          <div class="col-md-12">

            @include('_message')


            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Liste </h3>
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
                      <td style="width: 500px;">
                        <a href="{{ url('parent/my_student/course/'.$value->id)}}" class="btn btn-success btn-sm">Matières</a>

                        <a href="{{ url('parent/my_student/exam_timetable/'.$value->id)}}" class="btn btn-primary btn-sm">examen</a>
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