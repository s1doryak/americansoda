@if($model->photo && $model->photo->original && $model->photo->original->url)
    <a href="{{ $model->photo->original->url }}" target="_blank" title="{{ $model->name }}">
        <img src="{{ $model->photo->original->url }}" alt="{{ $model->name }}">
    </a>
@endif