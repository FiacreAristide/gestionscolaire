  @extends('layouts.app')

  @section('content')


    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Modifier une mention </h1>
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
                    <div class="form-group col-md-12">
                      <label>Domaine<span style="color:red;">*</span></label>  
                      <select class="form-control"  name="domain_id">
                        <option value=""> Selectionner Domaine </option>
                        @foreach($getDomain as $value)
                        <option {{(old('domain_id', $getRecord->domain_id) == $value->id) ? 'selected' : ''}} value="{{ $value->id}}">{{ $value->name}}</option>
                        @endforeach
                      </select>
                    </div>

                    <div class="form-group col-md-12">
                        <label>Nom</label>
                      </div>
                      <input type="text" class="form-control" placeholder="" name="nom" value="{{old('nom',$getRecord->nom)}}"/>

                    <div class="form-group col-md-12">
                    <label>Status<span style="color:red;"></span></label>
                    <select class="form-control" required name="status">
                        <option value=""> Selectionner Status </option>
                        <option {{(old('status',$getRecord->status) == 0) ? 'selected' : ''}} value= "0">Active</option>
                        <option {{(old('status',$getRecord->status) == 1) ? 'selected' : ''}} value= "1">Inactive</option>
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
  