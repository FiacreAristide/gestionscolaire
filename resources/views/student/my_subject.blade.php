  @extends('layouts.app')
  @section('content')

  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Liste de mes matières</h1>
          </div>
        </div>
      </div>
    </section>
    <section class="content">
      <div class="container-fluid" >
        <div class="row">
          <div class="col-md-12">
            @include('_message')
            <div class="card">
              <div class="card-header">
                <h2 class="card-title" style="font-size:30px;">Matières en cours </h2>
              </div>
              <div class="card-body p-0">
                <table class="table">
                  <thead>
                    <tr>                      
                      <th>Cours</th>
                      <th>Type</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($getRecord as $value)
                    <tr>      
                      <td>{{ $value->course_name }}</td>
                      <td>{{ $value->course_type }}</td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table> 
                </div>
              </div>
            </div>
          </div>
          <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h2 class="card-title" style="font-size:30px;">Matières non-validées </h2>
              </div>
              <div class="card-body p-0">
              <table class="table">
                  <thead>
                    <tr>                      
                      <th>Cours</th>
                      <th>Type</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($getInvalidCourse as $value)
                    <tr>      
                      <td>{{ $value->course_name }}</td>
                      <td>{{ $value->course_type }}</td>
                    </tr>
                    @endforeach
                  </tbody>
                </table> 
              </div>
            </div>
          </div>
        </div>
        </div>
        <div class="col-sm-6">
          <a href="{{ url('student/add_new_course')}}" class="btn btn-primary btn-sm">Ajouter un cours non validé</a> 
        </div>
      </section>
    </div>

    @endsection