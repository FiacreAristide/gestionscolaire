  @extends('layouts.app')

  @section('content')


    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Admin</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <form method="post" action="">
                {{ csrf_field() }}

                <div class="card-body">

                  <div class="form-group">
                    <label>Nom</label>
                    <input type="text" class="form-control" placeholder="Nom" name="name" required value="{{
                     old('name',$getRecord->name)
                      
                    }}">
                  </div>
                  <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control" placeholder="Email" name="email" required value="{{
                      old('email',$getRecord->email)
                      
                    }}">
                    <div style="color: red;">{{ $errors->first('email') }}</div>
                  </div>
                  <div class="form-group">
                    <label >Mot de passe</label>
                    <input type="text" class="form-control" placeholder="Password" name="password">

                    <p>Voulez-vous changer de mot de passe ? Veuillez entrer le nouveau mot de passe</p>


                  </div>

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Enregistrer</button>
                </div>
              </form>
            </div>

          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
 

  @endsection