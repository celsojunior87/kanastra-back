<?php

namespace App\Service;

use App\Http\Requests\TicketRequest;
use App\Interface\TicketInterface;
use App\Models\Ticket;
use App\Trait\Response;

class TicketService implements TicketInterface
{
    use Response;

    public function getAll()
    {
        try {
            $Ticket = Ticket::all();
            return $this->success("Listagem de Tickets", $Ticket);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 404);
        }
    }

    public function upload(TicketRequest $request)
    {
        dd($request->all());

    }


}
