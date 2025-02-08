<?php

declare(strict_types=1);

namespace App\Infrastructure\Invoice\Service;

use App\Domain\Invoice\Entity\Invoice;
use App\Domain\Invoice\Service\InvoiceMailerInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

readonly class InvoiceMailer implements InvoiceMailerInterface
{
    public function __construct(
        private MailerInterface       $mailer,
        private ParameterBagInterface $env
    )
    {
    }

    public function sendInvoice(Invoice $invoice, string $pdfContent): void
    {
        $email = (new Email())
            ->from($this->env->get('emailFrom'))
            ->to($invoice->getUser()->getEmail())
            ->subject('Счет на оплату ' . $invoice->getId())
            ->html('Ваш счет на оплату готов')
            ->attach($pdfContent, 'invoice.pdf', 'application/pdf');

        $this->mailer->send($email);

    }
}