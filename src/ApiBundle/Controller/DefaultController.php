<?php

namespace ApiBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use phpseclib\Crypt\RC4;
use League\Fractal;

class DefaultController extends Controller
{
    private $key;
    protected $manager;

    public function __construct()
    {
        $this->key = 'KL4>acv* <MFz axd-0+nm';
        #set fractal manager
        $this->manager = new Fractal\Manager();
        $this->manager->setSerializer(new Fractal\Serializer\ArraySerializer());
        
        if (isset($_GET['include'])) {
            $this->manager->parseIncludes($_GET['include']);
        }
    }


    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $users = $em->getRepository("AppBundle:User")->findAll();
        dump($users);exit;
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }

    protected function generateResponseData($data){
        $response = new Response(json_encode($data, JSON_FORCE_OBJECT), $data['code']);
        $response->headers->set('Content-Type', 'json');
        return $response;
    }

    protected function encrypt($text)
    {
        $rc4 = new RC4();
        $rc4->setKey($this->key);
        $ciphertext   = $rc4->encrypt($text);
        $base64cipher = base64_encode($ciphertext);

      
        return $base64cipher;
    }

    protected function decrypt($base64cipher)
    {
        $rc4 = new RC4();
        $rc4->setKey($this->key);
        $ciphertext = base64_decode($base64cipher);
        $string = $rc4->decrypt($ciphertext);


        return $string;
    }

    protected function getAuthorization(){
        $headers = null;
        if (isset($_SERVER['Authorization'])) {
            $headers = trim($_SERVER["Authorization"]);
        }
        else if (isset($_SERVER['HTTP_AUTHORIZATION'])) { //Nginx or fast CGI
            $headers = trim($_SERVER["HTTP_AUTHORIZATION"]);
        } elseif (function_exists('apache_request_headers')) {
            $requestHeaders = apache_request_headers();
            // Server-side fix for bug in old Android versions (a nice side-effect of this fix means we don't care about capitalization for Authorization)
            $requestHeaders = array_combine(array_map('ucwords', array_keys($requestHeaders)), array_values($requestHeaders));
            //print_r($requestHeaders);
            if (isset($requestHeaders['Authorization'])) {
                $headers = trim($requestHeaders['Authorization']);
            }
        }

        $realTimeToken = str_replace('Bearer ','',$headers);

        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository("AppBundle:User")->findOneBy(['token'=>$realTimeToken]);
        
        return $user ? true:false;
    }
}
