<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\FeedModel;

class Feed extends BaseController
{

    /**
     * fungsi strip_tags() digunakan untuk mencegah html injection
     */

    public function index()
    {
        $feed = new FeedModel();
        $like_post = $feed->getLikedPostByCurrentUser();
        $data['feed'] = $feed->getAllFeed();
        $data['post_id'] = array();
        $data['comment'] = $feed->getAllComment();
        foreach($like_post as $key => $value){
            array_push($data['post_id'],$value['post_id']);
        }
        return view('feed', $data);
    }

    public function storeLike()
    {
        $feed = new FeedModel();
        $data_like = array(
            'post_id' => $this->request->getPost('post_id'),
            'userid' => session()->get('userid')
        ); 
        $feed->storeLike($data_like);
        return redirect()->to(base_url('feed'));
    }

    public function storeComment()
    {
        $feed = new FeedModel();
        $data_comment = array(
            'post_id' => $this->request->getPost('post_id'),
            'userid' => session()->get('userid'),
            'comment' => strip_tags($this->request->getPost('comment'))
        );
        $feed->storeComment($data_comment);
        return redirect()->to(base_url('feed'));
    }

    public function removeLike()
    {
        $feed = new FeedModel();
        $post_id = $this->request->getPost('post_id');
        $userid = session()->get('userid');
        $feed->removeLike($userid,$post_id);
        return redirect()->to(base_url('feed'));
    }

    public function storePost()
    {
        $feed = new FeedModel();

        $post_image = $this->request->getFile('gambar');
        $random_name = $post_image->getRandomName();
        if ($post_image->isValid() && !$post_image->hasMoved()) {
            $post_image->move(ROOTPATH.'public/post-upload/',$random_name);
            $post_data = array(
                'userid' => session()->get('userid'),
                'post' => strip_tags($this->request->getPost('post')),
                'image' => $random_name
            );
            $store_post = $feed->insert($post_data);
            session()->setFlashData('success','Post Successful');
            return redirect()->to(base_url('feed'));
        }else {
            session()->setFlashData('errors','Failed to post');
            return redirect()->to(base_url('feed'));
        }
    }
}

?>