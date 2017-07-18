@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <form action="/edit/gallery" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="file" name="photo">
                    <button type="submit">Send</button>
                </form>
            </div>
        </div>
        <div class="row" style="margin-top: 30px; background-color: #a5a9bd">
            <div class="col-md-12">
                @foreach($images as $image)
                    <div class="image" style="display: inline-block;float: left;">
                        <span class="delete" data-id="{{ $image['id'] }}"
                              style="width: 20px;padding-left: 5px;position: absolute;margin-left: 18px;background-color: white;cursor: pointer">
                            X</span>
                        <img src="{{ $image['url'] }}" height="150" style="margin-left: 10px">
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function () {
            $(".delete").on("click", function () {
                if (confirm('Вы действительно хотите удалить фотографию?')) {
                    var block = $(this).parent();
                    var id = $(this).data('id');
                    $.ajax({
                        url: '/edit/gallery',
                        type: 'post',
                        data: {id: id, _method: 'delete', _token: '{{csrf_token()}}'},
                        success: function () {
                            block.remove();
                        }
                    })
                }
            })
        });
    </script>
@endsection
