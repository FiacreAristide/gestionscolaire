  @extends('layouts.app')
  @section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1>Frais de scolarité</h1>
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
                <h3 class="card-title">Rechercher</h3>
              </div>
                <div class="card card-primary">
                  <form method="get" action="">                   
                    <div class="card-body">
                      <div class="row">
                      <div class="form-group col-md-2">
                        <label>Classe</label>
                        <select name="class_id" class="form-control">
                        <option value="">Selectionner</option>
                        @foreach($getClass as $class)
                            <option {{ (Request::get('class_id') == $class->id) ? 'selected' : ''}} value="{{ $class->id}}">{{ $class->name}}</option>
                        @endforeach
                        </select>
                      </div>

                      <div class="form-group col-md-2">
                        <label>ID Etudiant</label>
                        <input type="text" class="form-control" placeholder="" name="student_id"  value="{{ Request::get('student_id')}}" placeholder="">
                      </div>

                      <div class="form-group col-md-3">
                        <label>Nom Etudiant</label>
                        <input type="text" class="form-control" placeholder="" name="name"  value="{{ Request::get('name')}}" placeholder="">
                      </div>

                      <div class="form-group col-md-3">
                        <label>Prénom Etudiant</label>
                        <input type="text" class="form-control" placeholder="" name="prenom"  value="{{ Request::get('prenom')}}" placeholder="">
                      </div>                


                      <div class="form-group col-md-3">
                        <button class="btn btn-primary" type="submit" style="margin-top: 32px;">Rechercher</button>
                         <a class="btn btn-success" style="margin-top: 32px;" href="{{ url('admin/fees_collection/collect')}}">Annuler</a>
                      </div>
                    </div>
                    </div>
                  </form>
                </div>

             @include('_message')
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Liste des étudiants </h3>
              </div>

              <div class="card-body p-0">
                <table class="table">
                  <thead>
                    <tr>
                      <th>ID étudiant</th>
                      <th>Classe</th>
                      <th>Nom étudiant</th>
                      <th>Montant total à payer</th>
                      <th>Montant réglé</th>
                      <th>Montant restant</th>
                      <th>Ajouté le</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if(!empty($getRecord))
                        @forelse($getRecord as $record)
                          @php
                            $paid_amount = $record->getPaidAmount($record->user_id, $record->class_id);

                            $remainingAmount = $record->amount - $paid_amount;
                          @endphp
                            <tr>
                                <td>{{ $record->user_id}}</td>
                                <td>{{ $record->class_name}}</td>
                                <td>{{ $record->name}} {{ $record->prenom}}</td>
                                <td>{{ number_format($record->amount)}} FCFA</td>
                                <td>{{ number_format($paid_amount) }} FCFA</td>
                                <td>{{ number_format($remainingAmount)}} FCFA</td>
                                <td>{{ date('d-m-Y', strtotime($record->created_at))}}</td>
                                <td>
                                    <a href="{{ url('admin/fees_collection/collect/add/'.$record->user_id)}}" class="btn btn-success">Collecter</a>
                                </td>
                            </tr>
                        @empty
                            <tr style="text-align: center;">
                                <td colspan="100%">Aucun résultat trouvé</td>
                            </tr>
                        @endforelse
                    @else
                        <tr style="text-align: center;">
                            <td colspan="100%">Aucun résultat trouvé</td>
                        </tr>
                    @endif

                  </tbody>
                </table>

                <div style="padding: 10px; float: right;">
                    @if(!empty($getRecord))
                        {!! $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
                    @endif
                </div>
                
              </div>
            </div>
          </div>
      </div>
    </section>
    <!-- /.content -->
  </div>

  @endsection