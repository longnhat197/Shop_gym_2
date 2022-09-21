@if (session('notification'))
<div class="alert alert-warning">
    {{ session('notification') }}
</div>
@endif
