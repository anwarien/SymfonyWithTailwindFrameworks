<?php
namespace App\Controller;

use App\Entity\Post;
use App\Form\PostType;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\RouterInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
// Include paginator interface
use Knp\Component\Pager\PaginatorInterface;


class BlogController extends AbstractController
{
    private $formFactory;
    private $entityManager;
    private $router;
    private $flashMessage;
    private $paginatorInterface;

    public function __construct(FormFactoryInterface $formFactory,
                                EntityManagerInterface $entityManager,
                                RouterInterface $router,
                                FlashBagInterface $flashMessage,
                                PaginatorInterface $paginatorInterface){
        $this->formFactory = $formFactory;
        $this->entityManager = $entityManager;
        $this->router = $router;
        $this->flashMessage = $flashMessage;
        $this->paginatorInterface = $paginatorInterface;
    }
    /**
     * @Route("/blog", name="blog_list")
     */

    public function index(Request $request, PaginatorInterface $paginator){
    
        $postRepository = $this->getDoctrine()->getRepository(Post::class);
        $allPosts = $postRepository->findBy(
            [], ['id' => 'DESC']
        );
        // Paginate the results of the query
        $posts = $paginator->paginate(
            // Doctrine Query, not results
            $allPosts,
            // Define the page parameter
            $request->query->getInt('page', 1),
            // Items per page
            9
        );

        return $this->render( 'index.html.twig' ,[
            'posts' => $posts
        ]);
    }

     /**
     * @Route("/blog/add", name="add_post")
     */
    
     public function add(Request $request, UserInterface $user){
        
        $post =  new Post();
        $post->setUser($user);
        $post->setTime(new \DateTime());

        $form = $this->createForm(PostType::class, $post, ['method' => 'POST']);
        
        $str = "Rest Api";
        $post->setUrldetail($str);
        $form->handleRequest($request);
        

        if($form->isSubmitted() && $form->isValid()){
            $this->entityManager->persist($post);
            $this->entityManager->flush();
            $this->flashMessage->add('success','The Post was Added Successfully !');
            return new RedirectResponse(
                $this->router->generate('blog_list')
            );
        }

        return $this->render('add.html.twig',[
            'form' => $form->createView()
        ]);
    }
    /*
    public function add(Request $request, ObjectManager $manager){
        $post = new Post();

        $form = $this->createFormBuilder($post)
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
                    
                ->add('Ajouter', SubmitType::class, [
                    'attr' => [
                        'class'=>'bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline',
                    ]
                ])
                ->getForm();

        return $this->render('add.html.twig',[
            'form' => $form->createView()
        ]);
    }
    */


     /**
     * @Route("/blog/{slug}", name="show_blog")
     */
    public function show($slug){
        $postRepository = $this->getDoctrine()->getRepository(Post::class);
        $post = $postRepository->findOneBy([
            'urldetail' => $slug,
            
        ]);
        return $this->render( 'show.html.twig' ,[
            'post' => $post
        ]);

    }

     /**
     * @Route("/blog/edit/{id}", name="blog_edit")
     */
    public function edit(Post $post, Request $request){
       $this->denyAccessUnlessGranted('edit', $post); 

       $form = $this->formFactory->create(PostType::class, $post);
       $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid() ){
            $this->entityManager->flush();
            $this->flashMessage->add('success','The Post was Edited Successfully !');
            return new RedirectResponse(
                $this->router->generate('blog_list')
            );
        }

        return $this->render( 'edit.html.twig' ,[
            'form' => $form->createView()
        ]);

    }

     /**
     * @Route("/blog/delete/{id}", name="blog_delete")
     */
    public function delete(Post $post){
        $this->denyAccessUnlessGranted('delete', $post);

         $this->entityManager->remove($post);
         $this->entityManager->flush();
         $this->flashMessage->add('success','The Post was Deleted Successfully !');
             return new RedirectResponse(
                 $this->router->generate('blog_list')
            );
    }

    

    public function list()
    {
        return new Response(
                'hello world'
            );
    }
}
?> 
