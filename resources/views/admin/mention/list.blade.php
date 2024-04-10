  @extends('layouts.app')
  @section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Liste des mentions</h1>
          </div>

          <div class="col-sm-6" style="text-align: right;">
            <a href="{{url('admin/mention/add')}}" class="btn btn-primary">Ajouter une mention</a>
          </div>

        </div>
      </div>
    </section>


    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            @include('_message')
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Liste des mentions </h3>
              </div>

              <div class="card-body p-0">
                <table class="table">
                  <thead>
                    <tr>
                      <th>Nom</th>
                      <th>Domaine</th>
                      <th>Ajouté par</th>
                      <th>Ajouté le</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse($getRecord as $record)
                        <tr>
                            <td style="min-width: 150px;">{{ $record->nom }}</td>
                            <td style="min-width: 150px;">{{ $record->domain_name}}</td>
                            <td style="min-width: 150px;">{{ $record->created_by_name }}</td>
                            <td style="min-width: 150px;">{{ $record->created_at }}</td>
                            <td style="min-width: 250px;">
                               <a href="{{ url('admin/mention/edit/'.$record->id)}}" class="btn btn-primary">Modifier</a>
                               <a href="{{ url('admin/mention/delete/'.$record->id)}}" class="btn btn-danger">supprimer</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="100%" style="text-align: center;">Aucun résultat trouvé</td>
                        </tr>
                    @endforelse
                   
                  </tbody>
                </table>  
              </div>
            </div>
          </div>
      </div>
    </section>
  </div>

  @endsection