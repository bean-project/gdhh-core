<?php
namespace App\Service\User;

use App\Entity\User\User;
use App\Service\BaseService;

use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;

class UserService extends BaseService
{

    public function logUserOut()
    {
        $this->container->get('security.token_storage')->setToken(null);
        $this->container->get('request_stack')->getCurrentRequest()->getSession()->invalidate();
    }

    /**
     * @param User $user
     */
    public function logUserIn(User $user, $firewall = 'main')
    {
        if ($this->isLoggedIn()) {
            return;
        }
        $token = new UsernamePasswordToken($user, null, $firewall, $user->getRoles());
        $this->container->get("security.token_storage")->setToken($token); //now the user is logged in

        //now dispatch the login event
        $request = $this->container->get("request_stack")->getCurrentRequest();
        $event = new InteractiveLoginEvent($request, $token);
        $this->container->get("event_dispatcher")->dispatch("security.interactive_login", $event);
    }

    public function isLoggedIn()
    {
        // authenticated REMEMBERED, FULLY will imply REMEMBERED (NON anonymous)
        if (empty($this->getUser(false))) {
            return false;
        }
        return $this->container->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_REMEMBERED');
    }

    /**
     * @param bool $throwException
     * @param string $msg
     * @return User
     */
    public function getUser($throwException = true, $msg = 'This user does not have access to this section.')
    {
        if (!$this->container->has('security.token_storage')) {
            throw new \LogicException('The SecurityBundle is not registered in your application.');
        }

        /** @var TokenInterface $token */
        if (null === $token = $this->container->get('security.token_storage')->getToken()) {
            if ($throwException) {
                throw new AccessDeniedException($msg);
            }
            return null;
        }

        if (!is_object($user = $token->getUser())) {
            // e.g. anonymous authentication
            if ($throwException) {
                throw new AccessDeniedException($msg);
            }
            return null;
        }

        if (!($user instanceof UserInterface)) {
            if ($throwException) {
                throw new AccessDeniedException($msg);
            }
            return null;
        }

        return $user;
    }
}