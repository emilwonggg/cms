@extends('layouts.app')
@section('class-name')
    class="mobile"
@endsection
@section('content')
    @if ($agent->isMobile())
        <m-work></m-work>
    @else
        <work></work>
    @endif
@endsection