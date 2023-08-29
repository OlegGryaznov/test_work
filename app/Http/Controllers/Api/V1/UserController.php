<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\User\UserStoreFormRequest;
use App\Http\Resources\Api\V1\UserResource;
use App\Repositories\UserRepository;
use App\Services\UserService;
use App\Traits\Logger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    use Logger;
    /**
     * Display a listing of the resource.
     */
    public function index(UserRepository $userRepository, Request $request)
    {
        return UserResource::collection(
            $userRepository->getUsers(
                $this->offset($request),
                $this->limit($request)
            )
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserStoreFormRequest $request, UserService $userService)
    {
        try {
            DB::beginTransaction();
            $user = $userService->create($request->validated());
            DB::commit();

            return UserResource::make($user)
                ->response()
                ->setStatusCode(Response::HTTP_CREATED);

        } catch (\Exception $exception) {
            DB::rollBack();
            $this->log($exception);

            return response()->json([
                'message' => 'Server error'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    protected function offset(Request $request)
    {
        return $request->offset ?? config('paginate.users.paginate');
    }

    protected function limit(Request $request)
    {
        return $request->limit ?? config('paginate.users.limit');
    }
}
