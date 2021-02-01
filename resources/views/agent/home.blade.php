@extends('agent.layouts.app')

@section('content')
<v-app>
    <my-stock :guard="'agent'" />
</v-app>
@endsection
