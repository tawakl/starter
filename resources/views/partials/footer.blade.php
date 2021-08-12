<div class="slim-footer"style="margin-top: 300px">
    <div class="container">
        <p>{{ trans('app.Copyright') }} {{ date('Y') }} &copy; {{ trans('app.All Rights Reserved') }}. {{appName()}}</p>
        <p>
            {{ trans('app.Developed by') }}: {{appName()}}
            <img src="{{asset('img/logo.jpeg')}}" width="40px">
        </p>
    </div><!-- container -->
</div>