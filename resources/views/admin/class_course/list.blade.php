  @extends('layouts.app')
  @section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Classes & Cours</h1>
          </div>

          <div class="col-sm-6" style="text-align: right;">
            <a href="{{ url('admin/class_course/add') }}" class="btn btn-primary">Ajouter</a>
          </div>

        </div>
      </div>
    </section>




    <!-- Main content -->
    <section class="content">

      <div class="container-fluid">
        <div class="row">

          <div class="col-md-12">
            <div class="card-header">
              <h3 class="card-title">Rechercher Domaine-Spécialisation </h3>
            </div>

            <div class="card card-primary">
              <form method="get" action="">

                <div class="card-body">

                  <div class="row">

                    <div class="form-group col-md-3">
                      <label>Domaine</label>
                      <input type="text" class="form-control" name="class_name"  value="{{ Request::get('class_name')}}" placeholder="Class name">
                    </div>


                    <div class="form-group col-md-3">
                      <label>Spécialisation</label>
                      <input type="text" class="form-control" name="subject_name"  value="{{ Request::get('subject_name')}}" placeholder="Subject name">
                    </div>

                    <div class="form-group col-md-3">
                      <label>Date</label>
                      <input type="date" class="form-control"  name="date"  value="{{ Request::get('date')}}" placeholder="date">
                    </div>

                    <div class="form-group col-md-3">
                      <button class="btn btn-primary" type="submit" style="margin-top: 32px;">Rechercher</button>

                      <a class="btn btn-success" style="margin-top: 32px;" href="{{ url('admin/class_course/list')}}">Annuler</a>
                    </div>

                  </div>
                </div>
              </form>
            </div>

            @include('_message')
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Liste Classes-Cours </h3>
              </div>

              <div class="card-body p-0">
                <table class="table">
                  <thead>
                    <tr>
                      <th>id</th>
                      <th>Classes</th>
                      <th>Cours</th>
                      <th>Status</th>
                      <th>Ajouté par</th>
                      <th>Ajouté le</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($getRecord as $value)
                    <tr>
                      <td>{{ $value->id }}</td>
                      <td>{{ $value->class_name }}</td>
                      <td>{{ $value->course_name }}</td>
                      <td>
                        @if($value->status == 0)
                        Active
                        @else
                        Inactive
                        @endif
                      </td>
                      <td>{{ $value->created_by_name}}</td>
                      <td>{{ date('d-m-Y H:i ', strtotime($value->created_at)) }}</td>

                      <td>
                        <a href="{{ url('admin/class_course/edit_single/'.$value->id)}}" class="btn btn-primary">Modifier cette ligne uniquement </a>

                        <a href="{{ url('admin/class_course/edit/'.$value->id)}}" class="btn btn-primary">Modifier toute la classe</a>

                        <a href="{{url('admin/class_course/delete/'.$value->id)}}" class="btn btn-danger">Supprimer</a>
                      </td>
                    </tr>
                    @endforeach 
                  </tbody>
                </table>

                <div style="padding: 10px; float: right;">
                  {!! $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>
      </section>

</div>
    @endsection