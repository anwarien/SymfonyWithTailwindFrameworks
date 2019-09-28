<?php
namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
//use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', TextType::class, [
                'label'=>false,
                'attr' => [
                    'class' => 'mb-2 focus:border-blue-500 appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none',
                    'placeholder'=>'Username',
                    ]])
            ->add('email', EmailType::class, [
                'label'=>false,
                'attr' => [
                    'class' => 'mb-2 focus:border-blue-500 appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none',
                    'placeholder'=>'Your Email',
                    ]])
                
             ->add('plainPassword', RepeatedType::class, [
                 'label'=>false,
                 'type'=> PasswordType::class,
                 'first_options' => [
                    'label'=>false,
                     'attr' => [
                        'class' => 'mb-2 focus:border-blue-500 appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none',
                        'placeholder'=>'Password' 
                     ],
                    ],
                 'second_options' => [
                    'label'=>false,
                    'attr' => [
                        'class' => 'mb-2 focus:border-blue-500 appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none',
                        'placeholder'=>'Confirmation Password' 
                     ],
                   ],
                 ])        
        
            ->add('fullname', TextType::class, [
                'label'=>false,
                'attr' => [
                    'class' => 'mb-2 focus:border-blue-500 appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none',
                    'placeholder'=>'Fullname',
                       ]])
                
            ->add('Valider', SubmitType::class, [
                'attr' => [
                    'class'=>'align-middle bg-blue-500 hover:bg-blue-600 text-center px-4 py-2 text-white text-sm font-semibold rounded-lg inline-block shadow-lg',
                ]
            ])
        ;
    }

    public function configureOptions(Optionsresolver $resolver){
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}

?>