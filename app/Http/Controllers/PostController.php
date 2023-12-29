<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Services\PostService;
use Exception;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class PostController extends Controller
{
    private PostService $service;

    public function __construct(PostService $service) {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $userId = null;
            if ($request->query('user') !== null &
                auth()->id() !== $request->query('user') &
                $request->query('user') !== 'me')
            {
                return response()->json([
                    'message' => 'you are not allowed to do this'
                ], 400);
            }

            if ($request->query('user') !== null &
                $request->query('user') === auth()->id() ||
                $request->query('user') === 'me')
            {
                $userId = auth()->id();
            }

            return response()->json($this->service->getPostsPreviews($userId), 200);
        } catch (Exception $err) {
            return response()->json([
                'message' => 'an error occured when trying to get posts'
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $post = $this->service->getPost($id);
            if ($post === null) {
                return response()->json([
                    'message' => 'bad request'
                ], 400);
            }

            return response()->json($post, 200);
        } catch(Exception $err) {
            return response()->json([
                'message' => 'an error occured when trying to get post',
                'error' => $err
            ], 500);
        }
    }
}
