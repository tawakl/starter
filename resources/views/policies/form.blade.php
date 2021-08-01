
<div class="form-group">
    <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="col-md-8 float-left">

                <div class="form-group">
                    {!! Form::textarea('description',null,[
                    'class' => 'form-control ckeditor',
                     ]) !!}
                </div>
            </div>
                <div class="col-md-4 float-right">
                    <article>
                        <h2 class="text-center">{{trans('app.Policy')}}</h2>
                        <p>{!!$row->description!!}</p>
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

