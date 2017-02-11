@extends('partials.sidebar')

@section('basecontent')

<div align="center"><img src="{{asset('img/logo.png')}}" alt="" ></div>

<div class="row weirascard" style="margin-left:-18px;">
  <div class="col-md-3 col-xs-6">
    <div id="card1">
      <div class="front">
        <img src="{{asset('img/icons/landing/1.png')}}" alt="" border="0">
      </div>
      <div class="back">
        <a style="color:white;text-decoration: none;" href="{{ url('search?query=&search_type=2') }}"><div class="card1 opensans">12<br>Teachers</div></a>
      </div>
    </div>
  </div>

  <div class="col-md-3 col-xs-6">
    <div id="card1">
      <div class="front">
        <img src="{{asset('img/icons/landing/2.png')}}" alt="" border="0">
      </div>
      <div class="back">
        <a style="color:white;text-decoration: none;" href="{{ url('search?query=&search_type=2') }}"><div class="card1 opensans">12<br>Students</div></a>
      </div>
    </div>
  </div>

  <div class="col-md-3 col-xs-6">
    <div id="card1">
      <div class="front">
        <img src="{{asset('img/icons/landing/3.png')}}" alt="" border="0">
      </div>
      <div class="back">
        <a style="color:white;text-decoration: none;" href="{{ url('search?query=&search_type=2') }}"><div class="card1 opensans">12<br>Schools</div></a>
      </div>
    </div>
  </div>

  <div class="col-md-3 col-xs-6">
    <div id="card1">
      <div class="front">
        <img src="{{asset('img/icons/landing/4.png')}}" alt="" border="0">
      </div>
      <div class="back">
        <a style="color:white;text-decoration: none;" href="{{ url('search?query=&search_type=2') }}"><div class="card1 opensans">12<br>Items</div></a>
      </div>
    </div>
  </div>

  <div class="col-md-3 col-xs-6">
    <div id="card1">
      <div class="front">
        <img src="{{asset('img/icons/landing/5.png')}}" alt="" border="0">
      </div>
      <div class="back">
        <a style="color:white;text-decoration: none;" href="{{ url('search?query=&search_type=2') }}"><div class="card1 opensans">12<br>Tests</div></a>
      </div>
    </div>
  </div>

  <div class="col-md-3 col-xs-6">
    <div id="card1">
      <div class="front">
        <img src="{{asset('img/icons/landing/6.png')}}" alt="" border="0">
      </div>
      <div class="back">
        <a style="color:white;text-decoration: none;" href="{{ url('search?query=&search_type=2') }}"><div class="card1 opensans">12<br>Internships</div></a>
      </div>
    </div>
  </div>

  <div class="col-md-3 col-xs-6">
    <div id="card1">
      <div class="front">
        <img src="{{asset('img/icons/landing/7.png')}}" alt="" border="0">
      </div>
      <div class="back">
        <a style="color:white;text-decoration: none;" href="{{ url('search?query=&search_type=2') }}"><div class="card1 opensans">12<br>Scholarships</div></a>
      </div>
    </div>
  </div>

  <div class="col-md-3 col-xs-6">
    <div id="card1">
      <div class="front">
        <img src="{{asset('img/icons/landing/8.png')}}" alt="" border="0">
      </div>
      <div class="back">
        <a style="color:white;text-decoration: none;" href="{{ url('search?query=&search_type=2') }}"><div class="card1 opensans">12<br>Groups</div></a>
      </div>
    </div>
  </div>
</div>

<div class="newsfeeds">
  
  <h2>NewsFeeds</h2>
</div>
@endsection