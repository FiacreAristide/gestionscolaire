  @extends('layouts.app')

  @section('content')


    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Cours - Enseignant</h1>
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

            @include('_message')
            <!-- general form elements -->
            <div class="card card-primary">
              <form method="post" action="">
                {{ csrf_field() }}

                <div class="card-body">
                <input type="hidden" name="school_year_id" value="{{ $getActiveYear->id }}">
                  <div class="form-group col-md-12">
                    <label>Enseignant</label>
                    <select class="form-control" name="teacher_id" required>
                      <option value=""> Selectionner enseignant </option>
                      @foreach($getTeacher as $teacher)
                          <option value="{{$teacher->id}}">{{$teacher->name}} {{$teacher->prenom}}</option>
                      @endforeach
                    </select>
                  </div>
                  
                  <div class="form-group col-md-12">
                    <label>Classe<span style="color:red;">*</span></label>  
                    <select class="form-control" required name="class_id">
                      <option value=""> Selectionner Classe </option>
                       @foreach($getClass as $value)
                      <option {{(old('class_id') == $value->id) ? 'selected' : ''}} value="{{ $value->id}}">{{ $value->name}}</option>
                      @endforeach
                    </select> 
                  </div>  

                  <div>
                    <label>Cours</label>
                      @foreach($getCourse as $course)
                      <div>
                        <label>
                          <input type="checkbox" name="course_id[]" value="{{ $course->id}}"> {{$course->name}}</label>
                      </div>
                      @endforeach
                  </div>

                  </div>
                  <div class="form-group col-md-12">
                    <label>Status</label>
                    <select class="form-control" name="status">
                      <option value="0">Active</option>
                      <option value="1">Inactive</option>
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
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
 

  @endsection