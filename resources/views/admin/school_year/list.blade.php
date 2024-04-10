  @extends('layouts.app')
  @section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Liste des années scolaires</h1>
          </div>

          <div class="col-sm-6" style="text-align: right;">
            <a href="{{url('admin/school_year/add')}}" class="btn btn-primary">Ajouter une année</a>
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
                <h3 class="card-title">Liste année scolaire </h3>
              </div>

              <div class="card-body p-0">
                <table class="table">
                  <thead>
                    <tr>
                      <th>Année Scolaire</th>
                      <th>Ajouté par</th>
                      <th>Ajouté le</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse($getRecord as $record)
                        <tr>
                            <td>{{ $record->title }}</td>
                            <td>{{ $record->created_by_name }}</td>
                            <td>{{ $record->created_at }}</td>
                            <td>
                              @if($record->status == 0)
                                  <a href="{{ url('admin/school_year/activate/'.$record->id)}}" class="btn btn-success activate-btn">Activer</a>
                                  <a href="{{ url('admin/school_year/update-activate/'.$record->id)}}" class="btn btn-primary">En cours</a>
                              @else
                                  <a href="{{ url('admin/school_year/activate/'.$record->id)}}" class="btn btn-secondary">Activer</a>
                              @endif                              
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

  @section('script')
    <script type="text/javascript">
    document.getElementById('inProgressBtn').addEventListener('click', function() {
        // Envoyer une requête AJAX au serveur pour notifier que le bouton "en cours" a été cliqué
        fetch('{{ url('admin/school_year/set-in-progress') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ clicked: true })
        })
        .then(response => {
            if (response.ok) {
                // Recharger la page pour afficher les données mises à jour
                window.location.reload();
            }
        })
        .catch(error => {
            console.error('Erreur lors de la requête AJAX :', error);
        });
    });
</script>
  @endsection

 








