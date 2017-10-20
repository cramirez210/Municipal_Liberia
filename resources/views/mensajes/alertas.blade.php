@if (session()->has('info')) 
<br>
    <dir class="alert alert-success text-center" id="suceso"> <b>{{session('info')}}</b></dir>
@elseif (session()->has('error')) 
<br>
    <dir class="alert alert-danger align-middle text-center" id="suceso"><b>{{session('error')}}</b></dir>
@elseif (session()->has('warning')) 
<br>
    <dir class="alert alert-warning align-middle text-center" id="suceso"><b>{{session('waring')}}</b></dir>
@endif
