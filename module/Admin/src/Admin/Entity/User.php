<?php

namespace Admin\Entity;

use \ZfcUser\Entity\User as ZfcUser;

class User extends ZfcUser
{
    /**
     * @var string
     */
    protected $aclrole;

    /**
     * Get aclrrole.
     *
     * @return int
     */
    public function getAclrole()
    {
        return $this->aclrole;
    }

    /**
     * Set state.
     *
     * @param int $aclrole
     * @return UserInterface
     */
    public function setAclrole($aclrole)
    {
        $this->aclrole = $aclrole;
        return $this;
    }
}
