<?php

namespace App\Http\Controllers\API;

use App\Models\Reaction;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReactionController extends BaseController
{
    public function __construct()
    {
        $this->middleware('auth:api')->except(['index']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $reaction = Reaction::where('post_id', $request->postId)->with('user')->get();

            return $this->sendResponse(["total" => count($reaction)], $reaction, '', 200);
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
            "postId" => 'required',
            "type" => 'required',
        ], [], ['postId' => 'Post']);

        if ($validator->fails()) {
            return $this->sendError($validator->errors(), "Something Went Wrong!!!", 400);
        }

        try {
            $previousReaction = Reaction::where('user_id', auth()->user()->id)->where('post_id', $request->postId)->first();

            if ($previousReaction) {
                if ($previousReaction->type === $request->type) {
                    $previousReaction->delete();

                    return $this->sendResponse([], null, '', 204);
                } else {
                    $previousReaction->type = $request->type;
                    $previousReaction->save();

                    return $this->sendResponse(["id" => $previousReaction->id], $previousReaction, 'Successfully', 200);
                }
            }

            $reaction = new Reaction();
            $reaction->post_id = $request->postId;
            $reaction->type = $request->type;
            $reaction->user_id = auth()->user()->id;
            $reaction->save();

            return $this->sendResponse(["id" => $reaction->id], $reaction, "Successfully", 201);
        } catch (QueryException $e) {
            return $this->sendError([], "Something Went Wrong!!!", 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
