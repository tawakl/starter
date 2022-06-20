
<div class="form-group">
    <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="col-md-8 float-left">

                <div class="form-group">
@include('form.select',[
    'name'=>'year_id',
    'options'=>$row->getYears(),
    'attributes'=>[
        'class'=>'form-control',
        'required'=>'required',
        'label'=>trans('post.years'),
        ]
    ])

</div>
<div class="form-group">
    {!! Form::textarea('question',null,[
    'class' => 'form-control ckeditor',
     ]) !!}
</div>
<div class="form-group">
    {!! Form::textarea('question_recommendation',null,[
    'class' => 'form-control ckeditor',
     ]) !!}
</div>

</div>
<div class="col-md-4 float-right">
    <article>
        <h2 class="text-center">{{trans('app.question')}}</h2>
        <p>{!!$row->question!!}</p>
    </article>
</div>
</div>
</div>
</div>
</div>
<div class="form-group">
<button class="btn btn-primary" type="submit"> {{trans('app.Save')}}</button>
</div>




<script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
<script type="text/javascript">
$(document).ready(function() {
$('.ckeditor').ckeditor();
});
</script>

