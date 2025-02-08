<?php

declare(strict_types=1);

namespace App\Domain\Invoice\ValueObject;

class Bank
{
    private string $name;
    private string $bik;
    private string $inn;
    private string $kpp;
    private string $accountNumber;

    public function __construct(string $name, string $bik, string $inn, string $kpp, string $accountNumber)
    {
        $this->assertNameValid($name);
        $this->assertBikValid($bik);
        $this->assertInnValid($inn);
        $this->assertKppValid($kpp);
        $this->assertAccountNumberValid($accountNumber);
        $this->name = $name;
        $this->bik = $bik;
        $this->inn = $inn;
        $this->kpp = $kpp;
        $this->accountNumber = $accountNumber;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getBik(): string
    {
        return $this->bik;
    }

    public function getInn(): string
    {
        return $this->inn;
    }

    public function getKpp(): string
    {
        return $this->kpp;
    }

    public function getAccountNumber(): string
    {
        return $this->accountNumber;
    }

    private function assertNameValid(string $value): void
    {
        if (mb_strlen($value) < 2) {
            throw new \InvalidArgumentException('Название клиента должно содержать хотя бы 2 символа');
        }
    }

    private function assertBikValid(string $value): void
    {
        if (mb_strlen($value) != 9) {
            throw new \InvalidArgumentException('БИК должен состоять из 9 цифр');
        }
    }

    private function assertInnValid(string $value): void
    {
        if (mb_strlen($value) !== 10 && mb_strlen($value) !== 12) {
            throw new \InvalidArgumentException('Инн должен быть 10 или 12 символов');
        }
    }

    private function assertKppValid(string $value): void
    {
        if (mb_strlen($value) != 9) {
            throw new \InvalidArgumentException('КПП должен состоять из 9 цифр');
        }
    }

    private function assertAccountNumberValid(string $value): void
    {
        if (mb_strlen($value) != 20) {
            throw new \InvalidArgumentException('Номер счета должен состоять из 20 цифр');
        }
    }
}
