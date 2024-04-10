  @extends('layouts.app')
  @section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Liste de présence ({{ $getStudent->name}} {{ $getStudent->prenom}})</h1>
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
                      <div class="form-group col-md-3">
                        <label>Classe</label>
                        <select class="form-control" name="class_id" id="getClass" >
                          <option value="">selectionner classe</option>
                          @foreach($getClass as $class)
                            <option {{ (Request::get('class_id') == $class->class_id) ? 'selected' : ''}} value="{{ $class->class_id}}">{{ $class->class_name}}</option>
                          @endforeach
                        </select>
                      </div>

                      <div class="form-group col-md-3">
                        <label>Date</label>
                        <input type="date" name="attendance_date" id="getAttendanceDate" value="{{ Request::get('attendance_date')}}" class="form-control" >
                      </div>


                      <div class="form-group col-md-3">
                        <label>Type</label>
                        <select name="attendance_type" class="form-control">
                            <option value="">Selectionner</option>
                            <option {{ (Request::get('attendance_type') == 1) ? 'selected' : ''}} value="1">Présent</option>
                            <option {{ (Request::get('attendance_type') == 2) ? 'selected' : ''}} value="2">En retard</option>
                            <option {{ (Request::get('attendance_type') == 3) ? 'selected' : ''}} value="3">Absent</option>
                        </select>
                      </div>

                      <div class="form-group col-md-3">
                        <button class="btn btn-primary" type="submit" style="margin-top: 32px;">Rechercher</button>
                         <a class="btn btn-success" style="margin-top: 32px;" href="{{ url('parent/my_student/attendance'.$getStudent->id)}}">Annuler</a>
                      </div>
                    </div>
                    </div>
                  </form>
                </div>
         
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Liste des étudiants </h3>
              </div>

              <div class="card-body p-0" style="overflow: auto;">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Classe</th>
                            <th>Présence</th>
                            <th>Date</th>
                            <th>Ajouté le</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($getRecord as $record)
                            <tr>
                                <td>{{ $record->class_name}}</td>
                                <td>
                                    @if($record->attendance_type == 1)
                                        Présent
                                    @elseif($record->attendance_type == 2)
                                        En retard
                                    @else
                                        Absent
                                    @endif

                                </td>
                                <td>{{ $record->attendance_date}}</td>
                                <td>{{ $record->created_at}}</td>
                            </tr>
                        @empty
                            <tr style="text-align: center;">
                                <td colspan="100%">Aucun resultat trouvé </td>
                            </tr>
                        @endforelse
                   

                      
                    </tbody>
                </table>
                 @if(!empty($getRecord))
                    <div style="padding: 10px; float:right;">
                    {!! $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links()!!}
                    </div>
                @endif
              </div>
            </div>
           
        
        
      </div>        
      </div>
    </section>
    <!-- /.content -->
  </div>

  @endsection

