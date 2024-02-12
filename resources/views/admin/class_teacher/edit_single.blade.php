  @extends('layouts.app')

  @section('content')


  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Modification</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <form method="post" action="">
                {{ csrf_field() }}

                <div class="card-body">

                  <div class="form-group col-md-12">
                    <label>Nom de la classe</label>
                    <select class="form-control" name="class_id" required>
                      <option value="0">---Selectionner la classe---</option>
                      
                      @foreach($getClass as $class)
                      <option
                      {{ ($getRecord->class_id == $class->id) ? 'selected':''}}
                      value="{{$class->id}}">{{$class->name}}</option>
                
                      @endforeach
                  </select>
                </div>

                <div class="form-group col-md-12">
                    <label>Nom de l'enseignant</label>
                    <select class="form-control" name="class_id" required>
                      <option value="0">---Selectionner l'enseignant'---</option>
                      
                      @foreach($getTeacher as $teacher)
                      <option
                      {{ ($getRecord->teacher_id == $teacher->id) ? 'selected':''}}
                      value="{{$teacher->id}}">{{ $teacher->name}} {{$teacher->prenom}}</option>
                
                      @endforeach
                  </select>
                </div>

                <div class="form-group col-md-12">
                  <label>Status</label>
                  <select class="form-control" name="status">
                    <option {{ ($getRecord->status == 0) ? 'selected':''}} value="0">Active</option>
                    <option {{ ($getRecord->status == 1) ? 'selected':''}} value="1">Inactive</option>
                  </select>
                </div>


              </div>

              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Modifier</button>
              </div>
            </form>
          </div>

        </div>
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>


@endsection