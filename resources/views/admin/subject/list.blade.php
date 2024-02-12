  @extends('layouts.app')
  @section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Liste Spécialisations</h1>
          </div>

          <div class="col-sm-6" style="text-align: right;">
            <a href="{{ url('admin/subject/add') }}" class="btn btn-primary">Ajouter une spécialité</a>
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
              <h3 class="card-title">Rechercher une spécialité </h3>
            </div>

            <div class="card card-primary">
              <form method="get" action="">

                <div class="card-body">

                  <div class="row">

                    <div class="form-group col-md-3">
                      <label>Nom</label>
                      <input type="text" class="form-control" placeholder="Enter name" name="name"  value="{{ Request::get('name')}}" placeholder="name">
                    </div>


                    <div class="form-group col-md-3">
                      <label>Parcours</label>
                      <select class="form-control" name="parcours">
                        <option value="">---Select type---</option>
                        <option {{ (Request::get('parcours') == 'Licence') ? 'selected' : ''}}

                        value="theory">Licence</option>
                        <option value="practical"

                       {{ (Request::get('parcours') == 'Master') ? 'selected' : ''}}

                        >Master</option>
                      </select>
                    </div>
                    <div class="form-group col-md-3">
                      <label>Date d'ajout</label>
                      <input type="date" class="form-control" placeholder="Enter email" name="date"  value="{{ Request::get('date')}}" placeholder="date">
                    </div>

                    <div class="form-group col-md-3">
                      <button class="btn btn-primary" type="submit" style="margin-top: 32px;">Rechercher</button>

                      <a class="btn btn-success" style="margin-top: 32px;" href="{{ url('admin/subject/list')}}">Annuler</a>
                    </div>

                  </div>
                </div>
              </form>
            </div>

            @include('_message')
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Liste des spécialités </h3>
              </div>

              <div class="card-body p-0">
                <table class="table">
                  <thead>
                    <tr>
                      <th>id</th>
                      <th>Spécialisation</th>
                      <th>Domaine</th>  
                      <th>Parcours</th>
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
                      <td>{{ $value->name }}</td>
                      <td>{{ $value->domain_name }}</td>                      
                      <td>{{ $value->parcours }}</td>
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
                        <a href="{{ url('admin/subject/edit/'.$value->id)}}" class="btn btn-primary">Modifier</a>
                        <a href="{{url('admin/subject/delete/'.$value->id)}}" class="btn btn-danger">Supprimer</a>
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