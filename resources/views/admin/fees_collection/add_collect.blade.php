  @extends('layouts.app')
  @section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Frais de scolarité ({{ $getStudent->name}} {{ $getStudent->prenom}})</h1>
          </div>

          <div class="col-sm-6" style="text-align: right;">
            <button type="button" class="btn btn-primary" id="addFees">Ajouter</button>
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
                <h3 class="card-title">Details</h3>
              </div>

              <div class="card-body p-0">
                <table class="table">
                  <thead>
                    <tr>
                      <th>Classe</th>
                      <th>Montant total à payer</th>
                      <th>Montant réglé</th>
                      <th>Montant restant</th>
                      <th>Type de paiement</th>
                      <th>Remarque</th>
                      <th>Ajouté par</th>
                      <th>Ajouté le</th>
                    </tr>
                  </thead>
                  <tbody> 
                    @forelse($getFees as $value)
                        <tr>
                            <td>{{ $value->class_name}}</td>
                            <td>{{ number_format($value->total_amount)}} FCFA </td>
                            <td>{{ number_format($value->paid_amount)}} FCFA </td>
                            <td>{{ number_format($value->remaining_amount)}} FCFA </td>
                            <td>{{$value->payment_type}} </td>
                            <td>{{ $value->remark ? $value->remark : 'Aucune remarque' }}</td>
                            <td>{{$value->creator}} </td>
                            <td>{{ date('d-m-Y', strtotime($value->created_at))}} </td>
                        </tr>
                    @empty
                        <tr style="text-align: center;">
                            <td colspan="100%">Aucun résultat trouvé</td>
                        </tr>
                    @endforelse                      
                  </tbody>
                </table>                
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <div class="modal fade" id="addFeesModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Frais de scolarité</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="" method="post">
        {{ csrf_field() }}
      <div class="modal-body">
        <div class="form-group">
            <label class="col-form-label">Classe: {{ $getStudent->class_name }}</label>
          </div>

         <div class="form-group">
            <label class="col-form-label">Montant Total: {{ number_format($getStudent->amount)}} FCFA</label>
          </div>

          <div class="form-group">
            <label class="col-form-label">Montant Réglé: {{ number_format($paid_amount)}} FCFA</label>
          </div>

          <div class="form-group">
            @php
                $remainingAmount = $getStudent->amount - $paid_amount
            @endphp
            <label class="col-form-label">Montant restant: {{ number_format($remainingAmount)}} FCFA</label>
          </div>

          <div class="form-group">
            <label class="col-form-label">Nouveau montant: </label>
            <input type="number" class="form-control" name="amount">
          </div>

          <div class="form-group">
            <label class="col-form-label">Type de paiement: </label>
            <select name="payment_type" class="form-control" required>
                <option value="">Selectionner</option>
                <option value="Espèce">Espèce</option>
                <option value="Banque">Virement banquaire</option>
                <option value="Chèque">Chèque</option>
            </select>
        </div>
        

          <div class="form-group">
            <label class="col-form-label">Remarque:</label>
            <textarea class="form-control" name="remark"></textarea>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
        <button type="submit" class="btn btn-primary">Enregistrer</button>
      </div>
      </form>
    </div>
  </div>
</div>

  @endsection

  @section('script')
    <script type="text/javascript">
        $('#addFees').click(function(){
            $('#addFeesModal').modal('show');
        });    
    </script>
  @endsection