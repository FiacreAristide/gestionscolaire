  @extends('layouts.app')

  @section('content')


    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Ajouter une spécialisation</h1>
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
                <div class="form-group col-md-12">
                  <label>Domaine<span style="color:red;">*</span></label>  
                  <select class="form-control" required name="domain_id">
                    <option value=""> Selectionner Domaine </option>
                      @foreach($getDomain as $value)
                        <option value="{{ $value->id}}">{{ $value->name}}</option>
                      @endforeach
                  </select> 
                </div>



                  <div class="form-group">
                    <label>Parcours</label>
                    <select class="form-control" name="parcours">
                      <option value=""> Selectionner parcours </option>
                      <option value="Licence">Licence</option>
                      <option value="Master">Master</option>
                    </select>
                  </div>

                  <div class="form-group">
                    <label>Spécialisation</label>
                    <input type="text" class="form-control" placeholder="" name="name" required >
                  </div>



                  <div class="form-group">
                    <label>Status</label>
                    <select class="form-control" name="status">
                      <option value="0">Active</option>
                      <option value="1">Inactive</option>
                    </select>
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