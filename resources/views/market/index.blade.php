@extends('partials.sidebar')

@section('basecontent')
<div class="clear clearfix"></div>
<div class="col-m-12">
    <div class="col-md-4 catbuttons">
        <a href="#">
        <i class="fa fa-paper-plane-o" aria-hidden="true"></i>
        <span>Educational DVD/Software</span>
        </a>
    </div>
    <div class="col-md-4 catbuttons">
        <a href="#">
        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
        <span>Competitive Examination books</span>
        </a>
    </div>
    <div class="col-md-4 catbuttons">
        <a href="#">
        <i class="fa fa-lightbulb-o" aria-hidden="true"></i>
        <span>Tutorial Hours</span>
        </a>
    </div>
    <div class="col-md-4 catbuttons">
        <a href="#">
        <i class="fa fa-graduation-cap" aria-hidden="true"></i>
        <span>Education stuff</span>
        </a>
    </div>
    <div class="col-md-4 catbuttons">
        <a href="#">
        <i class="fa fa-sticky-note-o" aria-hidden="true"></i>
        <span>Notes</span>
        </a>
    </div>
    <div class="col-md-4 catbuttons">
        <a href="#">
        <i class="fa fa-book" aria-hidden="true"></i>
        <span>Books</span>
        </a>
    </div>
</div>
<div class="clear clearfix"></div>
<div class="search_bar" style="margin-top: 30px;">
    <div class="">
        <div id="custom-search-input">
            <div class="input-group ">
            {{ Form::open(['route' => 'editMarketSubmit', 'method' => 'GET' , 'id' =>'marketsearchfrm']) }}
              <input name="query" type="text" style="font-size: 17px;" class="form-control form-control-nc" style="width: 445px;" placeholder="Search in Market Place..." />
            {{ Form::close() }}
            <span class="input-group-btn">
              <div class="search_icon edu-bg-green" style="border-radius: 0px 5px 5px 0px;"><div onclick="$('#marketsearchfrm').submit()"><img src="{{asset('img/icons/search.png')}}" alt="" border="0"></a></div>
            </span>
            </div>
        </div>
    </div>
</div>
<h4 class="opensans section-spozator">You'll Love These</h4>
<div>
@foreach ($market as $item)
<div class="col-md-12" style="margin-bottom: 20px; border-bottom: solid 1px #ccc;">
    <div class="col-md-2">
        <a href="{{ route('productDetail', ['id' => $item->id,'slug' => $item->slug]) }}" ><img style="height: 120px; margin-bottom: 10px;" src="{{ asset('img/books/' . explode(',', $item->images)[0]) }}"></a>
    </div>
    <div class="col-md-10">
        <a class="scholar_link" href="{{ route('productDetail', ['id' => $item->id,'slug' => $item->slug]) }}">{{ $item->title }}</a> <br><span>by {{ $item->author_name }}</span><br>
        <span><i class="fa fa-inr"></i><del>Rs. {{ $item->price }}</del>&nbsp; Rs. {{ $item->discount }}</span>
        <br>
        <span>{{ substr($item->description,0,150) }}</span>
    </div>
</div>
@endforeach


</div>

@if($market->total() > 8)
<ul class="pagination">
<li class="{{ $market->currentPage() == $market->firstItem() ? "disabled" : "" }}">
  <a href="{{ route('marketplace', ['page' => $market->currentPage()-1]) }}" aria-label="Previous">
    <span aria-hidden="true">&laquo;</span>
  </a>
</li>
@for($i = 1; $i <= $market->total(); $i++)
    <li class="{{ $i == $market->currentPage() ? 'active' : ""}}"><a href="{{ route('marketplace', ['page' => $i]) }}">{{ $i }}</a></li>
@endfor
<li class="{{ $market->currentPage() == $market->lastPage() ? "disabled" : "" }}">
  <a href="{{ route('marketplace', ['page' => $market->currentPage()+1]) }}" aria-label="Next">
    <span aria-hidden="true">&raquo;</span>
  </a>
</li>
</ul>
@endif

<!-- End Part 1 -->
<!-- Featured ADS -->
<h4 class="opensans section-spozator">Featured ADS</h4>

@foreach ($featured as $item)
<div class="col-md-3">
    <a href="{{ route('productDetail', ['id' => $item->id,'slug' => $item->slug]) }}"><img src="{{ asset('img/books/' . explode(',', $item->images)[0]) }}"  style="height:120px!important; width: 100%; padding: 0 20%;"></a>
    <div style="margin: auto; display: block; text-align: center;">
    <a class="scholar_link" style="font-size: 15px; font-weight:400; line-height:1.2em; color: #2bbba1;" href="{{ route('productDetail', ['id' => $item->id,'slug' => $item->slug]) }}">{{ $item->title }}</a> <br><span style="color:#555!important; font-size:12px;">by {{ $item->author_name}}</span><br>
    <span><i class="fa fa-inr"></i><del style="color: #b12704">Rs. {{ $item->price }}</del>&nbsp; Rs. {{$item->discount }}</span>
    </div>
</div>

@endforeach

<!-- Newest ADS -->
<h4 class="opensans section-spozator">Latest Items</h4>

@foreach ($latest as $item)
<div class="col-md-3">
    <a href="{{ route('productDetail', ['id' => $item->id,'slug' => $item->slug]) }}"><img src="{{ asset('img/books/' . explode(',', $item->images)[0]) }}"  style="height:120px!important; width: 100%; padding: 0 20%;"></a>
    <div style="margin: auto; display: block; text-align: center;">
    <a class="scholar_link" style="font-size: 15px; font-weight:400; line-height:1.2em; color: #2bbba1;" href="{{ route('productDetail', ['id' => $item->id,'slug' => $item->slug]) }}">{{ $item->title }}</a> <br><span style="color:#555!important; font-size:12px;">by {{ $item->author_name}}</span><br>
    <span><i class="fa fa-inr"></i><del style="color: #b12704">Rs. {{ $item->price }}</del>&nbsp; Rs. {{$item->discount }}</span>
    </div>
</div>

@endforeach
@endsection