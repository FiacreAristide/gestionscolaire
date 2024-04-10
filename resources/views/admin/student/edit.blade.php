      @extends('layouts.app')

      @section('content')



      <div class="content-wrapper">
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Ajouter un nouvel étudaint</h1>
            </div>
          </div>
        </div>
      </section>

      <section class="col-md-12" style="justify-content:space-between;align-items: center; display: flex; width: 100%; padding-left: 50px; padding-right: 50px;margin-top: 20px;">
        <div>
          <img src="{{ url('public/dist/img/logo.jpg')}}" class="elevation-2" alt="logo" style="height: 90px;">
          <!-- <img src="url('public/dist/img/logo.jpg')}}" alt="logo"> -->
        </div>

        <div>
          <p style="font-weight: 500; text-align: center;">REPUBLIQUE TOGOLAISE <br> <span style="font-style: italic;">Travail-Liberté-Patrie</span></p>  
        </div>
      </section>
      <hr>
      <div>
        <p style="font-weight: 500; text-align: center;">DIRECTION DE L'ACADEMIE, DE LA PEDAGOGIE ET DE LA SCOLARITE</p>  
      </div>

      <div>
        <p style="text-align: center; font-weight: bold; font-size: 25px; ">IDENTITE</p>
      </div>

      <section class="content" >
        <div class="container-fluid">
          <div class="row"> 
            <div class="col-md-12">
              <div class="card card-primary">
                <div class="card-body">
                  <div class="row">
                    <form method="post" action="" enctype="multipart/form-data">
                      {{ csrf_field() }}

                      <div class="form-group col-md-12">
                        <label>Nom<span style="color:red;">*</span></label>
                        <input type="text" class="form-control" placeholder="Votre nom" name="name" value="{{ old('name',$getRecord->name ) }}">
                      </div>

                      <div class="form-group col-md-12">
                        <label>Prénom<span style="color:red;">*</span></label>
                        <input type="text" class="form-control" placeholder="Votre prénom" name="prenom"  value="{{ old('prenom',$getRecord->prenom) }}">
                      </div>


                      <div class="form-group col-md-12">
                        <label>Date de naissance<span style="color:red;">*</span></label>
                        <input type="date" class="form-control" placeholder="" name="date_naissance"  value="{{ old('date_naissance',$getRecord->date_naissance) }}">
                      </div>


                      <div class="form-group col-md-12">
                        <label>Lieu de Naissance<span style="color:red;">*</span></label>
                        <input type="text" class="form-control" placeholder="" name="lieu_naissance"  value="{{ old('lieu_naissance',$getRecord->lieu_naissance) }}">
                      </div>

                      <div class="form-group col-md-12">
                        <label>Pays de naissance<span style="color:red;">*</span></label>
                        <select class="form-control" id="pays_naissance" name="pays_naissance">
                          <option {{(old('pays_naissance',$getRecord->pays_naissance) == 'Togo') ? 'selected' : ''}} value="Togo">Togo</option>
                          <option {{(old('pays_naissance',$getRecord->pays_naissance) == 'Benin') ? 'selected' : ''}} value="Benin">Benin</option>
                          <option {{(old('pays_naissance',$getRecord->pays_naissance) == 'Burkina-Faso') ? 'selected' : ''}} value="Burkina-Faso">Burkina Faso</option>
                          <option {{(old('pays_naissance',$getRecord->pays_naissance) == 'Cameroun') ? 'selected' : ''}} value="Cameroun">Cameroun</option>
                          <option {{(old('pays_naissance',$getRecord->pays_naissance) == 'Cote-ivoire') ? 'selected' : ''}} value="Cote-ivoire">Cote D'Ivoire</option>
                          <option {{(old('pays_naissance',$getRecord->pays_naissance) == 'Ghana') ? 'selected' : ''}} value="Ghana">Ghana</option>
                          <option {{(old('pays_naissance',$getRecord->pays_naissance) == 'Niger') ? 'selected' : ''}} value="Niger">Niger</option>
                          <option {{(old('pays_naissance',$getRecord->pays_naissance) == 'Nigeria') ? 'selected' : ''}} value="Nigeria">Nigeria</option>
                          <option {{(old('pays_naissance',$getRecord->pays_naissance) == 'Tchad') ? 'selected' : ''}} value="Tchad">Tchad</option>
                        </select>
                      </div>

                      <div class="form-group col-md-12">
                        <label>Nationalité<span style="color:red;">*</span></label>
                        <input type="text" class="form-control" placeholder="Votre nationalité" name="nationalite" required value="{{ old('nationalite',$getRecord->nationalite) }}">
                      </div>


                      <div class="form-group col-md-12">
                        <label>Ethnie</label>
                        <input type="text" class="form-control" placeholder="Votre ethnie" name="ethnie" required value="{{ old('ethnie',$getRecord->ethnie) }}">
                      </div>

                      <div class="form-group col-md-12">
                        <label>Préfecture</label>
                        <input type="text" class="form-control" placeholder="" name="prefecture" required value="{{ old('prefecture',$getRecord->prefecture) }}">
                      </div>

                      <div class="form-group col-md-12">
                        <label>Sexe</label>
                        <select class="form-control" id="sexe" name="sexe">
                          <option {{(old('sexe',$getRecord->sexe) == 'Masculin') ? 'selected' : ''}} value="Masculin">Masculin</option>
                          <option {{(old('sexe',$getRecord->sexe) == 'Feminin') ? 'selected' : ''}} value="Féminin">Féminin</option>
                          <option {{(old('sexe',$getRecord->sexe) == 'Autres') ? 'selected' : ''}} value="Autre">Autres</option>
                        </select>
                      </div>

                       <div class="form-group col-md-12">
                        <label for="profile_pic">Photo</label>
                        <input class="form-control" type="file" name="profile_pic" id="profile_pic">
                        @if(!empty($getRecord->getProfile()))
                          <img src="{{ $getRecord->getProfile()}}" width="100px">
                        @endif
                      </div>

                      <div class="form-group col-md-12">
                        <label>Situation Matrimoniale</label>
                        <select class="form-control" name="situation_matrimoniale">
                          <option {{(old('situation_matrimoniale',$getRecord->situation_matrimoniale) == 'Celibataire') ? 'selected' : ''}} value="Célibataire">Célibataire</option>
                          <option {{(old('situation_matrimoniale',$getRecord->situation_matrimoniale) == 'Marie') ? 'selected' : ''}} value="Marié">Marié(é)</option>
                          <option {{(old('situation_matrimoniale',$getRecord->situation_matrimoniale) == 'Veuve') ? 'selected' : ''}} value="Veuve">Veuve</option>
                          <option {{(old('situation_matrimoniale',$getRecord->situation_matrimoniale) == 'Divorce') ? 'selected' : ''}} value="Divorcé">Divorcé(e)</option>
                        </select>                        
                        <div style="color: red;">{{ $errors->first('name') }}</div>
                      </div>


                      <div class="form-group col-md-12">
                        <label>Adresse<span style="color:red;"></span></label>
                        <input type="text" class="form-control" placeholder="Adresse" name="adresse" value="{{ old('adresse',$getRecord->adresse) }}">
                      </div>

                      <div class="form-group col-md-12">
                        <label>BP</label>
                        <input type="text" class="form-control" placeholder="BP:xxxx" name="boite_postale" value="{{ old('boite_postale',$getRecord->boite_postale) }}">
                      </div>

                      <div class="form-group col-md-12">
                        <label>Ville</label>
                        <input type="text" class="form-control" placeholder="" name="ville" value="{{ old('ville',$getRecord->ville,$getRecord->name) }}">
                        <div style="color: red;">{{ $errors->first('name') }}</div>
                      </div> 

                      <div class="form-group col-md-12">
                        <label>Pays de résidence</label>
                        <select class="form-select" id="pays_residence" name="pays_residence">
                          <option {{(old('pays_residence',$getRecord->pays_residence) == 'Togo') ? 'selected' : ''}} value="Togo">Togo</option>
                          <option {{(old('pays_residence',$getRecord->pays_residence) == 'Benin') ? 'selected' : ''}} value="Benin">Benin</option>
                          <option {{(old('pays_residence',$getRecord->pays_residence) == 'Burkina-Faso') ? 'selected' : ''}} value="Burkina-Faso">Burkina Faso</option>
                          <option {{(old('pays_residence',$getRecord->pays_residence) == 'Cameroun') ? 'selected' : ''}} value="Cameroun">Cameroun</option>
                          <option {{(old('pays_residence',$getRecord->pays_residence) == 'Cote-ivoire') ? 'selected' : ''}} value="Cote-ivoire">Cote D'Ivoire</option>
                          <option {{(old('pays_residence',$getRecord->pays_residence) == 'Ghana') ? 'selected' : ''}} value="Ghana">Ghana</option>
                          <option {{(old('pays_residence',$getRecord->pays_residence) == 'Niger') ? 'selected' : ''}} value="Niger">Niger</option>
                          <option {{(old('pays_residence',$getRecord->pays_residence) == 'Nigeria') ? 'selected' : ''}} value="Nigeria">Nigeria</option>
                          <option {{(old('pays_residence',$getRecord->pays_residence) == 'Tchad') ? 'selected' : ''}} value="Tchad">Tchad</option>
                        </select> 
                      </div>

                      <div class="form-group col-md-12">
                        <label>Téléphone</label>
                        <input type="tel" class="form-control" name="telephone" value="{{ old('telephone',$getRecord->telephone) }}" placeholder="99-99-99-99" pattern="(9[0-9]|7[0-9])-[0-9]{2}-[0-9]{2}-[0-9]{2}">
                      </div> 

                      <div class="form-group col-md-12">
                        <label>Nom et prénoms Père<span style="color:red;">*</span></label>
                        <input type="text" class="form-control" placeholder="" name="nom_pere" value="{{ old('nom_pere',$getRecord->nom_pere) }}">
                      </div>

                      <div class="form-group col-md-12">
                        <label>Profession père<span style="color:red;">*</span></label>
                        <input type="text" class="form-control" placeholder="" name="prof_pere" value="{{ old('prof_pere',$getRecord->prof_pere) }}">
                      </div>

                      <div class="form-group col-md-12">
                        <label>Téléphone père</label>
                        <input type="tel" class="form-control" name="tel_pere" value="{{ old('tel_pere',$getRecord->tel_pere) }}" placeholder="99-99-99-99" pattern="(9[0-9]|7[0-9])-[0-9]{2}-[0-9]{2}-[0-9]{2}">
                      </div> 

                      <div class="form-group col-md-12">
                        <label>Nom et prénoms Mère<span style="color:red;">*</span></label>
                        <input type="text" class="form-control" placeholder="" name="nom_mere" value="{{ old('nom_mere',$getRecord->nom_mere) }}">
                      </div>

                      <div class="form-group col-md-12">
                        <label>Profession mère<span style="color:red;">*</span></label>
                        <input type="text" class="form-control" placeholder="" name="prof_mere" value="{{ old('prof_mere',$getRecord->prof_mere) }}">
                      </div>

                      <div class="form-group col-md-12">
                        <label>Téléphone mère</label>
                        <input type="tel" class="form-control" name="tel_mere" value="{{ old('tel_mere',$getRecord->tel_mere) }}" placeholder="99-99-99-99" pattern="(9[0-9]|7[0-9])-[0-9]{2}-[0-9]{2}-[0-9]{2}">
                      </div> 

                      <div class="form-group col-md-12">
                        <label>Boursier</label> <br>
                        <input type="radio" id="oui_boursier" name="boursier" {{ (old('boursier',$getRecord->boursier) == "OUI") ? 'checked' : '' }}" value="OUI">
                        <label for="oui_boursier">OUI</label><br>
                        <input type="radio" id="oui_boursier" name="boursier" {{ (old('boursier',$getRecord->boursier) == "NON") ? 'checked' : '' }}" value="NON">
                        <label for="non_boursier">NON</label><br>
                      </div> 

                      <div class="form-group col-md-12">
                        <label>Organisme</label>
                        <input type="text" class="form-control" placeholder="" name="organisme" value="{{ old('organisme',$getRecord->organisme) }}">
                      </div>

                      <div class="form-group col-md-12">
                        <label>Début de la bourse</label>
                        <input type="date" class="form-control" placeholder="" name="debut_bourse" value="{{ old('debut_bourse',$getRecord->debut_bourse) }}">
                        <div style="color: red;"></div>
                      </div>

                      <div class="form-group col-md-12">
                        <label>Religion</label>
                        <select class="form-control" name="religion">
                          <option {{(old('religion',$getRecord->religion) == 'Catholique') ? 'selected' : ''}} value="Catholique">Catholique</option>
                          <option {{(old('religion',$getRecord->religion) == 'Protestant') ? 'selected' : ''}} value="Protestant">Protestant</option>
                          <option {{(old('religion',$getRecord->religion) == 'Musulman') ? 'selected' : ''}} value="Musulman">Musulman</option>
                          <option {{(old('religion',$getRecord->religion) == 'Autres') ? 'selected' : ''}} value="Autres">Autres</option>
                        </select>
                      </div>

                      <div class="form-group col-md-12">
                        <label>Salarié(e)</label> <br>
                        <input type="radio" id="oui_sal" name="salarie" {{ (old('salarie',$getRecord->salarie) == "Oui") ? 'checked' : '' }}" value="Oui">
                        <label for="oui_sal">OUI</label><br>
                        <input type="radio" id="non_sal" name="salarie" {{ (old('salarie',$getRecord->salarie) == "Non") ? 'checked' : '' }}" value="Non">
                        <label for="non_sal">NON</label><br>
                        <div style="color: red;"></div>
                      </div> 

                      <div class="form-group col-md-12">
                        <label>Profession</label>
                        <input type="text" class="form-control" placeholder="" name="prof_salaire" value="{{ old('prof_salaire',$getRecord->prof_salaire) }}">
                        <div style="color: red;"></div>
                      </div>

                      <div class="form-group col-md-12">
                        <label for="etatPhys">État physique :</label>
                        <select id="etatPhys" name="etatPhys" class="form-control">
                          <option {{ old('etatPhys',$getRecord->etatPhys)}} value="En bonne santé">En bonne santé</option>
                          <option {{ old('etatPhys',$getRecord->etatPhys)}} value="Maladie légère">Maladie légère</option>
                          <option {{ old('etatPhys',$getRecord->etatPhys)}} value="Maladie chronique">Maladie chronique</option>
                          <option {{ old('etatPhys',$getRecord->etatPhys)}} value="Convalescence">Convalescence</option>
                          <option {{ old('etatPhys',$getRecord->etatPhys)}} value="Autres">Autres</option>
                        </select>
                      </div>

                      <div class="form-group col-md-12">
                        <label for="handicap">Handicap :</label>
                        <select id="handicap" name="handicap" class="form-control">
                          <option {{(old('handicap',$getRecord->handicap) == 'Aucun') ? 'selected' : ''}} value="aucun">Aucun handicap</option>
                          <option {{(old('handicap',$getRecord->handicap) == 'Moteur') ? 'selected' : ''}} value="moteur">Handicap moteur</option>
                          <option {{(old('handicap',$getRecord->handicap) == 'Visuel') ? 'selected' : ''}} value="visuel">Handicap visuel</option>
                          <option {{(old('handicap',$getRecord->handicap) == 'Auditif') ? 'selected' : ''}} value="auditif">Handicap auditif</option>
                          <option {{(old('handicap',$getRecord->handicap) == 'Cognitif') ? 'selected' : ''}} value="cognitif">Handicap cognitif</option>
                          <option {{(old('handicap',$getRecord->handicap) == 'Invisible') ? 'selected' : ''}} value="invisible">Handicap invisible</option>
                        </select>
                      </div>

                      <div class="form-group col-md-12">
                        <label for="person_prev">Personne à prévenir :</label>
                        <input type="text" class="form-control" id="person_prev" name="person_prev" placeholder="Nom de la personne" value="{{ old('person_prev',$getRecord->person_prev) }}">
                      </div>

                      <div class="form-group col-md-12">
                        <label for="tel_prev">Téléphone de la personne :</label>
                        <input type="tel" class="form-control" id="tel_prev" name="tel_prev" placeholder="Numéro de téléphone" value="{{ old('tel_prev',$getRecord->tel_prev) }}">
                      </div>
                      <div>
                        <p style="text-align: center; font-weight: bold;font-size: 25px;margin-top: 20px;">RENSEIGNEMENTS BACCALAUREAT(O/N):</p>
                      </div>

                      <div class="content" >
                        <div class="container-fluid">
                          <div class="row">
                            <div class="col-md-12">
                              <div class="card card-primary">
                                <div class="card-body">
                                  <div class="row">
                                    <div class="form-group col-md-6">
                                      <label>Année d'obtention<span style="color:red;">*</span></label>
                                      <input type="text" class="form-control" placeholder="Année" name="annee_bac"  value="{{ old('annee_bac',$getRecord->annee_bac) }}">
                                    </div>

                                    <div class="form-group col-md-6">
                                      <label>Mention<span style="color:red;">*</span></label>
                                      <select id="mention_bac" name="mention_bac" class="form-control">
                                        <option {{(old('mention_bac',$getRecord->mention_bac) == 'Passable') ? 'selected' : ''}} value="Passable">Passable</option>
                                        <option {{(old('mention_bac',$getRecord->mention_bac) == 'Assez-bien') ? 'selected' : ''}} value="Assez-bien">Assez-bien</option>
                                        <option {{(old('mention_bac',$getRecord->mention_bac) == 'Bien') ? 'selected' : ''}} value="Bien">Bien</option>
                                        <option {{(old('mention_bac',$getRecord->mention_bac) == 'Très-Bien') ? 'selected' : ''}} value="Très-Bien">Très-Bien</option>
                                      </select>                     
                                    </div>

                                    <div class="form-group col-md-6">
                                      <label>Série<span style="color:red;">*</span></label>
                                      <select id="serie" name="serie" class="form-control">
                                        <option {{(old('serie',$getRecord->serie) == 'A4') ? 'selected' : ''}} value="A4">A4</option>
                                        <option {{(old('serie',$getRecord->serie) == 'D') ? 'selected' : ''}} value="D">D</option>
                                        <option {{(old('serie',$getRecord->serie) == 'C') ? 'selected' : ''}} value="C">C</option>
                                        <option {{(old('serie',$getRecord->serie) == 'E') ? 'selected' : ''}} value="E">E</option>
                                        <option {{(old('serie',$getRecord->serie) == 'Ti') ? 'selected' : ''}} value="Ti">Ti</option>
                                      </select>
                                    </div>

                                    <div class="form-group col-md-6">
                                      <label>Numéro de table<span style="color:red;">*</span></label>
                                      <input type="text" class="form-control" placeholder="Numéro de table" name="num_table"  value="{{ old('num_table',$getRecord->num_table) }}">
                                    </div>

                                    <div class="form-group col-md-6">
                                      <label>Pays d'obtention du bac<span style="color:red;">*</span></label>
                                      <select class="form-control" id="pays_obtention" name="pays_obtention">
                                        <option {{(old('pays_obtention',$getRecord->pays_obtention) == 'Togo') ? 'selected' : ''}} value="Togo">Togo</option>
                                        <option {{(old('pays_obtention',$getRecord->pays_obtention) == 'Benin') ? 'selected' : ''}} value="Benin">Benin</option>
                                        <option {{(old('pays_obtention',$getRecord->pays_obtention) == 'Burkina-Faso') ? 'selected' : ''}} value="Burkina-Faso">Burkina Faso</option>
                                        <option {{(old('pays_obtention',$getRecord->pays_obtention) == 'Cameroun') ? 'selected' : ''}} value="Cameroun">Cameroun</option>
                                        <option {{(old('pays_obtention',$getRecord->pays_obtention) == 'Cote-ivoire') ? 'selected' : ''}} value="Cote-ivoire">Cote D'Ivoire</option>
                                        <option {{(old('pays_obtention',$getRecord->pays_obtention) == 'Ghana') ? 'selected' : ''}} value="Ghana">Ghana</option>
                                        <option {{(old('pays_obtention',$getRecord->pays_obtention) == 'Niger') ? 'selected' : ''}} value="Niger">Niger</option>
                                        <option {{(old('pays_obtention',$getRecord->pays_obtention) == 'Nigeria') ? 'selected' : ''}} value="Nigeria">Nigeria</option>
                                        <option {{(old('pays_obtention',$getRecord->pays_obtention) == 'Tchad') ? 'selected' : ''}} value="Tchad">Tchad</option>
                                      </select>                   
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div>
                        <p style="text-align: center; font-weight: bold;font-size: 25px;margin-top: 20px;">INSCRIPTIONS</p>
                      </div>

                      <div class="content" >
                        <div class="container-fluid">
                          <div class="row"> 
                            <div class="col-md-12">
                              <div class="card card-primary"> 
                                <div class="card-body">
                                  <div class="row">
                                    <div class="form-group col-md-6">
                                      <label>Année Académique<span style="color:red;"></span></label>
                                      <select name="school_year_id" class="form-control">
                                        @foreach($getYears as $year)
                                          <option {{ (old('school_year_id',$getRecord->school_year_id) == $year->title) ? 'selected' : '' }} value="{{$year->id}}">{{$year->title}}</option>
                                        @endforeach
                                      </select>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label>Matricule</label>
                                        <input type="text" class="form-control" name="matricule" value="{{ old('matricule',$getRecord->matricule) }}" readonly>
                                    </div>

                                    <div class="form-group col-md-6">
                                      <label>Domaine<span style="color:red;">*</span></label>  
                                      <select class="form-control"  name="domain_id" id="domain_id">
                                        <option value=""> Selectionner Domaine </option>
                                        @foreach($getDomain as $value)
                                        <option {{(old('domain_id', $getRecord->domain_id) == $value->id) ? 'selected' : ''}} value="{{ $value->id}}">{{ $value->name}}</option>
                                        @endforeach
                                      </select> 
                                    </div>

                                    <div class="form-group col-md-6">
                                      <label>Classe<span style="color:red;">*</span></label>  
                                      <select class="form-control" required name="class_id">
                                        <option value=""> Selectionner Classe </option>
                                        @foreach($getClass as $value)
                                        <option {{(old('class_id', $getRecord->class_id) == $value->id) ? 'selected' : ''}} value="{{ $value->id}}">{{ $value->name}}</option>
                                        @endforeach
                                      </select> 
                                    </div>

                                    <div class="form-group col-md-6">
                                      <label>Parcours<span style="color:red;"></span></label>
                                      <select name="parcours" class="form-control">
                                        <option value=""> Sélectionner le parcours </option>
                                        <option {{(old('parcours', $getRecord->parcours) == 'Licence') ? 'selected' : ''}} value="Licence">Licence</option>
                                        <option {{(old('parcours', $getRecord->parcours) == 'Master') ? 'selected' : ''}} value="Master">Master</option>
                                      </select>
                                    </div>

                                  <div class="form-group col-md-6">
                                      <label>Mention<span style="color:red;"></span></label>
                                      <select id="mention" name="mention" class="form-control">
                                        @foreach($getMentions as $mention)
                                        <option {{(old('mention', $getRecord->mention_id) == $mention->id) ? 'selected' : ''}} value="{{ $mention->id}}">{{ $mention->nom}}</option>
                                       @endforeach
                                      </select>  
                                    </div>  

                                    <div class="form-group col-md-6">
                                      <label>Spécialité<span style="color:red;"></span></label>
                                      <select id="subject" name="subject_id" class="form-control" required>
                                        <option value=""> Sélectionner Spécialité </option>
                                        @foreach($getSubject as $subject)
                                        <option {{(old('subject_id',$getRecord->subject_id) == $subject->id) ? 'selected' : ''}} value="{{ $subject->id }}">{{ $subject->name }}</option>
                                        @endforeach
                                      </select>
                                      <div style="color: red;"></div>
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
                                      <label>Status<span style="color:red;"></span></label>
                                      <select class="form-control" required name="status">
                                        <option value=""> Selectionner Status </option>
                                        <option {{(old('status',$getRecord->status) == 0) ? 'selected' : ''}} value= "0">Active</option>
                                        <option {{(old('status',$getRecord->status) == 1) ? 'selected' : ''}} value= "1">Inactive</option>
                                      </select>
                                    </div>

                                    <div class="form-group col-md-6">
                                      <label>Email<span style="color:red;">*</span></label>
                                      <input type="email" class="form-control" placeholder="Enter email" name="email"  value="{{ old('email',$getRecord->email) }}">

                                      <div style="color: red;">{{ $errors->first('email') }}</div>
                                    </div>
                                    <div class="form-group col-md-6">
                                      <label> Password<span style="color:red;"></span></label>
                                      <input type="text" class="form-control" placeholder="Password" name="password" >
                                      <p>Voulez-vous changer le mot de passe ? Veuillez entrer le nouveau mot de passe</p>
                                    </div>
                                  </div>

                                    <div class="card-footer" style="margin-top: 20px; width: 100%;">
                                      <button type="submit" class="btn btn-primary" style="font-size: 20px;">Enregistrer</button>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
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