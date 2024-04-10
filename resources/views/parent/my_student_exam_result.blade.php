  @extends('layouts.app')
  @section('content')

  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Résultat d'examen de ({{ $getStudent->name}} {{ $getStudent->prenom}})</h1>
          </div>
        </div>
      </div>
    </section>
    <section class="content">
      <div class="container-fluid" >
        <div class="row">

        @foreach($getRecord as $value)
          <div class="col-md-12">   
            <div class="card">
              <div class="card-header">
                <h2 class="card-title" style="font-size:30px;">{{ $value['exam_name']}} </h2>
              </div>
              <div class="card-body p-0">
                <table class="table">
                  <thead>
                    <tr>                      
                      <th>Cours</th>
                      <th>Note de devoir</th>
                      <th>Note d'examen</th>
                      <th>Moyenne</th>
                      <th>Noté sur</th>
                      <th>Validé</th>
                      <th>Appreciation</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($value['course'] as $exam)
                    <tr>
                        <td style="text-align: start;">{{$exam['course_name']}}</td>
                        <td style="text-align: end;">{{$exam['note_devoir']}}</td>
                        <td style="text-align: end;">{{$exam['note_exam']}}</td>
                        <td style="text-align: end;">{{$exam['average']}}</td>
                        <td style="text-align: end;">{{$exam['full_mark']}}</td>
                        <td style="text-align: end;">
                          @if($exam['average'] >= $exam['passing_mark'])
                          <span style="color: green; font-weight:bold;">OUI</span>
                          @else
                          <span style="color: red; font-weight:bold;">NON</span>
                          @endif
                        </td>
                        <td style="text-align: end;">
                          @if( $exam['passing_mark'] <= $exam['average'] && $exam['average'] < 11 )
                          <span style="color: blue; font-weight:bold;">Passable</span>
                          @elseif( 11 <= $exam['average'] && $exam['average'] < 14 )
                          <span style="color: blue; font-weight:bold;">Assez-Bien</span>
                          @elseif( 14 <= $exam['average'] && $exam['average'] < 16 )
                          <span style="color: blue; font-weight:bold;">Bien</span>
                          @elseif( 16 <= $exam['average'] && $exam['average'] < 18 )
                          <span style="color: blue; font-weight:bold;">Très-Bien</span>
                          @elseif( 18 <= $exam['average'] && $exam['average'] <= $exam['full_mark'] )
                          <span style="color: blue; font-weight:bold;">Excellent</span>
                          @else
                          <span style="color: blue; font-weight:bold;">Médiocre</span>
                          @endif
                        </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table> 
                </div>
              </div>
            </div>
        @endforeach

          </div>
         
        </div>
      
      </section>
    </div>

    @endsection