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
                        <input type="text" class="form-control" placeholder="nom" name="name" required value="{{ old('name') }}">
                      </div>

                      <div class="form-group col-md-12">
                        <label>Prénom<span style="color:red;">*</span></label>
                        <input type="text" class="form-control" placeholder="prénom" name="prenom" required value="{{ old('prenom') }}">
                      </div>


                      <div class="form-group col-md-12">
                        <label>Date de naissance<span style="color:red;">*</span></label>
                        <input type="date" class="form-control" placeholder="" name="date_naissance" required value="{{ old('date_naissance') }}">
                      </div>


                      <div class="form-group col-md-12">
                        <label>Lieu de Naissance<span style="color:red;">*</span></label>
                        <input type="text" class="form-control" placeholder="" name="lieu_naissance" required value="{{ old('lieu_naissance') }}">
                      </div>

                      <div class="form-group col-md-12">
                        <label>Pays de naissance<span style="color:red;">*</span></label>
                        <select required class="form-control" id="pays_naissance" name="pays_naissance">
                          <option value="Togo">Togo</option>
                          <option value="Benin">Benin</option>
                          <option value="Burkina-Faso">Burkina Faso</option>
                          <option value="Cameroun">Cameroun</option>
                          <option value="Cote-ivoire">Cote D'Ivoire</option>
                          <option value="Ghana">Ghana</option>
                          <option value="Niger">Niger</option>
                          <option value="Nigeria">Nigeria</option>
                          <option value="Tchad">Tchad</option>
                        </select>
                      </div>
                      <div class="form-group col-md-12">
                        <label>Nationalité<span style="color:red;">*</span></label>
                        <input type="text" class="form-control" placeholder="nationalité" name="nationalite" required value="{{ old('nationalite') }}">
                      </div>


                      <div class="form-group col-md-12">
                        <label>Ethnie</label>
                        <input type="text" class="form-control" placeholder="ethnie" name="ethnie" required value="{{ old('ethnie') }}">
                      </div>

                      <div class="form-group col-md-12">
                        <label>Préfecture</label>
                        <input type="text" class="form-control" placeholder="" name="prefecture" required value="{{ old('prefecture') }}">
                      </div>

                      <div class="form-group col-md-12">
                        <label>Sexe</label>
                        <select required class="form-control" id="sexe" name="sexe">
                          <option value="Masculin">Masculin</option>
                          <option value="Féminin">Féminin</option>
                          <option value="Autre">Autres</option>
                        </select>
                      </div>

                      <div class="form-group col-md-12">
                        <label for="profile_pic">Photo</label>
                        <input class="form-control" type="file" name="profile_pic" id="profile_pic">
                      </div>

                      <div class="form-group col-md-12">
                        <label>Situation Matrimoniale</label>
                        <select class="form-control" name="situation_matrimoniale">
                          <option value=""> Selectionner status </option>
                          <option value="Célibataire">Célibataire</option>
                          <option value="Marié">Marié(é)</option>
                          <option value="Veuve">Veuve</option>
                          <option value="Divorcé">Divorcé(e)</option>
                        </select>                        
                        
                      </div>


                      <div class="form-group col-md-12">
                        <label>Adresse<span style="color:red;"></span></label>
                        <input type="text" class="form-control" placeholder="Adresse" name="adresse" value="{{ old('adresse') }}">
                      </div>

                      <div class="form-group col-md-12">
                        <label>BP</label>
                        <input type="text" class="form-control" placeholder="BP:xxxx" name="boite_postale" value="{{ old('boite_postale') }}">
                      </div>

                      <div class="form-group col-md-12">
                        <label>Ville</label>
                        <input type="text" class="form-control" placeholder="" name="ville" value="{{ old('ville') }}">
                      </div> 

                      <div class="form-group col-md-12">
                        <label>Pays de résidence</label>
                        <select class="form-control" id="pays_residence" name="pays_residence">
                          <option {{(old('pays_residence') == 'Togo') ? 'selected' : ''}}  value="TG">Togo</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="Afghanistan">Afghanistan</option>
                          <option {{(old('pays_residence') == 'Aland Islands') ? 'selected' : ''}} value="Aland Islands">Aland Islands</option>
                          <option {{(old('pays_residence') == 'Albania') ? 'selected' : ''}} value="Albania">Albania</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="Algeria">Algeria</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="American Samoa">American Samoa</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="Andorra">Andorra</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="Angola">Angola</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="Anguilla">Anguilla</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="Antarctica">Antarctica</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="Antigua and Barbuda">Antigua and Barbuda</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="Argentina">Argentina</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="Armenia">Armenia</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="Aruba">Aruba</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="Australia">Australia</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="Austria">Austria</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="Azerbaijan">Azerbaijan</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="Bahamas">Bahamas</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="Bahrain">Bahrain</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="Bangladesh">Bangladesh</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="Barbados">Barbados</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="Belarus">Belarus</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="Belgium">Belgium</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="Belize">Belize</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="Benin">Benin</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="Bermuda">Bermuda</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="BT">Bhutan</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="BO">Bolivia</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="BQ">Bonaire, Sint Eustatius and Saba</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="BA">Bosnia and Herzegovina</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="BW">Botswana</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="BV">Bouvet Island</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="BR">Brazil</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="IO">British Indian Ocean Territory</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="BN">Brunei Darussalam</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="BG">Bulgaria</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="BF">Burkina Faso</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="BI">Burundi</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="KH">Cambodia</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="CM">Cameroon</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="CA">Canada</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="CV">Cape Verde</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="KY">Cayman Islands</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="CF">Central African Republic</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="TD">Chad</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="CL">Chile</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="CN">China</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="CX">Christmas Island</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="CC">Cocos (Keeling) Islands</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="CO">Colombia</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="KM">Comoros</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="CG">Congo</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="CD">Congo, Democratic Republic of the Congo</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="CK">Cook Islands</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="CR">Costa Rica</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="CI">Cote D'Ivoire</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="HR">Croatia</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="CU">Cuba</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="CW">Curacao</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="CY">Cyprus</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="CZ">Czech Republic</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="DK">Denmark</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="DJ">Djibouti</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="DM">Dominica</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="DO">Dominican Republic</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="EC">Ecuador</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="EG">Egypt</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="SV">El Salvador</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="GQ">Equatorial Guinea</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="ER">Eritrea</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="EE">Estonia</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="ET">Ethiopia</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="FK">Falkland Islands (Malvinas)</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="FO">Faroe Islands</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="FJ">Fiji</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="FI">Finland</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="FR">France</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="GF">French Guiana</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="PF">French Polynesia</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="TF">French Southern Territories</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="GA">Gabon</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="GM">Gambia</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="GE">Georgia</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="DE">Germany</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="GH">Ghana</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="GI">Gibraltar</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="GR">Greece</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="GL">Greenland</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="GD">Grenada</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="GP">Guadeloupe</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="GU">Guam</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="GT">Guatemala</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="GG">Guernsey</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="GN">Guinea</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="GW">Guinea-Bissau</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="GY">Guyana</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="HT">Haiti</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="HM">Heard Island and Mcdonald Islands</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="VA">Holy See (Vatican City State)</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="HN">Honduras</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="HK">Hong Kong</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="HU">Hungary</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="IS">Iceland</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="IN">India</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="ID">Indonesia</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="IR">Iran, Islamic Republic of</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="IQ">Iraq</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="IE">Ireland</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="IM">Isle of Man</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="IL">Israel</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="IT">Italy</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="JM">Jamaica</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="JP">Japan</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="JE">Jersey</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="JO">Jordan</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="KZ">Kazakhstan</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="KE">Kenya</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="KI">Kiribati</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="KP">Korea, Democratic People's Republic of</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="KR">Korea, Republic of</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="XK">Kosovo</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="KW">Kuwait</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="KG">Kyrgyzstan</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="LA">Lao People's Democratic Republic</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="LV">Latvia</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="LB">Lebanon</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="LS">Lesotho</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="LR">Liberia</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="LY">Libyan Arab Jamahiriya</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="LI">Liechtenstein</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="LT">Lithuania</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="LU">Luxembourg</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="MO">Macao</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="MK">Macedonia, the Former Yugoslav Republic of</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="MG">Madagascar</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="MW">Malawi</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="MY">Malaysia</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="MV">Maldives</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="ML">Mali</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="MT">Malta</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="MH">Marshall Islands</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="MQ">Martinique</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="MR">Mauritania</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="MU">Mauritius</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="YT">Mayotte</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="MX">Mexico</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="FM">Micronesia, Federated States of</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="MD">Moldova, Republic of</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="MC">Monaco</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="MN">Mongolia</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="ME">Montenegro</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="MS">Montserrat</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="MA">Morocco</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="MZ">Mozambique</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="MM">Myanmar</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="NA">Namibia</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="NR">Nauru</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="NP">Nepal</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="NL">Netherlands</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="AN">Netherlands Antilles</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="NC">New Caledonia</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="NZ">New Zealand</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="NI">Nicaragua</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="NE">Niger</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="NG">Nigeria</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="NU">Niue</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="NF">Norfolk Island</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="MP">Northern Mariana Islands</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="NO">Norway</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="OM">Oman</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="PK">Pakistan</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="PW">Palau</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="PS">Palestinian Territory, Occupied</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="PA">Panama</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="PG">Papua New Guinea</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="PY">Paraguay</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="PE">Peru</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="PH">Philippines</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="PN">Pitcairn</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="PL">Poland</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="PT">Portugal</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="PR">Puerto Rico</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="QA">Qatar</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="RE">Reunion</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="RO">Romania</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="RU">Russian Federation</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="RW">Rwanda</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="BL">Saint Barthelemy</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="SH">Saint Helena</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="KN">Saint Kitts and Nevis</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="LC">Saint Lucia</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="MF">Saint Martin</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="PM">Saint Pierre and Miquelon</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="VC">Saint Vincent and the Grenadines</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="WS">Samoa</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="SM">San Marino</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="ST">Sao Tome and Principe</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="SA">Saudi Arabia</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="SN">Senegal</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="RS">Serbia</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="CS">Serbia and Montenegro</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="SC">Seychelles</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="SL">Sierra Leone</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="SG">Singapore</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="SX">Sint Maarten</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="SK">Slovakia</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="SI">Slovenia</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="SB">Solomon Islands</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="SO">Somalia</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="ZA">South Africa</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="GS">South Georgia and the South Sandwich Islands</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="SS">South Sudan</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="ES">Spain</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="LK">Sri Lanka</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="SD">Sudan</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="SR">Suriname</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="SJ">Svalbard and Jan Mayen</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="SZ">Swaziland</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="SE">Sweden</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="CH">Switzerland</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="SY">Syrian Arab Republic</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="TW">Taiwan, Province of China</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="TJ">Tajikistan</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="TZ">Tanzania, United Republic of</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="TH">Thailand</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="TL">Timor-Leste</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="TG">Togo</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="TK">Tokelau</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="TO">Tonga</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="TT">Trinidad and Tobago</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="TN">Tunisia</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="TR">Turkey</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="TM">Turkmenistan</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="TC">Turks and Caicos Islands</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="TV">Tuvalu</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="UG">Uganda</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="UA">Ukraine</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="AE">United Arab Emirates</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="GB">United Kingdom</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="US">United States</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="UM">United States Minor Outlying Islands</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="UY">Uruguay</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="UZ">Uzbekistan</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="VU">Vanuatu</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="VE">Venezuela</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="VN">Viet Nam</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="VG">Virgin Islands, British</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="VI">Virgin Islands, U.s.</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="WF">Wallis and Futuna</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="EH">Western Sahara</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="YE">Yemen</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="ZM">Zambia</option>
                          <option {{(old('pays_residence') == 'Afghanistan') ? 'selected' : ''}} value="ZW">Zimbabwe</option>
                        </select> 
                      </div>

                      <div class="form-group col-md-12">
                        <label>Téléphone</label>
                        <input type="tel" class="form-control" name="telephone" value="{{ old('telephone') }}" placeholder="99-99-99-99" pattern="(9[0-9]|7[0-9])-[0-9]{2}-[0-9]{2}-[0-9]{2}">
                      </div> 

                      <div class="form-group col-md-12">
                        <label>Nom et prénoms Père<span style="color:red;">*</span></label>
                        <input type="text" class="form-control" placeholder="" name="nom_pere"  value="{{ old('nom_pere') }}">
                      </div>

                      <div class="form-group col-md-12">
                        <label>Profession père<span style="color:red;">*</span></label>
                        <input type="text" class="form-control" placeholder="" name="prof_pere"  value="{{ old('prof_pere') }}">
                    
                      </div>

                      <div class="form-group col-md-12">
                        <label>Téléphone père</label>
                        <input type="tel" class="form-control" name="tel_pere" value="{{ old('tel_pere') }}" placeholder="99-99-99-99" pattern="(9[0-9]|7[0-9])-[0-9]{2}-[0-9]{2}-[0-9]{2}">
                      </div> 

                      <div class="form-group col-md-12">
                        <label>Nom et prénoms Mère<span style="color:red;">*</span></label>
                        <input type="text" class="form-control" placeholder="" name="nom_mere" value="{{ old('nom_mere') }}">
                      </div>

                      <div class="form-group col-md-12">
                        <label>Profession mère<span style="color:red;">*</span></label>
                        <input type="text" class="form-control" placeholder="" name="prof_mere" value="{{ old('prof_mere') }}">
                      </div>

                      <div class="form-group col-md-12">
                        <label>Téléphone mère</label>
                        <input type="tel" class="form-control" name="tel_mere" value="{{ old('tel_mere') }}" placeholder="99-99-99-99" pattern="(9[0-9]|7[0-9])-[0-9]{2}-[0-9]{2}-[0-9]{2}">
                      </div> 

                      <div class="form-group col-md-12">
                        <label>Boursier</label> <br>
                        <input type="radio" id="oui_boursier" name="boursier" value="OUI"> OUI <br>
                        <input type="radio" id="non_boursier" name="boursier" value="NON"> NON
                      </div> 

                      <div class="form-group col-md-12">
                        <label>Organisme</label>
                        <input type="text" class="form-control" placeholder="" name="organisme" value="{{ old('organisme') }}">
                      </div>

                      <div class="form-group col-md-12">
                        <label>Début de la bourse</label>
                        <input type="date" class="form-control" placeholder="" name="debut_bourse" value="{{ old('debut_bourse') }}">
                        <div style="color: red;"></div>
                      </div>

                      <div class="form-group col-md-12">
                        <label>Religion</label>
                        <select class="form-control" name="religion">
                          <option value="Catholique">Catholique</option>
                          <option value="Protestant">Protestant</option>
                          <option value="Musulman">Musulman</option>
                          <option value="Autres">Autres</option>
                        </select>
                      </div>

                      <div class="form-group col-md-12">
                        <label>Salarié(e)</label> <br>
                        <input type="radio" name="salarie" value="Oui"> OUI <br>
                        <input type="radio" name="salarie" value="Non" > NON
                      </div> 

                      <div class="form-group col-md-12">
                        <label>Profession</label>
                        <input type="text" class="form-control" placeholder="" name="prof_salaire" value="{{ old('prof_salaire') }}">
                        <div style="color: red;"></div>
                      </div>

                      <div class="form-group col-md-12">
                        <label for="etatPhys">État physique :</label>
                        <select id="etatPhys" name="etatPhys" class="form-control">
                          <option value="bonneSante">En bonne santé</option>
                          <option value="maladieLegere">Maladie légère</option>
                          <option value="maladieChronique">Maladie chronique</option>
                          <option value="convalescence">Convalescence</option>
                          <option value="autre">Autres</option>
                        </select>
                      </div>

                      <div class="form-group col-md-12">
                        <label for="handicap">Handicap :</label>
                        <select id="handicap" name="handicap" class="form-control">
                          <option value="aucun">Aucun handicap</option>
                          <option value="moteur">Handicap moteur</option>
                          <option value="visuel">Handicap visuel</option>
                          <option value="auditif">Handicap auditif</option>
                          <option value="cognitif">Handicap cognitif</option>
                          <option value="invisible">Handicap invisible</option>
                        </select>
                      </div>

                      <div class="form-group col-md-12">
                        <label for="person_prev">Personne à prévenir :</label>
                        <input type="text" class="form-control" id="person_prev" name="person_prev" placeholder="Nom de la personne" value="{{ old('person_prev') }}">
                      </div>

                      <div class="form-group col-md-12">
                        <label for="tel_prev">Téléphone de la personne :</label>
                        <input type="tel" class="form-control" id="tel_prev" name="tel_prev" placeholder="Numéro de téléphone" value="{{ old('tel_prev') }}">
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
                                      <input type="text" class="form-control" placeholder="Année" name="annee_bac" value="{{ old('annee_bac') }}">
                                    </div>

                                    <div class="form-group col-md-6">
                                      <label>Mention<span style="color:red;">*</span></label>
                                      <select id="mention_bac" name="mention_bac" class="form-control">
                                        <option value="Passable">Passable</option>
                                        <option value="Assez-bien">Assez-bien</option>
                                        <option value="Bien">Bien</option>
                                        <option value="Très-Bien">Très-Bien</option>
                                      </select>                     
                                    </div>

                                    <div class="form-group col-md-6">
                                      <label>Série<span style="color:red;">*</span></label>
                                      <select id="serie" name="serie" class="form-control">
                                        <option value="A4">A4</option>
                                        <option value="D">D</option>
                                        <option value="C">C</option>
                                        <option value="E">E</option>
                                        <option value="Ti">Ti</option>
                                      </select>
                                    </div>

                                    <div class="form-group col-md-6">
                                      <label>Numéro de table<span style="color:red;">*</span></label>
                                      <input type="text" class="form-control" placeholder="Numéro de table" name="num_table" value="{{ old('num_table') }}">
                                    </div>

                                    <div class="form-group col-md-6">
                                      <label>Pays d'obtention du bac<span style="color:red;">*</span></label>
                                      <select class="form-control" id="pays_obtention" name="pays_obtention">
                                        <option value="Togo">Togo</option>
                                        <option value="Benin">Benin</option>
                                        <option value="Burkina-Faso">Burkina Faso</option>
                                        <option value="Cameroun">Cameroun</option>
                                        <option value="Cote-ivoire">Cote D'Ivoire</option>
                                        <option value="Ghana">Ghana</option>
                                        <option value="Niger">Niger</option>
                                        <option value="Nigeria">Nigeria</option>
                                        <option value="Tchad">Tchad</option>
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
                                      <label>Année Académique<span style="color:red;">*</span></label>
                                      <select name="school_year_id" class="form-control">
                                          @if ($getActiveYear)
                                              <option value="{{ $getActiveYear->id }}">{{ $getActiveYear->title }}</option>
                                          @endif
                                      </select>

                                    </div>

                                    <div class="form-group col-md-6">
                                        <label>Matricule</label>
                                        <input type="text" class="form-control" name="matricule" value="{{ $getMatricule }}" readonly>
                                    </div>


                                    <div class="form-group col-md-6">
                                      <label>Domaine<span style="color:red;">*</span></label>  
                                      <select class="form-control" required name="domain_id" id="domain_id">
                                        <option value=""> Selectionner Domaine </option>
                                        @foreach($getDomain as $value)
                                        <option value="{{ $value->id}}">{{ $value->name}}</option>
                                        @endforeach
                                      </select> 
                                    </div>

                                    <div class="form-group col-md-6">
                                      <label>Classe<span style="color:red;">*</span></label>  
                                      <select id="myclass" class="form-control" required name="class_id">
                                        <option value=""> Selectionner Classe </option>
                                        @foreach($getClass as $value)
                                        <option value="{{ $value->id}}">{{ $value->name}}</option>
                                        @endforeach
                                      </select> 
                                    </div>

                                    <div class="form-group col-md-6">
                                      <label>Parcours<span style="color:red;">*</span></label>
                                      <select id="parcours" name="parcours" class="form-control" required>
                                        <option value=""> Sélectionner le parcours</option>
                                        <option value="Licence">Licence</option>
                                        <option value="Master">Master</option>
                                      </select>
                                    </div>


                                    <div class="form-group col-md-6">
                                      <label>Mention<span style="color:red;"></span></label>
                                      <select id="mention" name="mention" class="form-control">
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
                                      <label>Status<span style="color:red;">*</span></label>
                                      <select class="form-control" required name="status">
                                        <option value=""> Selectionner Status </option>
                                        <option value= "0">Active </option>
                                        <option value= "1">Inactive</option>
                                      </select>
                                    </div>

                                    <div class="form-group col-md-6">
                                      <label>Email<span style="color:red;">*</span></label>
                                      <input type="email" class="form-control" placeholder="Enter email" name="email" required value="{{ old('email') }}">
                                    </div>

                                    <div class="form-group col-md-6">
                                      <label> Password<span style="color:red;">*</span></label>
                                      <input type="password" class="form-control" placeholder="Password" name="password" required value="{{ old('password') }}">
                                    </div>

                                    <div class="card-footer" style="margin-top: 20px; width: 100%;">
                                      <button type="submit" class="btn btn-primary" style="font-size: 20px;">Inscrire</button>
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
            var subjects = {!! $getSubject !!};
            var classes = {!! $getClass !!};
        </script>
        <script type="text/javascript">
            document.getElementById('domain_id').addEventListener('change', function() {
                var domainId = this.value;
                var mentionSelect = document.getElementById('mention');
                var subjectSelect = document.getElementById('subject');
                var classSelect = document.getElementById('myclass');
                
                // Effacer les anciennes options
                mentionSelect.innerHTML = '';
                subjectSelect.innerHTML = '';
                classSelect.innerHTML = '';
                
                // Filtrer les mentions en fonction du domaine sélectionné
                var filteredMentions = mentions.filter(function(mention) {
                    return mention.domain_id == domainId;
                });

                // Filtrer les spécialités en fonction du domaine sélectionné
                var filteredSubjects = subjects.filter(function(subject) {
                    return subject.domain_id == domainId;
                });

                // Filtrer les classes en fonction du domaine sélectionné
                var filteredClasses = classes.filter(function(myclass) {
                    return myclass.domain_id == domainId;
                });

                // Ajouter les options filtrées à la liste déroulante
                filteredMentions.forEach(function(mention) {
                    var option = document.createElement('option');
                    option.value = mention.id;
                    option.text = mention.nom;
                    mentionSelect.appendChild(option);
                });

                // Ajouter les options filtrées à la liste déroulante
                filteredSubjects.forEach(function(subject) {
                    var option = document.createElement('option');
                    option.value = subject.id;
                    option.text = subject.name;
                    subjectSelect.appendChild(option);
                });

                // Ajouter les options filtrées à la liste déroulante
                filteredClasses.forEach(function(myclass) {
                    var option = document.createElement('option');
                    option.value = myclass.id;
                    option.text = myclass.name;
                    classSelect.appendChild(option);
                });
            });
        </script>
        @endsection


