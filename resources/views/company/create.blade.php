<x-app-layout>
<form method="POST" action="/store-company">
@csrf
<input type="text" name="company_name" placeholder="Company Name">
<input type="text" name="admin_name" placeholder="Admin Name">
<input type="email" name="admin_email" placeholder="Admin Email">
<input type="password" name="password" placeholder="Password">
<button>Create</button>
</form>
</x-app-layout>