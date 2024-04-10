  @extends('layouts.app')

  @section('content')
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div>
        </div>
      </div>
    </div>

    <section class="content">
      <div class="container-fluid">
        <div class="row">


          <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
              <div class="inner">
                <h3>10</h3>
                <p>Total Etudiants</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="{{ url('teacher/my_student')}}" class="small-box-footer">En savoir plus<i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>2</h3>
                <p>Total Classes</p>
              </div>
              <div class="icon">
                <i class="nav-icon fas fa-table"></i>
              </div>
              <a href="{{ url('teacher/my_class_course')}}" class="small-box-footer">En savoir plus <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  @endsection