<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $app->id !!}</p>
</div>

<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', 'Name:') !!}
    <p>{!! $app->name !!}</p>
</div>

<!-- Description Field -->
<div class="form-group">
    {!! Form::label('description', 'Description:') !!}
    <p>{!! $app->description !!}</p>
</div>

<!-- Version Field -->
<div class="form-group">
    {!! Form::label('version', 'Version:') !!}
    <p>{!! $app->version !!}</p>
</div>

<!-- Hash Field -->
<div class="form-group">
    {!! Form::label('hash', 'Hash:') !!}
    <p>{!! $app->hash !!}</p>
</div>

<!-- Status Field -->
<div class="form-group">
    {!! Form::label('status', 'Status:') !!}
    <p>{!! $app->status !!}</p>
</div>

<!-- Update Url Field -->
<div class="form-group">
    {!! Form::label('update_url', 'Update Url:') !!}
    <p>{!! $app->update_url !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $app->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $app->updated_at !!}</p>
</div>

