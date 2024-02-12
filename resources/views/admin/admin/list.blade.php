  @extends('layouts.app')
  @section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Liste des administrateurs (Total: {{$getRecord->total()}})</h1>
          </div>

          <div class="col-sm-6" style="text-align: right;">
            <a href="{{url('admin/admin/add')}}" class="btn btn-primary">Ajouter un nouvel administrateur</a>
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
                <h3 class="card-title">Rechercher Administrateur </h3>
              </div>
                  <form method="get" action="">
                    
                    <div class="card-body">

                      <div class="row">

                      <div class="form-group col-md-2">
                        <label>Nom</label>
                        <input type="text" class="form-control" placeholder="Enter name" name="name"  value="{{ Request::get('name')}}" placeholder="name">
                      </div>


                      <div class="form-group col-md-2">
                        <label>Email</label>
                        <input type="text" class="form-control" placeholder="Enter email" name="email"  value="{{ Request::get('email')}}" placeholder="email">
                      </div>

                      <div class="form-group col-md-2">
                        <label>Date</label>
                        <input type="date" class="form-control" placeholder="Enter email" name="date"  value="{{ Request::get('date')}}" placeholder="date">
                      </div>

                      <div class="form-group col-md-3">
                        <button class="btn btn-primary" type="submit" style="margin-top: 32px;">Rechercher</button>

                         <a class="btn btn-success" style="margin-top: 32px;" href="{{ url('admin/admin/list')}}">Annuler</a>
                      </div>

                    </div>
                    </div>
                  </form>
                </div>

            @include('_message')

            
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Liste administrateur </h3>
              </div>

              <div class="card-body p-0">
                <table class="table">
                  <thead>
                    <tr>
                      <th>id</th>
                      <th>Nom</th>
                      <th>Email</th>
                      <th>Ajouté le</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($getRecord as $value)

                    <tr>
                      <td>{{ $value->id}}</td>
                      <td>{{ $value->name}}</td>
                      <td>{{ $value->email}}</td>
                      <td>{{ date('d-m-y h:i', strtotime($value->created_at))}}</td>

                      <td>
                        <a href="{{ url('admin/admin/edit/'.$value->id)}}" class="btn btn-primary">Modifier</a>
                        <a href="{{url('admin/admin/delete/'.$value->id)}}" class="btn btn-danger">Supprimer</a>
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
    </section>
    <!-- /.content -->
  </div>

  @endsection