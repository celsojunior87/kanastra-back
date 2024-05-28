<?php

namespace App\Interface;

use App\Http\Requests\TicketRequest;

interface TicketInterface
{

    public function getAll();
    public function upload(TicketRequest $request);

}
