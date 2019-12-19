<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRegistration;
use App\Repositories\ParkingRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ParkingController extends Controller
{
    private $userRepository;
    private $parkingRepository;

    public function __construct(ParkingRepository $parkingRepository, UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
        $this->parkingRepository = $parkingRepository;
    }

    public function getAvailablePlaces(Request $request)
    {
        return response($this->parkingRepository->getAvailablePlaces($request));
    }

    public function getCurrentFee(Request $request)
    {
        return response($this->userRepository->getCurrentFee($request));
    }

    public function registration(UserRegistration $request): Response
    {
        $result = $this->userRepository->register($request);
        $this->parkingRepository->decrementAvailablePlaces($request);

        return response($result);
    }

    public function unregister(Request $request)
    {
        $this->parkingRepository->incrementAvailablePlaces($request);
        $result = $this->userRepository->unregister($request);

        return response($result);
    }

}
