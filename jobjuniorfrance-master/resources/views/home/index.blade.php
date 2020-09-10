@extends('layout.app')
@section('title', 'Accueil')
@section('content')

<!-- Hero -->
<div id="home" class="jumbotron jumbotron-fluid bg-transparent hero section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-12  mx-auto">
                <div class="hero-content">
                    @include('hero-content')
                </div>
            </div>
        </div>
        <div class="mt-5 col-lg-7 col-md-8 mx-auto text-center">
            <label for="search dosis">🔎 Recherche par ville, techno, contrat, entreprise...</label>
            <input class="form-control" @input="search($event)" name="search" id="search"
                placeholder="Reactjs Laravel Bordeaux CDI" />
        </div>
        @if(count($topJobs) > 0 )
        <h1 class="text-center mt-5 upper top-job">⭐ Les top jobs ⭐</h1>
        <board :jobs="{{ $topJobs }}" :contracts="{{ json_encode(config('contracts')) }}"></board>
        @endif
        <h3 class="text-center last-job mt-5">Les derniers jobs à la une</h3>
        <board :jobs="{{ $jobs }}" :contracts="{{ json_encode(config('contracts')) }}"></board>
    </div>
</div>
<script src="/js/home.js"> </script>
@endsection