<?php
namespace App\Repository;

use App\Models\Ticket;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\UploadedFile;
use Illuminate\Validation\ValidationException;

class TicketRepository extends Ticket
{
    public function processCsv(UploadedFile $file)
    {
        $path = $file->getRealPath();
        $header = null;
        $data = [];
        if (($handle = fopen($path, 'r')) !== false) {
            while (($row = fgetcsv($handle, 1000, ',')) !== false) {
                if (!$header) {
                    $header = $row;
                } else {
                    $data[] = array_combine($header, $row);
                }
            }
            fclose($handle);
        }

        $emails = array_column($data, 'email');
        $email = $this->verificaEmail($emails);
//        $uniqueEmails = array_unique($emails);
//        if (count($emails) !== count($uniqueEmails)) {
//            throw ValidationException::withMessages(['email' => 'Os emails no arquivo não são únicos']);
//        }

        DB::transaction(function () use ($data) {
            foreach ($data as $row) {
                Ticket::create([
                    'name' => $row['name'],
                    'governmentId' => $row['governmentId'],
                    'email' => $row['email'],
                    'debtAmount' => $row['debtAmount'],
                    'debtDueDate' => $row['debtDueDate'],
                    'debtId' => $row['debtId'],
                ]);
            }
        });
    }

    public function verificaEmail($emails)
    {
        $results = DB::table('ticket')
            ->where('email', 'like', '%' . $emails . '%')
            ->get();
        return $results;
    }

}
