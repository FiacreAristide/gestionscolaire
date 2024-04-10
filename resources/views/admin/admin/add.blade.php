  @extends('layouts.app')

  @section('content')


    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Ajouter un nouvel administrateur</h1>
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
                  <input type="hidden" name="school_year_id" value="{{ $getActiveYear->id }}"> 
                  <div class="form-group">
                    <label>Nom</label>
                    <input type="text" class="form-control" placeholder="" name="name" required value="{{ old('name') }}">
                  </div>

                  <div class="form-group">
                    <label>Prénom</label>
                    <input type="text" class="form-control" placeholder="" name="prenom" required value="{{ old('prenom') }}">
                  </div>

                  <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control" placeholder="Enter email" name="email" required value="{{ old('email') }}">

                    <div style="color: red;">{{ $errors->first('email') }}</div>
                  </div>
                  <div class="form-group">
                    <label >Mot de passe</label>
                    <input type="password" class="form-control" placeholder="Password" name="password" required>
                  </div>
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