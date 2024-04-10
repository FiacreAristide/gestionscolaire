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

      <div class="content" >
        <div class="container-fluid">
          <div class="row"> 
            <div class="col-md-12">
              <div class="card card-primary"> 
                <div class="card-body">
                  <form method="post" action="">
                      {{ csrf_field() }}
                    <div class="row">
                    <input type="hidden" name="school_year_id" value="{{ $getActiveYear->id }}">
                    <div class="form-group col-md-6">
                      <label>Domaine<span style="color:red;">*</span></label>  
                      <select class="form-control" required name="domain_id" id="domain_id">
                        <option value=""> Selectionner Domaine </option>
                        @foreach($getDomain as $value)
                        <option {{(old('domain_id') == $value->id) ? 'selected' : ''}} value="{{ $value->id}}">{{ $value->name}}</option>
                        @endforeach
                      </select> 
                    </div>

                    <div class="form-group col-md-6">
                      <label>Mention<span style="color:red;"></span></label>
                      <select id="mention" name="mention_id" class="form-control">
                        @foreach($getMentions as $mention)
                        <option value="{{$mention->id}}">{{$mention->nom}}</option>
                        @endforeach
                      </select> 
                    </div> 
                                         
                    <div class="form-group col-md-6">
                      <label>Spécialité<span style="color:red;">*</span></label>
                      <select id="subject" name="subject_id" class="form-control" required>
                        <option value=""> Sélectionner Spécialité </option>
                        @foreach($getSubject as $subject)
                        <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                        @endforeach
                      </select>
                      <div style="color: red;"></div>
                    </div> 
                    
                    <div class="form-group col-md-6">
                      <label>Parcours<span style="color:red;">*</span></label>
                      <select id="parcours" name="parcours" class="form-control" required>
                        <option value=""> Sélectionner le parcours </option>
                        <option value="Licence">Licence</option>
                        <option value="Master">Master</option>
                      </select>
                    </div>
                      <div class="form-group col-md-6">
                          <label>Semestre<span style="color:red;">*</span></label>
                          <select id="semestre" name="semestre" class="form-control"required>
                            <option value=""> Sélectionner le Semestre </option>
                            <option value="01">01</option>
                            <option value="02">02</option>
                            <option value="03">03</option>
                            <option value="04">04</option>
                            <option value="05">05</option>
                            <option value="06">06</option>
                          </select>  
                        </div>  
                        <div class="form-group col-md-6">
                          <label>Code UE</label>
                          <input type="text" class="form-control" placeholder="" name="code_ue" required >
                        </div>

                        <div class="form-group col-md-6">
                          <label>UE</label>
                          <input type="text" class="form-control" placeholder="" name="ue" required >
                        </div>  
                        
                        <div class="form-group col-md-6">
                          <label>Code ECUE</label>
                          <input type="text" class="form-control" placeholder="" name="code_ecue" required >
                        </div>            

                        <div class="form-group col-md-6">
                          <label>ECUE</label>
                          <input type="text" class="form-control" placeholder="" name="name" required >
                        </div>

                        <div class="form-group col-md-6">
                          <label>Volume Horaire</label>
                          <input type="number" class="form-control" placeholder="" name="vol_horaire" required >
                        </div> 
                        
                        <div class="form-group col-md-6">
                          <label>Crédit</label>
                          <input type="number" class="form-control" placeholder="" name="coeff" required >
                        </div>  

                        <div class="form-group col-md-6">
                          <label>Type</label>
                          <select class="form-control" name="type">
                            <option value="théorique">Théorique</option>
                            <option value="pratique">Pratique</option>
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
                    
                  </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
  </div>
  @endsection

  @section('script')
<script type="text/javascript">
    var mentions = {!! $getMentions !!};
    var subjects = {!! $getSubject !!}; // Assurez-vous de récupérer également les spécialités

    document.getElementById('domain_id').addEventListener('change', function() {
        var domainId = this.value;
        var mentionSelect = document.getElementById('mention');
        var subjectSelect = document.getElementById('subject');
        
        // Effacer les anciennes options
        mentionSelect.innerHTML = '';
        subjectSelect.innerHTML = '';
        
        // Filtrer les mentions en fonction du domaine sélectionné
        var filteredMentions = mentions.filter(function(mention) {
            return mention.domain_id == domainId;
        });

        // Filtrer les spécialités en fonction du domaine sélectionné
        var filteredSubject = subjects.filter(function(subject) {
            return subject.domain_id == domainId;
        });

        // Ajouter les options filtrées à la liste déroulante des mentions
        filteredMentions.forEach(function(mention) {
            var option = document.createElement('option');
            option.value = mention.id;
            option.text = mention.nom;
            mentionSelect.appendChild(option);
        });

        // Ajouter les options filtrées à la liste déroulante des spécialités
        filteredSubject.forEach(function(subject) {
            var option = document.createElement('option');
            option.value = subject.id;
            option.text = subject.name;
            subjectSelect.appendChild(option);
        });
    });
</script>
@endsection
