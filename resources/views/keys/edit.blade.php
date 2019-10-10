@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Key
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($key, ['route' => ['keys.update', $key->id], 'method' => 'patch']) !!}

                        @include('keys.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection