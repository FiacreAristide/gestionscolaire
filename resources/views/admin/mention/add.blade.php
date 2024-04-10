  @extends('layouts.app')

  @section('content')


    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Ajouter une mention </h1>
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
                        <option {{(old('domain_id') == $value->id) ? 'selected' : ''}} value="{{ $value->id}}">{{ $value->name}}</option>
                        @endforeach
                      </select> 
                    </div>

                    <div class="form-group col-md-12">
                      <label>Spécialité<span style="color:red;">*</span></label>
                      <select id="subject" name="subject_id" class="form-control" required>
                        <option value=""> Sélectionner Spécialité </option>
                        @foreach($getSubject as $subject)
                          <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                        @endforeach
                      </select>
                    </div>                    
                    

                    <div class="form-group col-md-12">
                        <label>Nom</label>
                        <input type="text" class="form-control" placeholder="" name="nom" required>
                    </div>

                    <div class="form-group col-md-12">
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

   @section('script')
        <script type="text/javascript">
            var subjects = {!! $getSubject !!};
        </script>
        <script type="text/javascript">
            document.getElementById('domain_id').addEventListener('change', function() {
                var domainId = this.value;
                var subjectSelect = document.getElementById('subject');
                
                // Effacer les anciennes options
                subjectSelect.innerHTML = '';

                // Filtrer les spécialités en fonction du domaine sélectionné
                var filteredSubjects = subjects.filter(function(subject) {
                    return subject.domain_id == domainId;
                });
                
                // Ajouter les options filtrées à la liste déroulante
                filteredSubjects.forEach(function(subject) {
                    var option = document.createElement('option');
                    option.value = subject.id;
                    option.text = subject.name;
                    subjectSelect.appendChild(option);
                });
            });
        </script>
        @endsection