<?php

namespace App\Form;

use App\Entity\Answer;
use App\Entity\Question;
use App\Form\ApplicationType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

class Quiz6Type extends ApplicationType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('proposition', TextType::class, $this->getConfiguration("Proposition", "Veuillez saisir une proposition"))
            //->add('correction', CheckboxType::class, $this->getConfiguration("Correction", "Veuillez cocher si la proposition est correct"))
           ->add('correction', CheckboxType::class, [
               'label' => "Veuillez cocher si la proposition est correct",
               'required' => false,
           ])
          
            /*
            ->add('questions', EntityType::class, [
                'class' => Answer::class,
                'choice_label' => 'questions'
            ])
            */
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Answer::class,
        ]);
    }
}
