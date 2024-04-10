@extends('layouts.app')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Classes & Enseignants</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ url('admin/class_teacher/add') }}" class="btn btn-primary">Associer</a>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Rechercher Domaine-Spécialisation</h3>
                        </div>
                        <div class="card card-primary">
                            <form method="get" action="">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-3">
                                            <label>Classe</label>
                                            <input type="text" class="form-control" name="class_name"
                                                value="{{ Request::get('class_name')}}">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label>Nom Enseignant</label>
                                            <input type="text" class="form-control" name="name"
                                                value="{{ Request::get('name')}}">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label>Status</label>
                                            <select class="form-control" name="gender">
                                                <option value=""> Sélectionner Status </option>
                                                <option {{(Request::get('status') == 100) ? 'selected' : ''}} value="100">
                                                    Active
                                                </option>
                                                <option {{(Request::get('status') == 1) ? 'selected' : ''}} value="1">
                                                    Inactive
                                                </option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label>Date</label>
                                            <input type="date" class="form-control" name="date"
                                                value="{{ Request::get('date')}}" placeholder="date">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="form-group col-md-3">
                            <button class="btn btn-primary" type="submit" style="margin-top: 32px;">Rechercher</button>
                            <a class="btn btn-success" style="margin-top: 32px;"href="{{ url('admin/class_teacher/list')}}">Annuler</a>
                        </div>
                    </div>

                    @include('_message')

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Liste Classes-Enseignants</h3>
                        </div>

                        <div class="card-body p-0">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th style="text-align: center;">id</th>
                                        <th style="text-align: center;">Classe</th>
                                        <th style="text-align: center;">Enseigant</th>
                                        <th style="text-align: center;">Status</th>
                                        <th style="text-align: center;">Ajouté par</th>
                                        <th style="text-align: center;">Ajouté le</th>
                                        <th style="text-align: center;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($getRecord as $value)
                                    <tr>
                                        <td>{{ $value->id }}</td>
                                        <td>{{ $value->class_name }}</td>
                                        <td>{{ $value->teacher_name }} {{ $value->teacher_prenom}}</td>
                                        <td>
                                            @if($value->status == 0)
                                               Active
                                            @else
                                               Inactive
                                            @endif
                                        </td>
                                        <td>{{ $value->created_by_name}}</td>
                                        <td>{{ date('d-m-Y H:i ', strtotime($value->created_at)) }}</td>
                                        <td>
                                            <a href="{{ url('admin/class_teacher/edit_single/'.$value->id)}}"
                                                class="btn btn-primary">Modifier uniquement </a>
                                            <a href="{{ url('admin/class_teacher/edit/'.$value->id)}}"
                                                class="btn btn-primary">Modifier tout</a>
                                            <a href="{{url('admin/class_teacher/delete/'.$value->id)}}"
                                                class="btn btn-danger">Supprimer</a>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="100%" style="text-align: center;">Aucun résultat trouvé</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <div style="padding: 10px; float: right;">
                                {!! $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection
