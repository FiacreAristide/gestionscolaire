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
                      <td style="min-width: 200px;">{{ $value->name}} {{ $value->prenom}}</td>
                      <td style="min-width: 100px;">{{ $value->class_name}}</td>
                      <td style="min-width: 200px;">{{ $value->domain_name}}</td>
                      <td style="min-width: 200px;">{{ $value->parcours}}</td>
                      <td style="min-width: 200px;">{{ $value->subject_name}}</td>
                      <td style="min-width: 200px;">{{ $value->email}}</td>
                        <td style="min-width: 300px; text-align:center;">
                         @if(!empty($value->date_naissance))
                          {{ date('d-m-Y', strtotime($value->date_of_birth))}}
                         @endif
                        </td>
                     
                      <td style="min-width: 100px; ">{{ $value->lieu_naissance}}</td>
                      <td style="min-width: 100px; ">{{ $value->pays_naissance}}</td>
                      <td style="min-width: 200px; ">{{ $value->nationalite}}</td>
                      <td style="min-width: 100px; ">{{ $value->ehtnie}}</td>
                      <td style="min-width: 100px; ">{{ $value->prefecture}}</td>
                      <td style="min-width: 100px; ">{{ $value->sexe}}</td>
                      <td style="min-width: 100px; ">{{ $value->situation_matrimoniale}}</td>
                      <td style="min-width: 200px; ">{{ $value->adresse}}</td>
                      <td style="min-width: 100px; ">{{ $value->ville}}</td>
                      <td style="min-width: 100px; ">{{ $value->pays_residence}}</td>
                      <td style="min-width: 200px; ">{{ $value->telephone}}</td>
                      <td style="min-width: 200px; ">{{ $value->boursier}}</td>
                      <td style="min-width: 300px; ">{{ $value->debut_bourse}}</td>
                      <td style="min-width: 200px; ">{{ $value->religion}}</td>
                      <td style="min-width: 200px; ">{{ $value->etatPhys}}</td>
                      <td style="min-width: 200px; ">{{ $value->handicap}}</td>
                      <td style="min-width: 100px; ">{{ $value->person_prev}}</td>
                      <td style="min-width: 200px; ">{{ $value->tel_prev}}</td>
                      <td style="min-width: 100px; ">{{ ($value->status ==0) ? 'Active' : 'Inactive'}}</td>
                      
                      <td style="min-width: 200px; ">{{ date('d-m-y h:i', strtotime($value->created_at))}}</td>
                      <td style="min-width: 300px; text-align:center;">
                        <a href="{{ url('parent/my_student/course/'.$value->id)}}" class="btn btn-success btn-sm">Matières</a>
                        <a href="{{ url('parent/my_student/exam_timetable/'.$value->id)}}" class="btn btn-primary btn-sm">Examen</a>
                        <a href="{{ url('parent/my_student/exam_result/'.$value->id)}}" class="btn btn-success btn-sm">Résultat</a>
                        <a href="{{ url('parent/my_student/attendance/'.$value->id)}}" class="btn btn-primary btn-sm">Présence</a>
                        
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