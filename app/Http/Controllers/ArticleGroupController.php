<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreArticleGroupRequest;
use App\Models\ArticleGroup;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleGroupController extends Controller
{
    public function index(Request $request, $userId = null)
    {
        $userSpecific = ($userId != null);

        $articleGroups = (User::find($userId))
            ? ArticleGroup::where('user_id', $userId)->paginate(5)
            : ArticleGroup::paginate(5);

        return view('article-group.list', compact('articleGroups', 'userSpecific'));
    }

    public function store(StoreArticleGroupRequest $request)
    {
        $articleGroup = new ArticleGroup();
        $articleGroup->name = $request->name;
        $articleGroup->slug = Str::slug($request->name);
        $articleGroup->user_id = Auth::id();
        $articleGroup->save();

        return redirect()->route('article-groups.index')->with('success', "Article group '$articleGroup->name' created successfully");
    }

    public function delete(int $group, int $userId = null)
    {
        $articleGroup = ArticleGroup::where('id', $group)->first();
        $articleGroupName = $articleGroup->name;

        $articleGroup->delete();

        return redirect()->route('article-groups.index', ['userId' => $userId])
            ->with('success', "Article Group '$articleGroupName' successfully deleted");
    }
}
