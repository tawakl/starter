
<div class="form-group">

    @php
        $attributes=['class'=>'form-control','label'=>trans('app.description'),'placeholder'=>trans('app.description'),'required'=>1];
    @endphp

    @include('form.input',['name'=>'description','type'=>'textarea','attributes'=>$attributes])
</div>
<div class="form-group">
    <button class="btn btn-primary" type="submit"> {{trans('app.Save')}}</button>
</div>








