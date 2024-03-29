  @extends('layouts.app')

  @section('content')


    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Subject</h1>
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
                    <label>Subject Name</label>
                    <input type="text" class="form-control" placeholder="Class name" name="name" value="{{$getRecord->name }}" required >
                  </div>

                  <div class="form-group">
                    <label>Type</label>
                    <select class="form-control" name="type">
                      <option value="">---Select type---</option>
                      <option {{($getRecord->type == 'theory') ? 'selected' : ''}} value="theory">Theory</option>
                      <option {{($getRecord->type == 'practical') ? 'selected' : ''}} value="practical">Practical</option>
                    </select>
                  </div>

                  <div class="form-group">
                    <label>Status</label>
                    <select class="form-control" name="status">
                      <option {{($getRecord->status == 0) ? 'selected' : ''}} value="0">Active</option>
                      <option {{($getRecord->status == 1) ? 'selected' : ''}} value="1">Inactive</option>
                    </select>
                  </div>


                </div>

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Update</button>
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