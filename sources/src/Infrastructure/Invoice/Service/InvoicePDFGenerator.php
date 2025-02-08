<?php

declare(strict_types=1);

namespace App\Infrastructure\Invoice\Service;

use App\Domain\Invoice\Entity\Invoice;
use App\Domain\Invoice\Service\InvoicePDFGeneratorInterface;
use Dompdf\Dompdf;
use Twig\Environment;

readonly class InvoicePDFGenerator implements InvoicePDFGeneratorInterface
{

    public function __construct(
        private Environment $twig
    )
    {
    }

    public function generate(Invoice $invoice): string
    {
        $dompdf = new Dompdf();

        $htmlContent = $this->twig->render('invoice.html.twig', [
            'invoice' => $invoice,
        ]);
        $dompdf->loadHtml($htmlContent);

        $dompdf->setPaper('A4');
        $dompdf->render();

        return $dompdf->output();
    }
}