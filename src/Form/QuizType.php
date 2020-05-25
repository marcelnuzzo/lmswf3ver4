<?php

namespace App\Form;

use App\Entity\Answer;
use App\Form\Quiz4Type;
use App\Entity\Question;
use App\Form\UtiquizType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class QuizType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            
            ->add('answers', CollectionType::class, [
                'entry_type' => UtiquizType::class,
            ])
            
            /*
            ->add('answers', EntityType::class, [
                'class' => Question::class,
                'choice_label' => 'label',
            ])
            */
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Question::class,
        ]);
    }
}
