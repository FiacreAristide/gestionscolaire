  @extends('layouts.app')

  @section('content')


    <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Associer</h1>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            @include('_message')
            <div class="card card-primary">
              <form method="post" action="">
                {{ csrf_field() }}
                <div class="card-body">
                  <input type="hidden" name="school_year_id" value="{{ $getActiveYear->id }}">
                  <div class="form-group">
                    <label>Classe</label>
                    <select class="form-control" name="class_id" required>
                      <option value=""> Selectionner Classe </option>
                      @foreach($getClass as $class)
                          <option value="{{$class->id}}">{{$class->name}}</option>
                      @endforeach
                    </select>
                  </div>

                  <div class="form-group col-md-6">
                      <label>Cours théorique</label>
                      @foreach($getCourse as $course)
                          @if($course->type == 'théorique')
                              <div>
                                  <label style="font-weight:normal;">
                                      <input type="checkbox" name="course_id[]" value="{{ $course->id }}"> {{ $course->name }}
                                  </label>
                              </div>
                          @endif
                      @endforeach
                  </div>

                  <div class="form-group col-md-6">
                      <label>Cours pratique</label>
                      @foreach($getCourse as $course)
                          @if($course->type == 'pratique')
                              <div>
                                  <label style="font-weight:normal;">
                                      <input type="checkbox" name="course_id[]" value="{{ $course->id }}"> {{ $course->name }}
                                  </label>
                              </div>
                          @endif
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