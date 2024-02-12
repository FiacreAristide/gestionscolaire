  @extends('layouts.app')
  @section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><span style="color:blue;">{{ $getUser->name}} {{ $getUser->prenom}}</span></h1>
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
            <div class="card">
              <div class="card-header">
                <h3 class="card-title" style="font-size:20px; font-weight: bold;">Matières en cours pour cette année</h3>
              </div>

              <div class="card-body p-0">
                <table class="table">
                  <thead>
                    <tr>
                      
                      <th>Cours</th>
                      <th>Type</th>
                      <th>Action</th>

                    </tr>
                  </thead>
                  <tbody>

                    @foreach($getRecord as $value)
                    <tr>      
                      <td>{{ $value->course_name }}</td>
                      <td>{{ $value->course_type }}</td>
                      <td>
                        <a class="btn btn-primary" href="{{url('parent/my_student/course/class_timetable/'.$value->class_id.'/'.$value->course_id.'/'.$getUser->id) }} " >Horaire</a>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>


            </div>


          <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h2 class="card-title" style="font-size:20px; font-weight: bold;">Matières non-validées </h2>
              </div>
              <div class="card-body p-0">
              <table class="table">
                  <thead>
                    <tr>                      
                      <th>Cours</th>
                      <th>Type</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($getInvalidCourse as $value)
                    <tr>      
                      <td>{{ $value->course_name }}</td>
                      <td>{{ $value->course_type }}</td>
                      <td>
                        <a class="btn btn-primary" href="{{ url('parent/my_student/course/class_timetable/'.$value->class_id.'/'.$value->course_id)}}">Horaire</a>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table> 
              </div>
            </div>
          </div>
        </div>
          </div>


        </div>
      </section>
      <!-- /.content -->
    </div>

    @endsection