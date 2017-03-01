@extends('master')

@section('content')
@push('topscripts')
{{ HTML::style('css/home-style.css') }}
<style>
  #topnavloader{
    display: none;
  }
</style>
@endpush
<section id="vue">
  <section id="main" style="">
    <header class="left-cor">
      <section class="wrapper flex align-center justify-sb">
        <div id="logo"><a href="/"><img src="{{ asset('img/logo-white.png') }}" alt="Skills2Connect"></a></div>
        <div class="btn_container">
          <button class="btn style1" data-toggle="modal" data-target="#nav-login-dialog">Login</button>
          <button class="btn style1" data-toggle="modal" data-target="#nav-signup-dialog">Sign Up</button>
          
        </div>
      </section>
    </header>
    <section id="home" class="fullHeight flex vertical align-center justify-center">
      <div class="lg-12">THE CONNECTED WORLD OF</div>
      <div class="focus color-1 lg-12">EDUCATION</div>
    </section>
    <section id="edu_features">
      <section class="wrapper">
        <div class="why_edu flex align-center justify-center">
          <h2>WHY EDUCOMBINE?</h2>
        </div>
        <div class="for_students fullHeight flex wrap align-start justify-end">
          <div class="lg-4 dark_band">
            <h3>FOR<span class="block color-1">STUDENT</span></h3>
            <p>At Educombine, we believe that a student is the most valuable asset for a nation. Potential leaders of tomorrow, the youth hold the power, ability and skills to convert stumbling stones to building blocks essential for the success of a nation. Thus we work with an earnest intent and dedicate our sincere efforts to provide support to students so that they can overcome all hurdles hampering their quest to become knowledgeable. Educombine aims to provide various solutions to the students to ease their day to day activities.</p>
            <hr class="bg-1">
          </div>
          <div class="feature_box lg-8 flex inline wrap justify-sa align-start">
            <div class="lg-5 xs-8">
              <div class="icon icon-1"></div>
              <h3>Connect With Teachers</h3>
              <hr class="bg-1">
              <p>Get assignments &amp; notes, discuss queries, stay informed. All privately.</p>
            </div>
            <div class="lg-5 xs-8">
              <div class="icon icon-2"></div>
              <h3>Take Tests</h3>
              <hr class="bg-1">
              <p>Prepare for exams, give mock tests, attend quizzes. Stay prepared.</p>
            </div>
            <div class="lg-5 xs-8">
              <div class="icon icon-4"></div>
              <h3>Buy &amp; Sell</h3>
              <hr class="bg-1">
              <p>All your stuff like books, instruments, even your notes get the right buyer, quickly.</p>
            </div>
            <div class="lg-5 xs-8">
              <div class="icon icon-3"></div>
              <h3>Scholarships &amp; Internships</h3>
              <hr class="bg-1">
              <p>Access all relevant information about latest corporate projects &amp; internships to support your college finances.</p>
            </div>
          </div>
        </div>
        
       
      </section>
    </section>
    <footer>
      <section class="wrapper">
        <div class="flex wrap justify-sb">
          <div class="footer_div lg-3 md-4 xs-12 flex inline align-center">
            <div id="footer_logo"><img src="{{ asset('img/logo.png') }}" alt="Skills2Connect"></div>
          </div>
          <div class="footer_div lg-3 md-4 xs-12">
            <div>
              <h4 class="color-1">Phone:</h4>
              <p><a href="tel:8800306382">+91 88003 06382</a></p>
            </div>
            <div>
              <h4 class="color-1">Write Us:</h4>
              <p><a href="mailto:operation@educombine.com" target="_blank">operation@educombine.com</a></p>
            </div>
          </div>
          <div class="footer_div lg-3 md-4 xs-12">
            <h4 class="color-1">Follow Us:</h4>
            <div class="social">
              <a href="#" target="_blank" class="flex inline align-center justify-center"><i class="fa fa-facebook"></i></a>
              <a href="#" target="_blank" class="flex inline align-center justify-center"><i class="fa fa-twitter"></i></a>
              <a href="#" target="_blank" class="flex inline align-center justify-center"><i class="fa fa-instagram"></i></a>
            </div>
          </div>
        </div>
      </section>
      <section id="copyright" class="flex vertical align-center">
        <p><a href="/terms">Terms &amp; Conditions</a> | &copy; 2016 Educombine. All Rights Reserved.</p>
        <p>Made with <i class="fa fa-heart" style="color:#f00;"></i> by <a href="https://crazyripples.com">CrazyRipples</a></p>
      </section>
    </footer>
  </section>
</section>

@endsection