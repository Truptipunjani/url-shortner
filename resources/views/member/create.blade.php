<x-app-layout>

<div class="container mt-4">
<div class="card p-4">

<h4>Invite User</h4>

<form method="POST" action="/store-member">
@csrf


{{-- Only SuperAdmin sees Company field --}}
@if(Auth::user()->role == 'SuperAdmin')
<div class="mb-3">
<label>Company Name</label>
<input type="text" name="company_name" class="form-control" required>
</div>
@endif


<div class="mb-3">
<label>Name</label>
<input type="text" name="name" class="form-control" required>
</div>

<div class="mb-3">
<label>Email</label>
<input type="email" name="email" class="form-control" required>
</div>


{{-- Only Admin selects role --}}
@if(Auth::user()->role == 'Admin')
<div class="mb-3">
<label>Role</label>
<select name="role" class="form-control">
<option value="Admin">Admin</option>
<option value="Member">Member</option>
</select>
</div>
@endif


<button class="btn btn-primary">Invite</button>

</form>

</div>
</div>

</x-app-layout>