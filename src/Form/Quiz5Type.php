<?php

namespace App\Form;

use App\Entity\Answer;
use App\Form\Quiz6Type;
use App\Entity\Question;
use App\Form\ApplicationType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class Quiz5Type extends ApplicationType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
       
            ->add('label', TextType::class, $this->getConfiguration("label", "Veuillez saisir la question"))
            ->add('choice', CheckboxType::class, [
                'label' => "Veuillez cocher la case si la question présente un choix multiple",
                'required' => false,
            ])
            ->add('answers', CollectionType::class, [
                'entry_type' => Quiz6Type::class,
                'allow_add' => true,
                'allow_delete' => true
            ])
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Question::class,
        ]);
    }
}
