

@php
    $attributes=['class'=>'form-control','label'=>trans('users.Name'),'placeholder'=>trans('users.Name'),'required'=>1];
@endphp

@include('form.input',['name'=>'name','type'=>'text','attributes'=>$attributes])


@php
    $attributes=['class'=>'form-control','label'=>trans('users.Mobile'),'placeholder'=>trans('users.Mobile'),'required'=>1];
@endphp
@include('form.input',['name'=>'mobile_number','type'=>'text','attributes'=>$attributes])

<div class="form-group">
    <label for="name">Description</label>
    {!! Form::textarea('description',null,[
    'class' => 'form-control',
    'placeholder'=>trans('users.description')
     ]) !!}
</div>
<div class="form-group">
    <button class="btn btn-primary" type="submit"> {{trans('app.save')}}</button>
</div>







