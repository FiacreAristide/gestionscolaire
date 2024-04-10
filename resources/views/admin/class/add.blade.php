  @extends('layouts.app')

  @section('content')


    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Ajouter une nouvelle classe</h1>
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
                 <input type="hidden" name="school_year_id" value="{{ $getActiveYear->id }}">
                  <div class="form-group col-md-12">
                    <label>Domaine<span style="color:red;">*</span></label>  
                    <select class="form-control" required name="domain_id" id="domain_id">
                      <option value=""> Selectionner Domaine </option>
                      @foreach($getDomain as $value)
                      <option {{(old('domain_id') == $value->id) ? 'selected' : ''}} value="{{ $value->id}}">{{ $value->name}}</option>
                      @endforeach
                    </select> 
                  </div>

                  <div class="form-group col-md-12">
                    <label>Mention<span style="color:red;"></span></label>
                    <select id="mention" name="mention" class="form-control">
                      <option value=""> Selectionner Mention </option>
                      @foreach($getMentions as $mention)
                      <option value="{{$mention->id}}">{{$mention->nom}}</option>
                      @endforeach
                    </select>
                  </div>

                  <div class="form-group col-md-12">
                    <label>Nom de la classe</label>
                    <input type="text" class="form-control" placeholder="" name="name" required >
                  </div>

                  <div class="form-group col-md-12">
                    <label>Frais de scolarité</label>
                    <input type="number" class="form-control" placeholder="xxx.xxx FCFA" name="amount" required >
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
    @section('script')
        <script type="text/javascript">
            var mentions = {!! $getMentions !!};
        </script>
        <script type="text/javascript">
            document.getElementById('domain_id').addEventListener('change', function() {
                var domainId = this.value;
                var mentionSelect = document.getElementById('mention');
                
                // Effacer les anciennes options
                mentionSelect.innerHTML = '';
                
                // Filtrer les mentions en fonction du domaine sélectionné
                var filteredMentions = mentions.filter(function(mention) {
                    return mention.domain_id == domainId;
                });

                // Ajouter les options filtrées à la liste déroulante
                filteredMentions.forEach(function(mention) {
                    var option = document.createElement('option');
                    option.value = mention.id;
                    option.text = mention.nom;
                    mentionSelect.appendChild(option);
                });
            });
        </script>
    @endsection
   
  </div>
 

  @endsection