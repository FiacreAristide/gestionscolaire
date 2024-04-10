@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Notes</h1>
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
                            <h3 class="card-title">Rechercher</h3>
                        </div>
                        <form method="get" action="">                    
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label>Nom</label>
                                        <select class="form-control" name="exam_id" required>
                                            <option value="">sélectionner examen</option>
                                            @foreach($getExam as $exam)
                                                <option {{ (Request::get('exam_id')== $exam->id) ? 'selected' : ''}} value="{{ $exam->id}}">{{ $exam->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Classe</label>
                                        <select class="form-control" name="class_id" required>
                                            <option value="">sélectionner classe</option>
                                            @foreach($getClass as $class)
                                                <option {{ (Request::get('class_id')== $class->id) ? 'selected' : ''}} value="{{ $class->id}}">{{ $class->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <button class="btn btn-primary" type="submit" style="margin-top: 32px;">Rechercher</button>
                                        <a class="btn btn-success" style="margin-top: 32px;" href="{{ url('admin/examinations/register')}}">Annuler</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    @include('_message')
                    @if(!empty($getStudent) && !empty($getStudent->count()))
                        <div class="accordion" id="accordionExample">
                            @foreach($getStudent as $student)
                                <div class="card">
                                    <div class="card-header" id="heading{{ $student->user_id }}">
                                        <h2 class="mb-0">
                                            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse{{ $student->user_id }}" aria-expanded="true" aria-controls="collapse{{ $student->user_id }}">
                                                {{ $student->name}} {{ $student->prenom}}
                                            </button>
                                        </h2>
                                    </div>

                                    <div id="collapse{{ $student->user_id }}" class="collapse" aria-labelledby="heading{{ $student->user_id }}" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <ul class="list-group list-group-flush">
                                                @php $i = 1; @endphp
                                                @foreach($coursesByStudent[$student->user_id] as $course)
                                                    <li class="list-group-item">
                                                        {{ $course->course_name}} ({{ $course->course_type}}: {{ $course->passing_mark}}/{{ $course->full_mark}})
                                                        <div style="margin-top: 10px;">
                                                            Note Devoir:
                                                            <input type="hidden" name="mark[{{ $i }}][full_mark]" value="" class="form-control">
                                                            <input type="hidden" name="mark[{{ $i }}][passing_mark]" value="" class="form-control">
                                                            <input type="hidden" name="mark[{{ $i }}][id]" value="" class="form-control">
                                                            <input type="hidden" name="mark[{{ $i }}][course_id]" value="" class="form-control">
                                                            <input type="text" name="mark[{{ $i }}][note_devoir]" value="" style ="width:100px;" id="note_devoir_{{ $student->user_id}}{{ $course->course_id}}" class="form-control">
                                                        </div>
                                                        <div style="margin-top: 10px;">
                                                            Note Examen:
                                                            <input type="text" name="mark[{{ $i }}][note_exam]" value="" style ="width:100px;" id="note_exam_{{ $student->user_id}}{{ $course->course_id}}" class="form-control">
                                                        </div>

                                                        <div style="margin-top: 10px;">
                                                            <button type="button" class="btn btn-primary saveSingleCourse" id="{{ $student->user_id }}" data-val="{{ $course->course_id}}" data-exam ="{{Request::get('exam_id')}}" data-class ="{{Request::get('class_id')}}" data-schedule="{{ $course->id}}">Enregistrer</button>
                                                        </div>
                                                    </li>
                                                @php $i++; @endphp
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
</div>

@endsection

@section('script')
    <script type="text/javascript">
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
                    url : "{{ url('admin/examinations/single_submit_make_up_register')}}",
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
