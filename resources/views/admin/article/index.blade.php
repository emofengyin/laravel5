@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">文章管理</div>
                    <div class="panel-body">
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                {!! implode('<br>', $errors->all()) !!}
                            </div>
                        @endif

                        <a href="{{ url('admin/article/create') }}" class="btn btn-lg btn-primary">新增</a>

                        @foreach ($data['articles'] as $article)
                            <hr>
                            <div class="article">
                                <h4>{{ $article->title }}</h4>
                                <div class="content">
                                    <p>
                                        {{ $article->content }}
                                    </p>
                                </div>
                            </div>
                            <a href="{{ url('admin/article/'.$article->id.'/edit') }}"
                               class="btn btn-success @if($article->user_id != $data['user_id']) disabled @endif">编辑</a>
                            @if($article->user_id != $data['user_id'])
                                <button type="submit" class="btn btn-danger disabled">删除</button>
                            @else
                                <form action="{{ url('admin/article/'.$article->id) }}" method="POST" style="display: inline;">
                                    {{ method_field('DELETE') }}
                                    {{ csrf_field() }}
                                    <button type="submit" class="btn btn-danger">删除</button>
                                </form>
                            @endif
                            <a href="{{ url('admin/article/'.$article->id.'/comment') }}" class="btn btn-info">查看评论</a>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection