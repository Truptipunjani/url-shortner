<x-app-layout>

<div class="container mt-4">

<div class="card shadow p-4">

<div class="d-flex justify-content-between">

<h4>
Welcome, {{ Auth::user()->name }}
</h4>

<span class="badge bg-primary p-2">
{{ Auth::user()->role }}
</span>

</div>

<hr>


{{-- CREATE URL FORM --}}
@if(Auth::user()->role == 'Admin' || Auth::user()->role == 'Member')

<div class="card p-3 mb-4">

<h5>Create Short URL</h5>

<form method="POST" action="/create-url">
@csrf

<div class="row">

<div class="col-md-10">
<input type="text"
name="original_url"
class="form-control"
placeholder="Enter Original URL"
required>
</div>

<div class="col-md-2">
<button class="btn btn-success w-100">
Generate
</button>
</div>

</div>

</form>

</div>

@endif


@if(Auth::user()->role == 'SuperAdmin')

<div class="alert alert-danger">
Super Admin cannot create Short URL
</div>

@endif

@if(Auth::user()->role != 'Member')

<a href="/invite-member"
class="btn btn-success mb-3">
Invite User
</a>

@endif
{{-- URL TABLE --}}

<h5>Generated Short URLs</h5>

<table class="table table-bordered table-hover mt-3">

<tr class="table-dark">
<th>Short URL</th>
<th>Original URL</th>
<th>Created By</th>
<th>Action</th>
</tr>

@foreach($data as $url)

<tr>

<td>
<a href="{{ url('/'.$url->short_code) }}" target="_blank">
{{ url('/'.$url->short_code) }}
</a>
</td>

<td>{{ $url->original_url }}</td>

<td>{{ $url->user_id }}</td>

<td>

<button class="btn btn-sm btn-primary"
onclick="navigator.clipboard.writeText('{{ url('/'.$url->short_code) }}')">

Copy

</button>

</td>

</tr>

@endforeach

</table>

</div>

</div>

</x-app-layout>