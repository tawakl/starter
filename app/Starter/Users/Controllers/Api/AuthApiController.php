<?php

namespace App\Starter\Users\Controllers\Api;

use App\Starter\BaseApp\Controllers\BaseApiController;
use App\Starter\BaseApp\Controllers\Enums\ResourceTypes;
use App\Starter\BaseApp\Requests\BaseApiTokenRequest;
use App\Starter\Users\Requests\Api\LoginRequest;
use App\Starter\Users\Transformers\UserAuthTransformer;
use App\Starter\Users\User;
use App\Starter\Users\UserEnums;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Swis\JsonApi\Client\Interfaces\ParserInterface;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Http\Request;


class AuthApiController extends BaseApiController
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255|unique:users',
            'name' => 'required',
            'password'=> 'required'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors());
        }
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->governorate = $request->governorate;
        $user->city = $request->city;
        $user->save();
        $user = User::first();
        $token = JWTAuth::fromUser($user);

        return response()->json([
            'success' => true,
            'token' => $token,
        ]);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
            'password'=> 'required'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $input = $request->only('email', 'password');
        $jwt_token = null;

        if (!$jwt_token = JWTAuth::attempt($input)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid Email or Password',
            ], 401);
        }

        return response()->json([
            'success' => true,
            'token' => $jwt_token,
            'user' => Auth::user()
        ]);
    }

    public function logout(Request $request)
    {
        $this->validate($request, [
            'token' => 'required'
        ]);

        try {
            JWTAuth::invalidate($request->token);

            return response()->json([
                'success' => true,
                'message' => 'User logged out successfully'
            ]);
        } catch (JWTException $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, the user cannot be logged out'
            ], 500);
        }
    }

    public function getAuthUser(Request $request)
    {
        $this->validate($request, [
            'token' => 'required'
        ]);

        $user = JWTAuth::authenticate($request->token);

        return response()->json(['user' => $user]);
    }

//    public $loginAfterSignUp = true;
//
//    public function register(Request $request)
//    {
//        $user = User::create([
//            'name' => $request->name,
//            'email' => $request->email,
//            'password' => bcrypt($request->password),
//            'governorate' => $request->governorate,
//            'city' => $request->city,
//        ]);
//
//        $token = auth()->login($user);
//
//        return $this->respondWithToken($token);
//    }
//
//    public function login(Request $request)
//    {
//        $credentials = $request->only(['email', 'password']);
//
//        if (!$token = auth()->attempt($credentials)) {
//            return response()->json(['error' => 'Unauthorized'], 401);
//        }
//        return $this->respondWithToken($token);
//    }
//    public function getAuthUser(Request $request)
//    {
//        return response()->json(auth()->user());
//    }
//    public function logout()
//    {
//        auth()->logout();
//        return response()->json(['message'=>'Successfully logged out']);
//    }
//    protected function respondWithToken($token)
//    {
//        return response()->json([
//            'access_token' => $token,
//            'token_type' => 'bearer',
//            'expires_in' => auth()->factory()->getTTL() * 60
//
//        ]);

//    public $parserInterface;
//
//    public function __construct(ParserInterface $parserInterface)
//    {
//        $this->parserInterface = $parserInterface;
//    }
//
//    public function login(LoginRequest $request)
//    {
//        try {
//            //parse data from jsonapi request body
//            $data = $request->getContent();
//            $data = $this->parserInterface->deserialize($data);
//            $data = $data->getData();
//            $errorArray = [];
//            $row = User::where('mobile_number', $data->mobile_number)->first();
//
//            if (!$row) {
//                $errorArray[] = [
//                    'status' => 422,
//                    'title' => trans('api.login_failed'),
//                    'detail' => trans("api.data did not match any records"),
//                ];
//                throw new HttpResponseException(response()->json(["errors" => $errorArray], 422));
//            }
//            if (!$row->confirmed) {
//                $errorArray[] = [
//                    'status' => 422,
//                    'title' => trans('api.login_failed'),
//                    'detail' => trans("api.This account is not confirmed"),
//                ];
//            }
//            if (!$row->is_active) {
//                $errorArray[] = [
//                    'status' => 422,
//                    'title' => trans('api.login_failed'),
//                    'detail' => trans("api.This account is banned"),
//                ];
//            }
//            if (!Hash::check(trim($data->password), $row->password)) {
//                $errorArray[] = [
//                    'status' => 422,
//                    'title' => trans('api.login_failed'),
//                    'detail' => trans("api.Password Invalid"),
//                ];
//            }
//            if ($errorArray) {
//                throw new HttpResponseException(response()->json(["errors" => $errorArray], 422));
//            } else {
//                if ($token = auth()->attempt([
//                    'mobile_number' => $data->mobile_number,
//                    'password' => $data->password
//                ])) {
//                    if ($data->location_id && $row->citizen) {
//                        $row->citizen->update(['location_id' => $data->location_id]);
//                    }
//
//                    $include = '';
//                    $meta = [
//                        'token' => JWTAuth::fromUser($row),
//                        'language' => (string) ($row->language ?? config('app.locale')),
//                    ];
//                    //send data to transformer
//                    return $this->transformDataModInclude($row, '', new UserAuthTransformer(), ResourceTypes::USER, $meta);
//                } else {
//                    $errorArray[] = [
//                        'status' => 422,
//                        'title' => trans('api.login_failed'),
//                        'detail' => trans("api.something went wrong, please try again"),
//                    ];
//                    throw new HttpResponseException(response()->json(["errors" => $errorArray], 422));
//                }
//            }
//        } catch (JWTException $e) {
//            return response()->json(
//                [
//                    'status' => $e->getCode(),
//                    'title' => $e->getMessage(),
//                    'detail' => $e->getTrace()
//                ],
//                500
//            );
//        }
//    }
//
//    public function logout(BaseApiTokenRequest $request)
//    {
//        try {
//            $token = JWTAuth::getToken();
//            JWTAuth::invalidate($token);
//            return response()->json(
//                [
//                    "meta" => [
//                        'message' => trans('api.Successfully Logged Out')
//                    ]
//                ]
//            );
//        } catch (JWTException $e) {
//            return response()->json(
//                [
//                    'status' => $e->getCode(),
//                    'title' => $e->getMessage(),
//                    'detail' => $e->getTrace()
//                ],
//                500
//            );
//        }
//    }
}
