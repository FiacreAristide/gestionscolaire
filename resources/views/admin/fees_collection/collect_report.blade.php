  @extends('layouts.app')
  @section('content')

  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Liste des frais de scolarité</h1>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">

         <div class="card">              
              <div class="card-header">
                <h3 class="card-title">Rechercher</h3>
              </div>
                  <form method="get" action="">                    
                    <div class="card-body">
                      <div class="row">

                      <div class="form-group col-md-3">
                          <label>ID</label>
                          <input type="text" name="student_id" id="" class="form-control" value="{{ Request::get('student_id')}}"  placeholder="Entre ID">
                      </div>

                      <div class="form-group col-md-3">
                          <label>Nom Etudiant</label>
                          <input type="text" name="student_name" id="" class="form-control" value="{{ Request::get('student_name')}}" placeholder="Entre Nom">
                      </div>

                      <div class="form-group col-md-3">
                        <label>Classe</label>
                        <select class="form-control" name="class_id" id="getClass" >
                          <option value="">selectionner classe</option>
                          @foreach($getClass as $class)
                            <option {{ (Request::get('class_id') == $class->id) ? 'selected' : ''}} value="{{ $class->id}}">{{ $class->name}}</option>
                          @endforeach
                        </select>
                      </div>

                      <div class="form-group col-md-3">
                        <label>Début collecte</label>
                        <input type="date" name="start_date" value="{{ Request::get('start_date')}}" class="form-control" >
                      </div>

                      <div class="form-group col-md-3">
                        <label>Fin collecte</label>
                        <input type="date" name="end_date" value="{{ Request::get('end_date')}}" class="form-control" >
                      </div>

                      <div class="form-group col-md-2">
                         <label>Type de paiement</label>
                         <select name="payment_type" class = "form-control">
                         <option {{ (Request::get('payment_type') == 'Espèce') ? 'selected' : ''}} value="Espèce">Espèce</option>
                         <option {{ (Request::get('payment_type') == 'Banque') ? 'selected' : ''}} value="Banque">Virement Banquaire</option>
                         <option {{ (Request::get('payment_type') == 'Chèque') ? 'selected' : ''}} value="Chèque">Chèque</option>
                         </select>
                      </div>

                      <div class="form-group col-md-3">
                        <button class="btn btn-primary" type="submit" style="margin-top: 32px;">Rechercher</button>
                         <a class="btn btn-success" style="margin-top: 32px;" href="{{ url('admin/fees_collection/collect_report')}}">Annuler</a>
                      </div>
                    </div>
                    </div>
                  </form>
                </div>
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Liste étudiant</h3>
              </div>
              <div class="card-body p-0" style="overflow: auto;">
                <table class="table">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Nom étudiant</th>
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
                     @forelse($getRecord as $record)
                        <tr>
                            <td>{{$record->student_id}}</td>
                            <td style="min-width: 180px;">{{$record->student_name}} {{$record->prenom}}</td>
                            <td style="min-width: 80px;">{{ $record->class_name}}</td>
                            <td style="min-width: 180px;">{{ number_format($record->total_amount)}} FCFA</td>
                            <td style="min-width: 180px;">{{ number_format($record->paid_amount) }} FCFA</td>
                            <td style="min-width: 180px;">
                              @if($record->remaining_amount == 0)
                                <span style="color:green; font-weight:bold;">Frais soldé</span>
                              @else
                                {{ number_format($record->remaining_amount)}} FCFA
                              @endif

                            </td>
                            <td style="min-width: 180px;">{{ $record->payment_type}}</td>
                            <td style="min-width: 180px;">{{ $record->remark ? $record->remark : 'Aucune remarque' }}</td>
                            <td style="min-width: 180px;">{{ $record->admin_name}}</td>
                            <td style="min-width: 180px;">{{ date('d-m-Y', strtotime($record->created_at))}}</td>
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
  </div>
  @endsection