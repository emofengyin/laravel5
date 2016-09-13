<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Article;
use App\Http\Controllers\Controller;

class ArticleController extends Controller
{
    public function index(Request $request) {
        $data['user_id'] = $request->user()->id;
        $data['articles'] = Article::all();

        return view('admin/article/index')->with('data', $data);
    }

    //新建文章
    public function create() {
        return view('admin/article/create');
    }

    //保存文章
    public function store(Request $request) {
        $this->validate($request, [
            'title' => 'required|unique:articles|max:255',
            'content' => 'required'
        ]);

        $article = new Article();
        $article->title = $request->get('title');
        $article->content = $request->get('content');
        $article->user_id = $request->user()->id;

        if($article->save()) {
            return redirect('admin/article');
        }else{
            return redirect()->back()->withInput()->withErrors('保存失败');
        }

    }

    //编辑文章
    public function edit($id) {
        return view('admin/article/edit')->with('article', Article::find($id));
    }

    //更新文章
    public function update(Request $request, $id) {
        $this->validate($request, [
            'title' => 'required|unique:articles,title,'.$id.'|max:255',
            'content' => 'required'
        ]);

        $article = Article::find($id);
        $article->title = $request->get('title');
        $article->content = $request->get('content');

        if($article->update()) {
            return redirect('admin/article');
        }else{
            return redirect()->back()->withInput()->withErrors('修改失败');
        }

    }

    //删除文章
    public function destroy($id) {
        $ret = Article::find($id)->delete();
        if($ret) {
            return redirect()->back()->withInput()->withErrors('删除成功');
        } else{
            return redirect()->back()->withInput()->withErrors('删除失败');
        }
    }

    //查看文章评论



}
