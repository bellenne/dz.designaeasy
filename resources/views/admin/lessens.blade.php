@extends('admin.layouts.header')
@section('content')
    <table class="table">
            <tr>
                <td style="max-width: 10px">#</td>
                <td>Наименование</td>
                <td>Курс</td>
                <td></td>
            </tr>
        <tbody id="content">
            @foreach($lessens as $lessen)
                <tr>
                    <td style="max-width: 10px">{{$lessen->id}}</td>

                    <td>
                        <input class="form-control form-edit" type="text" id="title{{$lessen->id}}" name="title"   data-id="{{$lessen->id}}" value="{{$lessen->title}}"></input>
                    </td>
                    <td >
                        <select class="form-control form-edit" name="academicSubject_id" id="id{{$lessen->id}}" data-id="{{$lessen->id}}" >
                            @foreach($academicSubjects as $academicSubject)
                                <option @if($academicSubject->id == $lessen->academicSubject_id) selected @endif value="{{$academicSubject->id}}">{{$academicSubject->name}}</option>
                            @endforeach
                        </select>
                    </td>
                        <td style="max-width: 10px"><a href="#" data-id="{{$lessen->id}}"
                                                       class="btn btn-danger btn-delete">Удалить</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
        <form>
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Название урока</label>
                <input type="text" class="form-control" name="title" placeholder="Название и номер урока" id="title">
            </div>
            <div class="mb-3">
                <label for="title" class="form-label">Название предмета</label>
                <select class="form-control" name="academicSubject_id">
                    @foreach($academicSubjects as $academicSubject)
                        <option value="{{$academicSubject->id}}">{{$academicSubject->name}}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary" style="min-width: 100%">Добавить</button>
        </form>

        <script>
            $("body").delegate(".btn-delete", 'click', function(e){
                console.log(this.dataset.id);
                $.ajax({
                    url: "{{route("lessens.destroy")}}",
                    method: 'get',
                    dataType: 'json',
                    data: {"_token": "{{ csrf_token() }}", course_id: this.dataset.id},
                    success: function (data) {
                        reloadContent(JSON.parse(data["lessens"]), JSON.parse(data['academicSubjects']));
                    },
                    error: function (data) {
                        console.log(data);
                    }
                });
            });
            $("body").delegate(".form-edit", 'change', function(e){
                $.ajax({
                    url: "{{route("lessens.edit")}}",
                    method: 'get',
                    dataType: 'json',
                    data: {"_token": "{{ csrf_token() }}", lessen_id: this.dataset.id, column:$("#"+this.id).attr("name") ,value: $("#"+this.id).val()},
                    success: function (data) {
                        reloadContent(JSON.parse(data["lessens"]), JSON.parse(data['academicSubjects']));
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
                    url: "{{route("lessens.create")}}",
                    method: 'get',
                    dataType: 'json',
                    data: data,
                    success: function (data) {
                        reloadContent(JSON.parse(data["lessens"]), JSON.parse(data['academicSubjects']));
                    },
                    error: function (data) {
                        console.log(data);
                    }
                });
            });

            function reloadContent(lessens, academicSubjects) {
                $("#content").html("");
                Object.values(lessens).forEach(function (value) {

                    $("#content").append(
                        '<tr>' +
                        '<td style="max-width: 10px">'+value["id"]+'</td>' +
                        '<td>' +
                        '<input class="form-control form-edit" type="text" id="title'+value["id"]+'"'
                        +'name="title" data-id="'+value["id"]+'" value="'+ value["title"]+'"></input>' +
                        '</td>' +
                        '<td>' +
                        isSelected(academicSubjects, value['academicSubject_id'], value['id'])+
                        '</td>'
                        +'<td style="max-width: 10px">' +
                        '<a href="#" data-id="'+value["id"]
                        +'"class="btn btn-danger btn-delete">Удалить</a>' +
                        '</td><tr>'
                    );
                });

            }
            function isSelected(academicSubjects, academicSubjects_id, id) {
                let select='<select id="id'+id+'" class="form-control form-edit" name="academicSubject_id" data-id="'+id+'">';
                Object.values(academicSubjects).forEach(function (value) {
                    let optionIsSelected = academicSubjects_id == value["id"] ? "selected" : "";

                    select += '<option value="' + value['id'] + '" ' + optionIsSelected + '>' + value['name'] + "</option>";
                });
                select += '</select>';
                return select;
            }
        </script>

@endsection
