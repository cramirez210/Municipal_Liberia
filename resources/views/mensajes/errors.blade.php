  @if(count($errors))

        @if($errors->has('valor'))
        <dir class="alert alert-warning text-center"> <b>{{ $errors->first('valor') }}</b></dir>
        @endif

        @if($errors->has('Criterio'))
        <dir class="alert alert-warning text-center"> <b>{{ $errors->first('Criterio') }}</b></dir>
        @endif

        @if($errors->has('desde'))
        <dir class="alert alert-warning text-center"> <b>{{ $errors->first('desde') }}</b></dir>
        @endif
        
        @if($errors->has('hasta'))
        <dir class="alert alert-warning text-center"> <b>{{ $errors->first('hasta') }}</b></dir>
        @endif
@endif 