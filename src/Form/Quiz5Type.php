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
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class Quiz5Type extends ApplicationType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        /*
            ->add('proposition')
            ->add('correction')
            */
            ->add('label', TextType::class, $this->getConfiguration("label", "Veuillez saisir la question"))
            ->add('answers', CollectionType::class, [
                'entry_type' => Quiz6Type::class,
                //'by_reference' => true,
                
                'entry_options' => [
                    'label' => false,
                ],
                
                //'allow_add'  => false
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
