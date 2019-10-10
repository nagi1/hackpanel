<!-- App Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('app_id', 'App:') !!}
    {!! Form::select('app_id', \App\App::pluck('name', 'id')->toArray(), null, ['class' => 'form-control']) !!}
</div>

<!-- Plan Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('plan_id', 'Plan:') !!}
    {!! Form::select('plan_id', \App\Plan::pluck('name', 'id')->toArray(), null, ['class' => 'form-control']) !!}
</div>




  @if( \Route::current()->getName() == 'keys.create' )

<div class="form-group col-md-6">

    <div class="col-md-6">
     {!! Form::checkbox('new_key_expires', true, config('main.new_key_expires')) !!}    
     {!! Form::label('new_key_expires', 'Start Expire Date when creating') !!}
    </div>

    <div class=" col-sm-6">
        {!! Form::label('key_count', 'How many keys?:') !!}
        {!! Form::text('key_count', 1, ['class' => 'form-control']) !!}
    </div>
</div>

   <div class="form-group col-md-6">

        <div class="col-md-6">
             {!! Form::label('key', 'Prefix-Key:') !!}
             {!! Form::text('key_prefix', config('main.default_key_prefix'), ['class' => 'form-control'] ) !!}
        </div>

        <div class="col-md-6"> 
            {!! Form::label('key_len', 'Key length:') !!}
            {!! Form::text('key_len', config('main.default_key_length'), ['class' => 'form-control']) !!}
        </div>

    </div>

   @endif


   @if(\Route::current()->getName() == 'keys.edit')

        <div class="form-group col-sm-6">
            {!! Form::label('key', 'Key:') !!}
            {!! Form::text('key', null, ['class' => 'form-control']) !!}
        </div>
   @endif


<!-- Expires Field -->
<div class="form-group col-sm-6">
    {!! Form::label('expires', 'Expires Date (Leave it Blank if multiple):') !!}
    {!! Form::text('expires', null, ['class' => 'form-control','id'=>'expires']) !!}
</div>

@section('scripts')
    <script type="text/javascript">
        $('#expires').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: false
        })
    </script>
@endsection

<!-- Hwid Field -->
<div class="form-group col-sm-6">
    {!! Form::label('hwid', 'HWID (Leave it Blank if multiple):') !!}
    {!! Form::text('hwid', null, ['class' => 'form-control']) !!}
</div>

<!-- Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email', 'Email (Leave it Blank if multiple):') !!}
    {!! Form::text('email', null, ['class' => 'form-control']) !!}
</div>


<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('keys.index') !!}" class="btn btn-default">Cancel</a>
</div>
