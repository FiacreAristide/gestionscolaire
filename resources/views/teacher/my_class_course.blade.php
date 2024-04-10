  @extends('layouts.app')
  @section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Classes & Cours</h1>
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
                <h3 class="card-title">Liste Classes-Cours </h3>
              </div>

              <div class="card-body p-0">
                <table class="table">
                  <thead>
                    <tr>                     
                      <th>Classes</th>
                      <th>Cours</th>
                      <th>Aujourd'hui</th>
                      <!-- <th>Ajouté le</th> -->
                      <th>Action</th>          
                    </tr>
                  </thead>
                  <tbody>                      
                    @foreach($getRecord as $value)
                     <tr>                    
                      <td>{{ $value->class_name }}</td>
                      <td>{{ $value->course_name }}</td>
                      <td>
                        @php
                          $classCourse = $value->getMyTimeTable($value->class_id, $value->course_id);
                        @endphp

                        @if(!empty($classCourse))
                          @php
                            $dayMapping = [
                              'Monday' => 'lundi',
                              'Tuesday' => 'mardi',
                              'Wednesday' => 'mercredi',
                              'Thursday' => 'jeudi',
                              'Friday' => 'vendredi',
                              'Saturday' => 'samedi',
                              'Sunday' => 'dimanche',
                                  ];
                              @endphp
                              De 
                                <span style="color:blue; font-weight: bold;"> {{ $classCourse->start_time }} </span> à 
                                <span style="color:blue; font-weight: bold;"> {{ $classCourse->end_time }}</span>                               
                                <br>
                                <span style="color:red; font-weight: bold;">Salle: {{ $classCourse->room_number}}</span>                       
                          @endif
                      </td>

                      <!-- <td>{{ date('d-m-Y H:i ', strtotime($value->created_at)) }}</td> -->
                      <td>
                        <a class="btn btn-primary" href="{{ url('teacher/my_class_course/class_timetable/'.$value->class_id.'/'.$value->course_id)}}">Horaire</a>
                      </td>
                    </tr>
                    @endforeach 

                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      </section>

</div>
    @endsection