@extends('layouts.layout')

@section('title', 'W mediach')

@section('background', $content->string_1)

@section('content')
    <div class="main-content">
        <div class="row"><!-- row -->

            <!-- About -->
            <div class="col-md-12">
                <h1 class="animbounceInLeft" data-time="600">Media</h1>
                @if(!empty($content->lead))<h2 class="animbounceInLeft" data-time="900">{{ $content->lead }}</h2>@endif
                <div class="devider-page animfadeInLeft" data-time="1100"></div>
            </div>

            <div class="col-md-12 spacedown animfadeInUp" data-time="1800">
                {!! $content->text !!}
            </div>


            <!-- About end -->
        </div><!-- row end -->
    </div>

@endsection
