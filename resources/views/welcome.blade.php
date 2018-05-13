<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- PAGE settings -->
  <link rel="icon" href="{{asset('images/ico.png') }}">
  <title>Wheet Company</title>
  <meta name="description" content="Green wheet">
  <meta name="keywords" content="wheet">
  <!-- CSS dependencies -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
  <link rel="stylesheet" href="{{asset('css/grain.css') }}">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>

<body class="text-center">
  <a href="javascript:" id="return-to-top">
    <i class="icon-chevron-up"></i>
  </a>
  <!-- Navbar -->
  <div class="p-0">
    <div class="container-fluid">
      <div class="row w-100">
        <div class="col-md-2 h-25" style=" background-repeat: no-repeat; background-size:auto; background-position:left top;">
          <img class="img-fluid d-block mx-auto py-5" src="{{asset('images/logo.png') }}"> </div>
        <div class="col-md-10">
          <div class="row">
              <div class="col-md-6 col-lg-6 col-sm-6 col-xl-6 col-6 float-right"> </div>
              <div class="col-md-6 col-lg-6 col-sm-6 col-xl-6 col-6 float-right  mr-auto w-100 d-flex flex-column justify-content-end align-items-end align-self-end"> 
                  @if (Route::has('login'))
              <nav class="navbar navbar-expand-lg navbar-light">
                <div class="class=&quot;collapse" id="navbarSupportedContent">
                  <ul class="navbar-nav text-dark">				  
                             @auth
							 <li class="nav-item">
                                 <a href="{{ url('/home') }}" class="nav-link" >Home</a>
               </li>	 
							 <li class="nav-item">
                  <a href="{{ route('sigmalive') }}" class="nav-link" >Sigma Live</a>
                </li>               
                 @else
							 <li class="nav-item">
                                 <a href="{{ route('login') }}" class="nav-link" >Login</a>
							 </li>	 
							<li class="nav-item">	 
                                 <a href="{{ route('register') }}" class="nav-link" >Register</a>
               </li>	 
							 <li class="nav-item">
                  <a href="{{ route('sigmalive') }}" class="nav-link" >Sigma Live</a>
                </li>                  
                             @endauth				  
                  </ul>
                </div>
              </nav>
                 @endif

               </div>            

          </div>
          <div class="row">
              <div class="col-md-6 col-lg-6 col-sm-6 col-xl-6 col-6 float-right"> </div>
            <div class="col-md-6 col-lg-6 col-sm-6 col-xl-6 col-6 mr-auto w-100 d-flex flex-column justify-content-end align-items-end align-self-end">
              <nav class="navbar navbar-expand-lg navbar-light">
                <div class="class=&quot;collapse" id="navbarSupportedContent">
                  <ul class="navbar-nav text-dark">
                    <li class="nav-item">
                      <a class="nav-link" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#aboutus">About</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#services">Services</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#products">Products</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#contactus">Contact</a>
                    </li>
                    <button type="button" class="btn btn-default">
                      <span class="glyphicon glyphicon-search"></span> Search </button>
                  </ul>
                </div>
              </nav>
            </div>
            <hr> </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Cover -->
  <div class="h-100 w-100" style="background-image: url('{{asset('images/image1.png') }}');">
    <div class="container-fluid">
      <div class="row w-100 h-100" style="background-image: url('{{asset('images/image1.png') }}');background-position:center top;background-size:fit;background-repeat:no-repeat;"></div>
    </div>
  </div>
  <!-- Parallax section -->
  <section id="aboutus">
    <div class="section-parallax w-100 h-100 py-5" style="background-image: url('{{asset('images/image2.png') }}');background-position:right top;background-size:auto;background-repeat:no-repeat;">
      <div class="h-100 container-fluid">
        <div class="row mx-auto h-100">
          <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <div class="row">
              <div class="col-2 col-sm-2 col-md-2 col-lg-2 col-xl-2">
                <h3 class="display-3 w-100 ml-auto">About Us</h3>
              </div>
              <div class="col-10 col-sm-10 col-md-10 col-lg-10 col-xl-10"> </div>
            </div>
            <div class="row h-100">
              <div class="col-md-12 col-12 col-sm-12 col-lg-12 col-xl-12 h-100">
                <div class="row h-100">
                  <div class="col-md-6">
                    <h2 class="text-left text-primary"> sdfdsfs </h2>
                    <p class="h-100 text-left"> Three days immersion in the world of UX/UI prototyping. Meet the most important design influencer of the moment, assist to speeches given by worldwide known designers and much, much more. The unique possibility to enhance your professionality
                      with the smallest effort.</p>
                  </div>
                  <div class="col-md-6 h-100 w-100"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>


          @foreach($aboutus->chunk(3) as $chunk)
          <div class="row">   
              <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
                </div>      
            <div class="case-item-wrap">          
          @foreach ($chunk as $post)
          <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
            <div class="case-item">
                <div class="case-item__thumb">
                    <img  height="200" width="200" src="{{ $post['image'] }}" alt="our case">
                </div>
                <h6 class="case-item__title text-center"><a href="{{ route('post.single', ['id' => $post['id'] ]) }}" target="_blank">{{ $post['title'] }}</a></h6>
            </div>
          </div>
          <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
          </div>
          @endforeach
        </div>
      </div>
        @endforeach
    

  </section>
  <!-- Services -->
  <section id="services">
    <div class="background-color: lightblue; bg-light">
      <div class="w-100 container-fluid">
        <div class="row">
          <div class="col-2 col-sm-2 col-md-2 col-lg-2 col-xl-2 bg-light">
            <h3 class="display-3 w-100 ml-auto">Services</h3>
          </div>
          <div class="col-10 col-sm-10 col-md-10 col-lg-10 col-xl-10 bg-light"> </div>
        </div>
        <div class="row">
          <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 bg-light">
            <img class="float-left" src="{{asset('images/icon1.png') }}">
            <img class="float-right" src="{{asset('images/icon2.png') }}"> </div>
        </div>
        <div class="newspaper h-100 p-5"> Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip
          ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril
          delenit augue duis dolore te feugait nulla facilisi. Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. </div>
      </div>
      <div class="row"></div>
    </div>
  </section>
  <!-- products -->
  <section id="products">
    <div class="row">
      <div class="col-2 col-sm-2 col-md-2 col-lg-2 col-xl-2">
        <h3 class="display-3 w-100 ml-auto">Products</h3>
      </div>
      <div class="col-10 col-sm-10 col-md-10 col-lg-10 col-xl-10"> 
      </div>
    </div>

    @foreach($products->chunk(3) as $chunk)
    <div class="row">   
        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
          </div>      
      <div class="case-item-wrap">          
    @foreach ($chunk as $post)
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
      <div class="case-item">
          <div class="case-item__thumb">
              <img  height="200" width="200" src="{{ $post['image'] }}" alt="our case">
          </div>
          <h6 class="case-item__title text-center"><a href="{{ route('post.single', ['id' => $post['id'] ]) }}" target="_blank">{{ $post['title'] }}</a></h6>
      </div>
    </div>
    <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
    </div>
    @endforeach
  </div>
</div>
  @endforeach
    
  </section>
  <!-- logos -->
  <div class="py-5 section bg-faded bg-light">
    <div class="container">
      <div class="row">
        <div class="col-md-2 col-6">
          <img class="center-block img-fluid d-block" src="{{asset('images/1.jpg') }}"> </div>
        <div class="col-md-2 col-6">
          <img class="center-block img-fluid d-block" src="{{asset('images/2.jpg') }}"> </div>
        <div class="col-md-2 col-6">
          <img class="center-block img-fluid d-block" src="{{asset('images/3.jpg') }}"> </div>
        <div class="col-md-2 col-6">
          <img class="center-block img-fluid d-block" src="{{asset('images/4.jpg') }}"> </div>
        <div class="col-md-2 col-6">
          <img class="center-block img-fluid d-block" src="{{asset('images/5.jpg') }}"> </div>
      </div>
    </div>
  </div>
  <!-- Footer -->
  <section id="contactus">
    <footer class="text-md-left text-center p-4 bg-light text-dark">
      <div class="container-fluid">
        <div class="row">
          <div class="my-3 col-lg-4 col-md-4 bg-secondary col-4 col-sm-4 col-xl-4">
            <h3 class="text-dark">Contact Us
              <br> </h3>
            <p class="text-muted">December 12-14, 2017</p>
            <p class="my-3 text-muted">
              <i class="fas fa-map-marker"></i>
              <a href="https://goo.gl/maps/ayn28vkB5F92" target="blank">Agias Paraskevis 14,
                <br>Kokkinotrimithia, Nicosia</a>
            </p>
            <p class="text-muted">
              <i class="fas fa-phone"></i>&nbsp;&nbsp;22922662</p>
            <p class="text-muted">
              <i class="fas fa-fax"></i>&nbsp;&nbsp;22922662</p>
            <p class="text-muted">
              <i class="fas fa-envelope"></i>&nbsp;&nbsp;iacovos.ioannou@gmail.com</p>
          </div>
          <div class="my-3 col-lg-4 col-md-4"> </div>
          <div class="col-lg-4 col-4 col-sm-4 col-md-4 col-xl-4">
            <h3 class="text-dark">Get In Touch</h3>
            <form>
              <fieldset class="form-group my-3">
                <div class="any">
                  <span class="fa fa-user good"></span>
                  <input type="name" id="Input Name" placeholder="Name" class="form-control"> </div>
              </fieldset>
              <fieldset class="form-group my-3">
                <div class="any">
                  <span class="fa fa-envelope good"></span>
                  <input type="email" class="form-control" id="Input Email" placeholder="Email"> </div>
              </fieldset>
              <fieldset class="form-group my-3">
                <div class="any">
                  <span class="fa fa-comment good"></span>
                  <input type="message" class="form-control" id="Input Message" placeholder="Message"> </div>
              </fieldset>
              <button type="submit" class="btn btn-outline-primary ">Send a Message</button>
            </form>
          </div>
        </div>
        <div class="row justify-content-center">
          <div class="col-md-12 col-12 col-sm-12 col-lg-12 col-xl-12">
            <div class="container">
              <div id="map_container"></div>
              <div id="map"></div>
            </div>
          </div>
        </div>
        <div class="row h-25">
          <div class="col-4 col-sm-4 col-md-4 col-lg-4 col-xl-4 py-2">
            <img class="img-fluid d-block mx-auto py-5" src="{{asset('images/logo.png') }}"> </div>
          <div class="bg-light w-100 ml-auto justify-content-center align-items-center align-self-center flex-row-reverse px-5 col-5 col-sm-5 col-lg-5 col-md-5 col-xl-5">
            <h3 class="text-dark">Recieve our NewsLetter</h3>
            <form class="form-inline">
              <input type="text" class="form-control mr-2" id="Name" placeholder="Name">
              <button type="submit" class="btn btn-outline-primary">SUBSCRIBE</button>
            </form>
          </div>
          <div class="bg-light col-3 col-sm-3 col-md-3 col-lg-3 col-xl-3">
            <a href="#" class="scrollup text-primary">&gt;</a>
          </div>
          <div class="row">
            <div class="col-md-12">
              <p class="text-muted">© Copyright 2018 IacovosI - All rights reserved. </p>
            </div>
          </div>
        </div>
      </div>
    </footer>
    <!-- JavaScript dependencies -->
    <script src="https://maps.googleapis.com/maps/api/js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <!-- Script: Smooth scrolling between anchors in a same page -->
    <script src="{{asset('/js/smooth-scroll.js') }}"></script>
  <!-- Script: Make my navbar transparent when the document is scrolled to top -->
  <script src="{{asset('/js/smooth-scroll.js') }}"></script>
  <!-- Script: Animated entrance -->
  <script src="{{asset('/js/animate-in.js') }}"></script>  
  <script src="{{asset('/js/extra.js') }}"></script>  	
  </section>
  <primetel onclick="window.open('https://www.primetel.com.cy/', '_blank')" style="cursor:pointer;position: fixed;bottom: 10px;right:10px;padding:4px;background-color: #00b0eb;border-radius: 8px; width:250px;display:flex;flex-direction:row;align-items:center;justify-content:center;font-size:14px;color:white">IacovosI Company&nbsp;&nbsp;
    <img src="./assets/images/logo.png" class="d-block" alt="logo" height="16">
  </primetel>  
</body>

</html>