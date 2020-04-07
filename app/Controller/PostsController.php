<?php

class PostsController extends AppController {
    //$helpersにプロパティを入れることによって、そのヘルパーが使用できる
    //HTML、FORMタグを作る
    public $helpers = array('Html', 'Form', 'Flash');
    public $components = array('Flash');

    public function index() {
        //$this->set('(viewに送る変数名)', $this->(テーブル名)->find('all'));Viewへ送るデータの指定
        // find('all')は複数のデータ取得
        $this->set('posts', $this->Post->find('all'));
    }

    public function view($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Invalid post'));
        }
        // Posts['id']があれば$postに代入
        //　findById($id)は単一のデータ取得
        $post = $this->Post->findById($id);
        if (!$post) {
            throw new NotFoundException(__('Invalid post'));
        }
        // $postがあればViewに送る
        $this->set('post', $post);
    }

    public function add() {
        // もし、リクエストの HTTP メソッドが POST なら
        if ($this->request->is('post')) {
            //Added this line
            $this->request->data['Post']['user_id'] = $this->Auth->user('id');
            // $this->request->dataにフォームを使ってデータが入る
            //$this->Post->saveで保存
            if ($this->Post->save($this->request->data)) {
                // リダイレクト後のページでこれを表示
                $this->Flash->success(__('Your post has been saved.'));

                return $this->redirect(array('action' => 'index'));
            }
        }
    }

    public function edit($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Invalid post'));
        }
         // Posts['id']があれば$postに代入
        $post = $this->Post->findById($id);
        if (!$post) {
            throw new NotFoundException(__('Invalid post'));
        }
        // もしリクエストが POST か PUT なら
        if ($this->request->is(array('post', 'put'))) {
            $this->Post->id = $id;
            if ($this->Post->save($this->request->data)) {
                $this->Flash->success(__('Your post has been updated.'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Flash->error(__('Unable to update your post.'));
        }
        //リクエストデータがないなら
        if (!$this->request->data) {
            // 取得していたポストレコードを そのままセッット
            $this->request->data = $post;
        }
    }

    public function delete($id) {
        if ($this->request->is('get')) {
            throw new MethodNotAllowedException();
        }
    
        if ($this->Post->delete($id)) {
            $this->Flash->success(
                __('The post with id: %s has been deleted.', h($id))
            );
        } else {
            $this->Flash->error(
                __('The post with id: %s could not be deleted.', h($id))
            );
        }
    
        return $this->redirect(array('action' => 'index'));
    }

    public function isAuthorized($user) {
        // 登録済ユーザーは投稿できる
        if ($this->action === 'add') {
            return true;
        }
    
        // 投稿のオーナーは編集や削除ができる
        if (in_array($this->action, array('edit', 'delete'))) {
            $postId = (int) $this->request->params['pass'][0];
            if ($this->Post->isOwnedBy($postId, $user['id'])) {
                return true;
            }
        }
    
        return parent::isAuthorized($user);
    }
}