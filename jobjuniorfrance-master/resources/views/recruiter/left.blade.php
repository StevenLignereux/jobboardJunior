<div class="col-12 col-md-12 col-lg-8">
    <form method="post" action="{{ route('recruiter.post.job') }}" id="payment-form">
        {{ csrf_field() }}
        <input name="admin_token" value="{{ $adminToken }}" hidden>
        @include('recruiter.job')
        @if(empty($adminToken) || (!empty($adminToken) &&  $adminToken != config('site.admin_token') ))
            @include('recruiter.company')
            <div id="options">
                <impact propsPrice="{{ config('site.prices.price') }}"
                        propsHighlight="{{ config('site.prices.highlight') }}"
                        propsWeek="{{ config('site.prices.week') }}"
                        propsMonth="{{ config('site.prices.month') }}"
                ></impact>
            </div>
        @endif
    </form>
</div>