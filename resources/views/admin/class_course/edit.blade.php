  @extends('layouts.app')

  @section('content')


  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Modification</h1>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-primary">
              <form method="post" action="">
                {{ csrf_field() }}
                <div class="card-body">
                <input type="hidden" name="school_year_id" value="{{ $getActiveYear->id }}">
                  <div class="form-group">
                    <label>Classe</label>
                    <select class="form-control" name="class_id" >
                      <option value=""> Selectionner Classe </option>
                      @foreach($getClass as $class)
                      <option
                      {{ ($getRecord->class_id == $class->id) ? 'selected':''}}
                      value="{{$class->id}}">{{$class->name}}</option>
                      @endforeach
                  </select>
                </div>

                <div class="form-group col-md-12">
                  <label>Cours</label>                     
                    @foreach($getCourse as $course)
                      @php
                        $checked = "";
                      @endphp

                      @foreach($getAssignCourseID as $courseAssign)
                        @if($courseAssign->course_id == $course->id)
                           @php
                              $checked = "checked";
                            @endphp
                        @endif
                      @endforeach

                    <div>
                      <label style="font-weight:normal;">
                        <input {{ $checked}} type="checkbox" name="course_id[]" value="{{ $course->id}}"> {{ $course->name}}
                      </label>
                    </div>
                    @endforeach

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