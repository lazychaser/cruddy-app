@if ($errors->has('sentry'))
<p class="alert alert-warning">{{ $errors->first('sentry') }}</p>
@endif

{{ Form::open(['class' => 'form-inline']) }}

<div class="form-group">
    {{ Form::label('email', 'Email', ['class' => 'sr-only']) }}

    {{ Form::email('email', null, array(
        'required' => true,
        'placeholder' => 'E-mail',
        'class' => 'form-control',
    )) }}
</div>

<div class="form-group">
    {{ Form::label('password', 'Password', ['class' => 'sr-only']) }}
    
    {{ Form::password('password', array(
        'required' => true,
        'placeholder' => 'Пароль',
        'class' => 'form-control',
    )) }}
</div>

{{ Form::submit('Отправить', ['class' => 'btn btn-default']) }}

{{ Form::close() }}