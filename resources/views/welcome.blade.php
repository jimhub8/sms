@extends('layouts.app')

@section('content')
<v-app>

    {{-- <router-view /> --}}
    <my-header :user="{{ json_encode($user) }}" :guard="{{ json_encode(Auth::getDefaultDriver()) }}"></my-header>
    <my-app :user="{{ json_encode($user) }}" :guard="{{ json_encode(Auth::getDefaultDriver()) }}" />
</v-app>
@endsection
