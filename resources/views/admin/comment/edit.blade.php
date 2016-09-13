@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">修改评论</div>
                    <div class="panel-body">

                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <strong>修改失败</strong> 输入不符合要求<br><br>
                                {!! implode('<br>', $errors->all()) !!}
                            </div>
                        @endif

                        <form action="{{ url('admin/article/'.$comment->article_id.'/comment/'.$comment->id) }}" method="POST">
                            {{ method_field('PATCH') }}
                            {{ csrf_field() }}
                            <input type="text" name="nickname" class="form-control" required="required" value={{$comment->nickname}} placeholder="请输入昵称">
                            <br>
                            <textarea name="comment" rows="10" class="form-control" required="required" placeholder="请输入内容">{{$comment->comment}}</textarea>
                            <br>
                            <button class="btn btn-lg btn-info">修改评论</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection