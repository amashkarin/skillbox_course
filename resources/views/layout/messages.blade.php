@if(Session::has('message'))
    <div class="container">
        <div class="alert alert-success">{{Session::get('message')}}</div>
    </div>
@endif