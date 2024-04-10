<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Imprimer rélevé</title>
    <style>
        
        .starter{
            text-align: start;
        }
        .center{
            text-align: center;
        }
        .ender{
            text-align: end;
        }


    </style>
</head>
<body>
    <section style="width: 100%;">
        <section style=" width: 100%; margin-top:-10px;">
        <div style="text-align: center; margin-left:-500px;">
            <p style="font-size:9px; ">REPUBLIQUE TOGOLAISE</p>
            <p style="margin-top: -7px; font-size:9px;">Travail-Liberté-Patrie</p>
            <hr style="width: 80px; margin-top: -8px;">
        </div>
        <div style="margin-left: 250px; margin-top: -300px;">
            <img src="{{ url('public/dist/img/logo.jpg')}}" alt="" width="200">
        </div>
        <div style="text-align: center; margin-left:500px; margin-top: -300px;">
            <p style="font-size:9px;">MINISTERE DE L'ENSEIGNEMENT SUPERIEUR</p>
            <P style="margin-top: -7px;font-size:9px;">ET DE LA RECHERCHE</P>
            <hr style="width: 80px; margin-top: -8px;">
        </div>
    </section>
    <hr width="100%" style="margin-top: 50px;">
   
    <section id="noteSect">
        <div>
            <p style="font-size:9px; margin-left:290px;">RELEVE ANNUEL DE NOTES</p>
            <hr style="width: 80px; margin-top: -8px;">
            <p style="font-size:9px; margin-left:290px;">Année universitaire: {{ App\Models\SchoolYear::getActiveYear()->title }}</p>
        </div>

        <div id="infos" style="width: 100%;">
            <div style="width: 50%; float:left;">
                <table>
                    <tr>
                        <td colspan="2" style="font-size:9px;"><u>IDENTIFICATION</u></td>
                    </tr>
                    <tr>
                        <td style="font-size:9px;">Nom et prénom(s):</td>
                        <td style="font-size:9px;">{{$getStudent->name}} {{$getStudent->prenom}}</td>
                    </tr>
                    <tr>
                        <td style="font-size:9px;">Sexe:</td>
                        <td style="font-size:9px;">{{$getStudent->sexe}}</td>
                    </tr>
                    <tr>
                        <td style="font-size:9px;">Date-Lieu de naissance:</td>
                        <td style="font-size:9px;">{{$getStudent->date_naissance}} à {{$getStudent->lieu_naissance}}</td>
                    </tr>
                    <tr>
                        <td style="font-size:9px;">Matricule:</td>
                        <td style="font-size:9px;">{{ $getStudent->matricule}}</td>
                    </tr>
                </table>
            </div>
            <div style="width: 50%; float:right;">
                <table>
                    <tr>
                        <td colspan="2" style="font-size:9px;"><u>FORMATIONS</u></td>
                    </tr>
                    <tr>
                        <td style="font-size:9px;">Domaine:</td>
                        <td style="font-size:9px;">{{$getStudent->domain_name}}</td>
                    </tr>
                    <tr>
                        <td style="font-size:9px;">Mention:</td>
                        <td style="font-size:9px;">{{$getStudent->mention_name}}</td>
                    </tr>
                    <tr>
                        <td style="font-size:9px;">Option/Spécialité:</td>
                        <td style="font-size:9px;">{{$getStudent->subject_name}}</td>
                    </tr>
                </table>
            </div>
        </div>
    </section>

    
<section style="margin-top:90px;">
    <table style="width: 100%; border-collapse: collapse;" border="1">
        <thead>
            
            <tr>
                <th style="text-align: start;font-size:9px;">CODE UE</th>
                <th style="text-align: start;font-size:9px;">UNITE D'ENSEIGNEMENT</th>
                <th style="text-align: start;font-size:9px;">CREDIT</th>
                <th style="text-align: start;font-size:9px;">MOYENNE</th>
                <th style="text-align: start;font-size:9px;">VALIDE</th>
                <th style="text-align: start;font-size:9px;">APPRECIATION</th>
            </tr>
        @foreach($coursesBySemester as $semester => $courses)
            <tr>
                <th style="text-align: start;font-size:9px;" colspan="6">Semestre {{$semester}}</th>
            </tr>
        </thead>
        <tbody>
            
            @foreach($courses as $ueData)
            <tr>
                <td style="font-size:9px; font-weight:bold;" class="starter">{{ $ueData['code_ue'] }}</td>
                <td style="font-size:9px; font-weight:bold;" class="starter">{{$ueData['ue']}}</td>
                <td style="font-size:9px;" class="ender">{{ $ueData['credits'] }}</td>
                <td style="font-size:9px;" class="ender">{{ number_format($ueData['average'],2) }}</td>
                <td style="font-size:9px;" class="center">{{ $ueData['valid'] ? 'OUI' : 'NON' }}</td>
                <td style="font-size:9px;" class="center">
                    @if (number_format($ueData['average'],2) >= 10)
                        <span style="color: green; font-weight:bold;font-size:9px;">Valide</span>
                    @else
                        <span style="color: red; font-weight:bold;font-size:9px;">Non Valide</span>
                    @endif
                </td>
            </tr>
            @foreach($ueData['courses'] as $course)
            <tr>
                <td style="font-size:9px;" class="starter">{{ $course['ecue'] }}</td>
                <td style="font-size:9px;" class="starter">{{ $course['course_name'] }}</td>
                <td style="font-size:9px;" class="ender">{{ $course['credit'] }}</td>
                <td style="font-size:9px;" class="ender">{{ number_format($course['average'],2) }}</td>
                <td style="font-size:9px;" class="center">
                    @if (number_format($course['average'],2) >= 10)
                        <span style="color: green; font-weight:bold;font-size:9px;">OUI</span>
                    @else
                        <span style="color: red; font-weight:bold;font-size:9px;">NON</span>
                    @endif
                </td>
                <td class="center">
                    @if( number_format($course['average'],2) >= 10 && number_format($course['average'],2) < 11 )
                        <span style="color: blue; font-weight:bold;font-size:9px;">Passable</span>
                    @elseif( 11 <= number_format($course['average'],2) && number_format($course['average'],2) < 14 )
                        <span style="color: blue; font-weight:bold;font-size:9px;">Assez-Bien</span>
                    @elseif( 14 <= number_format($course['average'],2) && number_format($course['average'],2) < 16 )
                        <span style="color: blue; font-weight:bold;font-size:9px;">Bien</span>
                    @elseif( 16 <= number_format($course['average'],2) && number_format($course['average'],2) < 18 )
                        <span style="color: blue; font-weight:bold;font-size:9px;">Très-Bien</span>
                    @elseif( 18 <= number_format($course['average'],2) && number_format($course['average'],2) <= 20 )
                        <span style="color: blue; font-weight:bold;font-size:9px;">Excellent</span>
                    @else
                        <span style="color: blue; font-weight:bold;font-size:9px;">Médiocre</span>
                    @endif
                </td>
            </tr>
            @endforeach
        @endforeach
        @endforeach
        </tbody>
    </table>
</section>
<div>
@php
    $totalAverage = 0;
    $totalUes = 0;
@endphp

@foreach($coursesBySemester as $semester => $courses)
    @foreach($courses as $ueData)
        @php
            $totalAverage += number_format($ueData['average'],2);
            $totalUes += 1;
        @endphp
    @endforeach
@endforeach

@php
    $annualAverage = $totalUes > 0 ? $totalAverage / $totalUes : 0;
@endphp

<p style="font-size:9px;">TOTAL DES CREDITS CAPITALISES {{$getTotalCredit}}/{{$getTotalCredit}}</p>
<p style="font-size:9px;">Moyenne annuelle:<span style="font-weight: bold;"> {{ number_format($annualAverage, 2) }}</span></p>
<p style="font-size:9px;">Mention:
@if( number_format($annualAverage, 2) >= 10 && number_format($annualAverage, 2) < 11 )
    <span style="font-weight:bold;font-size:9px;"> Passable</span>
@elseif( 11 <= number_format($annualAverage, 2) && number_format($annualAverage, 2) < 14 )
    <span style="font-weight:bold;font-size:9px;"> Assez-Bien</span>
@elseif( 14 <= number_format($annualAverage, 2) && number_format($annualAverage, 2) < 16 )
    <span style="font-weight:bold;font-size:9px;"> Bien</span>
@elseif( 16 <= number_format($annualAverage, 2) && number_format($annualAverage, 2) < 18 )
    <span style="font-weight:bold;font-size:9px;"> Très-Bien</span>
@elseif( 18 <= number_format($annualAverage, 2) && number_format($annualAverage, 2) <= 20 )
    <span style="font-weight:bold;font-size:9px;"> Excellent</span>
@else
    <span style="font-weight:bold;font-size:9px;">Médiocre</span>
@endif

</p>
</div>
</section>
</body>
</html>
