<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body style="display: grid; place-items:center;">
    <h1>LISTE DES ETUDIANTS</h1>
    <table border="1" style="border-collapse: collapse;">
        <thead>
            <th style="width: 250px; text-align:start;">Nom</th>
            <th style="width: 250px; text-align:start;">Prénoms</th>
            <th style="width: 250px; text-align:start;">Classe</th>
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
            <td colspan="2">Aucun étudiant trouvé</td>
        </tr>
        @endforelse
        </tbody>

    </table>
</body>
</html>