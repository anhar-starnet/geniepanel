<?php

namespace App\Http\Controllers;

use App\Repositories\DeviceEventRepository;

class EventController extends Controller
{
    public function __construct(
        protected DeviceEventRepository $events
    ) {
    }

    /**
     * Device Event Timeline.
     */
    public function index()
    {
        return view('admin.events.index', [
            'events' => $this->events->latest(100),
        ]);
    }
}