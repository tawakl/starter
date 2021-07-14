

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







