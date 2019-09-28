<?php
namespace App\Form;

use App\Entity\Post;
use Symfony\Component\Form\AbstractType;
//use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'label'=>false,
                'attr' => [
                    'class' => 'bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500',
                    'placeholder'=>'Titre',
                    ]])
            ->add('body', TextareaType::class, [
                'label'=>false,
                'attr' => [
                    'class' => 'mt-2 bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500',
                    'placeholder'=>'Description',
                    ]])
        
            ->add('img', TextType::class, [
                'label'=>false,
                'attr' => [
                'class' => 'mb-2 bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500',
                      'placeholder'=>'Lien de l\'image',
                       ]])
                
            ->add('Valider', SubmitType::class, [
                'attr' => [
                    'class'=>'bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline',
                ]
            ])
        ;
    }

    public function configureOptions(Optionsresolver $resolver){
        $resolver->setDefaults([
            'data_class' => Post::class,
        ]);
    }
}

?>