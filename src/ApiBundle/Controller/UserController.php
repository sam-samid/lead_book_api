<?php

namespace ApiBundle\Controller;

use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\User;
/**
 * Class UserController
 */
class UserController extends DefaultController
{
    const USER_REPO = 'AppBundle:User';

    /**
     * register user
     * @Rest\Post("/users/register", name="api_register_user")
     * @param Request $request
     * @return View
     */
    public function registerUser(Request $request)
    {
        $postdata = $request->request->all();
        $em = $this->getDoctrine()->getManager();
        
        $existUser = $em->getRepository(self::USER_REPO)->findOneBy(['username'=>$postdata['username']]);
        switch (true) {
            case ($existUser):
                $message = 'username already exist';
                $error = true;
                break;
            
            case (strlen($postdata['password'])<8);
                $message = 'password must be 8 length';
                $error = true;
                break;
            
            default:
                $message = '';
                $error = false;
                break;
        }
        
        $data = [
            'code' => 400,
            'status' => 'error',
            'message' => $message
        ];
        
        if(!$error){
            $user = new User();
            $user->setUsername($postdata['username']);
            $user->setpassword($this->encrypt($postdata['password']));
            $user->setemail($postdata['email']);
            $user->setPhoneNumber($postdata['phone_number']);
            $user->setCreatedAt(new \DateTime());
            $em->persist($user);
            $em->flush();

            $subject = 'Lead Book Email Verification';

            $configEmailFrom = $this->getParameter('mailer_sender_from');
            $emailLinkEncripted = $this->getParameter('url')."/user/".$this->encrypt($postdata['email'])."/verify";

            $message = (new \Swift_Message($subject))
                ->setFrom([$configEmailFrom])
                ->setTo($postdata['email'])
                ->setBody(
                    "Hi {$postdata['username']},<br><br>".
    
                        "Please click this link to verify your account: {$emailLinkEncripted}<br>".
    
                        "<br><br><p style='font-size:10px;'>*This is automated email. Please do not reply.</p>"
                    ,
                    'text/html'
                )
            ;

            $this->get('mailer')->send($message);
            
            $data = [
                'code' => 200,
                'status' => 'success',
                'message' => 'email verifying has been sent to your email'
            ];
        }


        return $this->generateResponseData($data);
    }

    /**
     * verify email address
     * @Rest\Post("/users/{mailEncode}/verify", name="user_email_verify")
     * @param Request $request
     * @return View
     */
    public function veryfyEmail(Request $request, $mailEncode)
    {
        $em = $this->getDoctrine()->getManager();

        $mailDecode = $this->decrypt($mailEncode);
        $existUser = $em->getRepository(self::USER_REPO)->findOneBy(['email'=>$mailDecode]);

        if($existUser){
            $existUser->setEmailVerified(true);
            $em->persist($existUser);
            $em->flush();
        }

        $data = [
            'code' => 200,
            'status' => 'success',
            'message' => 'email verifying has been success'
        ];

        return $this->generateResponseData($data);
    }

    /**
     * reset password
     * @Rest\Post("/users/{userId}/password/reset", name="user_password_reset")
     * @param Request $request
     * @return View
     */
    public function resetPassword(Request $request, $userId)
    {
        if(!$this->getAuthorization()){
            $data = [
                'code' => 400,
                'status' => 'error',
                'message' => 'please login to your account'
            ];
            return $this->generateResponseData($data);
        }

        $postdata = $request->request->all();

        $em = $this->getDoctrine()->getManager();

        $existUser = $em->getRepository(self::USER_REPO)->find($userId);
        $passwordDecode = $this->decrypt($existUser->getPassword());

        if($postdata['old_password'] == $passwordDecode){
            $existUser->setPassword($this->encrypt($postdata['new_password']));
            $em->persist($existUser);
            $em->flush();

            $code = 200;
            $status = 'success';
            $message = 'password updated';
        }else{
            $code = 400;
            $status = 'error';
            $message = 'password false';
        }

        $data = [
            'code' => $code,
            'status' => $status,
            'message' => $message
        ];

        return $this->generateResponseData($data);
    }

    /**
     * login
     * @Rest\Post("/users/login", name="api_user_login")
     * @param Request $request
     * @return View
     */
    public function login(Request $request)
    {
        $postdata = $request->request->all();

        $em = $this->getDoctrine()->getManager();
        $existUser = $em->getRepository(self::USER_REPO)->findOneBy(['username'=>$postdata['username'], 'password'=>$this->encrypt($postdata['password'])]);
        $currentDateTime = new \DateTime();

        if($existUser){
            $existUser->setToken($this->encrypt($currentDateTime->format('Y-m-d H:i:s')));
            $em->persist($existUser);
            $em->flush();
            $data = [
                'code' => 200,
                'status' => 'success',
                'data' => [
                    'userId'=>$existUser->getId(),
                    'username'=>$existUser->getUsername(),
                    'email'=>$existUser->getEmail(),
                    'token'=>$existUser->getToken()
                ]
            ]; 
        }else{
            $data = [
                'code' => 404,
                'status' => 'error',
                'message' => 'username or password false'
            ]; 
        }

        return $this->generateResponseData($data);
    }

}
