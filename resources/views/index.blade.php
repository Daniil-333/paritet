@extends('layouts.layout')

@section('title')
@parent Купите квартиру — получите автомобиль и другие 100 подарков
@endsection

@section('content')
    <main class="main">
        @include('main.promo')
        @include('main.gift')
        @include('main.membership')
        @include('main.video')
        @include('main.about')
        @include('main.slider')
        @include('main.join')
    </main>
@endsection
