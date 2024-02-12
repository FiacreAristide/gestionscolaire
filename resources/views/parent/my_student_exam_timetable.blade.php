  @extends('layouts.app')
  @section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Calendrier d'examen de ( {{ $getStudent->name}} {{ $getStudent->prenom}})</h1>
          </div>

        </div>
      </div>
    </section>




    <!-- Main content -->
    <section class="content">

      <div class="container-fluid">
        <div class="row">

          <div class="col-md-12">
           
            

            @foreach($getRecord as $value)
            <div class="card">
              <div class="card-header">
                <h3 class="card-title" style="text-align:center; width: 100%; color: blue; font-weight: bold;">{{$value['name']}} </h3>
              </div>

              <div class="card-body p-0">
                <table class="table table-stripped">
                  <thead>
                     <tr>
                      <th>Cours</th>
                      <th>Jour</th>
                      <th>Date Examen</th>
                      <th>Début de l'examen</th>
                      <th>Fin de l'examen</th>
                      <th>Salle</th>
                      <th>Noté sur</th>
                      <th>Moyenne</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($value['exam'] as $valueS)
                        <tr>
                            <td>{{$valueS['course_name'] }} </td>
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
                                {{ $dayMapping[date('l', strtotime($valueS['exam_date']))] }}
                        </td>
                            <td>{{ date('d-m-Y', strtotime($valueS['exam_date']))}}</td>
                            <td>{{ date('h:i', strtotime($valueS['start_time']))}} </td>
                            <td>{{date('h:i', strtotime($valueS['end_time']))}}</td>
                            <td>{{$valueS['room_number'] }} </td>
                            <td>{{$valueS['full_mark']}} </td>
                            <td>{{$valueS['passing_mark'] }} </td>
                        </tr>
                   
                    @endforeach
                  </tbody>
                </table> 
              </div>
            </div>
            @endforeach
            

          </div>
        </div>
      </div>
    </div>
  </section>
</div>

</div>
@endsection






