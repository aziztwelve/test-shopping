<?php

namespace App\Http\Controllers;

use App\Repository\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {

        $this->userRepository = $userRepository;
    }

    public function index()
    {
        $users = $this->userRepository->all();
        $users_db = DB::table('users')->where('id', 5)->get();

        dd(gettype($users_db));
//        dd(is_iterable($users_db));

        return view('users.index', [
            'users' => $users
        ]);

    }
}
