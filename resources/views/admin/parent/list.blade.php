  @extends('layouts.app')
  @section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Parents (Total: {{$getRecord->total()}})</h1>
          </div>

          <div class="col-sm-6" style="text-align: right;">
            <a href="{{url('admin/parent/add')}}" class="btn btn-primary">Ajouter un parent</a>
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
                <h3 class="card-title">Rechercher parent </h3>
              </div>
                  <form method="get" action="">
                    
                    <div class="card-body">

                      <div class="row">

                      <div class="form-group col-md-3">
                        <label>Nom</label>
                        <input type="text" class="form-control" placeholder="Enter name" name="name"  value="{{ Request::get('name')}}" placeholder="name">
                      </div>

<!-- 
                      <div class="form-group col-md-2">
                        <label>Last Name</label>
                        <input type="text" class="form-control" placeholder="Enter name" name="last_name"  value="{{ Request::get('last_name')}}" placeholder="Last Name">
                      </div> -->

                      <div class="form-group col-md-3">
                        <label>Email</label>
                        <input type="text" class="form-control" placeholder="Enter email" name="email"  value="{{ Request::get('email')}}" placeholder="email">
                      </div>                    
<!-- 
                      <div class="form-group col-md-2">
                        <label>Gender</label>
                        <select class="form-control" name="gender">
                            <option  value="">---Select Gender---</option>
                            <option {{(Request::get('gender') == 'male') ? 'selected' : ''}} value="male">Male </option>
                            <option {{(Request::get('gender') == 'female') ? 'selected' : ''}} value="female">Female</option>
                            <option {{(Request::get('gender') == 'other') ? 'selected' : ''}} value="other">Other</option>
                        </select>
                      </div> -->


                      <div class="form-group col-md-2">
                        <label>Occupation</label>
                        <input type="text" class="form-control" name="occupation"  value="{{ Request::get('occupation')}}" placeholder="Occupation">
                      </div> 

                      <div class="form-group col-md-2">
                        <label>Adresse</label>
                        <input type="text" class="form-control" name="address"  value="{{ Request::get('address')}}" placeholder="Address">
                      </div>                                              

                      <div class="form-group col-md-2">
                        <label>Téléphone</label>
                        <input type="text" class="form-control" placeholder="Mobile Number" name="mobile_number"  value="{{ Request::get('mobile_number')}}" placeholder="Mobile Number">
                      </div>  


                      <div class="form-group col-md-2">
                        <label>Status</label>
                        <select class="form-control" name="gender">
                            <option  value="">---Select Status---</option>
                            <option {{(Request::get('status') == 100) ? 'selected' : ''}} value="100">Active </option>
                            <option {{(Request::get('status') == 1) ? 'selected' : ''}} value="1">Inactive</option>
                        </select>
                      </div>                      

                      <div class="form-group col-md-2">
                        <label>Date d'ajout</label>
                        <input type="date" class="form-control" placeholder="Enter email" name="date"  value="{{ Request::get('date')}}">
                      </div>

                      <div class="form-group col-md-3">
                        <button class="btn btn-primary" type="submit" style="margin-top: 32px;">Rechercher</button>

                         <a class="btn btn-success" style="margin-top: 32px;" href="{{ url('admin/parent/list')}}">Annuler</a>
                      </div>

                    </div>
                    </div>
                  </form>
                </div>

            @include('_message')
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Liste des parents </h3>
              </div>

              <div class="card-body p-0">
                <table class="table">
                  <thead>
                    <tr>
                      <th>id</th>
                      <th>Nom</th>
                      <th>Email</th> 
                      <th>Sexe</th>
                      <th>Telephone</th>
                      <th>Occupation</th>
                      <th>Adresse</th> 
                      <th>Status</th>
                      <th>Ajouté le</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($getRecord as $value)

                    <tr>
                      <td>{{ $value->id}}</td>
<!--                       <td>
                        @if(!empty($value->getProfile()))
                        <img src="{{ $value->getProfile()}}" style="height: 50px; width:50px;border-radius: 50px;">
                        @endif
                      </td> -->
                      <td>{{ $value->name}}</td>
                      <td>{{ $value->email}}</td>
                      <td>{{ $value->sexe}}</td>
                      <td>{{ $value->telephone}}</td>
                      <td>{{ $value->occupation}}</td>
                      <td>{{ $value->adresse}}</td>
                      <td>{{ ($value->status ==0) ? 'Active' : 'Inactive'}}</td>
                      
                      <td>{{ date('d-m-y h:i', strtotime($value->created_at))}}</td>

                      <td style="min-width:150px;">
                        <a href="{{ url('admin/parent/edit/'.$value->id)}}" class="btn btn-primary btn-sm">Modifier</a>
                        <a href="{{url('admin/parent/delete/'.$value->id)}}" class="btn btn-danger btn-sm">Supprimer</a>
                        <a href="{{ url('admin/parent/my-student/'.$value->id)}}" class="btn btn-primary btn-sm">Mon étudiant</a>
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