
<div class="form-group">
    <div class="container">
        <div class="row">
          <div class="col-md-12">
              @php
                  $attributes=['class'=>'form-control','label'=>trans('app.question'),'required'=>1];
              @endphp

              @include('form.input',['name'=>'question','type'=>'textarea','attributes'=>$attributes])

              @php
                  $attributes=['class'=>'form-control','label'=>trans('app.question_recommendation')];
              @endphp

              @include('form.input',['name'=>'question_recommendation','type'=>'textarea','attributes'=>$attributes])

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

