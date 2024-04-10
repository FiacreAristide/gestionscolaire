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
                    <input type="hidden" value="{{ App\Models\SchoolYear::getActiveYear()->title }}" class="form-control" name="school_year_id"> 
                    <div class="form-group col-md-6">
                      <label>Domaine<span style="color:red;"></span></label>  
                      <select class="form-control" required name="domain_id">
                        <option value=""> Selectionner Domaine </option>
                        @foreach($getDomain as $value)
                          <option {{(old('domain_id',$getRecord->domain_id) == $value->id) ? 'selected' : ''}} value="{{ $value->id}}">{{ $value->name}}</option>
                        @endforeach
                      </select> 
                    </div>

                    <div class="form-group col-md-6">
                      <label>Mention<span style="color:red;"></span></label>
                      <select id="mention" name="mention_id" class="form-control">
                        @foreach($getMentions as $mention)
                        @endforeach
                        <option {{ (old('mention_id,getRecord->mention_id') == $mention->id) ? 'selected' : ''}} value="{{$mention->id}}">{{$mention->nom}}</option>
                      </select>
                    </div> 
                                         
                    <div class="form-group col-md-6">
                      <label>Spécialité<span style="color:red;"></span></label>
                      <select  name="subject_id" class="form-control" >
                        <option value=""> Sélectionner Spécialité </option>
                        @foreach($getSubject as $subject)
                          <option {{(old('subject_id',$getRecord->subject_id) == $subject->id) ? 'selected' : ''}} value="{{ $subject->id }}">{{ $subject->name }}</option>
                        @endforeach
                      </select>
                      <div style="color: red;"></div>
                    </div> 
                    
                    <div class="form-group col-md-6">
                      <label>Parcours<span style="color:red;">*</span></label>
                      <select id="parcours" name="parcours" class="form-control" required>
                        <option value=""> Sélectionner le parcours </option>
                        <option {{(old('parcours',$getRecord->parcours) == 'Licence') ? 'selected' : ''}} value="Licence">LICENCE</option>
                        <option {{(old('parcours',$getRecord->parcours) == 'Master') ? 'selected' : ''}} value="Master">MASTER</option>
                      </select>
                    </div>
                      <div class="form-group col-md-6">
                          <label>Semestre<span style="color:red;">*</span></label>
                          <select id="semestre" name="semestre" class="form-control"required>
                            <option value=""> Sélectionner le Semestre </option>
                            <option {{(old('semestre',$getRecord->semestre) == '01') ? 'selected' : ''}} value="01">01</option>
                            <option {{(old('semestre',$getRecord->semestre) == '02') ? 'selected' : ''}} value="02">02</option>
                            <option {{(old('semestre',$getRecord->semestre) == '03') ? 'selected' : ''}} value="03">03</option>
                            <option {{(old('semestre',$getRecord->semestre) == '04') ? 'selected' : ''}} value="04">04</option>
                            <option {{(old('semestre',$getRecord->semestre) == '05') ? 'selected' : ''}} value="05">05</option>
                            <option {{(old('semestre',$getRecord->semestre) == '06') ? 'selected' : ''}} value="06">06</option>
                          </select>  
                        </div>  
                        <div class="form-group col-md-6">
                          <label>Code UE</label>
                          <input type="text" class="form-control" placeholder="" name="code_ue" value="{{ old('code_ue',$getRecord->code_ue)}}" >
                        </div>

                        <div class="form-group col-md-6">
                          <label>UE</label>
                          <input type="text" class="form-control" placeholder="" name="ue" value="{{ old('ue',$getRecord->ue)}}" >
                        </div>  
                        
                        <div class="form-group col-md-6">
                          <label>Code ECUE</label>
                          <input type="text" class="form-control" placeholder="" name="code_ecue" value="{{ old('code_ecue',$getRecord->code_ecue)}}" >
                        </div>            

                        <div class="form-group col-md-6">
                          <label>Nom du cours</label>
                          <input type="text" class="form-control" placeholder="" name="name" value="{{ old('name',$getRecord->name)}}" >
                        </div>

                        <div class="form-group col-md-6">
                          <label>Volume Horaire</label>
                          <input type="number" class="form-control" placeholder="" name="vol_horaire" value="{{ old('vol_horaire',$getRecord->vol_horaire)}}" >
                        </div> 
                        
                        <div class="form-group col-md-6">
                          <label>Crédit</label>
                          <input type="number" class="form-control" placeholder="" name="coeff" value="{{ old('coeff',$getRecord->coeff)}}" >
                        </div>  

                        <div class="form-group col-md-6">
                          <label>Type</label>
                          <select class="form-control" name="type">
                            <option {{ (old('type',$getRecord->type ) == 'théorique') ? 'selected' : ''}} value="théorique">Théorique</option>
                            <option {{ (old('type',$getRecord->type ) == 'pratique') ? 'selected' : ''}} value="pratique">Pratique</option>
                          </select>
                        </div>                              

                        <div class="form-group col-md-6">
                          <label>Status</label>
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