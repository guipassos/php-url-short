<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Url;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;

class UrlController extends Controller
{
    public function __construct()
    {
        //
    }

    public function go($hash){
        $url = Url::where('hash', $hash)->orWhere('id',$hash)->first();
        if($url && $url->url){
            Url::where('id', $url->id)->increment('access_count');
            return redirect($url->url,301);
        }
        return response()->json(['message' => 'URL not found'],400);
    }

    public function detail($hash){
        $url = Url::where('hash', $hash)->orWhere('id',$hash)->first();
        if($url && $url->url){
            $url->minify = env('APP_URL').'/'.$url->hash;
            return response($url);
        }
        return response()->json(['message' => 'URL not found'],400);
    }

    public function insert(Request $request)
    {
        $data = $request->all();
        $user = User::where('token', $request->header('token'))->first();
        if ($user && $user->id) {
            $url = new Url($data);
            $url->hash = str_random(16);
            $url->user_id = $user->id;

            if (!empty($url->hash) && !empty($url->url) && !empty($url->user_id)){
                $url->save();
                $url->minify = env('APP_URL').'/'.$url->hash;
                return response()->json($url,200);
            }else{
                return response()->json(['message' => 'Invalid arguments'],400);
            }
        }
        return response()->json(['message' => 'Invalid token'],401);
    }

    public function update($hash, Request $request)
    {
        $data = $request->all();
        $user = User::where('token', $request->header('token'))->first();
        if ($user && $user->id) {
            if (isset($data['url']) && $data['url']){
                $url =  Url::where(function($query) use ($hash){
                            $query->where('hash', $hash);
                            $query->orWhere('id',$hash);
                        })
                        ->where('user_id',$user->id)
                        ->first();
                if($url && $url->id){
                    Url::where('id',$url->id)->update($data);
                    return response()->json(['message' => 'Updated URL'],200);
                }else{
                    return response()->json(['message' => 'Update failed or is not allowed'],400);
                }
            }else{
                return response()->json(['message' => 'Invalid arguments'],400);
            }
        }
        return response()->json(['message' => 'Invalid token'],401);
    }

    public function delete($hash, Request $request){
        $user = User::where('token', $request->header('token'))->first();
        if ($user && $user->id) {
            $url =  Url::where(function($query) use ($hash){
                        $query->where('hash', $hash);
                        $query->orWhere('id',$hash);
                    })
                    ->where('user_id',$user->id)
                    ->first();
            if($url && $url->url){
                Url::where('id',$url->id)->delete();
                return response()->json(['message' => 'URL removed'],200);
            }else{
                return response()->json(['message' => 'URL not found'],400);
            }
        }
        return response()->json(['message' => 'Invalid token'],401);
    }
}
