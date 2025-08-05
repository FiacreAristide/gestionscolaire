<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Étudiants</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
        }
        h1 {
            color: #333;
            text-align: center;
            margin-bottom: 20px;
            font-size: 2rem;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            max-width: 1000px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            background-color: #fff;
        }
        th, td {
            text-align: left;
            padding: 12px;
            border: 1px solid #ddd;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        td[colspan="2"] {
            text-align: center;
            color: #777;
        }
    </style>
</head>
<body>
    <div>
        <h1>LISTE DES ÉTUDIANTS</h1>
        <table>
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Prénoms</th>
                    <th>Classe</th>
                </tr>
            </thead>
            <tbody>
            @forelse($getAllStudent as $student)
                <tr>
                    <td>{{$student->name}}</td>
                    <td>{{$student->prenom}}</td>
                    <td>{{$student->class_name}}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">Aucun étudiant trouvé</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</body>
</html>
