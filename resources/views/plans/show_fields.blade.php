<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $plan->id !!}</p>
</div>

<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', 'Name:') !!}
    <p>{!! $plan->name !!}</p>
</div>

<!-- Description Field -->
<div class="form-group">
    {!! Form::label('description', 'Description:') !!}
    <p>{!! $plan->description !!}</p>
</div>

<!-- Hour Interval Field -->
<div class="form-group">
    {!! Form::label('hour_interval', 'Hour Interval:') !!}
    <p>{!! $plan->hour_interval !!}</p>
</div>

<!-- Cost Field -->
<div class="form-group">
    {!! Form::label('cost', 'Cost:') !!}
    <p>{!! $plan->cost !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $plan->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $plan->updated_at !!}</p>
</div>

