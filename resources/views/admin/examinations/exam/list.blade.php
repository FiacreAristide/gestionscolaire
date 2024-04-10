  @extends('layouts.app')
  @section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Examens (Total: {{$getRecord->total()}})</h1>
          </div>

          <div class="col-sm-6" style="text-align: right;">
            <a href="{{url('admin/examinations/exam/add')}}" class="btn btn-primary">Ajouter un nouvel examen</a>
          </div>

        </div>
      </div>
    </section>




    <!-- Main content -->
    <section class="content">

      <div class="container-fluid">
        <div class="row">

          <div class="col-md-12">

            <div class="card">
              
              <div class="card-header">
                <h3 class="card-title">Rechercher examen</h3>
              </div>
                  <form method="get" action="">
                    
                    <div class="card-body">

                      <div class="row">

                      <div class="form-group col-md-2">
                        <label>Nom</label>
                        <input type="text" class="form-control" placeholder="" name="name"  value="{{ Request::get('name')}}">
                      </div>


                      <div class="form-group col-md-3">
                        <button class="btn btn-primary" type="submit" style="margin-top: 32px;">Rechercher</button>

                         <a class="btn btn-success" style="margin-top: 32px;" href="{{ url('admin/examinations/exam/list')}}">Annuler</a>
                      </div>

                    </div>
                    </div>
                  </form>
                </div>

            @include('_message')

            
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Examens </h3>
              </div>

              <div class="card-body p-0">
                <table class="table">
                  <thead>
                    <tr>
                      <th>id</th>
                      <th>Nom</th>
                      <th>Note</th>
                      <th>Ajouté par</th>
                      <th>Ajouté le</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse($getRecord as $value)
                    <tr>
                      <td>{{ $value->id}}</td>
                      <td>{{ $value->name}}</td>
                      <td>{{ ($value->note) ? $value->note : 'Aucune note'}}</td>
                      <td>{{ $value->creator_name}}</td>
                      <td>{{ date('d-m-y h:i', strtotime($value->created_at))}}</td>
                      <td>
                        <a href="{{ url('admin/examinations/exam/edit/'.$value->id)}}" class="btn btn-primary">Modifier</a>
                        <a href="{{url('admin/examinations/exam/delete/'.$value->id)}}" class="btn btn-danger">Supprimer</a>
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
    </section>
    <!-- /.content -->
  </div>

  @endsection