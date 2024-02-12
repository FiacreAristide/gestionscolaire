  @extends('layouts.app')

  @section('content')


    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Ajouter un nouveau cours</h1>
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

                <div class="form-group col-md-6">
                   <input type="hidden" name="etudiant_id" value="{{ Auth::id() }}">
                </div>

                  <div class="form-group col-md-6">
                     
                      @foreach($getOthersCourses as $course)
                        <div>
                          <label style="font-weight:normal;">
                          <input type="checkbox" name="course[]" value="{{ $course->id }}"> {{ $course->name }}
                          </label>
                        </div>
                      @endforeach
                  </div>

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Ajouter</button>
                </div>
              </form>
            </div>

          </div>
        </div>
     
      </div>
    </section>

  </div>
 

  @endsection