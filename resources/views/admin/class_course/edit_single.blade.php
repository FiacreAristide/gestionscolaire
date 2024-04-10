  @extends('layouts.app')

  @section('content')


  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Modifier cours</h1>
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
                  <div class="form-group">
                    <label>Nom de la classe</label>
                    <select class="form-control" name="class_id" required>
                      <option value=""> Selectionner Classe </option>
                      @foreach($getClass as $class)
                      <option {{ ($getRecord->class_id == $class->id) ? 'selected':''}}
                      value="{{$class->id}}">{{$class->name}}</option>
                      @endforeach
                    </select>
                  </div>

                  <div class="form-group">
                      <label>Nom du cours</label>
                      <select class="form-control" name="course_id" required>
                        <option value=""> Selectionner Cours </option>
                        @foreach($getCourse as $course)
                        <option
                        {{ ($getRecord->course_id == $course->id) ? 'selected':''}}
                        value="{{$course->id}}">{{$course->name}}</option>
                        @endforeach
                    </select>
                  </div>

                  <div class="form-group">
                    <label>Status</label>
                    <select class="form-control" name="status">
                      <option {{ ($getRecord->status == 0) ? 'selected':''}} value="0">Active</option>
                      <option {{ ($getRecord->status == 1) ? 'selected':''}} value="1">Inactive</option>
                    </select>
                  </div>
              </div>
              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Enregistrer</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>


@endsection