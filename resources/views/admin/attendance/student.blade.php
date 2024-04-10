  @extends('layouts.app')
  @section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Gestion présence</h1>
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
                        <label>Classe</label>
                        <select class="form-control" name="class_id" id="getClass" required>
                          <option value="">selectionner classe</option>
                          @foreach($getClass as $class)
                            <option {{ (Request::get('class_id') == $class->id) ? 'selected' : ''}} value="{{ $class->id}}">{{ $class->name}}</option>
                          @endforeach
                        </select>
                      </div>

                      <div class="form-group col-md-4">
                        <label>Date</label>
                        <input type="date" name="attendance_date" id="getAttendanceDate" value="{{ Request::get('attendance_date')}}" class="form-control" required>
                      </div>

                      <div class="form-group col-md-3">
                        <button class="btn btn-primary" type="submit" style="margin-top: 32px;">Rechercher</button>
                         <a class="btn btn-success" style="margin-top: 32px;" href="{{ url('admin/attendance/student')}}">Annuler</a>
                      </div>
                    </div>
                    </div>
                  </form>
                </div>
            @if(!empty(Request::get('class_id')) && !empty(Request::get('attendance_date')))
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Liste des étudiants </h3>
              </div>

              <div class="card-body p-0" style="overflow: auto;">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nom</th>
                            <th>Présence</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(!empty($getStudent) && !empty($getStudent->count()))
                            @foreach($getStudent as $student)
                            @php
                                $attendance_type = '';
                                $getAttendance = $student->getAttendance($student->user_id, Request::get('class_id'), Request::get('attendance_date'));
                                
                                if(!empty($getAttendance->attendance_type))
                                {
                                    $attendance_type = $getAttendance->attendance_type;
                                }
                            @endphp
                            <tr>
                                <td>{{$student->user_id}}</td>
                                <td>{{$student->name}} {{$student->prenom}}</td>
                                <td>
                                    <label style="margin-right: 10px;">
                                        <input type="radio" name="attendance{{$student->user_id}}" value="1" id="{{$student->user_id}}" class="saveAttendance" {{ ($attendance_type == '1') ? 'checked': ''}}>
                                            Présent
                                    </label>
                                    <label style="margin-right: 10px;">
                                        <input type="radio" name="attendance{{$student->user_id}}" value="2" id="{{$student->user_id}}" class="saveAttendance" {{ ($attendance_type == '2') ? 'checked': ''}}>
                                        En retard
                                    </label>
                                    <label style="margin-right: 10px;">
                                        <input type="radio" name="attendance{{$student->user_id}}" value="3" id="{{$student->user_id}}" class="saveAttendance" {{ ($attendance_type == '3') ? 'checked': ''}}>
                                         Absent
                                    </label>
                                </td>
                            </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
              </div>
            </div>
            @endif
        
        
      </div>        
      </div>
    </section>
    <!-- /.content -->
  </div>

  @endsection

  @section('script')
    <script type="text/javascript">
         $('.saveAttendance').change(function(e){
            var student_id = $(this).attr('id');
            var attendance_type = $(this).val();
            var class_id = $('#getClass').val();
            var attendance_date = $('#getAttendanceDate').val();

            $.ajax(
                {
                    type: "POST",
                    url: "{{ url('admin/attendance/student/save')}}",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        student_id: student_id,
                        attendance_type: attendance_type,
                        class_id: class_id,
                        attendance_date: attendance_date,
                    },
                    dataType: "json",
                    success: function(data){
                        alert(data.message);
                    }
                }
            );

            
         });
    </script>
  @endsection