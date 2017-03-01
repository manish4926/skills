@extends('master')

@section('content')
<style>
    body{
        background: url("{{ asset('img/home_bg.png') }}");
    }
</style>

<div class="banner_text">
<span class="large_text" style="font-size:52px;line-height:1.4;color:#000;text-shadow:0 0 0;text-align:center;">The Connected<br>World of<br><span style="color:#ee2039;font-size:68px;">Education</span></span>
</div>


<!--Start-Middle-5-Blocks-->
<section class="main-middle-blocks">
  <div class="container">
    <div class="row">
      <div class="tile"><a href="#"><span>Internship Test</span></a></div>
      <div class="tile"><a href="#"><span>Scholarship</span></a></div>
      <div class="tile"><a href="#"><span>Buy &amp; Sell</span></a></div>
      <div class="tile"><a href="#"><span>Education Groups</span></a></div>
    </div>
  </div>
</section>
<!--End-Middle-5-Blocks-->


@endsection