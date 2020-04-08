@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card-header">
                    <h1>{{ $question->title }}</h1>
                </div>
                <div class="card-body">
                    {!! $question->body  !!}
                </div>
                <div class="card-footer">
                    {{--TO DISPLAY THE USER INFO OF THE OWNER--}}

                    <div class="d-flex justify-content-between">
                        <div class="d-flex">
                            <div>
                                <a href="" title="up vote" class="d-block text-dark text-center">
                                    <i class="fa fa-caret-up fa-3x"></i>
                                </a>
                                <h4 class="text-dark m-0 text-center">{{ $question->votes_count }}</h4>
                                <a href="" title="up vote" class="d-block text-dark text-center">
                                    <i class="fa fa-caret-down fa-3x"></i>
                                </a>
                            </div>
                            <div class="ml-5 mt-4">
                                <a href="" class="d-block text-center">
                                    <i class="fa fa-star text-dark fa-2x"></i>
                                </a>
                                <h4 class="text-dark mt-0">45</h4>
                            </div>
                        </div>
                        <div class="d-flex flex-column">
                            <div class="text-muted flex-column">
                                Asked : {{ $question->created_date }}
                            </div>
                            <div class="d-flex mb-2">
                                <div >
                                    <img src="{{$question->owner->avatar}}" alt="{{$question->owner->name}}">
                                </div>
                                <div class="mt-2 ml-2">
                                    {{ $question->owner->name }}
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            {{--ANSWERS--}}


        </div>
@include('answers._index')
        @include('answers._create')
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.js"></script>
@endsection

@section('styles')
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.css">
@endsection
