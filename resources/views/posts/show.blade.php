@extends('layout')

@section('meta-title', $post->title)


@section('content')
<!-- Page Header -->


@if($post->photos->count() === 1)
<header class="masthead" style="background-image: url({{ $post->photos->first()->url }})">
@else
<header class="masthead" style="background-color: #f60 ">
@endif
  <div class="overlay"></div>
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
        <div class="post-heading">
          <h1>{{ $post->title }}</h1>
          <!-- <h2 class="subheading">Problems look mighty small from 150 miles up</h2> -->
          <span class="meta">Posted by
            <a href="#">Start Bootstrap</a>
            {{ $post->published_at->diffForHumans() }}</span>
        </div>
      </div>
    </div>
  </div>
</header>

<!-- Post Content -->
<article>
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
        {!! $post->body !!}
      </div>
      <div class="col-lg-8 col-md-10 mx-auto">
        @foreach($post->tags as $tag)
          <span> #{{ $tag->name }} </span>
        @endforeach
      </div>
    </div>
  </div>
</article>

<hr>

@stop
