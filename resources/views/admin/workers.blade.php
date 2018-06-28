@extends('layouts.app')

@section('head')
    @parent
    <link href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container theme-showcase" role="main">
        <div class="row">
            <div class="main">
                <h1 class="card-header">Список сотрудников</h1>
                <div class="card panel-default" id="workers_list">
                    <div class="card-body">
                        <div class="table">
                            <div class="row table-header">
                                <div class="col-sm-2">
                                    <a href="{{ route('formCreateWorker') }}" class="btn btn-primary">Добавить сотрудника</a>
                                </div>
                                <div class="col-sm-10">
                                    @if(session()->has('success'))
                                        <div class="alert alert-success fade in">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            <strong>{{ session('success') }}</strong>
                                        </div>
                                    @endif
                                    @if(session()->has('error'))
                                        <div class="alert alert-danger fade in">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            <strong>{{ session('error') }}</strong>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <table id="workers" class="table table-striped table-hover">
                                <thead>
                                <tr>
                                    <th>ФИО</th>
                                    <th>Должность</th>
                                    <th>Зарплата</th>
                                    <th>Дата приема</th>
                                    <th>Операции</th>
                                </tr>
                                </thead>
                                <tfoot>
                                    <th>ФИО</th>
                                    <th>Должность</th>
                                    <th>Зарплата</th>
                                    <th>Дата приема</th>
                                    <th>Операции</th>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="modal__wrapper"></div>
@endsection

@section('scripts')
    @parent
    <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('js/script.js') }}"></script>
    <script>
        $(document).ready( function () {
            $('#workers').DataTable({
                "displayLength": 25,
                "stateSave": true,
                "Processing": true,
                "serverSide": true,
                rowId: 'id',
                ajax: {
                    url: '{{ route('getWorkers') }}',
                    data: {
                        '_token': $('meta[name=csrf-token]').attr('content')
                    },
                    type: "POST"
                },
                "columns": [
                    {
                        "data": "name",
                        "name": "name",
                        "render": function ( name )  {
                            return '<button class="btn btn-xs btn-link worker_name" title="Подробный просмотр">'+name+'</button>';
                        }
                    },
                    { "data": "post.name", "name": "post_id" },
                    { "data": "salary", "name": "salary" },
                    { "data": "created_at", "name": "created_at" },
                    {
                        "data": null,
                        "orderable": false,
                        "render": function (row)  {
                            return '<a href="/admin/'+row.id+'/edit" class="btn btn-xs btn-primary" title="Изменить запись">Изменить</a> '+
                                ' <button class="btn btn-xs btn-danger" title="Удалить запись" onclick="if(confirm(\'Вы действительно хотите удалить запись?\')\) window.location = \'/admin/'+row.id+'/destroy\'">Удалить</button>';
                        }
                    }
                ]
            });
        });
    </script>
@endsection

