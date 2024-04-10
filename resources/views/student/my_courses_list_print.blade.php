<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://rawcdn.githack.com/eKoopmans/html2pdf/master/dist/html2pdf.bundle.js"></script>
    <title>Mes ues</title>
    <style type="text/css" >
        body {
            display: grid;
            place-items: center;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }

        .content-wrapper {
            width: 100%;
            max-width: 1500px;
            background-color: #fff;
            padding: 20px;
            font-family: Arial, sans-serif;
        }

        section, div {
            margin: 20px 0;
        }

        section:last-child {
            margin-bottom: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            border: none;
        }

        th, td {
            padding: 10px;
            text-align: start;
            height: 40px;
        }

        th {
            background-color: #fff;
        }

        .nested-table {
            border: none;
            width: 100%;
            margin: 0;
        }

        .nested-table th, .nested-table td {
            border: 1px solid #000;
            padding: 5px;
            text-align: center;
        }

        #printButton {
            background-color: #3498db;
            color: #fff;
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        #printButton:hover {
            background-color: #2980b9;
        }
        @page{
            size: 8.3in 11.7in;
        }

        @page{
            size: A4;
        }

        @media print{
            @page{
                margin:0;
                margin-left: 20px;
                margin-right: 20px;
            }
        }

    </style>
</head>
<body>
     
   <div class="content-wrapper" id="page">
    <section style="justify-content:space-between;align-items: flex-start; display: flex; width: 100%; margin-top: 20px; margin-left: 20px;">
        <div style="width: 530px;display: flex;justify-content:space-between;align-items: flex-start;">
            <img src="{{ url('public/dist/img/logo.jpg')}}" class="elevation-2" alt="logo" style="height: 150px; width: 250px;"> 
            <div style="height: 125px; width: 10px; margin-top:22px;margin-left: 20px ; background-color: black;"></div> 
            <p style="font-size: 20px;margin-left: 20px;">DIRECTION DE L'ACADEMIE, DE LA PEDAGOGIE ET DE LA SCOLARITE</p>
        </div>    
        <div style="margin-right: 20px;">
            <p style="font-weight: 500;font-size: 20px; text-align: center;">REPUBLIQUE TOGOLAISE <br> <span style="font-style: italic;">Travail-Liberté-Patrie</span></p>  
        </div>
    </section>
    <div style="text-align: end; font-size: 20px;margin-right: 20px;">
        Année scolaire: {{ App\Models\SchoolYear::getActiveYear()->title }}
    </div>
        <hr style="margin-left: 20px; margin-right: 20px;margin-top: 0px; background-color:black;">
        <hr style="margin-left: 20px; margin-right: 20px; margin-top: -15px; background-color:black;">

        <section style="display: flex; justify-content: space-between; height: 100px; align-items: flex-start;margin-right: 20px; margin-bottom:50px;">
            <div style="text-align: center; margin-left: 70px;">
                <h1>FICHE DE MES UNITES D'ENSEIGNEMENTS</h1>
                <h3> {{ $getCourses[0]->domain_name }}</h3>
                <h3>Parcours: {{ $getCourses[0]->parcours }}, {{ $getCourses[0]->subject_name }}</h3>
            </div>
            <div style=" border: solid black 1px">
                <img src="{{ url('upload/profile/'.$getCourses[0]->photo) }}" alt="Photo de l'étudiant" width="153px" height="153px">
            </div>           
        </section>

        <section style="margin-right: 20px;">
            <table style="width: 100%; margin-left: 20px; border-collapse: collapse;">
                                <tr>
                    <td colspan="4">
                        <p style="font-size: 20px;">Nom et prénoms: <b>{{ $getCourses[0]->student_name }} {{ $getCourses[0]->prenom }}</b></p>
                        <p style="font-size: 20px;">Sexe: <b>{{ $getCourses[0]->sexe }}</b></p>
                        <p style="font-size: 20px;">Date et lieu de naissance: <b>{{ $getCourses[0]->date_naissance }} à {{ $getCourses[0]->lieu_naissance }} ({{ $getCourses[0]->nationalite }})</b></p>
                        <p style="font-size: 20px;">Matricule: <b>{{ $getCourses[0]->matricule}}</b></p>
                    </td>
                </tr>
                <tr>
                    <td colspan="4" style="text-align: center; font-size:20px;">LISTES DES UNITES D'ENSEIGNEMENTS</td>
                </tr>
                <tr>
                    <td style="text-align: center; font-size:20px; font-weight:bold;">Semestre: {{ $getCourses[0]->semestre }}</td>
                </tr>
                <tr>
                    <td colspan="4">
                        <table class="nested-table" width: 100%; border-collapse: collapse;" border="1">
                            <thead>
                                <th>N°</th>
                                <th>CODE UE</th>
                                <th>UE</th>
                                <th>CODE ECUE</th>
                                <th>Intutilé</th>
                                <th>Crédit</th>
                            </thead>
                            <tbody>
                                @foreach ($getCourses as $index => $course)
                                    <tr>
                                        <td style="text-align: center; font-size: 20px;">{{ $index + 1 }}</td>
                                        <td style="text-align: center; font-size: 20px;">{{ $course->code_ue }}</td>
                                        <td style="text-align: center; font-size: 20px;">{{ $course->ue }}</td>
                                        <td style="text-align: center; font-size: 20px;">{{ $course->ecue }}</td>
                                        <td style="text-align: center; font-size: 20px;">{{ $course->course_name }}</td>
                                        <td style="text-align: center; font-size: 20px;">{{ $course->credit }}</td>
                                    </tr>
                                @endforeach

                                <tr id="totalCredits">
                                    <td colspan="5" style="font-size: 20px; font-weight:500; text-align: end;">Total crédit :</td>
                                    <td style="text-align: center;" id="totalCredit">0</td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </table>
        </section>
   </div>
   <div id="printDiv">
        <a class="btn btn-primary" id="printButton">Imprimer en PDF</a>
   </div>
   <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function () {
            var totalCredit = 0;

            // Sélectionnez toutes les cellules de crédit dans le tableau
            var creditCells = document.querySelectorAll('.nested-table tbody td:nth-child(6)');

            // Parcourez chaque cellule et ajoutez le crédit au total
            creditCells.forEach(function (cell) {
                totalCredit += parseInt(cell.textContent);
            });

            // Mettez à jour le total des crédits dans la cellule correspondante
            document.getElementById('totalCredit').textContent = totalCredit;
        });

        var printButton = document.getElementById('printButton');
        var printDiv = document.getElementById('printDiv');

        printButton.addEventListener('click', function () {
            printDiv.textContent = ""
            window.print();         
        });
    </script>
 </body>
</html>
