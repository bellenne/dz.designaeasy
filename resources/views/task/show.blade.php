@extends('layouts.header')
@section('academic_subjects')
    @include("layouts.academic_subjects")
@endsection
@section('content')
    <div class="container">
        <nav class="navbar" data-bs-theme="light">
            <ul class="nav">
                <span class="navbar-text fw-bold">{{$lessenTitle}}</span>
                @foreach($tasks as $task)
                    <li class="nav-item">
                        <button class="nav-link task-info" id="{{$task->id}}">{{$task->title}}</button>
                    </li>
                @endforeach
            </ul>
        </nav>
    </div>
        <div class="container" id="task-info" hidden>
            <h3 id="taskId"></h3>
            <section>
                <h3 id="taskTitle"></h3>
                <h4>Описание задания:</h4>
                <p id="taskDescription"></p>
                <div class="d-flex fd-column" style="gap:20px">
                    <iframe id="taskExampleFrame" src="" allowtransparency="true" width="485" height="402" frameborder="0" scrolling="no" allowfullscreen></iframe>
                    <img width="400" src="" id="taskExampleImg" alt="">
                    <a href="" id="taskExampleLink"></a>
                    <a href="" id="taskResource" target="_blank" class="btn btn-primary">Перейти к заданию</a>
                </div>
                <div class="container">
                    <form method="get" action="{{route("finalytask.create")}}">
{{--                        {{csrf_token()}}--}}
                        @csrf
                        <div class="mb-3">
                            <label for="result" class="form-label">Ссылка на решение</label>
                            <input type="text" class="form-control" data-taskId="" id="result" aria-describedby="resultHelp">
                            <div id="resultHelp" class="form-text">Вставьте сюда ссылку на решение задачи</div>
                        </div>
                        <button type="submit" class="btn btn-primary">Сохранить</button>
                    </form>
                </div>
            </section>
        </div>
    <script>
        $("form").submit(function (e){
            e.preventDefault();
            $.ajax({
                url: "{{route("finalytask.create")}}",
                method: 'get',
                dataType: 'html',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {"_token": "{{ csrf_token() }}",task_id: $("#result").attr("data-taskId"), user_id: {{auth()->id()}}, result:$("#result").val()},
                success: function(data){
                    console.log(data);
                },
                error:function(data) {
                    console.log(data);
                }});
        });

        $(".task-info").click(function (e) {
            console.log(this.id);
            $.ajax({
                url: "{{route("task.show", $lessenId)}}",
                method: 'get',
                dataType: 'html',
                data: {"_token": "{{ csrf_token() }}",taskId: this.id},
                success: function(data){
                    newData = JSON.parse(data);
                    console.log(newData)
                    $key =0;
                    for (var key in newData) {
                        $key = key;
                        break;
                    }
                    console.log(key);
                    $("#task-info").removeAttr("hidden");
                    $("#taskId").html("Задание № "+newData[$key]["id"]);
                    $("#taskTitle").html(newData[$key]["title"]);
                    $("#taskDescription").html(newData[$key]["description"]);
                    $("#taskResource").attr("href",newData[$key]["resource"]);
                    $("#result").attr("data-taskId",newData[$key]["id"]);
                    $("#result").val(newData["result"]);
                    if(newData[$key]["example_type"] === "frame"){
                        $("#taskExampleFrame").removeAttr("hidden");
                        $("#taskExampleLink").attr("hidden",true);
                        $("#taskExampleImg").attr("hidden",true);
                        $("#taskExampleFrame").attr("src",newData[$key]["example"]+"/embed");
                    }else if(newData[$key]["example_type"] === "img"){
                        $("#taskExampleImg").removeAttr("hidden");
                        $("#taskExampleLink").attr("hidden",true);
                        $("#taskExampleFrame").attr("hidden",true);
                        $("#taskExampleImg").attr("src",newData[$key]["example"]);
                    }else if(newData[$key]["example_type"] === "link"){
                        $("#taskExampleLink").removeAttr("hidden");
                        $("#taskExampleImg").attr("hidden",true);
                        $("#taskExampleFrame").attr("hidden",true);
                        $("#taskExampleLink").attr("href",newData[$key]["example"]);
                    }
                },
                error:function(data){
                    console.log(data);
                }
            });
        });
    </script>
@endsection
