  @extends('layouts.app')
  @section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Notes </h1>
          </div>
        </div>
      </div>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">              
              <div class="card-header">
                <h3 class="card-title">Rechercher</h3>
              </div>
                  <form method="get" action="">                    
                    <div class="card-body">
                      <div class="row">
                      <div class="form-group col-md-4">
                        <label>Nom</label>
                        <select class="form-control" name="exam_id" required>
                          <option value="">selectionner examen</option>
                          @foreach($getExam as $exam)
                            <option {{ (Request::get('exam_id')== $exam->exam_id) ? 'selected' : ''}} value="{{ $exam->exam_id}}">{{ $exam->exam_name}}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="form-group col-md-4">
                        <label>Classe</label>
                        <select class="form-control" name="class_id" required>
                          <option value="">selectionner classe</option>
                          @foreach($getClass as $class)
                            <option {{ (Request::get('class_id')== $class->class_id) ? 'selected' : ''}} value="{{ $class->class_id}}">{{ $class->class_name}}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="form-group col-md-3">
                        <button class="btn btn-primary" type="submit" style="margin-top: 32px;">Rechercher</button>
                        <a class="btn btn-success" style="margin-top: 32px;" href="{{ url('teacher/register')}}">Annuler</a>

                         <!-- <a class="btn btn-success" style="margin-top: 32px;" href="{{ url('admin/examinations/register')}}">Annuler</a> -->
                      </div>
                    </div>
                    </div>
                  </form>
                </div>

        @include('_message')
        @if(!empty($getCourse) && !empty($getCourse->count()))
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Notes étudiants </h3>
              </div>

              <div class="card-body p-0" style="overflow: auto;">
                <table class="table">
                  <thead>
                    <tr>
                      <th>Etudiant</th>
                      @foreach($getCourse as $course)
                      <th>{{ $course->course_name}} <br>
                      ({{ $course->course_type}}: {{ $course->passing_mark}}/{{ $course->full_mark}})

                      </th>
                      @endforeach
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                      @if(!empty($getStudent) && !empty($getStudent->count()))
                        @foreach($getStudent as $student)
                        <form action="" method="post" class="submitForm">
                            {{ csrf_field() }}
                            <input type="hidden" name="student_id" value="{{$student->user_id}}">
                            <input type="hidden" name="exam_id" value="{{Request::get('exam_id')}}">
                            <input type="hidden" name="class_id" value="{{Request::get('class_id')}}">
                            <tr>
                                <td>
                                    {{ $student->name}} {{ $student->prenom}}
                                </td>
                                @php
                                    $i = 1;
                                @endphp
                                @foreach($getCourse as $course)
                                  @php
                                    $totalMark = 0;
                                    $getMark = $course->getMark($student->user_id,Request::get('exam_id'),Request::get('class_id'),$course->course_id );

                                    if(!empty($getMark))
                                    {
                                      $totalMark = $getMark->note_devoir + $getMark->note_exam;
                                    }
                                  @endphp
                                    <td>
                                        <div style="margin-bottom: 10px;">
                                            Note Devoir:
                                            <input type="hidden" name="mark[{{ $i }}][full_mark]" value="{{ $course->full_mark}}" class="form-control">
                                            <input type="hidden" name="mark[{{ $i }}][passing_mark]" value="{{ $course->passing_mark}}" class="form-control">
                                            <input type="hidden" name="mark[{{ $i }}][id]" value="{{ $course->id}}" class="form-control">
                                            <input type="hidden" name="mark[{{ $i }}][course_id]" value="{{ $course->course_id}}" class="form-control">
                                            <input type="text" name="mark[{{ $i }}][note_devoir]" value="{{ !empty($getMark->note_devoir) ? $getMark->note_devoir : '' }}" style ="width:100px;" id="note_devoir_{{ $student->user_id}}{{ $course->course_id}}" class="form-control">
                                        </div>

                                        <div style="margin-bottom: 10px;">
                                            Note Examen:
                                            <input type="text" name="mark[{{ $i }}][note_exam]" value="{{ !empty($getMark->note_exam) ? $getMark->note_exam : '' }}" style ="width:100px;" id="note_exam_{{ $student->user_id}}{{ $course->course_id}}" class="form-control">
                                        </div>

                                        <div style="margin-bottom: 10px;">
                                            <button type="button" class="btn btn-primary saveSingleCourse" id="{{ $student->user_id }}" data-val="{{ $course->course_id}}" data-exam ="{{Request::get('exam_id')}}" data-class ="{{Request::get('class_id')}}" data-schedule="{{ $course->id}}">Enregistrer</button>
                                        </div>
                                        @if(!empty($getMark))
                                        <div style="margin-bottom: 10px;">
                                          <b>Total: </b>{{$totalMark}} <br>
                                          <b>Moyenne: </b>{{ $totalMark/2 }} <br>
                                          @if($course->full_mark >= $totalMark/2 && $course->passing_mark <= $totalMark/2)
                                            <span style="color: green; font-weight:bold;">Validé</span>
                                          @else
                                            <span style="color: red; font-weight:bold;">Non-validé</span>
                                          @endif
                                        </div>
                                         @endif
                                    </td>

                                    
                                @php
                                    $i++;
                                @endphp
                                @endforeach
                                
                                <td>
                                    <button type="submit" class="btn btn-success">Enregistrer</button>
                                </td>
                            </tr>
                        </form>
                        @endforeach
                     @endif
                  </tbody>
                </table>
              </div>
            </div>
        @endif

      </div>        
      </div>
    </section>
    <!-- /.content -->
  </div>

  @endsection

  @section('script')
    <script type="text/javascript">
        $('.submitForm').submit(function(e){
            e.preventDefault();
            $.ajax(
                {
                    type: "POST",
                    url: "{{url('teacher/submit_register')}}",
                    data: $(this).serialize(),
                    dataType: "json",
                    success: function(data){
                        alert(data.message);
                    }
                }
            );
        });


        $('.saveSingleCourse').click(function(e){
            var student_id = $(this).attr('id');
            var course_id = $(this).attr('data-val');
            var exam_id = $(this).attr('data-exam');
            var class_id = $(this).attr('data-class');
            var id = $(this).attr('data-schedule');
            var note_devoir = $('#note_devoir_'+student_id+course_id).val();
            var note_exam = $('#note_exam_'+student_id+course_id).val();

            $.ajax(
                {
                    type : "POST",
                    url : "{{ url('teacher/single_submit_register')}}",
                    data : {
                        "_token": "{{ csrf_token() }}",
                        id: id,
                        student_id: student_id,
                        course_id: course_id,
                        exam_id: exam_id,
                        class_id: class_id,
                        note_devoir: note_devoir,
                        note_exam: note_exam,
                    },
                    dataType: "json",
                    success: function(data){
                        alert(data.message);
                    }
                }
            );

        });
    </script>
  @endsection