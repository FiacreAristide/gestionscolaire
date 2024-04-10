  @extends('layouts.app')
  @section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Enseignants (Total: {{$getRecord->total()}})</h1>
          </div>

          <div class="col-sm-6" style="text-align: right;">
            <a href="{{url('admin/teacher/add')}}" class="btn btn-primary">Ajouter un enseignant</a>
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
                <h3 class="card-title">Rechercher enseignant </h3>
              </div>
                  <form method="get" action="">
                    
                    <div class="card-body">

                      <div class="row">

                      <div class="form-group col-md-3">
                        <label>Nom</label>
                        <input type="text" class="form-control" placeholder="Nom" name="name"  value="{{ Request::get('name')}}">
                      </div>


                      <div class="form-group col-md-2">
                        <label>Prénom</label>
                        <input type="text" class="form-control" placeholder="Prénom" name="prenom"  value="{{ Request::get('prenom')}}">
                      </div>

                      <div class="form-group col-md-3">
                        <label>Email</label>
                        <input type="text" class="form-control" placeholder="Email" name="email"  value="{{ Request::get('email')}}">
                      </div>


                      <div class="form-group col-md-2">
                        <label>Sexe</label>
                        <select class="form-control" name="sexe">
                            <option  value="">Selectionner sexe</option>
                            <option {{(Request::get('sexe') == 'Masculin') ? 'selected' : ''}} value="male">Masculin </option>
                            <option {{(Request::get('sexe') == 'Feminin') ? 'selected' : ''}} value="female">Féminin</option>
                            <option {{(Request::get('sexe') == 'Autres') ? 'selected' : ''}} value="other">Autres</option>
                        </select>
                      </div>                       

                      <div class="form-group col-md-2">
                        <label>Status</label>
                        <select class="form-control" name="gender">
                            <option  value="">Selectionner Status</option>
                            <option {{(Request::get('status') == 100) ? 'selected' : ''}} value="100">Active </option>
                            <option {{(Request::get('status') == 1) ? 'selected' : ''}} value="1">Inactive</option>
                        </select>
                      </div>                      

                      <div class="form-group col-md-3">
                        <button class="btn btn-primary" type="submit" style="margin-top: 32px;">Rechercher</button>
                         <a class="btn btn-success" style="margin-top: 32px;" href="{{ url('admin/teacher/list')}}">Annuler</a>
                      </div>
                    </div>
                    </div>
                  </form>
                </div>


            @include('_message')
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Liste Enseignants </h3>
                <a class="btn btn-primary" style="float: right;" href="{{url('admin/teacher/print_list')}}">Imprimer liste</a>
              </div>
              <div class="card-body p-0"style="overflow: auto;">
                <table class="table">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Nom de l'enseignant</th>
                      <th>Email</th>
                      <th>Sexe</th>                     
                      <th>Date d'intégration</th>
                      <th>Téléphone</th>                      
                      <th>Adresse</th>                      
                      <th>Dernier diplôme</th>
                      <th>Grade universitaire</th>
                      <th>Status</th>
                      <th>Ajouté le</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse($getRecord as $value)

                    <tr>
                      <td>{{ $value->id}}</td>
<!--                       <td>
                        @if(!empty($value->getProfile()))
                        <img src="{{ $value->getProfile()}}" style="height: 50px; width:50px;border-radius: 50px;">
                        @endif
                      </td> -->

                      <td style="min-width: 150px;">{{ $value->name}} {{ $value->prenom}}</td>
                      <td style="min-width: 150px;">{{ $value->email}}</td>
                      <td style="min-width: 150px;">{{ $value->sexe}}</td>
                      <td style="min-width: 150px;">

                         @if(!empty($value->date_integration))
                          {{ date('d-m-Y', strtotime($value->date_integration))}}
                         @endif
                        </td> 
                                          
                      <td style="min-width: 150px;">{{ $value->telephone}}</td>
                      <td style="min-width: 150px;">{{ $value->adresse}}</td>
                      <td style="min-width: 150px;">{{ $value->dernier_diplome}}</td>
                      <td style="min-width: 150px;">{{ $value->grade_universitaire}}</td>
                      <td style="min-width: 150px;">{{ ($value->status ==0) ? 'Active' : 'Inactive'}}</td>                  
                      <td style="min-width: 150px;">{{ date('d-m-y h:i', strtotime($value->created_at))}}</td>

                      <td style="min-width: 200px;">
                        <a href="{{ url('admin/teacher/edit/'.$value->user_id)}}" class="btn btn-primary btn-sm">Modifier</a>
                        <a href="{{url('admin/teacher/delete/'.$value->user_id)}}" class="btn btn-danger btn-sm">Supprimer</a>
                      </td>
                    </tr>
                    @empty
                      <tr style="text-align: center;">
                        <td colspan="100%">Aucun resultat trouvé </td>
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