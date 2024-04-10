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
            <a href="{{ url('admin/class_course/add') }}" class="btn btn-primary">Associer</a>
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
              <h3 class="card-title">Rechercher Classe-cours </h3>
            </div>

            <div class="card card-primary">
              <form method="get" action="">

                <div class="card-body">

                  <div class="row">

                    <div class="form-group col-md-4">
                      <label>Classe</label>
                      <input type="text" class="form-control" name="class_name"  value="{{ Request::get('class_name')}}" placeholder="Nom de la class">
                    </div>


                    <div class="form-group col-md-4">
                      <label>Cours</label>
                      <input type="text" class="form-control" name="course_name"  value="{{ Request::get('course_name')}}" placeholder="Nom du cours">
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

              <div class="card-body p-0" style="overflow: auto;">
                <table class="table">
                  <thead>
                    <tr>
                      <th>id</th>
                      <th style="width: 300px;text-align: center;">Classes</th>
                      <th style="width: 300px;text-align: center;">Cours</th>
                      <th style="width: 300px;text-align: center;">Status</th>
                      <th style="width: 300px;text-align: center;">Ajouté par</th>
                      <th style="width: 300px;text-align: center;">Ajouté le</th>
                      <th style="text-align: center; width:1000px;">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse($getRecord as $value)
                    <tr>
                      <td>{{ $value->id }}</td>
                      <td style="text-align: center;">{{ $value->class_name }}</td>
                      <td style="text-align: center;">{{ $value->course_name }}</td>
                      <td style="text-align: center;">
                        @if($value->status == 0)
                        Active
                        @else
                        Inactive
                        @endif
                      </td>
                      <td>{{ $value->created_by_name}}</td>
                      <td style="text-align: center;">{{ date('d-m-Y H:i ', strtotime($value->created_at)) }}</td>

                      <td style="margin-left: 60px;display:grid; grid-template-columns:200px;grid-row-gap:10px;">
                        <a href="{{ url('admin/class_course/edit_single/'.$value->id)}}" class="btn btn-primary">Modifier uniquement </a>

                        <a href="{{ url('admin/class_course/edit/'.$value->id)}}" class="btn btn-primary">Modifier toute la classe</a>

                        <a href="{{url('admin/class_course/delete/'.$value->id)}}" class="btn btn-danger">Supprimer</a>
                      </td>
                    </tr>
                    @empty
                      <tr>
                        <td colspan="100%" style="text-align: center;">Aucun résultat trouvé</td>
                      </tr>
                    @endforelse 
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