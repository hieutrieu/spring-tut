<?php
/**
 * Hieutrieu
 */
namespace App\Libraries\Acl;

use Framework\ACL\Acl as BaseAcl;

/**
 * App/Libraries\Acl
 */
class Acl
{
    private static $instance = null;
    /**
     * The ACL Object
     */
    private $acl;
    private $privateRoles = [
        'admin' => ['groups', 'users'],
        'group' => ['groups', 'users'],
        'user' => ['users'],
    ];

    /**
     * Define the resources that are considered "private". These controller => actions require authentication.
     *
     * @var array
     */
    private $privateResources = [
        'groups' => ['*'],
        'users' => ['*'],
    ];

    public function __construct()
    {
        $this->acl = $this->rebuild();
    }

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new Acl();
        }
        return self::$instance;
    }

    /**
     * Checks if a controller is private or not
     *
     * @param string $controllerName
     * @return boolean
     */
    public function isPrivate($controllerName)
    {
        return isset($this->privateResources[$controllerName]);
    }

    /**
     * Checks if the current profile is allowed to access a resource
     *
     * @param string $profile
     * @param string $controller
     * @param string $action
     * @return boolean
     */
    public function isAllowed($roleId, $controllerName, $actionName)
    {
        return $this->getAcl()->isAllowed($roleId, $controllerName, $actionName);
    }

    /**
     * Returns the ACL list
     *
     * @return object ACL
     */
    public function getAcl()
    {
        if (is_object($this->acl)) {
            return $this->acl;
        }
        return $this->acl;
    }

    /**
     * Returns all the resoruces and their actions available in the application
     *
     * @return array
     */
    public function getResources()
    {
        return $this->privateResources;
    }

    /**
     * Rebuilds the access list into a file
     *
     * @return ACL
     */
    public function rebuild()
    {
        $acl = new BaseAcl();
        $acl->setDefaultAction(BaseAcl::ACCESS_ALLOW);
        foreach ($this->privateRoles as $role => $resources) {
            $acl->addRole($role);
            foreach ($resources as $resource) {
                if (in_array($resource, array_keys($this->privateResources))) {
                    // provider full access for
                    //$acl = $this->fullAccess($acl);
                    $acl->addResource($resource, $this->privateResources[$resource]);
                }
            }
        }
        return $acl;
    }

    public function fullAccess($acl)
    {
        $acl->setDefaultAction(BaseAcl::ACCESS_ALLOW);
        foreach ($this->getResources() as $resource => $actions) {
            $acl->addResource($resource, $actions);
        }
        return $acl;
    }
}
