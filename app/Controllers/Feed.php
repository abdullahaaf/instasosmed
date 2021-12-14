<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\FeedModel;

class Feed extends BaseController
{
    public function index()
    {
        $feed = new FeedModel();
        $data['feed'] = $feed->getAllFeed();
        return view('feed', $data);
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