<div class="modal fade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Подробная информация</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                
            </div>
            <div class="modal-body">
                <h1>{{ $worker->name }}</h1>
                <div class="row">
                    <div class="col-sm-7">
                        <p><strong>Должность:</strong> {{ $worker->post->name }}</p>
                        <p><strong>Зарплата:</strong> {{ $worker->salary }}</p>
                        <p><strong>Принят:</strong> {{ $worker->created_at->format('d-m-Y') }}</p>
                        <p><strong>Последние изменения:</strong> {{ $worker->updated_at->format('d-m-Y') }}</p>
                    </div>
                    <div class="col-sm-5">
                        <img src="{{ asset('storage/avatars/'.$worker->avatar) }}" alt="{{ $worker->name }}" class="img-thumbnail center-block">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
            </div>
        </div>
    </div>
</div>