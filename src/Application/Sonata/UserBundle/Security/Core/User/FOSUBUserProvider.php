<?php

namespace Application\Sonata\UserBundle\Security\Core\User;

use HWI\Bundle\OAuthBundle\OAuth\Response\UserResponseInterface;
use HWI\Bundle\OAuthBundle\Security\Core\User\FOSUBUserProvider as BaseClass;
use Symfony\Component\Security\Core\User\UserInterface;

class FOSUBUserProvider extends BaseClass {

    /**
     * {@inheritDoc}
     */
    public function connect(UserInterface $user, UserResponseInterface $response) {
        $property = $this->getProperty($response);
        $username = $response->getUsername();
        //on connect - get the access token and the user ID
        $service = $response->getResourceOwner()->getName();
        $setter = 'set' . ucfirst($service);
        $setter_id = $setter . 'Id';
        $setter_token = $setter . 'AccessToken';
        //we "disconnect" previously connected users
        if (null !== $previousUser = $this->userManager->findUserBy(array($property => $username))) {
            $previousUser->$setter_id(null);
            $previousUser->$setter_token(null);
            $this->userManager->updateUser($previousUser);
        }
        //we connect current user
        $user->$setter_id($username);
        $user->$setter_token($response->getAccessToken());
        $this->userManager->updateUser($user);
    }

    /**
     * {@inheritdoc}
     */
    public function loadUserByOAuthUserResponse(UserResponseInterface $response) {
        
        //dump($response);die;
        $social_id = $response->getUsername();
        $realName = $response->getRealName();
        $email = $response->getEmail();
        if($email === null){
        	$email = $this->generateRandomString().'@doe.com';
        }
        $avatar = $response->getProfilePicture();
        $firstName = "";
        $firstName = explode(" ", $realName)[0];
        $lastName = "";
        $aux = explode(" ", $realName);
        for ($i = 1; $i < count($aux); $i++) {
            $lastName .= $aux[$i] . " ";
        }
        $lastName = trim($lastName);
        $userNameM = explode("@", $email)[0];
        $username = $response->getUsername();
        $user = $this->userManager->findUserBy(array($this->getProperty($response) => $username));
        //when the user is registrating
        if (null === $user) {
            $service = $response->getResourceOwner()->getName();
            $setter = 'set' . ucfirst($service);
            $setter_id = $setter . 'Id';
            $setter_token = $setter . 'AccessToken';
            // create new user here
            $user = $this->userManager->createUser();
            $user->$setter_id($username);
            $user->$setter_token($response->getAccessToken());
            //I have set all requested data with the user's username
            //modify here with relevant data
            if ($service === "facebook") {
                $user->setUsername($userNameM);
                $user->setUsernameCanonical($userNameM);
                $user->setEmail($email);
                $user->setEmailCanonical($email);
                $user->setPassword($username);
                $user->setEnabled(true);
                $user->setRoles(array('ROLE_USER'));
                $user->setAvatar($avatar);
                $user->setFirstName($firstName);
                $user->setLastName($lastName);
                $user->setFacebookName($realName);
                $user->setFacebookUID($username);
                $user->setTwitterUID($username);
                $this->userManager->updateUser($user);
            } else if ($service === "twitter") {
                $user->setUsername($userNameM);
                $user->setUsernameCanonical($userNameM);
                $user->setEmail($email);
                $user->setEmailCanonical($email);
                $user->setPassword($username);
                $user->setEnabled(true);
                $user->setRoles(array('ROLE_USER'));
                $user->setAvatar($avatar);
                $user->setFirstName($firstName);
                $user->setLastName($lastName);
                $user->setTwitterName($realName);
                $user->setTwitterUID($username);
                $this->userManager->updateUser($user);
                return $user;
            } else if ($service === 'google') {
                $user->setUsername($userNameM);
                $user->setUsernameCanonical($userNameM);
                $user->setEmail($email);
                $user->setEmailCanonical($email);
                $user->setPassword($username);
                $user->setEnabled(true);
                $user->setRoles(array('ROLE_USER'));
                $user->setAvatar($avatar);
                $user->setFirstName($firstName);
                $user->setLastName($lastName);
                $user->setGPlusName($realName);
                $user->setGPlusUID($username);
                $this->userManager->updateUser($user);
                return $user;
            } else {
                $user->setUsername($userNameM);
                $user->setUsernameCanonical($userNameM);
                $user->setEmail($email);
                $user->setEmailCanonical($email);
                $user->setPassword($username);
                $user->setEnabled(true);
                $user->setRoles(array('ROLE_USER'));
                $user->setAvatar($avatar);
                $user->setFirstName($firstName);
                $user->setLastName($lastName);
                $this->userManager->updateUser($user);
                return $user;
            }
        }
        //if user exists - go with the HWIOAuth way
        $user = parent::loadUserByOAuthUserResponse($response);
        $serviceName = $response->getResourceOwner()->getName();
        $setter = 'set' . ucfirst($serviceName) . 'AccessToken';
        //update access token
        $user->$setter($response->getAccessToken());
        return $user;
    }

    public function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

}
