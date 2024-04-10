  @extends('layouts.app')
  @section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Mes Horaires</h1>
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
                <h3 class="card-title" style="text-align:center; width: 100%;">
                  <span style="color: red; font-weight: bold;">{{ $getClass->name}}</span> - <span style="color: blue; font-weight: bold;">{{ $getCourse->name}} 
                  </span> <span style="color:maroon; font-weight: bold;">({{ $getStudent->name}})</span>
                  </h3>
                </div>

                <div class="card-body p-0">
                  <table class="table table-stripped">
                    <thead>
                      <tr>
                        <th>Jours</th>
                        <th>Début du cours</th>
                        <th>Fin du cours</th>
                        <th>Salle</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($getRecord as $valueW)
                      <tr>
                        <td>
                          @php
                          $dayMapping = [
                          'Monday' => 'Lundi',
                          'Tuesday' => 'Mardi',
                          'Wednesday' => 'Mercredi',
                          'Thursday' => 'Jeudi',
                          'Friday' => 'Vendredi',
                          'Saturday' => 'Samedi',
                          'Sunday' => 'Dimanche',
                          ];
                          @endphp
                          {{ $dayMapping[$valueW['week_name']] }}
                        </td>
                        <td>
                          {{ $valueW['start_time'] }}
                        </td>
                        <td>
                          {{ $valueW['end_time'] }}
                        </td>
                        <td>{{ $valueW['room_number']}}</td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table> 
                </div>
              </div>

              

            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

</div>
@endsection






