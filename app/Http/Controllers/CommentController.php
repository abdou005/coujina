<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{

    public function getCommentsRecipes()
    {
        $user = auth()->user();
        $recipeIds = $user->recipes()->pluck('id')->toArray();
        $comments = Comment::with(['user', 'recipe'])->whereIn('recipe_id', $recipeIds)->paginate(10);
        $comments->each(function (Comment $comment) {
            $comment->elapsed = elapsed($comment->created_at);
        });
        return response()->json($comments, 200);
    }

    public function removeComment($commentId)
    {
        $comment = Comment::findOrFail($commentId);
        $comment->delete();
        return response()->json(['status' => 'success', 'message' => 'commentaire supprimé avec succes'], 200);
    }
}