<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Http\Requests\TicketRequest;
use App\Interface\TicketInterface;

class TicketController extends Controller
{

    public function __construct(TicketInterface $ticket)
    {
        $this->ticket = $ticket;
    }

    public function getAll()
    {
        return $this->ticket->getAll();
    }

    public function upload(TicketRequest $ticket)
    {
        return $this->ticket->upload($ticket);
    }



}
