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
                <h3 class="card-title">Liste de mes étudiants  </h3>
              </div>

              <div class="card-body p-0" style="overflow: auto;">
                <table class="table">
                  <thead>
                    <tr>
                     
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
                      <th>Religion</th>
                      <th>Etat Physique</th>
                      <th>Handicap</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($getRecord as $value)
                    <tr>
                      <td>{{ $value->name}} {{ $value->prenom}}</td>
                      <td>{{ $value->class_name}}</td>
                      <td style="min-width: 250px;">{{ $value->domain_name}}</td>
                      <td>{{ $value->parcours}}</td>
                      <td>{{ $value->subject_name}}</td>
                      <td>{{ $value->email}}</td>
                        <td style="min-width: 200px;">
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
                      <td style="min-width: 200px;">{{ $value->adresse}}</td>
                      <td>{{ $value->ville}}</td>
                      <td>{{ $value->pays_residence}}</td>
                      <td style="min-width: 200px;">{{ $value->telephone}}</td>
                      <td>{{ $value->religion}}</td>
                      <td>{{ $value->etatPhys}}</td>
                      <td>{{ $value->handicap}}</td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
                
              </div>
            </div>
          </div>
      </div>
    </section>
    <!-- /.content -->
  </div>

  @endsection