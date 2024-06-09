<?php
namespace App\Controller;

use App\Repository\CountryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApiCountryController extends AbstractController
{
    public function __construct(
        private readonly CountryRepository $countryRepository,
    )
    {
    }

    #[Route('/api/countries', methods: ['GET'])]
    public function countries(): Response
    {
        $countries = $this->countryRepository->findAll();
        return $this->json($countries);
    }
}
