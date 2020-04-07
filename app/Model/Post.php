<?php

class Post extends AppModel {
    // save() メソッドが呼ばれた時に、 どうやってバリデートするかを CakePHP に教え
    public $validate = array(
        // titleとbodyが空ではいけない
        'title' => array(
            'rule' => 'notBlank'
        ),
        'body' => array(
            'rule' => 'notBlank'
        )
    );

    public function isOwnedBy($post, $user) {
        return $this->field('id', array('id' => $post, 'user_id' => $user)) !== false;
    }
}
