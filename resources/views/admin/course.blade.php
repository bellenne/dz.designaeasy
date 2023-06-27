@extends('admin.layouts.header')
@section('content')
    <table class="table">
            <tr>
                <td style="max-width: 10px">#</td>
                <td>Наименование</td>
                <td>Адрес</td>
                <td></td>
            </tr>
        <tbody id="content">
            @foreach($academicSubjects as $academincSubject)
                <tr>
                    <td style="max-width: 10px">{{$academincSubject->id}}</td>
                    <td><input class="form-control form-edit" type="text" id="name{{$academincSubject->id}}" name="name" @if(auth()->user()->role_id != 2) readonly
                               @endif  data-id="{{$academincSubject->id}}" value="{{$academincSubject->name}}"></input></td>
                    <td style="max-width: 50px"><input  class="form-control form-edit" type="text" @if(auth()->user()->role_id != 2) readonly
                               @endif  data-id="{{$academincSubject->id}}" id="url{{$academincSubject->id}}" name="url_address" value="{{$academincSubject->url_address}}"></input></td>
                    @if(auth()->user()->role_id == 2)
                        <td style="max-width: 10px"><a href="#" data-id="{{$academincSubject->id}}"
                                                       class="btn btn-danger btn-delete">Удалить</a></td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
    @if(auth()->user()->role_id == 2)
        <form>
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Название предмета</label>
                <input type="title" class="form-control" name="name" placeholder="Программирование Scratch" id="name">
            </div>
            <div class="mb-3">
                <label for="title" class="form-label">Url Адресс</label>
                <input type="title" class="form-control" placeholder="scratch" name="url_address" id="url_address">
            </div>
            <button type="submit" class="btn btn-primary" style="min-width: 100%">Добавить</button>
        </form>

        <script>
            $("body").delegate(".btn-delete", 'click', function(e){
                console.log(this.dataset.id);
                $.ajax({
                    url: "{{route("courses.destroy")}}",
                    method: 'get',
                    dataType: 'json',
                    data: {"_token": "{{ csrf_token() }}", course_id: this.dataset.id},
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
                    url: "{{route("courses.edit")}}",
                    method: 'get',
                    dataType: 'json',
                    data: {"_token": "{{ csrf_token() }}", course_id: this.dataset.id, column:$("#"+this.id).attr("name") ,value: $("#"+this.id).val()},
                    success: function (data) {
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
                    url: "{{route("courses.create")}}",
                    method: 'get',
                    dataType: 'json',
                    data: data,
                    success: function (data) {
                        // console.log(data);
                        reloadContent(data);
                        $("#name").val("");
                        $("#url_address").val("");
                    },
                    error: function (data) {
                        console.log(data);
                    }
                });
                console.log(data);
            });

            function reloadContent(data) {
                $("#content").html("");
                Object.values(data).forEach(function (value) {
                    $("#content").append('<tr><td style="max-width: 10px">'+value["id"]+'</td><td><input class="form-control form-edit" type="text" id="name'+value["id"]+'"'
                        +'name="name" data-id="'+value["id"]+'" value="'+ value["name"]+'"></input></td>' +
                        '<td style="max-width: 50px"><input  class="form-control form-edit" type="text" data-id="'+value["id"]+
                        '" id="url'+value["id"]+'" name="url_address" value="'+value["url_address"]+'"></input></td>'
                        +'<td style="max-width: 10px"><a href="#" data-id="'+value["id"]
                        +'"class="btn btn-danger btn-delete">Удалить</a></td><tr>'
                    );
                });

            }
        </script>
    @endif

@endsection
