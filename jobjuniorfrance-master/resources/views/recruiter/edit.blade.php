@extends('layout.app')
@section('title', 'Je suis un recruteur - Edition de l\'offre')
@section('content')
<div class="container-fluid">
    <div id="edit-job" class="row">
        <div class="col-12 col-md-12 col-lg-8">
            <form method="post" action="{{ route('recruiter.update.job', ['token' => $job->token]) }}" id="payment-form">
                    {{ csrf_field() }}
                    <fieldset class="border p-4">
                            <legend class="w-auto text-center p-3">édition de l'offre</legend>

                            <div class="form-group mt-4">
                                <label for="position">Type de poste</label>
                                <br>
                                @foreach ( $contracts as $key => $contract)
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio"  value="{{ $key }}" name="contract" required {{ $job->type == $key ? 'checked' : '' }}>
                                    <label class="form-check-label" for="contract">{{ $contract['type'] }}</label>
                                </div>
                                @endforeach
                            </div>
                            <div class="form-group mt-4">
                                <label for="position">Intitulé du poste *</label>
                                <input type="text" class="form-control" id="position" aria-describedby="positionHelp" name="title" required value="{{ $job->title }}">
                                <small id="positionHelp" class="form-text text-muted">Intitulé du poste, e.g. "Front-End developper - ReactJs" ou "Back-end developper PHP - Laravel"</small>
                            </div>
                            <div class="form-group mt-4">
                                <label for="company_name">Nom de l'entreprise *</label>
                                <input type="text" class="form-control" id="company_name" aria-describedby="company_name" name="company_name" required value="{{ $job->company_name }}">
                            </div>
                            <div class="form-group mt-4">
                                <label for="city">Ville *</label>
                                <input type="text" class="form-control" id="city" aria-describedby="city" name="city" required value="{{ $job->city }}">
                            </div>
                            <div id="tag-selector">
                                <div class="form-group mt-4">
                                    <label for="techno">techno ou étiquette *</label>
                                    <selector name="tags" id="tags" :tags="{{ $tags }}" :default-Value="{{ $job->tags }}"></selector>
                                </div>
                            </div>
                            <small class="form-text text-muted">Si selon profil et expérience, veuillez laisser zéro</small>
                            <div class="form-group mt-4">
                                <label for="link_to_apply">Lien vers la fiche du poste</label>
                                <input type="text" class="form-control" id="link_to_apply" aria-describedby="link_to_apply" name="link" value="{{ $job->link }}">
                            </div>
                            <div id="editor">
                                <div class="strike bu">
                                    <span>ou</span>
                                </div>
                                <div class="form-group mt-4">
                                    <label for="job_description">Description du poste</label>
                                    <wys name="job_description" init="{{ $job->job_description }}"></wys>
                                    <small class="form-text text-muted">Donnez vos attentes ! Et essayez d'immerger votre futur développeur !</small>
                                    <small class="form-text text-muted">Bien entendu, ici vous n'aurez que des purs junior, alors pas besoin de mettre "min 2 ans XP" :)</small>
                                    <small class="form-text text-muted">Exemple: Bonnes notions de la POO, avoir travaillé sur framework php de type symfony ou laravel. Savoir s'intégrer rapidement à une équipe et écouter les feedbacks</small>
                                </div>
                                <div class="form-group mt-4">
                                    <label for="how_to_apply">Comment postuler</label>
                                    <wys name="how_to_apply" init="{{ $job->how_to_apply }}"></wys>
                                    <small class="form-text text-muted">Cela peut être l'envoi d'un cv par email, ou bien un lien vers votre entreprise.</small>
                                </div>
                            </div>
                            <div class="form-group mt-4">
                                <label for="company_email">E-mail de l'entreprise *  ( Celui-ci reste privé, il ne sert qu'à' l'édition de la fiche)</label>
                                <input type="email" class="form-control" id="company_email" aria-describedby="company_email" name="company_email" required value="{{ $job->company_email }}">
                            </div>
                            <button type="submit" class="btn bg-bl mt-5 float-right">Mettre à jour</button>
                        </fieldset>
            </form>
        </div>
</div>

<script src="/js/recruiter.js"></script>

@endsection
