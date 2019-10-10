<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

  @if( \Route::current()->getName() == 'apps.create' )
    <div class="form-group col-sm-6">
        {!! Form::label('access_token', 'Client Access Token:') !!}
        {!! Form::text('access_token', str_random(60), ['class' => 'form-control', 'readonly'=>true]) !!}
    </div>
@endif

<!-- Description Field -->
<div class="form-group col-sm-6">
    {!! Form::label('description', 'Description:') !!}
    {!! Form::text('description', null, ['class' => 'form-control']) !!}
</div>

<!-- Version Field -->
<div class="form-group col-sm-6">
    {!! Form::label('version', 'Version:') !!}
    {!! Form::text('version', null, ['class' => 'form-control']) !!}
</div>

<!-- Hash Field -->
<div class="form-group col-sm-6">
    {!! Form::label('hash', 'Hash:') !!}
    {!! Form::text('hash', null, ['class' => 'form-control']) !!}
</div>

<!-- Status Field -->
<div class="form-group col-sm-6">
    {!! Form::label('status', 'Status:') !!}
    {!! Form::text('status', null, ['class' => 'form-control']) !!}
</div>

<!-- Update Url Field -->
<div class="form-group col-sm-6">
    {!! Form::label('update_url', 'Update Url:') !!}
    {!! Form::text('update_url', null, ['class' => 'form-control']) !!}
</div>



<hr>

<!-- Meta Data -->
<div class="form-group col-sm-6">
    <p>Additional Meta Data:</p>

    <div class="meta_place">

        @if( \Route::current()->getName() == 'apps.edit' )

            @foreach ($app->getAllMeta() as $key => $value)

                {!! Form::label('meta_key', 'Meta Key:') !!}
                {!! Form::text('meta_key[]', $key, ['class' => 'form-control']) !!}
                {!! Form::label('meta_value', 'Meta Value:') !!} 
                {!! Form::text('meta_value[]', $value, ['class' => 'form-control']) !!}

            @endforeach

        @endif

    </div>

    <br>
    <a href="#" class="btn btn-primary add_meta_btn">Add Meta</a>
</div>



<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('apps.index') !!}" class="btn btn-default">Cancel</a>
</div>



@push('scripts')

    <script>
    $(function(){
        $('.add_meta_btn').click(function()
            {
                $('.meta_place').append('{!! Form::label('meta_key', 'Meta Key:') !!} {!! Form::text('meta_key[]', null, ['class' => 'form-control']) !!} {!! Form::label('meta_value', 'Meta Value:') !!} {!! Form::text('meta_value[]', null, ['class' => 'form-control']) !!}');
            });
    });
</script>

@endpush