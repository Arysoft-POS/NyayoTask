      <!-- Navbar-->
      <header class="main-header-top hidden-print">
         <a href="{{ url('/home') }}" class="logo"><img class="img-fluid able-logo" src="{{ asset('assets/images/logow.png') }}" alt="Theme-logo"></a>
         <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#!" data-toggle="offcanvas" class="sidebar-toggle"></a>
         
            <!-- Navbar Right Menu-->
            <div class="navbar-custom-menu f-right">
            
            <!-- Navbar Right Menu-->
            <div class="navbar-custom-menu f-right">
              

               <ul class="top-nav">

                  <!-- User Menu-->
                  <li class="dropdown notification-menu">
                     <a  data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle drop icon-circle drop-image">

                        <span><b>{{ Auth::user()->name }}</b> <i class=" icofont icofont-simple-down"></i></span>

                        </a>
                     <ul class="dropdown-menu settings-menu">
                        
                        <li><a href="#"><i class="icon-user"></i> Profile</a></li>
                        <li>
                        <a  href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">    
                                    
                         <i class="icon-power"></i>  {{ __('Logout') }} 
                          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                           </form>
                           </a>
                        </li>

                     </ul>
                  </li>
            

                  <li class="dropdown">
                  <a  href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                  <i class="icon-power txt-red"></i>
                  </a>
                  </li>
               </ul>

               
            </div>
         </nav>
      </header>