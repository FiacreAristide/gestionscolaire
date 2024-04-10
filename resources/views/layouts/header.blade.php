  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      @if(Auth::user()->user_type == 1)
        <p style="font-size: 20px;">Année Scolaire: <span style="font-size: 20px; font-weight:bold; margin-right:25px;">{{ App\Models\SchoolYear::getActiveYear()->title }}</span></p>
      @endif
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link" style="text-align: center; font-weight: bold;">
    <img src="{{ url('public/dist/img/logo.jpg')}}" style="width: 200px; height: 80px; border-radius: 5%">
      <!-- <span class="brand-text font-weight-light" style="font-weight: bold!important; font-size: 25px;">HEST</span> -->
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex" style="align-items: center">
        <div style="background-color: blue; border-radius : 50%; height: 50px; width:50px; display: grid; place-items:center; ">
          <!-- <img src="{{ url('public/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image"> -->
          <span style="font-size: 20px; font-weight :900; color: white;">{{ Auth::user()->name[0] }}{{ Auth::user()->prenom[0] }}</span>
        </div>
        <div class="info">
          <a href="#" class="d-block" style="font-weight: 800;">{{ Auth::user()->name }} {{ Auth::user()->prenom }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

          @if(Auth::user()->user_type == 1)
            <li class="nav-item">
              <a href="{{ url('admin/dashboard')}}"  class="nav-link @if(Request::segment(2) == 'dashboard') active @endif">
                <i class="fas fa-tachometer-alt"></i>
                <p>
                  Tableau de bord
                </p>
              </a>
            </li>

            <li class="nav-item">
              <a href="{{ url('admin/school_year/list')}}" class="nav-link @if(Request::segment(2) =='school_year') active @endif">
                <i class="far fa-calendar-alt"></i>
                <p>
                  Année scolaire
                </p>
              </a>
            </li>

            <li class="nav-item">
              <a href="{{ url('admin/admin/list')}}" class="nav-link @if(Request::segment(2) =='admin') active @endif">
                <i class="fas fa-users-cog"></i>
                <p>
                  Administration
                </p>
              </a>
            </li>

          <li class="nav-item  @if(Request::segment(2) =='class' || Request::segment(2) =='domain' || Request::segment(2) =='subject' || Request::segment(2) =='course' || Request::segment(2) =='class_course' || Request::segment(2) =='class_teacher'|| Request::segment(2) =='class_timetable' || Request::segment(2) =='mention' || Request::segment(2) =='teacher' || Request::segment(2) =='student' || Request::segment(2) =='course_teacher') menu-is-opening menu-open @endif">
            <a href="#" class="nav-link @if(Request::segment(2) =='class' || Request::segment(2) =='domain' || Request::segment(2) =='subject' || Request::segment(2) =='course' || Request::segment(2) =='class_course' || Request::segment(2) =='class_teacher' || Request::segment(2) =='class_timetable' || Request::segment(2) =='mention' || Request::segment(2) =='course_teacher' || Request::segment(2) =='teacher' || Request::segment(2) =='student') active @endif">
              <i class="fas fa-graduation-cap"></i>
              <p>
                Gestion académique
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ url('admin/domain/list')}}" class="nav-link @if(Request::segment(2) =='domain') active @endif">
                  <i class="fas fa-sitemap nav-icon"></i>
                  <p>Domaines</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ url('admin/subject/list')}}" class="nav-link @if(Request::segment(2) =='subject') active @endif">
                  <i class="fas fa-award nav-icon"></i>
                  <p>Spécialités</p>
                </a>
              </li>
              
              <li class="nav-item">
                <a href="{{ url('admin/mention/list')}}" class="nav-link @if(Request::segment(2) =='mention') active @endif">
                  <i class="fas fa-sitemap nav-icon"></i>
                  <p>Mentions</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ url('admin/class/list')}}" class="nav-link @if(Request::segment(2) =='class') active @endif">
                  <i class="fas fa-chalkboard nav-icon"></i>
                  <p>Classes</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ url('admin/course/list')}}" class="nav-link @if(Request::segment(2) =='course') active @endif">
                  <i class="fas fa-book nav-icon"></i>
                  <p>Cours</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ url('admin/class_course/list')}}" class="nav-link @if(Request::segment(2) =='class_course') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Classes & Cours</p>
                </a> 
              </li>  
              
              <li class="nav-item">
              <a href="{{ url('admin/teacher/list')}}" class="nav-link @if(Request::segment(2) =='teacher') active @endif">
                <i class="fas fa-chalkboard-teacher nav-icon"></i>
                <p>
                  Enseignants
                </p>
              </a>
            </li>

            <li class="nav-item">
              <a href="{{ url('admin/student/list')}}" class="nav-link @if(Request::segment(2) =='student') active @endif">
                <i class="fas fa-user-graduate nav-icon"></i>
                <p>
                  Etudiants
                </p>
              </a>
            </li>

              <li class="nav-item">
                <a href="{{ url('admin/course_teacher/list')}}" class="nav-link @if(Request::segment(2) =='course_teacher') active @endif">
                  <i class="fas fa-book-reader nav-icon"></i>
                  <p>Cours & Enseignants</p>
                </a> 
              </li>

              <li class="nav-item">
                <a href="{{ url('admin/class_teacher/list')}}" class="nav-link @if(Request::segment(2) =='class_teacher') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Classes & Enseignants</p>
                </a>
              </li>       

              <li class="nav-item">
                <a href="{{ url('admin/class_timetable/list')}}" class="nav-link @if(Request::segment(2) =='class_timetable') active @endif">
                  <i class="far fa-clock nav-icon"></i>
                  <p>Horaires</p>
                </a>
              </li>
              </ul>
            </li>  


          <li class="nav-item  @if(Request::segment(2) =='examinations') menu-is-opening menu-open @endif">
            <a href="#" class="nav-link @if(Request::segment(2) =='examinations') active @endif">
              <i class="far fa-calendar-alt"></i>
              <p>
                Gestion Examens/Devoirs
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ url('admin/examinations/exam/list')}}" class="nav-link @if(Request::segment(3) =='exam') active @endif">
                  <i class="far fa-file-alt nav-icon"></i>
                  <p>Evaluations</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ url('admin/examinations/calendar')}}" class="nav-link @if(Request::segment(3) =='calendar') active @endif">
                  <i class="far fa-calendar-alt nav-icon"></i>
                  <p>Calendrier</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ url('admin/examinations/register')}}" class="nav-link @if(Request::segment(3) =='register') active @endif">
                  <i class="fas fa-clipboard nav-icon"></i>
                  <p>Notes/Normale</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ url('admin/examinations/makeup_register')}}" class="nav-link @if(Request::segment(3) =='second_register') active @endif">
                  <i class="fas fa-clipboard nav-icon"></i>
                  <p>Notes/Rattrapage</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item  @if(Request::segment(2) =='fees_collection') menu-is-opening menu-open @endif">
            <a href="#" class="nav-link @if(Request::segment(2) =='fees_collection') active @endif">
              <i class="fas fa-money-bill"></i>
              <p>
                Gestion écolage
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">

            <li class="nav-item">
              <a href="{{ url('admin/fees_collection/collect')}}" class="nav-link @if(Request::segment(3) =='collect') active @endif">
                <i class="far fa-circle nav-icon"></i>
                <p>Frais scolarité</p>
              </a>
            </li>   

              <li class="nav-item">
                <a href="{{ url('admin/fees_collection/collect_report')}}" class="nav-link @if(Request::segment(3) =='collect_report') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Liste frais scolarité</p>
                </a>
              </li> 

            </ul>
          </li>


          <li class="nav-item  @if(Request::segment(2) =='attendance') menu-is-opening menu-open @endif">
            <a href="#" class="nav-link @if(Request::segment(2) =='attendance') active @endif">
              <i class="far fa-check-circle"></i>
              <p>
                Gestion Assiduité
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ url('admin/attendance/student')}}" class="nav-link @if(Request::segment(3) =='student') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Reporter</p>
                </a>
              </li>   
              
              <li class="nav-item">
                <a href="{{ url('admin/attendance/report')}}" class="nav-link @if(Request::segment(3) =='report') active @endif">
                  <i class="far fa-list-alt nav-icon"></i>
                  <p>Liste de présence</p>
                </a>
              </li> 

            </ul>
          </li>

          <li class="nav-item">
            <a href="{{ url('admin/change_password')}}" class="nav-link @if(Request::segment(2) =='change_password') active @endif">
              <i class="fas fa-key"></i>
              <p>
                Modifier mot de passe
              </p>
            </a>
          </li>

            <li class="nav-item">
              <a href="{{ url('admin/account')}}" class="nav-link @if(Request::segment(2) =='account') active @endif">
                <i class="fas fa-user"></i>
                <p>
                  Mon compte
                </p>
              </a>
            </li>


          @elseif(Auth::user()->user_type == 2)

            <li class="nav-item">
              <a href="{{ url('teacher/dashboard')}}" class="nav-link @if(Request::segment(2) =='dashboard') active @endif">
                <i class="fas fa-tachometer-alt"></i>
                <p>
                  Tableau de bord
                </p>
              </a>
            </li>

            <li class="nav-item">
              <a href="{{ url('teacher/my_class_course')}}" class="nav-link @if(Request::segment(2) =='my_class_course') active @endif">
                <i class="far fa-circle"></i>
                <p>
                  Mes classes & cours
                </p>
              </a>
            </li>


            <li class="nav-item">
              <a href="{{ url('teacher/my_student')}}" class="nav-link @if(Request::segment(2) =='my_student') active @endif">
                <i class="fas fa-user-graduate"></i>
                <p>
                  Mes étudiants
                </p>
              </a>
            </li>    


            <li class="nav-item">
              <a href="{{ url('teacher/my_exam_calendar')}}" class="nav-link @if(Request::segment(2) =='my_exam_calendar') active @endif">
                <i class="far fa-file-alt"></i>
                <p>
                   Infos Examens
                </p>
              </a>
            </li>  
            
            <li class="nav-item">
              <a href="{{ url('teacher/register')}}" class="nav-link @if(Request::segment(2) =='register') active @endif">
                <i class="fas fa-clipboard"></i>
                <p>
                   Gestion des notes
                </p>
              </a>
            </li> 
            
          <li class="nav-item  @if(Request::segment(2) =='attendance') menu-is-opening menu-open @endif">
            <a href="#" class="nav-link @if(Request::segment(2) =='attendance') active @endif">
              <i class="far fa-check-circle"></i>
              <p>
                Gestion Assiduité
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ url('teacher/attendance/student')}}" class="nav-link @if(Request::segment(3) =='student') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Reporter</p>
                </a>
              </li>   
              
              <li class="nav-item">
                <a href="{{ url('teacher/attendance/report')}}" class="nav-link @if(Request::segment(3) =='report') active @endif">
                  <i class="far fa-list-alt nav-icon"></i>
                  <p>Liste de présence</p>
                </a>
              </li> 
            </ul>
          </li>

            <li class="nav-item">
              <a href="{{ url('teacher/account')}}" class="nav-link @if(Request::segment(2) =='account') active @endif">
                <i class="fa fa-user"></i>
                <p>
                  Mon compte
                </p>
              </a>
            </li>


            <li class="nav-item">
              <a href="{{ url('teacher/change_password')}}" class="nav-link @if(Request::segment(2) =='change_password') active @endif">
                <i class="fas fa-key"></i>
                <p>
                  Modifier mot de passe
                </p>
              </a>
            </li>

          @elseif(Auth::user()->user_type == 3)

            <li class="nav-item">
              <a href="{{ url('student/dashboard')}}" class="nav-link @if(Request::segment(2) =='dashboard') active @endif">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Tableau de bord
                </p>
              </a>
            </li>

            <li class="nav-item">
              <a href="{{ url('student/my_courses')}}" class="nav-link @if(Request::segment(2) =='my_courses') active @endif">
                <i class="nav-icon far fa-user"></i>
                <p>
                  Choix des UEs
                </p>
              </a>
            </li>  

            <li class="nav-item">
              <a href="{{ url('student/my_subject')}}" class="nav-link @if(Request::segment(2) =='my_subject') active @endif">
                <i class="nav-icon far fa-user"></i>
                <p>
                 Mes Cours
                </p>
              </a>
            </li>

            <li class="nav-item">
              <a href="{{ url('student/my_timetable')}}" class="nav-link @if(Request::segment(2) =='my_timetable') active @endif">
                <i class="nav-icon far fa-user"></i>
                <p>
                  Mon emplois du temps
                </p>
              </a>
            </li> 

            <li class="nav-item">
              <a href="{{ url('student/my_exam_timetable')}}" class="nav-link @if(Request::segment(2) =='my_exam_timetable') active @endif">
                <i class="nav-icon far fa-user"></i>
                <p>
                  Infos Examens
                </p>
              </a>
            </li> 

            <li class="nav-item">
              <a href="{{ url('student/my_exam_result')}}" class="nav-link @if(Request::segment(2) =='my_exam_result') active @endif">
                <i class="nav-icon far fa-user"></i>
                <p>
                  Résultat Examens
                </p>
              </a>
            </li>

            <li class="nav-item">
              <a href="{{ url('student/account')}}" class="nav-link @if(Request::segment(2) =='account') active @endif">
                <i class="nav-icon far fa-user"></i>
                <p>
                  Mon compte
                </p>
              </a>
            </li>            

            <li class="nav-item">
              <a href="{{ url('student/change_password')}}" class="nav-link @if(Request::segment(2) =='change_password') active @endif">
                <i class="nav-icon far fa-user"></i>
                <p>
                  Modifier mot de passe
                </p>
              </a>
            </li>

          @endif

          <li class="nav-item">
            <a href="{{ url('logout')}}" class="nav-link">
              <i class="fas fa-sign-out-alt"></i>
              <p>
                Se déconnecter
              </p>
            </a>
          </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>