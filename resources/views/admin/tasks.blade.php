@extends('admin.layouts.header')
@section('content')
    <table class="table">
            <tr>
                <td style="max-width: 10px">#</td>
                <td>Предмет</td>
                <td>Урок</td>
                <td>Название</td>
                <td>Описание</td>
                <td>Пример</td>
                <td>Тип примера</td>
                <td>Ресурс</td>
                <td></td>
            </tr>
        <tbody id="content">
            @foreach($tasks as $task)
                <tr>
                    <td style="max-width: 10px">{{$task->task_id}}</td>
                    <td>
                        {{$task->name}}
                    </td>
                    <td>
                        {{$task->title}}
                    </td>
                    <td>
                        <input class="form-control form-edit" type="text" id="title{{$task->task_id}}" name="title" data-id="{{$task->task_id}}" value="{{$task->task}}"></input>
                    </td>
                    <td >
                        <textarea class="form-control form-edit" data-id="{{$task->task_id}}" name="description" id="desc{{$task->task_id}}">{{$task->description}}</textarea>
                    </td>
                    <td>
                        <input class="form-control form-edit" type="text" id="example{{$task->task_id}}" name="title" data-id="{{$task->task_id}}" value="{{$task->example}}"></input>
                    </td>
                    <td>
                        <select class="form-control form-edit" id="example_type{{$task->task_id}}" name="example_type" data-id="{{$task->task_id}}">
                            <option value="frame" @if($task->example_type == "frame") selected @endif>Ссылка для вставки контента (iframe)</option>
                            <option value="img" @if($task->example_type == "img") selected @endif>Картинка</option>
                            <option value="link" @if($task->example_type == "link") selected @endif>Ссылка для перехода на другую страницу</option>
                        </select>
                    </td>
                    <td>
                        <input class="form-control form-edit" type="text" id="resource{{$task->task_id}}" name="resource" data-id="{{$task->task_id}}" value="{{$task->resource}}"></input>
                    </td>
                    <td style="max-width: 10px"><a href="#" data-id="{{$task->task_id}}" class="btn btn-danger btn-delete">Удалить</a>
                    </td>

                </tr>
            @endforeach
        </tbody>
    </table>
        <div class="mb-3">
            <label for="title" class="form-label">Предмет</label>
            <select  class="form-control" name="course_id" id="course">
                <option value="default" selected disabled>Выберите предмет</option>
                @foreach($academicSubjects as $academicSubject)
                    <option value="{{$academicSubject->id}}">{{$academicSubject->name}}</option>
                @endforeach
            </select>
        </div>
        <form>
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Урок</label>
                <select  class="form-control" name="lessen_id" id="loadLessens">

                </select>
            </div>
            <div class="mb-3">
                <label for="title" class="form-label">Заголовок задания</label>
                <input type="text" class="form-control" name="title" id="title">
            </div>
            <div class="mb-3">
                <label for="title" class="form-label">Описание задания</label>
                <textarea name="description" id="description"  class="form-control"></textarea>
            </div>
            <div class="mb-3">
                <label for="title" class="form-label">Пример для задания (если нужен)</label>
                <input type="text" class="form-control" name="example" id="example">
            </div>
            <div class="mb-3">
                <label for="title" class="form-label">Тип примера</label>
                <select class="form-control" id="example_type" name="example_type">
                    <option value="null" selected disabled>Оставить если нет примера</option>
                    <option value="frame" >Ссылка для вставки контента (iframe)</option>
                    <option value="img" >Картинка</option>
                    <option value="link">Ссылка для перехода на другую страницу</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="title" class="form-label">Ресурс для выполнения (если нужен)</label>
                <input type="text" class="form-control" name="resource" id="resource">
            </div>
            <button type="submit" class="btn btn-primary" style="min-width: 100%">Добавить</button>
        </form>

        <script>
            $("#course").change(function (e) {
                console.log($('#'+this.id).val());
                $.ajax({
                    url: "{{route("tasks.show.lessen")}}",
                    method: 'get',
                    dataType: 'json',
                    data: {"_token": "{{ csrf_token() }}", course_id: $('#'+this.id).val()},
                    success: function (data) {
                        loadLessens(data);
                        // reloadContent(JSON.parse(data["lessens"]), JSON.parse(data['academicSubjects']));

                    },
                    error: function (data) {
                        console.log(data);
                    }
                });
            });

            $("body").delegate(".btn-delete", 'click', function(e){
                $.ajax({
                    url: "{{route("tasks.destroy")}}",
                    method: 'get',
                    dataType: 'json',
                    data: {"_token": "{{ csrf_token() }}", task_id: this.dataset.id},
                    success: function (data) {
                        reloadContent(data);
                    },
                    error: function (data) {
                        console.log(data);
                    }
                });
            });
            $("body").delegate(".form-edit", 'change', function(e){
                $.ajax({
                    url: "{{route("tasks.edit")}}",
                    method: 'get',
                    dataType: 'json',
                    data: {"_token": "{{ csrf_token() }}", task_id: this.dataset.id, column:$("#"+this.id).attr("name") ,value: $("#"+this.id).val()},
                    success: function (data) {
                        console.log(data);
                        reloadContent(data);
                    },
                    error: function (data) {
                        console.log(data);
                    }
                });
            });

            $("form").submit(function (e) {
                e.preventDefault();
                data = $("form").serializeArray();
                $.ajax({
                    url: "{{route("tasks.create")}}",
                    method: 'get',
                    dataType: 'json',
                    data: data,
                    success: function (data) {
                        reloadContent(data);
                    },
                    error: function (data) {
                        console.log(data);
                    }
                });
            });

            function loadLessens(data) {
                $("#loadLessens").html("");
                console.log(data);
                Object.values(data).forEach(function (value) {
                    console.log(value);
                    $("#loadLessens").append('<option value="'+value['id']+'">'+value['title']+'</option>');
                })
            }
            function reloadContent(data) {
                $("#content").html("");
                Object.values(data).forEach(function (value) {

                    $("#content").append(
                        '<tr>' +
                        '<td style="max-width: 10px">'+value["task_id"]+'</td><td>' +value["name"]+ '</td><td>'+value['title']+"</td>"+
                        '<td>' +
                        '<input class="form-control form-edit" type="text" id="title'+value["task_id"]+'"'
                        +'name="title" data-id="'+value["task_id"]+'" value="'+ value["task"]+'"></input>' +
                        '</td>' +
                        '<td>' +
                        '<textarea class="form-control form-edit" data-id="'+value["task_id"]+'" name="description" id="desc'+value["task_id"]+'">'+value["description"]+'</textarea>'+
                        '</td>'+
                        '<td>' +
                        '<input class="form-control form-edit" type="text" id="example'+value["task_id"]+'" name="title" data-id="'+value["task_id"]+'" value="'+value["example"]+'"></input>'+
                        '</td>'+
                        '<td>' +
                        '<select class="form-control form-edit" id="example_type'+value["task_id"]+'" name="example_type" data-id="'+value["task_id"]+'">'+
                            '<option value="frame" '+exampleType(value["example_type"])+'>Ссылка для вставки контента (iframe)</option>'+
                            '<option value="img"'+exampleType(value["example_type"])+'>Картинка</option>'+
                            '<option value="link" '+exampleType(value["example_type"])+'>Ссылка для перехода на другую страницу</option>'+
                        '</select>'+
                        '</td>'+
                        '<td>'+
                            '<input class="form-control form-edit" type="text" id="resource'+value["task_id"]+'" name="resource" data-id="'+value["task_id"]+'" value="'+value["resource"]+'"></input>'+
                        '</td>'+ '<td style="max-width: 10px"><a href="#" data-id="'+value["task_id"]+'"class="btn btn-danger btn-delete">Удалить</a></td><tr>'
                    );
                });

            }
            function exampleType(type) {
                let result = type === "frame" ? 'selected': type === "img" ? "selected" : type === 'link' ? "selected" : "";
                return result;
            }
        </script>

@endsection
