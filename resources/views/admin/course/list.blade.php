  @extends('layouts.app')
  @section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Liste des cours</h1>
          </div>
          <div class="col-sm-6" style="text-align: right;">
            <a href="{{ url('admin/course/add') }}" class="btn btn-primary">Ajouter un nouveau cours</a>
          </div>
        </div>
      </div>
    </section>
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
              <div class="card-header">
                <h3 class="card-title">Rechercher un cours </h3>
              </div>
                <div class="card card-primary">
                  <form method="get" action="">  
                    <div class="card-body">
                      <div class="row">
                      <div class="form-group col-md-3">
                        <label>Nom</label>
                        <input type="text" class="form-control" placeholder="" name="name"  value="{{ Request::get('name')}}">
                      </div>
                      <div class="form-group col-md-3">
                        <button class="btn btn-primary" type="submit" style="margin-top: 32px;">Rechercher</button>
                         <a class="btn btn-success" style="margin-top: 32px;" href="{{ url('admin/domain/list')}}">Annuler</a>
                      </div>
                    </div>
                    </div>
                  </form>
                </div>

            @include('_message')
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Liste des cours </h3>
              </div>
              <div class="card-body p-0" style="overflow: auto;">
                <table class="table">
                  <thead>
                    <tr >
                      <th style="text-align: center;">id</th>
                      <th style="text-align: center;">Nom Cours</th>
                      <th style="text-align: center;">Code UE</th>
                      <th style="text-align: center;">UE</th>
                      <th style="text-align: center;">Code ECUE</th>
                      <th style="text-align: center;">Domaine</th>
                      <th style="text-align: center;">Mention</th>
                      <th style="text-align: center;">Spécialité</th>
                      <th style="text-align: center;">Parcours</th>
                      <th style="text-align: center;">Semestre</th>
                      <th style="text-align: center;">Vol. Horaire</th>
                      <th style="text-align: center;">Coefficient</th>
                      <th style="text-align: center;">Type</th>
                      <th style="text-align: center;">Status</th>
                      <th style="text-align: center;">Ajouter par</th>
                      <th style="text-align: center;">Ajouté le</th>
                      <th style="text-align: center;">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse($getRecord as $value)
                      <tr>
                        <td>{{ $value->id }}</td>
                        <td style="text-align:start; min-width:150px;">{{ $value->name }}</td>
                        <td style="text-align:start; min-width:80px;">{{ $value->code_ue }}</td>
                        <td style="text-align:center; min-width:150px;">{{ $value->ue }}</td>
                        <td style="text-align:center; min-width:80px;">{{ $value->code_ecue }}</td>
                        <td style="text-align:start; min-width:150px;">{{ $value->domain_name }}</td>
                        <td style="text-align:star; min-width:150px;">{{ $value->mention_name }}</td>
                        <td style="text-align:start; min-width:150px;">{{ $value->subject_name }}</td>
                        <td style="text-align:end; min-width:100px;">{{ $value->parcours }}</td>
                        <td style="text-align:center">{{ $value->semestre }}</td>                        
                        <td style="text-align:end;">{{ $value->vol_horaire }}</td>
                        <td style="text-align:end;">{{ $value->coeff }}</td>
                        <td style="text-align:end; min-width:80px;">{{ $value->type}}</td>
                        <td style="text-align:end;">
                        @if($value->status == 0)
                            Active
                        @else
                            Inactive
                        @endif
                        </td>
                        <td>{{ $value->created_by_name}}</td>
                        <td>{{ date('d-m-Y H:i ', strtotime($value->created_at)) }}</td>
                        <td style="text-align:start;min-width: 250px;"">
                        <a href="{{ url('admin/course/edit/'.$value->id)}}" class="btn btn-primary">Modifier</a>
                        <a href="{{url('admin/course/delete/'.$value->id)}}" class="btn btn-danger">Supprimer</a>
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
    <!-- /.content -->
  </div>

  @endsection