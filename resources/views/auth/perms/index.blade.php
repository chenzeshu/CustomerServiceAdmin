@extends('layouts.app')

@section('content')
    <div class="container">
        <v-userrole :users="{{ $users }}" :roles="{{ $roles }}"></v-userrole>
    </div>
@endsection