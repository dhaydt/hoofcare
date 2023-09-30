<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Exception;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;
use Facebook\Facebook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GraphController extends Controller
{
    private $api;

    public function __construct(Facebook $fb)
    {
        $this->middleware(function ($request, $next) use ($fb) {
            $fb->setDefaultAccessToken(Auth::user()->fb_token);
            $this->api = $fb;
            return $next($request);
        });
    }

    public function getPageAccessToken($page_id)
    {
        try {
            // Get the \Facebook\GraphNodes\GraphUser object for the current user.
            // If you provided a 'default_access_token', the '{access-token}' is optional.
            $response = $this->api->get('/me/accounts', Auth::user()->fb_token);
        } catch (FacebookResponseException $e) {
            // When Graph returns an error
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch (FacebookSDKException $e) {
            // When validation fails or other local issues
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }

        try {
            $pages = $response->getGraphEdge()->asArray();
            foreach ($pages as $key) {
                if ($key['id'] == $page_id) {
                    return $key['access_token'];
                }
            }
        } catch (FacebookSDKException $e) {
            dd($e); // handle exception
        }
    }

    public function publishToPage(Request $request)
    {

        $page_id = Auth::user()->page_id ?? '';

        try {
            if ($page_id && Auth::user()->fb_token) {

                $id = $request->id;
                $getdata = Item::find($id);

                $type1 = 'photos';
                $type2 = 'message';

                if ($getdata->fb_post_id) {
                    $post = $this->api->post('/' . $getdata->fb_post_id, [$type2 => $getdata->name], $this->getPageAccessToken($page_id));
                } else {
                    $post = $this->api->post('/' . $page_id . '/' . $type1, [$type2 => $getdata->name, 'source' => $this->api->fileToUpload(public_path('storage/' . $getdata->pic1))], $this->getPageAccessToken($page_id));
                }

                $post = $post->getGraphNode()->asArray();
                if (empty($getdata->fb_post_id)) {
                    if ($post) {
                        $getdata->fb_post_id = $post['post_id'] ?? $post['id'];
                        $getdata->fb_id = $post['id'];
                        $getdata->save();
                        $status_code = 200;
                        $msg = 'Created on facebook post successfully';
                    } else {
                        $msg = 'your post was not created in facebook.';
                        $status_code = 400;
                    }
                } else {
                    if ($post['success'] == true) {
                        $msg = 'Updated on facebook post successfully';
                        $status_code = 200;
                    } else {
                        $msg = 'your post was not updated in facebook.';
                        $status_code = 400;
                    }
                }
            } else {
                if (empty(Auth::user()->token)) {
                    $msg = 'please generate  facebook token. > Go to <a href="' . url("/profile") . '">profile</a>.';
                } else {
                    $msg = 'please add facebook page id > Go to <a href="' . url("/profile") . '">profile</a>.';
                }
                $status_code = 400;
            }
            $arr = array("status" => $status_code, "msg" => $msg);
        } catch (\Illuminate\Database\QueryException $ex) {
            $msg = $ex->getMessage();
            if (isset($ex->errorInfo[2])) :
                $msg = $ex->errorInfo[2];
            endif;
            $status_code = 400;
            $arr = array("status" => 400, "msg" => $msg, "result" => array());
        } catch (Exception $ex) {

            dd('ex', $ex);

            if ($ex->getcode() == 100) {
                $id = decrypt($request->id);
                $getdata = Item::find($id);
                $getdata->fb_post_id = null;
                $getdata->fb_id = null;
                $getdata->save();
                $this->publishToPage($request->id);
            }
            $msg = $ex->getMessage();
            if (isset($ex->errorInfo[2])) :
                $msg = $ex->errorInfo[2];
            endif;
            $status_code = 400;
            $arr = array("status" => 400, "msg" => $msg, 'line' => $ex->getLine(), "result" => array());
        }
        // return response()->json($arr, $status_code)->header('Content-Type', 'text/plain');
        return \Response::json($arr);
    }

    // public function publishToPage(Request $request){

    //     $page_token = auth()->user()->page_token;
    //     if(!$page_token){
    //         $page_info = $this->api->get('/'.auth()->user()->fb_id.'/accounts?access_token='.auth()->user()->fb_token);
    //         $page_info = json_decode($page_info->getBody());
    //         $page_token = $page_info->data[0]->access_token;
    //     }

    //     $fb = new \Facebook\Facebook([
    //         'app_id' => config('services.facebook.client_id'),
    //         'app_secret' => config('services.facebook.client_secret'),
    //         'default_graph_version' => 'v2.10',
    //     ]);

    //     try {
    //         $id = $request->id;
    //         $getdata = Item::find($id);

    //         if (!empty($getdata)) {
    //             $response = $fb->post('/me/feed', [
    //                 'message' => $getdata->name
    //             ], $page_token)->getGraphNode()->asArray();

    //             if($response['id']){
    //                 dump($response['id']);
    //                 dd($response);
    //                 // post created
    //             }
    //         }else {

    //             dd('record not found');
    //         }
    //     } catch (FacebookSDKException $e) {
    //         dd($e); // handle exception
    //     }
    // }
}
