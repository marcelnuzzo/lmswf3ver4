<?php

namespace App\Controller;

use App\Entity\Answer;
use App\Form\QuizType;
use App\Form\Quiz5Type;
use App\Form\Quiz6Type;
use App\Entity\Question;
use App\Form\QuestionType;
use App\Repository\AnswerRepository;
use App\Repository\QuestionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/question")
 */
class QuestionController extends AbstractController
{
    /**
     * @Route("/", name="question_index", methods={"GET"})
     */
    public function index(QuestionRepository $questionRepository): Response
    {
        return $this->render('question/index.html.twig', [
            'questions' => $questionRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="question_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $question = new Question();
        $form = $this->createForm(QuestionType::class, $question);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($question);
            $entityManager->flush();

            return $this->redirectToRoute('question_index');
        }

        return $this->render('question/new.html.twig', [
            'question' => $question,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="question_show", methods={"GET"})
     */
    public function show(Question $question): Response
    {
        return $this->render('question/show.html.twig', [
            'question' => $question,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="question_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Question $question): Response
    {
        $form = $this->createForm(QuestionType::class, $question);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('question_index');
        }

        return $this->render('question/edit.html.twig', [
            'question' => $question,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="question_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Question $question): Response
    {
        if ($this->isCsrfTokenValid('delete'.$question->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($question);
            $entityManager->flush();
        }

        return $this->redirectToRoute('question_index');
    }

    /**
     * 
     * @Route("/question/nouveau", name="question_nouveau")
     *
     * @return Response
     */
    public function nouveau(EntityManagerInterface $manager, Request $request) {
        $question = new Question();
       
        $form = $this->createForm(Quiz5Type::class, $question);

        $form->handleRequest($request);
               
        if($form->isSubmitted() && $form->isValid()) {  
            foreach($question->getanswers() as $answer) {
                $answer->setQuestions($question);
                $manager->persist($answer);
            }
                        
            $manager->persist($question);
            $manager->flush();
                    
            $this->addFlash(
                'success',
                "création du quiz sauvegardée"
            );
                
            //return $this->redirectToRoute('home_list');
        }
        return $this->render('question/nouveau.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * 
     * @Route("/question/affiche2", name="question_affiche2")
     *
     * @return Response
     */
    public function affiche(EntityManagerInterface $manager, Request $request, QuestionRepository $qRepo, AnswerRepository $aRepo) {
        
        $firstQuestion = $qRepo->findFirstId()[0]['id'];
        $id = $firstQuestion;    
        $choice = $qRepo->findChoice($id)->getChoice();
        $countQuestion = $qRepo->findCountQuestion();
        $tabPropo = [];
        //for($i=1; $i<=$countQuestion; $i++) {
            $tabPropo[] = $aRepo->findPropo($id);
        //}
        for($i=0; $i<$countQuestion; $i++) {
           $tabPropo = $tabPropo[$i]['proposition'];
        }
        

        dd($tabPropo);
        
        $answer = new Answer();
        
        $form = $this->createForm(QuizType::class, $answer, [
            'choice' => $choice,
            'tabPropo' => $tabPropo,
        ]);

        $form->handleRequest($request);
           
        if($form->isSubmitted() && $form->isValid()) {  
            /*
            foreach($question->getanswers() as $answer) {
                $answer->setQuestions($question);
                $manager->persist($answer);
            }
                        
            $manager->persist($question);
            $manager->flush();
             */       
           
                
            return $this->redirectToRoute('home_list');
        }
        return $this->render('question/affiche2.html.twig', [
            'form' => $form->createView(),
            'answers' => $aRepo->findAll()
        ]);
    }
    
}
