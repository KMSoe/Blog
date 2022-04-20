<?php

namespace App\Http\Controllers\API;

use App\Models\Post;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class PostController extends BaseController
{
    public function __construct()
    {
        $this->middleware('auth:api')->except(['index', 'show']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $sorts = explode(',', $request->input('sort', ''));

            $query = Post::query();
            foreach ($sorts as $sortColumn) {
                if ($sortColumn !== '') {
                    $sortDirection = str_starts_with($sortColumn, '-') ? 'desc' : 'asc';
                    $sortColumn = ltrim($sortColumn, '-');

                    $query->orderBy($sortColumn, $sortDirection);
                }
            }

            $filters = explode(',', $request->query('filter'));

            foreach ($filters as $filterColumn) {
                if ($filterColumn !== '') {
                    [$field, $value] = explode(':', $filterColumn);

                    $query->where($field, $value);
                }
            }

            $posts = $query->with(['reactions'])->join('categories', "posts.category_id", "=", "categories.id")
                ->join("users", "posts.user_id", "=", "users.id")
                ->select("posts.*", "users.name as Owner", "users.profile AS profile", "categories.name AS categoryName")
                ->get();

            return $this->sendResponse(['total' => count($posts)], $posts, '', 200);
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
            "category_id" => 'required',
            "title" => 'required',
            "description" => 'required',
            'image' => 'image | mimes:png,jpg,jpeg',
        ], [], ['category_id' => 'Category']);

        if ($validator->fails()) {
            return $this->sendError($validator->errors(), "Something Went Wrong!!!", 400);
        }

        try {
            $post = new Post();
            $post->title = $request->title;
            $post->description = $request->description;
            $post->category_id = $request->category_id;
            $post->user_id = auth()->user()->id;
            $post->save();

            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                $imagePath = $request->file('image');
                $imageName = explode('.', $imagePath->getClientOriginalName())[0] . Carbon::now()->valueOf() . "." . $imagePath->extension();

                $path = $request->file('image')->storeAs('posts', $imageName, 'public');

                $post->image = $imageName;
                $success = $post->save();
            }
            return $this->sendResponse(["id" => $post->id], $post, 'Successfully Created', 201);
        } catch (QueryException $e) {
            return $this->sendError([], "Something Went Wrong!!!", 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $post = Post::with(['comments.user', 'reactions.user'])->findOrFail($id);

            return $this->sendResponse(["id" => $post->id], $post, '', 200);
        } catch (ModelNotFoundException $e) {
            return $this->sendError([], "Post Not Found", 404);
        } catch (QueryException $e) {
            return $this->sendError([], "Something Went Wrong!!!", 500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $post = Post::findOrFail($id);
            $validator = Validator::make($request->all(), [
                "category_id" => 'required',
                "title" => 'required',
                "description" => 'required',
                'image' => 'image | mimes:png,jpg,jpeg',
            ], [], ['category_id' => 'Category']);

            if ($validator->fails()) {
                return $this->sendError($validator->errors(), "Something Went Wrong!!!", 400);
            }

            $post->title = $request->title;
            $post->description = $request->description;
            $post->category_id = $request->category_id;
            $post->user_id = auth()->user()->id;
            $post->save();

            return $this->sendResponse(["id" => $post->id], $post, 'Successfully Updated', 201);
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
            $post = Post::findOrFail($id);

            $response = Gate::inspect('post-manage', $post);

            if ($response->allowed()) {
                $countDeleted = $post->delete();

                if ($countDeleted) {
                    return response()->json([], 204);
                }
            } else {
                return $this->sendError([], "You don't have permission!!!", 403);
            }
        } catch (ModelNotFoundException $e) {
            return $this->sendError([], "Post Not Found", 404);
        } catch (QueryException $e) {
            return $this->sendError([], "Something Went Wrong!!!", 500);
        }
    }
}
