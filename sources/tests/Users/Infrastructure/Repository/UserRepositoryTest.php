<?php

namespace App\Tests\Users\Infrastructure\Repository;

use App\Users\Application\Factory\UserFactory;
use App\Users\Domain\Ulid\UlidGeneratorInterface;
use App\Users\Infrastructure\Repository\UserRepository;
use Faker\Factory;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\PasswordHasher\PasswordHasherInterface;
use Symfony\Component\Uid\Ulid as SymfonyUlid;

class UserRepositoryTest extends KernelTestCase
{
    private UserRepository $repository;
    private \Faker\Generator $faker;

    protected function setUp(): void
    {
        parent::setUp();
        $this->repository = static::getContainer()->get(UserRepository::class);
        $this->faker = Factory::create();
    }

    public function test_added_user_successfully()
    {

        $email = $this->faker->email();
        $password = $this->faker->password();

        $hasher = $this->createMock(PasswordHasherInterface::class);
        $hasher->method('hash')
            ->willReturn('mocked_hashed_password');
        $ulid = $this->createMock(UlidGeneratorInterface::class);
        $ulid->method('generate')
            ->willReturn(SymfonyUlid::generate()); // TODO убрать как сделаю удаление перед тестом

        $user = (new UserFactory($ulid, $hasher))->create($email, $password);

        $this->repository->save($user);

        $existingUser = $this->repository->findByUlid($user->getUlid());

        $this->assertNotNull($existingUser);
        $this->assertEquals($user->getUlid(), $existingUser->getUlid());
    }
}
