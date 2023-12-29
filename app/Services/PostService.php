<?php

namespace App\Services;

use App\DTO\PostDTO;
use App\DTO\PostPreviewDTO;
use App\Models\Post;

class PostService {
    private function getPostPreview(Post $origin): PostPreviewDTO {
        $preview = new PostPreviewDTO;
        $preview->title = $origin->title;
        $preview->description = $origin->description;
        $preview->publishDate = $origin->publish_date;
        $img = file_get_contents($origin->image);
        $preview->imageData = base64_encode($img);

        return $preview;
    }

    public function getPostsPreviews(?string $userId = null): array {
        $posts = [];
        $previews = [];

        if ($userId !== null) {
            $posts = Post::query()
                ->where('user_id', '=', $userId)
                ->get()
                ->toArray();
        } else {
            $posts = Post::all();
        }

        foreach ($posts as $post) {
            array_push($previews, $this->getPostPreview($post));
        }

        return $previews;
    }

    private function getPostView(Post $origin): PostDTO {
        $view = new PostDTO;
        $view->title = $origin->title;
        $view->description = $origin->description;
        $view->publishDate = $origin->publish_date;
        $img = file_get_contents($origin->image);
        $view->imageData = base64_encode($img);
        $view->publishDate = $origin->publish_date;

        return $view;
    }

    public function getPost(string $id): ?PostDTO {
        $post = Post::query()->find($id);

        if ($post == null) {
            return null;
        }

        return $this->getPostView($post);
    }
}