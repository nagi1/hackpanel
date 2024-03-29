<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-6">
    {!! Form::label('description', 'Description:') !!}
    {!! Form::text('description', null, ['class' => 'form-control']) !!}
</div>

<?php
    $units =
     [
        'hour' => 'Hour(s)',
        'day' => 'Day(s)',
        'week' => 'Week(s)',
        'month' => 'Month(s)',
        'year' => 'Year(s)',
    ];
?>

<!-- Unit Interval Field -->
<div class="form-group col-sm-6">
    {!! Form::label('interval_unit', 'Interval Unit :') !!}
    {!! Form::select('interval_unit', $units , null, ['class' => 'form-control']) !!}
</div>

<!-- Hour Interval Field -->
<div class="form-group col-sm-6">
    {!! Form::label('interval_value', 'Interval Value:') !!}
    {!! Form::text('interval_value', null, ['class' => 'form-control']) !!}
</div>


<!-- Cost Field -->
<div class="form-group col-sm-6">
    {!! Form::label('cost', 'Cost:') !!}
    {!! Form::text('cost', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('plans.index') !!}" class="btn btn-default">Cancel</a>
</div>
