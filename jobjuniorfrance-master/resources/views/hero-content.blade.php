<div class="row">
    <div class="col-12 col-sm-12 col-md-12 col-lg-6 hero-title text-left">
        <p class="lead-text">
            Inscris-toi à la newsletter pour être averti des nouveaux jobs de la semaine !
        </p>
        <form class="mt-3" action="{{ route('home.post.subscribe') }}" method="POST">
            {{ csrf_field() }}
            <div class="input-group mb-3">
                <input type="email" name="email" class="form-control newsletter" placeholder="Email" aria-label="Email"
                    aria-describedby="Email">
                <input hidden value="{{app('request')->input('p')}}" name="parrain">
                <div class="input-group-append">
                    <button class="btn bg-bl" type="submit">Je veux un super job !</button>
                </div>
            </div>
        </form>
        <small>Tu as matché avec une offre, besoin de préparer un entretien ou ton CV?</small>
        <br>
        <small>Envie de rencontrer de super dev juniors ?</small>
        <br>
        <small>
            Rejoins-nous sur le <a href="https://discord.gg/Jy2hCXF">discord</a> de la communauté ! &nbsp; <img
                src="images/discord.svg" width="25" height="25" class="rotate">
        </small>
    </div>
    <div class="col-12 col-sm-12 col-md-12 col-lg-6 mt-3 mt-md-3 mt-lg-0">
        <img src="images/developpers.jpg" class="image">
    </div>
</div>