<?php
namespace App\Controller;

use App\Entity\User;
use App\Repository\CountryRepository;
use App\Repository\UserRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApiUserController extends AbstractController
{
    public function __construct(
        private readonly UserRepository $userRepository,
        private readonly EntityManagerInterface $entityManager,
        private readonly CountryRepository $countryRepository,
    )
    {
    }

    #[Route('/api/users', methods: ['GET'])]
    public function index(Request $request): Response
    {
        $startDate = new DateTime($request->query->get('startDate'));
        $endDate = new DateTime($request->query->get('endDate'));

        $users = $this->userRepository->findByDateRange($startDate, $endDate);
        return $this->json($users);
    }

    #[Route('/api/users', methods: ['POST'])]
    public function create(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);
        $country = $this->countryRepository->find($data['country']['id']);

        $user = new User();
        $user->setFirstName($data['firstName']);
        $user->setLastName($data['lastName']);
        $user->setDateOfBirth(new DateTime($data['dateOfBirth']));
        $user->setCountry($country);

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return $this->json($user);
    }

    #[Route('/api/users/{id}', methods: ['PUT'])]
    public function update(User $user, Request $request): Response
    {
        $data = json_decode($request->getContent(), true);
        $country = $this->countryRepository->find($data['country']['id']);

        $user->setFirstName($data['firstName']);
        $user->setLastName($data['lastName']);
        $user->setDateOfBirth(new DateTime($data['dateOfBirth']));
        $user->setCountry($country);

        $this->entityManager->flush();

        return $this->json($user);
    }

    #[Route('/api/users/{id}', methods: ['DELETE'])]
    public function delete(User $user): Response
    {
        $this->entityManager->remove($user);
        $this->entityManager->flush();

        return new Response(null, 204);
    }
}
