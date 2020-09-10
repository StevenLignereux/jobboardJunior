@extends('auth.layout.master')
@section('title', 'Dashboard')
@section('content')
<div class="container-fluid mt-5">
    <div class="row mb-5 ml-5">
        <div class="col-3">

            <form method="GET" action="{{ route('bo.dashboard.index') }}">
                <div class="form-group">
                    <label>Statut</label>
                    <select name="status" class="form-control input-sm">
                        <option value="">Tout</option>
                        @foreach (config('status') as $status)
                        <option value="{{ $status }}" {{ $filter['status'] == $status ? 'selected' : '' }}>{{ $status }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Title / Description / Id / Company</label>
                    <input name="text" class="form-control input-sm" value="{{$filter['text'] ?? ''}}" />
                </div>
                <div class="form-group">
                    <label>City</label>
                    <input name="city" class="form-control input-sm" value="{{$filter['city'] ?? ''}}" />
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="" name="cpc">
                    <label class="form-check-label" for="defaultCheck1">
                        Order by cpc
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="" name="not_send">
                    <label class="form-check-label" for="defaultCheck1">
                        Not send yet
                    </label>
                </div>
                <button type="submit" class="btn btn-primary">Filter</button>
            </form>
        </div>
    </div>
    Count : {{$count}}<br>
    {{ $jobs->links()}}
    <table id="table" class="table table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Partenaire id</th>
                <th scope="col">Partenaire</th>
                <th scope="col">Société</th>
                <th scope="col">Titre</th>
                <th scope="col">Description</th>
                <th scope="col">Ville</th>
                <th scope="col">Link</th>
                <th scope="col">Contrat</th>
                <th scope="col">CPC</th>
                <th scope="col">Views</th>
                <th scope="col">Créé le</th>
                <th scope="col">Posté le</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($jobs as $job)
            <tr id="row-{{$job->partner_id}}">
                <th scope="row">{{$job->id}}</th>
                <th scope="row">{{$job->partner_id}}</th>
                <th scope="row" style="width:5%">{{$job->partner_name}}</th>
                <th scope="row" style="width:5%">{{$job->company_name}}</th>
                <td style="width:10%">{{$job->title}}</td>
                <td style="width: 25%">{!! $job->job_description !!}</td>
                <td style="width:5%">{{$job->city}}</td>
                <td><a href="{{$job->link}}">show</a></td>
                <td>
                    <select name="type" class="form-control input-xs"
                        onchange="manageType(event, '{{$job->partner_id}}', '{{$job->partner_name}}');">
                        @foreach (config('contracts') as $key => $contract)
                        <option value="{{ $key }}" {{ intval($job->type) === intval($key) ? 'selected' : '' }}>
                            {{ $contract['type'] }}
                        </option>
                        @endforeach
                    </select>
                <td>{{$job->cpc}}</td>
                <td>{{$job->views}}</td>
                <td>{{$job->created_at}}</td>
                <td>{{$job->posted_date}}</td>
                <td>
                    <div class="form-group">
                        <select name="status" class="form-control input-sm"
                            onchange="manage(event, '{{$job->partner_id}}', '{{$job->partner_name}}');">
                            @foreach (config('status') as $status)
                            <option value="{{ $status }}" {{ $job->status == $status ? 'selected' : '' }}>
                                {{ $status }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </td>
            </tr>
            </form>
            @endforeach
        </tbody>
    </table>
</div>

<script>
    const urlManageJob = "{{route('bo.dashboard.manage')}}";
    const urlManageType = "{{route('bo.dashboard.updatetype')}}";
    function manage(event, partnerId, partnerName) {
        const status = event.target.value;
        const data = {
            "partner_id": partnerId,
            "partner_name": partnerName,
            "status": status
        }
        axios.post(urlManageJob, data).then(response => {
            if (response.status == 200) {
                $.notify("Job " + partnerId + " set to " + status, "success");
                document.getElementById('row-' + partnerId).remove();
            } else {
                $.notify("Failed set job " + partnerId + " to " + status, "error");
            }
        })
    }


    function manageType(event, partnerId, partnerName) {
        const type = event.target.value;
        const data = {
            "partner_id": partnerId,
            "partner_name": partnerName,
            "type": type
        }
        axios.post(urlManageType, data).then(response => {
            if (response.status == 200) {
                $.notify("Job " + partnerId + " set to " + type, "success");
            } else {
                $.notify("Failed set job " + partnerId + " to " + type, "error");
            }
        })
    }

</script>
@endsection