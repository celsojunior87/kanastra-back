<?php

namespace App\Service;

use App\Http\Requests\TicketRequest;
use App\Interface\TicketInterface;
use App\Models\Ticket;
use App\Repository\TicketRepository;
use App\Trait\Response;

class TicketService implements TicketInterface
{
    use Response;

    protected $ticketRepository;

    public function __construct(TicketRepository $ticketRepository)
    {
        $this->ticketRepository = $ticketRepository;
    }

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
        try {
            $this->ticketRepository->processCsv($request->file('file'));
            return response()->json(['message' => 'File uploaded successfully'], 200);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 500);
        }
    }


}
