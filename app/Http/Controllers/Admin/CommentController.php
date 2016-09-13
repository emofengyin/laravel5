<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Article;
use App\Comment;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    //查看文章评论
    public function index($article_id) {
        return view('admin/comment/index')->withArticle(Article::with('hasManyComments')->find($article_id));
    }

    //新增评论
    public function create($article_id){
        return view('admin/comment/create')->withArticle(Article::find($article_id));
    }

    //保存评论
    public function store(Request $request, $article_id) {
        $this->validate($request, [
            'nickname' => 'required|unique:comments,nickname|max:255',
            'comment' => 'required'
        ]);

        $comment = new Comment();
        $comment->nickname = $request->get('nickname');
        $comment->comment = $request->get('comment');
        $comment->article_id = $article_id;

        if($comment->save()) {
            return redirect('admin/article/'.$article_id.'/comment');
        }else{
            return redirect()->back()->withInput()->withErrors('保存失败');
        }
    }

    //编辑评论
    public function edit($article_id, $comment_id) {
        return view('admin/comment/edit')->with('comment', Comment::find($comment_id));
    }

    //修改评论
    public function update(Request $request, $article_id, $comment_id) {
        $this->validate($request, [
            'nickname' => 'required|unique:comments,nickname,'.$comment_id.'|max:255',
            'comment' => 'required'
        ]);

        $comment = Comment::find($comment_id);
        $comment->nickname = $request->get('nickname');
        $comment->comment = $request->get('comment');

        if($comment->update()) {
            return redirect('admin/article/'.$article_id.'/comment');
        }else{
            return redirect()->back()->withInput()->withErrors('修改失败');
        }
    }

    //删除评论
    public function destroy($article_id,$comment_id) {
        $ret = Comment::find($comment_id)->delete();
        if($ret) {
            return redirect()->back()->withInput()->withErrors('删除成功');
        }else{
            return redirect()->back()->withInput()->withErrors('删除失败');
        }
    }

}
