  @extends('layouts.app')

  @section('content')
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Tableau de bord</h1>
          </div>
        </div>
      </div>
    </div>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{ number_format($getTotalFees)}} FCFA</h3>
                <p>Total des Frais de Scolarité payés</p>
              </div>
              <div class="icon">
                <i class="fas fa-money-bill"></i>
              </div> 
              <a href="{{ url('admin/fees_collection/collect')}}" class="small-box-footer">En savoir plus<i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
         
          <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{ number_format($getTotalToday)}} FCFA</h3>
                <p>Total des Frais payés aujourd'hui</p>
              </div>
              <div class="icon">
                <i class="fas fa-money-bill"></i>
              </div>
              <a href="{{ url('admin/fees_collection/collect_report?start_date='.date('Y-m-d').'&end_date='.date('Y-m-d').'')}}" class="small-box-footer">En savoir plus <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{$totalStudent}}</h3>
                <p>Total Etudiants</p>
              </div>
              <div class="icon">
                <i class="fas fa-user"></i>
              </div>
              <a href="{{ url('admin/student/list')}}" class="small-box-footer">En savoir plus<i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{$totalTeacher}}</h3>
                <p>Total Enseignants</p>
              </div>
              <div class="icon">
                <i class="fas fa-user"></i>
              </div>
              <a href="{{ url('admin/teacher/list')}}" class="small-box-footer">En savoir plus <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <div class="small-box bg-primary">
              <div class="inner">
                <h3>{{$totalAdmin}}</h3>
                <p>Total Administrateurs</p>
              </div>
              <div class="icon">
                <i class="fas fa-user"></i>
              </div>
              <a href="{{ url('admin/admin/list')}}" class="small-box-footer">En savoir plus <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <div class="small-box bg-primary">
              <div class="inner">
                <h3>{{$totalExam}}</h3>
                <p>Total Examens</p>
              </div>
              <div class="icon">
                <i class="nav-icon fas fa-table"></i>
              </div>
              <a href="{{ url('admin/examinations/exam/list')}}" class="small-box-footer">En savoir plus <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>{{$totalClass}}</h3>
                <p>Total Classes</p>
              </div>
              <div class="icon">
                <i class="nav-icon fas fa-table"></i>
              </div>
              <a href="{{ url('admin/class/list')}}" class="small-box-footer">En savoir plus <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  @endsection