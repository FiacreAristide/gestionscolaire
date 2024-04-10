<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carte étudiant</title>
    <style>
        body{
            margin: 0;
            padding-top: 50px;
            display: grid;
            place-items: center;
        }

        .cardDiv{
            height: 210px;
            width: 330px;
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            border: 1px solid black;
        }

       
    </style>
</head>
<body>
        <section class="cardDiv" style="margin-left: 190px;">
            <div style="width:122px; height: 180px;display: block; float:left;">
                <div style="text-align: center; margin-left: 5px;">
                    <span style="font-size: 9px;">ANNEE ACADEMIQUE</span> <br>
                    <span style="font-size: 9px; font-weight: bold;">{{ $getInfos[0]->school_year_name }}</span>
                    <img style="margin-top: 7px; border: 2px black;" src="{{ url('upload/profile/'.$getInfos[0]->profile_pic) }}" alt="" width="80" height="100" >
                </div>
            <p style="font-size: 9px; margin-left: 5px;"><span>Contact: </span>{{ $getInfos[0]->telephone }}</p>
            <div style="background-color: rgba(177, 109, 109, 0.589); color: white; text-align: center; height: 20px;">https:://hest-edu.fr</div>
            </div>
            <div style="width: 215px; height: 210px;float:right; ">
                <div style="float:right;margin-top:2px;">
                    <img src="{{ url('public/dist/img/logo.jpg')}}" alt="" width="60" height="30" style="margin-right: 5px;">
                </div>
                <div>
                    <p style="font-size: 9px; text-align: center; margin-top: 23px; margin-right: 54px; margin-bottom: -2px;">CARTE D'ETUDIANT</p>
                    <span style="font-size: 9px;">Matricule: {{ $getInfos[0]->matricule }}</span> <br>
                    <span style="font-size: 9px;">Nom: <b>{{ $getInfos[0]->name }}</b></span> <br>
                    <span style="font-size: 9px;">Prenom: <b>{{ $getInfos[0]->prenom }}</b></span> <br>
                    <span style="font-size: 9px;">Mention: {{ $getInfos[0]->mention_name }}</span> <br>
                    <span style="font-size: 9px;">Spécialité: {{ $getInfos[0]->subject_name }}</span> <br>
                    <span style="font-size: 9px;">Niveau:
                    @if($getInfos[0]->parcours == "Licence" && $getInfos[0]->semestre == "01") 
                        Licence 1
                    @elseif($getInfos[0]->parcours == "Licence" && $getInfos[0]->semestre == "02")
                        Licence 1
                    @elseif($getInfos[0]->parcours == "Licence" && $getInfos[0]->semestre == "03")
                        Licence 2
                    @elseif($getInfos[0]->parcours == "Licence" && $getInfos[0]->semestre == "04") 
                        Licence 2
                    @elseif($getInfos[0]->parcours == "Licence" && $getInfos[0]->semestre == "05")
                        Licence 3
                    @elseif($getInfos[0]->parcours == "Licence" && $getInfos[0]->semestre == "06")
                        Licence 3    
                    @elseif($getInfos[0]->parcours == "Master" && $getInfos[0]->semestre == "01")
                        Master 1
                    @elseif($getInfos[0]->parcours == "Master" && $getInfos[0]->semestre == "02")
                        Master 1
                    @elseif($getInfos[0]->parcours == "Master" && $getInfos[0]->semestre == "03")
                        Master 2        
                    @elseif($getInfos[0]->parcours == "Master" && $getInfos[0]->semestre == "04")
                        Master 2
                    @endif
                </span><br>
                </div>
                <div style="margin-left: 20px; margin-top: 10px;">
                    <img src="data:image/png;base64,{!! base64_encode(QrCode::format('png')->size(40)->generate($qrCodeInfos)) !!}" alt="qrCode">
                </div>
            </div>
        </section>

        <section class="cardDiv" style="display: block;margin-left: 190px; ">
            <div style="font-size: 10px;margin-top: 10px; margin-left: 15px;">
                <span>Date de naissance: {{ date('d-m-Y', strtotime($getInfos[0]->date_naissance)) }}</span> <br>
                <span>Lieu: {{ $getInfos[0]->lieu_naissance }}</span> <br>
                <span>Contact parent: {{ $getInfos[0]->tel_prev }}</span>   
            </div>
            <div style="text-align: center; margin-top: 10px;">
                <div>
                    <img src="{{ url('public/dist/img/logo.jpg')}}" alt="" width="100" height="50">
                </div>
                <div style="margin-top: -5px;">
                    <p style="font-size: 9px;" >HAUTES ETUDES DES SCIENCES ET TECHNOLOGIES</p>
                    <p style="margin-top: -10px; font-size: 9px; margin-bottom: 2px;">Tokoin Wuiti, 134, Avenue Jean Paul II, Lomé-Togo</p>
                    <span style="font-size: 9px; margin-top: 2px;">Tél: +228 91 24 50 50</span><br>
                    <span style="font-size: 9px;">Tél: +228 96 24 50 50</span><br>
                    <span style="font-size: 9px;">Tél: +228 22 61 86 34</span>
                </div>
            </div>
        </section>
</body>
</html>