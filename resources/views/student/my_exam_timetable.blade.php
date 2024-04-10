  
@extends('layouts.app')
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Mon calendrier d'examen</h1>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @forelse($getRecord as $value)
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title" style="text-align:center; width: 100%; color: blue; font-weight: bold;">{{$value['name']}} </h3>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-stripped">
                                <thead>
                                    <tr>
                                        <th>Cours</th>
                                        <th>Jour</th>
                                        <th>Date Examen</th>
                                        <th>Début de l'examen</th>
                                        <th>Fin de l'examen</th>
                                        <th>Salle</th>
                                        <th>Noté sur</th>
                                        <th>Moyenne</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($value['exam'] as $valueS)
                                    <tr>
                                        <td>{{$valueS['course_name'] }} </td>
                                        <td>
                                            @php
                                            $dayMapping = [
                                            'Monday' => 'Lundi',
                                            'Tuesday' => 'Mardi',
                                            'Wednesday' => 'Mercredi',
                                            'Thursday' => 'Jeudi',
                                            'Friday' => 'Vendredi',
                                            'Saturday' => 'Samedi',
                                            'Sunday' => 'Dimanche',
                                            ];
                                            @endphp
                                            {{ $dayMapping[date('l', strtotime($valueS['exam_date']))] }}
                                        </td>
                                        <td>{{ $valueS['exam_date'] }}</td>
                                        <td>{{$valueS['start_time']}} </td>
                                        <td>{{$valueS['end_time']}}</td>
                                        <td>{{$valueS['room_number'] }} </td>
                                        <td>{{$valueS['full_mark']}} </td>
                                        <td>{{$valueS['passing_mark'] }} </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="8">Aucun examen trouvé pour {{$value['name']}}</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @empty
                    <div class="alert alert-warning">
                        Aucun résultat trouvé.
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </section>
</div>
</div>
@endsection