@extends('admin-auth::layouts.master')

@section('content')

<div id="app">

    @if(session('passwordResetMessage'))
        <div class="py-3 text-center text-white bg-green-600 border">
            {{ session('passwordResetMessage') }}
        </div>
    @endif

    <login-form placeholder="Usuário"></login-form>

</div>

@endsection