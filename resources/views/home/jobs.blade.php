@extends('layouts.app')
@section('content')
    @if ($agent->isMobile())
    @else
        <Job></Job>
    @endif
@endsection