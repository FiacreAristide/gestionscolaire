  @extends('layouts.app')
  @section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Horaires</h1>
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

            <div class="card-header">
              <h3 class="card-title">Rechercher Horaire </h3>
            </div>

            <div class="card card-primary">
              <form method="get" action="">

                <div class="card-body">

                  <div class="row">

                    <div class="form-group col-md-3">
                      <label>Classe</label>
                      <select class="form-control getClass" name="class_id" required>
                        <option value="">Selectionner classe</option>
                        @foreach($getClass as $class)
                          <option {{ (Request::get('class_id') == $class->id ) ? 'selected' : ''}} value="{{ $class->id }}">{{ $class->name}}</option>
                        @endforeach
                      </select>
                   
                    </div>


                    <div class="form-group col-md-3">
                      <label>Cours</label>
                      <select class="form-control getCourse" name="course_id" required>
                        <option value="">Selectionner cours</option>
                        @if(!empty($getCourse))
                          @foreach($getCourse as $course)
                            <option {{(Request::get('course_id') == $course->course_id) ? 'selected' : ''}} value="{{ $course->course_id }}">{{ $course->course_name }}</option>
                          @endforeach
                        @endif
                      </select>
                    </div>

                    <div class="form-group col-md-3">
                      <button class="btn btn-primary" type="submit" style="margin-top: 32px;">Rechercher</button>

                      <a class="btn btn-success" style="margin-top: 32px;" href="{{ url('admin/class_timetable/list')}}">Annuler</a>
                    </div>

                  </div>
                </div>
              </form>
            </div>

            @if(!empty(Request::get('class_id')) && !empty(Request::get('course_id')))

            <form action="{{ url('admin/class_timetable/add') }}" method="post">
              {{ csrf_field() }}
              <input type="hidden" name="course_id" value="{{ Request::get('course_id') }}">
              <input type="hidden" name="class_id" value="{{ Request::get('class_id') }}">

              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Emplois du temps </h3>
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
                      @php
                        $i = 1;
                      @endphp
                        @foreach($week as $value)
                          <tr>
                            <th>

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
                              {{ $dayMapping[$value['week_name']] }}
                              <input type="hidden" name="timetable[{{ $i }}][week_id]" value="{{ $value['week_id']}}">
                             
                            </th>
                            <td>
                              <input type="time" name="timetable[{{ $i }}][start_time]" class="form-control" value="{{ $value['start_time']}}">
                            </td>
                            <td>
                              <input type="time" name="timetable[{{ $i }}][end_time]" class="form-control" value="{{ $value['end_time']}}">
                            </td>
                            <td>
                              <input type="text" style="width: 200px;" name="timetable[{{ $i }}][room_number]" class="form-control" value="{{ $value['room_number']}}">
                            </td>
                          </tr>
                        @php
                          $i++;
                        @endphp
                        @endforeach
                    </tbody>
                  </table>

                  <div style="text-align: center; padding: 20px;">
                    <button class="btn btn-primary">Enregistrer</button>
                  </div> 
                </div>
              </div>
            </form>
            @endif


            </div>
            </div>
          </div>
        </div>
      </div>
      </section>

</div>
@endsection


@section('script')
<script type="text/javascript">
  $('.getClass').change(function(){
      var class_id = $(this).val();
      $.ajax({
        url: "{{ url('admin/class_timetable/get_course') }}",
        type: "POST",
        data: {
          "_token": "{{ csrf_token() }}",
          class_id: class_id,
        },
        dataType: "json",
        success: function(response) {
          $('.getCourse').html(response.html);
        }
      });
  });
</script>
@endsection



