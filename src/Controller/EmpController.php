<?php

namespace App\Controller;

use App\Entity\Employee;
use App\Entity\User;
use App\Form\EmployeeType;
use App\Repository\EmployeeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/emp')]
class EmpController extends AbstractController
{
    #[Route('/', name: 'app_emp_index', methods: ['GET'])]
    public function index(EmployeeRepository $employeeRepository): Response
    {

        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        return $this->render('emp/index.html.twig', [
            'employees' => $employeeRepository->findAll(),
        ]);

        // $user = $this->getUser();
        
        // return match ($user->isVerified()) {
        //     true => $this->render('emp/index.html.twig', [
        //     'employees' => $employeeRepository->findAll(),
        // ]),
        //     false => $this->render("registration/please-verify-email.html.twig"),
        // };
    }

    #[Route('/new', name: 'app_emp_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $employee = new Employee();

        $form = $this->createForm(EmployeeType::class, $employee);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($employee);
            $entityManager->flush();

            return $this->redirectToRoute('app_emp_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('emp/new.html.twig', [
                'employee' => $employee,
                'form' => $form,
            ]);
    }

    #[Route('/show/{id}', name: 'app_emp_show', methods: ['GET'])]
    public function show(Employee $employee): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        return $this->render('emp/show.html.twig', [
            'employee' => $employee,
        ]);
    }

    #[Route('/edit/{id}', name: 'app_emp_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Employee $employee, EntityManagerInterface $entityManager): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $form = $this->createForm(EmployeeType::class, $employee);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $uploadedFile = $form['profile_pic']->getData();
            if ($uploadedFile) {
                $destination = $this->getParameter('kernel.project_dir').'/public/uploads/profile_image';
                $originalFilename = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
                $newFilename = $originalFilename.'-'.uniqid().'.'.$uploadedFile->guessExtension();
                $uploadedFile->move(
                    $destination,
                    $newFilename
                );
                $employee->setProfilePic($newFilename);
            }


            $entityManager->flush();

            return $this->redirectToRoute('app_emp_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('emp/edit.html.twig', [
            'employee' => $employee,
            'form' => $form,
        ]);
    }

    #[Route('/delete/{id}', name: 'app_emp_delete', methods: ['POST'])]
    public function delete(Request $request, Employee $employee, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$employee->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($employee);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_emp_index', [], Response::HTTP_SEE_OTHER);
    }
}
