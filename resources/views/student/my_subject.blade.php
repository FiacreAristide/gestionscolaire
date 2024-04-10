@extends('layouts.app')
@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Liste de mes matières</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @include('_message')
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title" style="font-size:30px;">Matières en cours </h2>
                        </div>
                        <div class="card-body p-0">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th style="width:100px ;">Cours</th>
                                        <th style="width:100px ;">Type</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($getRecord as $value)
                                    <tr>
                                        <td>{{ $value->course_name }}</td>
                                        <td>{{ $value->course_type }}</td>
                                    </tr>
                                    @empty
                                    <tr style="text-align: center;">
                                        <td colspan="2">Aucune matière en cours trouvée.</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

  
  
  
  
  
  
  
  