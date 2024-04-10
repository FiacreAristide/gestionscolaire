<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body style="display: grid; place-items:center;">
    <h1>LISTE DES ENSEIGNANTS</h1>
    <table border="1" style="border-collapse: collapse;">
        <thead>
            <th style="width: 250px; text-align:start;">Nom</th>
            <th style="width: 250px; text-align:start;">Prénoms</th>
        </thead>
        <tbody>
        @forelse($getTeacherList as $teacher)
            <tr>
                <td>{{$teacher->name}}</td>
                <td>{{$teacher->prenom}}</td>
            </tr>
        @empty
        <tr>
            <td colspan="2">Aucun enseignant trouvé</td>
        </tr>
        @endforelse
        </tbody>

    </table>
</body>
</html>