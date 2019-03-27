@extends('layout')

@section('content')
<!-- Page Header -->
<header class="masthead" style="background-image: url('img/home-bg.jpg')">
  <div class="overlay"></div>
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
        <div class="site-heading">
          <h1>Clean Blog</h1>
          <span class="subheading">A Blog Theme by Start Bootstrap</span>
        </div>
      </div>
    </div>
  </div>
</header>
    <!-- Main Content -->
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          @foreach($posts as $post)
          <div class="post-preview">
            <a href="blog/{{ $post->url }}">
              <h2 class="post-title">{{ $post->title }}</h2>
              <!-- <h3 class="post-subtitle"></h3> -->
              <p>{{ $post->except }}</p>
            </a>
            <p class="post-meta">Publicado por <a href="#">Blog.blog </a>on {{ $post->published_at->diffForHumans() }} </p>

            @foreach($post->tags as $tag)
              <span> #{{ $tag->name }} </span>
            @endforeach

            <p> | <a href="{{ route('categories.show', $post->category) }}">{{ $post->category->name }}</a> </p>
          </div>
          @endforeach



          <hr>
          <!-- Pager -->
          <div class="clearfix">
            <a class="btn btn-primary float-right" href="#">Older Posts &rarr;</a>
          </div>
        </div>
      </div>
    </div>
    <hr>

@stop
