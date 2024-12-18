<?php

namespace App\Http\Controllers;

use App\Http\Resources\LinkResource;
use App\Models\Link;
use App\Models\LinkProduct;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LinkController extends Controller
{
    public UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index($id)
    {
        $links = Link::with('orders')->where('user_id', $id)->get();

        return LinkResource::collection($links);
    }

    public function store(Request $request)
    {
        $user = $this->userService->get('user');

        $link = Link::create([
            'user_id' => $user['id'],
            'code' => Str::random(6)
        ]);

        foreach ($request->input('products') as $product_id) {
            LinkProduct::create([
                'link_id' => $link->id,
                'product_id' => $product_id
            ]);
        }

        return $link;
    }

    public function show($code)
    {
        $link = Link::with('products')->where('code', $code)->first();
        $user = $this->userService->get('users/{$link->user_id}');
        $link['user'] = $user;
        return $link;
    }
}
