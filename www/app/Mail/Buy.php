<?php

namespace App\Mail;

use Dompdf\Dompdf;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class Buy extends Mailable
{
    use Queueable, SerializesModels;

    protected $obInstruction;

    /**
     * Buy constructor.
     * @param $obInstruction
     */
    public function __construct($obInstruction)
    {
        $this->obInstruction = $obInstruction;

    }


    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
//        $text = 'Text blablabla' . $this->obInstruction['name'] ;

        $html =
        "
        <h1> Name1 : " . $this->obInstruction['name'] ." </h1>
        ";

        $fileName = time().str_replace(' ', '', $this->obInstruction['name']) . '.pdf';
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $pdf = $dompdf->output();
//        $pdf = $dompdf->stream($this->obInstruction['name'], ['Attachment' => false]);
//        file_put_contents(asset('storage') .'/uploads/test1.pdf'  , $pdf);
        Storage::put('/public/uploads/' . $fileName, $pdf);

        $pdfForSend = asset('storage' . '/uploads/' . $fileName);
if (    $this->view('mail.exampleBuy', ['obInstruction' => $this->obInstruction,])
    ->subject('PDF1')
    ->attach($pdfForSend)
)

        unlink(storage_path('app/public/uploads/' . $fileName));
    }
}
