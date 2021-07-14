

@php
    $attributes=['class'=>'form-control','label'=>trans('app.Name'),'placeholder'=>trans('app.Name'),'required'=>1];
@endphp

@include('form.input',['name'=>'name','type'=>'text','attributes'=>$attributes])


@php
    $attributes=['class'=>'form-control','label'=>trans('app.Mobile'),'placeholder'=>trans('app.Mobile'),'required'=>1];
@endphp
@include('form.input',['name'=>'mobile_number','type'=>'text','attributes'=>$attributes])

<div class="form-group">
    <label for="name">Description</label>
    {!! Form::textarea('description',null,[
    'class' => 'form-control',
    'placeholder'=>trans('app.description')
     ]) !!}
</div>
<div class="form-group">
    <button class="btn btn-primary" type="submit"> {{trans('app.save')}}</button>
</div>







