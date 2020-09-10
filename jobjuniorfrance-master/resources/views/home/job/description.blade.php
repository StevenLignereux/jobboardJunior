<div class="row job-card pb-3" v-show="id == '{{ $job->id }}'">
    <div class="col">
        <h5 class="mb-3 mt-3" >Description du poste</h5>
        {!! $job->job_description !!}
        @if(!empty($job->how_to_apply))
            <h5 class="mb-3 mt-3">Comment postuler ?</h5>
            {!! $job->how_to_apply !!}
        @endif
    </div>
</div>