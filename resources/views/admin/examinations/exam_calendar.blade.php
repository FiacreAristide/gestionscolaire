  @extends('layouts.app')
  @section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Calendrier des examens </h1>
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
                <h3 class="card-title">Rechercher</h3>
              </div>
                  <form method="get" action="">
                    
                    <div class="card-body">

                      <div class="row">

                      <div class="form-group col-md-4">
                        <label>Nom</label>
                        <select class="form-control" name="exam_id" required>
                          <option value="">selectionner examen</option>
                          @foreach($getExam as $exam)
                            <option {{ (Request::get('exam_id')== $exam->id) ? 'selected' : ''}} value="{{ $exam->id}}">{{ $exam->name}}</option>
                          @endforeach
                        </select>
                      </div>

                      <div class="form-group col-md-4">
                        <label>Classe</label>
                        <select class="form-control" name="class_id" required>
                          <option value="">selectionner classe</option>
                          @foreach($getClass as $class)
                            <option {{ (Request::get('class_id')== $class->id) ? 'selected' : ''}} value="{{ $class->id}}">{{ $class->name}}</option>
                          @endforeach
                        </select>
                      </div>


                      <div class="form-group col-md-3">
                        <button class="btn btn-primary" type="submit" style="margin-top: 32px;">Rechercher</button>

                         <a class="btn btn-success" style="margin-top: 32px;" href="{{ url('admin/examinations/calendar')}}">Annuler</a>
                      </div>

                    </div>
                    </div>
                  </form>
                </div>

            @include('_message')

          @if(!empty($getRecord)) 
            <form action="{{ url('admin/examinations/calendar_insert') }}" method="post">
              {{ csrf_field() }}
              <input type="hidden" name="exam_id" value="{{ Request::get('exam_id') }}">
              <input type="hidden" name="class_id" value="{{ Request::get('class_id') }}">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Calendrier </h3>
              </div>

              <div class="card-body p-0">
                <table class="table">
                  <thead>
                    <tr>
                      <th>Cours</th>
                      <th>Date Examen</th>
                      <th>Début de l'examen</th>
                      <th>Fin de l'examen</th>
                      <th>Salle</th>
                      <th>Noté sur</th>
                      <th>Moyenne</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php
                      $i = 1;
                    @endphp
                      @foreach($getRecord as $value)
                        <tr>
                           <td>{{ $value['course_name']}}
                              <input type="hidden" value="{{ $value['course_id'] }}" class="form-control" name="calendar[{{ $i }}][course_id]">
                           </td>
                           <td>
                             <input type="date" class="form-control" value="{{ $value['exam_date'] }}" name="calendar[{{ $i }}][exam_date]">
                           </td>
                           <td>
                             <input type="time" class="form-control" value="{{ $value['start_time'] }}" name="calendar[{{ $i }}][start_time]">
                           </td>

                           <td>
                             <input type="time" class="form-control" value="{{ $value['end_time'] }}" name="calendar[{{ $i }}][end_time]">
                           </td>

                           <td>
                             <input type="text" class="form-control" value="{{ $value['room_number'] }}" name="calendar[{{ $i }}][room_number]">
                           </td>

                           <td>
                             <input type="text" class="form-control" value="{{ $value['full_mark'] }}" name="calendar[{{ $i }}][full_mark]">
                           </td>

                           <td>
                             <input type="text" class="form-control" value="{{ $value['passing_mark'] }}" name="calendar[{{ $i }}][passing_mark]">
                           </td>
                        </tr>

                    @php
                      $i++;
                    @endphp   
                      @endforeach
                  </tbody>
                </table>
              </div>
            <div style="text-align:center;padding: 20px;">
                  <button class="btn btn-primary" >Enregistrer</button>
                </div>
            </div>
             </form> 
          @endif

          </div>

        
      </div>
    </section>
    <!-- /.content -->
  </div>

  @endsection