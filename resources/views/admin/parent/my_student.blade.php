  @extends('layouts.app')
  @section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Parent-Etudiant ({{ $getParent->name}} {{ $getParent->prenom}}) </h1>
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
                <h3 class="card-title">Rechercher Etudiant </h3>
              </div>
                  <form method="get" action="">
                    
                    <div class="card-body">

                      <div class="row">

                      <div class="form-group col-md-3">
                        <label>Etudiant ID</label>
                        <input type="text" class="form-control"  name="id"  value="{{ Request::get('id')}}" placeholder="ID">
                      </div>

                      <div class="form-group col-md-3">
                        <label>Nom</label>
                        <input type="text" class="form-control" placeholder="Enter name" name="name"  value="{{ Request::get('name')}}" placeholder="name">
                      </div>                      


                      <div class="form-group col-md-2">
                        <label>Prénom</label>
                        <input type="text" class="form-control" name="prenom"  value="{{ Request::get('prenom')}}" placeholder="Last Name">
                      </div>

                      <div class="form-group col-md-3">
                        <label>Email</label>
                        <input type="text" class="form-control" placeholder="Enter email" name="email"  value="{{ Request::get('email')}}">
                      </div>                    


                      <div class="form-group col-md-3">
                        <button class="btn btn-primary" type="submit" style="margin-top: 32px;">Rechercher</button>

                         <a class="btn btn-success" style="margin-top: 32px;" href="{{ url('admin/parent/my-student/'.$parent_id)}}">Reset</a>
                      </div>

                    </div>
                    </div>
                  </form>
                </div>

            @include('_message')

@if(!empty($getSearchStudent))
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Liste Etudiant </h3>
              </div>

              <div class="card-body p-0">
                <table class="table">
                  <thead>
                    <tr>
                      <th>id</th>
                      <th>Nom Etudiant</th>
                      <th>Email</th> 
                      <th>Nom Parent</th>
                      <th>Ajouté le</th>
                      <th>Action</th>
                    </tr>
                  </thead>

                  <tbody>
                  	@foreach($getSearchStudent as $value)
	                    <tr>
	                      <td>{{ $value->id}}</td>
	             <!--          <td>
	                        @if(!empty($value->getProfile()))
	                        <img src="{{ $value->getProfile()}}" style="height: 50px; width:50px;border-radius: 50px;">
	                        @endif
	                      </td> -->
	                      <td>{{ $value->name}} {{ $value->prenom}}</td>
	                      <td>{{ $value->email}}</td>
	                      <td>{{ $value->parent_name}} {{ $value->parent_prenom}}</td>                    
	                      <td>{{ date('d-m-y h:i', strtotime($value->created_at))}}</td>

	                      <td style="min-width: 150px;">
	                        <a href="{{ url('admin/parent/assign_student_parent/'.$value->id.'/'.$parent_id)}}" class="btn btn-primary btn-sm">Ajouter cet étudiant à ce parent</a>
	                      </td>
	                    </tr>
                    @endforeach
                  </tbody>

                </table>
   
                <div style="padding: 10px; float: right;">

                </div>
                
              </div>
            </div>
@endif

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Liste Etudiant-Parent </h3>
              </div>

              <div class="card-body p-0">
                <table class="table">
                  <thead>
                    <tr>
                      <th>id</th>
                      <th>Nom Etudiant</th>
                      <th>Email</th> 
                      <th>Nom Parent</th>
                      <th>Ajouté le</th>
                      <th>Action</th>
                    </tr>
                  </thead>

                  <tbody>
                  	@foreach($getRecord as $value)
	                    <tr>
	                      <td>{{ $value->id}}</td>
	             <!--          <td>
	                        @if(!empty($value->getProfile()))
	                        <img src="{{ $value->getProfile()}}" style="height: 50px; width:50px;border-radius: 50px;">
	                        @endif
	                      </td> -->
	                      <td>{{ $value->name}} {{ $value->prenom}}</td>
	                      <td>{{ $value->email}}</td>
	                      <td>{{ $value->parent_name}} {{ $value->parent_prenom}}</td>                    
	                      <td>{{ date('d-m-y h:i', strtotime($value->created_at))}}</td>

	                      <td style="min-width: 150px;">
	                        <a href="{{ url('admin/parent/assign_student_parent_delete/'.$value->id)}}" class="btn btn-danger btn-sm">supprimer</a>
	                      </td>
	                    </tr>
                    @endforeach
                  </tbody>

                </table>

                <div style="padding: 10px; float: right;">

                </div>
                
              </div>
            </div>            
          </div>
      </div>
    </section>
    <!-- /.content -->
  </div>

  @endsection