  @extends('layouts.app')
  @section('content')

  <div class="content-wrapper">
      <section class="content-header">
          <div class="container-fluid">
              <div class="row mb-2">
                  <div class="col-sm-6">
                      <h1>Veuillez choisir vos unités d'enseignements</h1>
                  </div>
              </div>
          </div>
      </section>

      @include('_message')
      <section class="content">
          <div class="container-fluid">
              <div class="row">
                  <div class="col-md-12">

                      <div class="card">
                          <div class="card-header">
                              <h2 class="card-title" style="font-size:30px;">Choix des UEs </h2>
                          </div>
                          <div class="card-body p-0">
                              <form action="" method="post" id="courseForm">
                                  @csrf
                                  <table class="table">
                                      <thead>
                                          <tr>
                                              <th>Cocher</th>
                                              <th>Code UE</th>
                                              <th>UE</th>
                                              <th>Code ECUE</th>
                                              <th>Cours</th>
                                              <th>Crédit</th>
                                              <th>Type</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                          @if(!empty($getRecord))
                                          @forelse($getRecord as $value)
                                          <tr>
                                              <td><input type="checkbox" name="course_id[]" value="{{ $value->id }}"></td>
                                              <td>{{ $value->code_ue }}</td>
                                              <td>{{ $value->ue }}</td>
                                              <td>{{ $value->ecue }}</td>
                                              <td>{{ $value->name }}</td>
                                              <td style="text-align: end;" class="coeff">{{ $value->coeff }}</td>
                                              <td style="text-align: end;">{{ $value->type }}</td>
                                          </tr>
                                          @empty
                                          <tr style="text-align: center;">
                                              <td colspan="7">Aucun cours trouvé</td>
                                          </tr>
                                          @endforelse
                                          @else
                                          <tr>
                                              <td colspan="7">Aucun cours trouvé</td>
                                          </tr>
                                          @endif
                                          <tr id="totalCoeff">
                                              <td></td>
                                              <td></td>
                                              <td></td>
                                              <td></td>
                                              <td style="font-size: 20px; font-weight:500;">Total crédit :</td>
                                              <td style="text-align: end;" id="totalCredit">0</td>
                                              <td></td>
                                          </tr>
                                      </tbody>
                                  </table>
                                  <div class="footer" style="margin: 20px; text-align:center;">
                                      <button type="submit" class="btn btn-success">Valider</button>
                                      @if (!empty($getRecord) && isset($value))
                                      <a href="{{ url('student/my_courses_list_print/'.$value->id)}}" class="btn btn-primary" target="_blank">Voir mes UEs</a>
                                      @endif
                                  </div>
                              </form>
                          </div>

                      </div>
                  </div>
              </div>
          </div>
      </section>
  </div>

  @endsection

  @section('script')
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

  <script>
      $(document).ready(function() {
          var totalCredit = 0;
          // Fonction pour mettre à jour le total des crédits
          function updateTotalCredit() {
              $('#totalCredit').text(totalCredit);
          }
          // Écouter les changements dans les cases à cocher
          $('#courseForm').on('change', 'input[type="checkbox"]', function() {
              var coeff = parseFloat($(this).closest('tr').find('.coeff').text());
              if ($(this).is(':checked')) {
                  totalCredit += coeff;
              } else {
                  totalCredit -= coeff;
              }
              updateTotalCredit();
          });
      });
  </script>

  <!-- <script>
    $(document).ready(function () {
        var totalCredit = 0;

        // Fonction pour mettre à jour le total des crédits
        function updateTotalCredit() {
            $('#totalCredit').text(totalCredit);
        }

        // Fonction pour sauvegarder les cases cochées et le total dans un cookie
        function saveStateToCookie() {
            var state = {
                checkedCourses: [],
                totalCredit: totalCredit
            };

            $('input[name="selected_courses[]"]:checked').each(function () {
                state.checkedCourses.push($(this).val());
            });

            document.cookie = 'courseState=' + JSON.stringify(state);
        }

        // Écouter les changements dans les cases à cocher
        $('#courseForm').on('change', 'input[type="checkbox"]', function () {
            var coeff = parseFloat($(this).closest('tr').find('.coeff').text());
            if ($(this).is(':checked')) {
                totalCredit += coeff;
            } else {
                totalCredit -= coeff;
            }
            updateTotalCredit();
            saveStateToCookie();
        });

        // Charger les cases cochées et le total depuis le cookie lors du chargement de la page
        function loadStateFromCookie() {
            var state = JSON.parse(getCookie('courseState') || '{}');
            
            state.checkedCourses.forEach(function (courseId) {
                $('input[name="selected_courses[]"][value="' + courseId + '"]').prop('checked', true);
            });

            totalCredit = state.totalCredit || 0;
            updateTotalCredit();
        }

        // Fonction pour réinitialiser toutes les cases cochées et le total
        function resetForm() {
            $('input[name="selected_courses[]"]').prop('checked', false);
            totalCredit = 0;
            updateTotalCredit();
            saveStateToCookie();
        }

        // Fonction pour obtenir la valeur d'un cookie
        function getCookie(name) {
            var matches = document.cookie.match(new RegExp(
                "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
            ));
            return matches ? decodeURIComponent(matches[1]) : undefined;
        }

        loadStateFromCookie();
        updateTotalCredit();

        // Écouter le clic sur le bouton de réinitialisation
        $('#resetForm').on('click', function () {
            resetForm();
        });
    });
</script> -->


  @endsection