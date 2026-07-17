@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<div class="card shadow">

    <div class="card-body">

        <h2 class="fw-bold">

            Dashboard Admin

        </h2>

        <hr>

        <h5>

            Selamat Datang,

            <strong>{{ Auth::user()->name }}</strong>

        </h5>

        <p class="text-muted">

            Email :
            {{ Auth::user()->email }}

        </p>

        <p>

            Role :

            <span class="badge bg-success">

                {{ Auth::user()->role }}

            </span>

        </p>

    </div>

</div>

@endsection