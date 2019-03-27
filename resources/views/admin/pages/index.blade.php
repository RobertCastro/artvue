@extends('admin.layout')
@section('content')

	<template v-if="menu==0">
		{{-- <pageslist></pageslist> --}}
    <router-view></router-view>
	</template>

	<template v-if="menu==1">
		<h2>menu 1</h2>
	</template>

	<template v-if="menu==2">
		{{-- <pagesview></pagesview> --}}
	</template>

	<template v-if="menu==3">
		<h2>menu 3</h2>
	</template>


@endsection