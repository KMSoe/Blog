<?php

namespace App\Http\Controllers\API;

use App\Models\Comment;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class CommentController extends BaseController
{
    public function __construct()
    {
        // $this->middleware('auth:api');
    }

    public function index(Request $request) {
        try {
            $comments = Comment::where('post_id', $request->postId)->with('user')->get();

            return $this->sendResponse(["total" => count($comments)], $comments, '', 200);
        } catch (QueryException $e) {
            return $this->sendError([], "Something Went Wrong!!!", 500);
        }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "comment_text" => 'required',
        ], [], ['post_id' => 'Post']);

        if ($validator->fails()) {
            return $this->sendError($validator->errors(), "Something Went Wrong!!!", 400);
        }

        try {
            $comment = new Comment();
            $comment->comment_text = $request->comment_text;
            $comment->post_id = $request->id;
            $comment->user_id = auth()->user()->id;
            $comment->save();

            return $this->sendResponse(["id" => $comment->id], $comment->with("user"), 'Successfully Created', 201);
        } catch (QueryException $e) {
            return $this->sendError([], "Something Went Wrong!!!", 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $comment = Comment::findOrFail($id);
            $validator = Validator::make($request->all(), [
                "post_id" => 'required',
                "comment_text" => 'required',
            ], [], ['post_id' => 'Post']);

            if ($validator->fails()) {
                return $this->sendError($validator->errors(), "Something Went Wrong!!!", 400);
            }

            $comment->comment_text = $request->comment_text;
            $comment->post_id = $request->post_id;
            $comment->user_id = auth()->user()->id;
            $comment->save();

            return $this->sendResponse(["id" => $comment->id], $comment, 'Successfully Updated', 201);
        } catch (QueryException $e) {
            return $this->sendError([], "Something Went Wrong!!!", 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $comment = Comment::findOrFail($id);

            $response = Gate::inspect('comment-manage', $comment);

            if ($response->allowed()) {
                $countDeleted = $comment->delete();

                if ($countDeleted) {
                    return response()->json([], 204);
                }
            } else {
                return $this->sendError([], "You don't have permission!!!", 403);
            }
        } catch (ModelNotFoundException $e) {
            return $this->sendError([], "Comment Not Found", 404);
        } catch (QueryException $e) {
            return $this->sendError([], "Something Went Wrong!!!", 500);
        }
    }
}
