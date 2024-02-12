  @extends('layouts.app')

  @section('content')


    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Ajouter un nouveau cours</h1>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

       <section class="content">
      <div class="container-fluid">
        <div class="row">
         
          <div class="col-md-12">
            
            <div class="card card-primary">
              <form method="post" action="">
                {{ csrf_field() }}

                <div class="card-body">

                  <div class="form-group col-md-6">
                    <label>Nom du cours</label>
                    <input type="text" class="form-control" placeholder="" name="name" required >
                  </div>

                  <div class="form-group col-md-6">
                    <label>Type</label>
                    <select class="form-control" name="type">
                      <option value="théorique">Théorique</option>
                      <option value="Pratique">Pratique</option>
                    </select>
                  </div>

                  <div class="form-group col-md-6">
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
       
      </div>
    </section>
 
  </div>
 

  @endsection