<?php

error_reporting(E_ALL);

/**
 * VPN-SSH-GW - class.UserProfile.php
 *
 * $Id$
 *
 * This file is part of VPN-SSH-GW.
 *
 * Automatically generated on 15.07.2014, 10:49:28 with ArgoUML PHP module 
 * (last revised $Date: 2010-01-12 20:14:42 +0100 (Tue, 12 Jan 2010) $)
 *
 * @author firstname and lastname of author, <author@example.org>
 */

if (0 > version_compare(PHP_VERSION, '5')) {
    die('This file was generated for PHP 5');
}

/**
 * For now, we will only manage adding One Key to authorized Key file
 *
 * @author firstname and lastname of author, <author@example.org>
 */
require_once('class.SSHProfile.php');

/* user defined includes */
// section -64--88-103-15-16126094:1473939329b:-8000:0000000000000A9C-includes begin
// section -64--88-103-15-16126094:1473939329b:-8000:0000000000000A9C-includes end

/* user defined constants */
// section -64--88-103-15-16126094:1473939329b:-8000:0000000000000A9C-constants begin
// section -64--88-103-15-16126094:1473939329b:-8000:0000000000000A9C-constants end

/**
 * Short description of class UserProfile
 *
 * @access public
 * @author firstname and lastname of author, <author@example.org>
 */
class UserProfile
{
    // --- ASSOCIATIONS ---
    // generateAssociationEnd : 

    // --- ATTRIBUTES ---

    /**
     * Short description of attribute strUsername
     *
     * @access private
     * @var String
     */
    private $strUsername = null;

    /**
     * Short description of attribute strProfilePath
     *
     * @access private
     * @var String
     */
    private $strProfilePath = null;

    /**
     * Short description of attribute sshProfile
     *
     * @access private
     * @var SSHProfile
     */
    private $sshProfile = null;

    // --- OPERATIONS ---

    /**
     * Short description of method UserProfile
     *
     * @access public
     * @author firstname and lastname of author, <author@example.org>
     * @param  String strUsername
     * @return mixed
     */
    public function UserProfile( String $strUsername)
    {
        // section -64--88-103-15-16126094:1473939329b:-8000:0000000000000AA6 begin
        // section -64--88-103-15-16126094:1473939329b:-8000:0000000000000AA6 end
    }

    /**
     * Short description of method GetProfilePath
     *
     * @access public
     * @author firstname and lastname of author, <author@example.org>
     * @return String
     */
    public function GetProfilePath()
    {
        $returnValue = null;

        // section -64--88-103-15-16126094:1473939329b:-8000:0000000000000AA9 begin
        // section -64--88-103-15-16126094:1473939329b:-8000:0000000000000AA9 end

        return $returnValue;
    }

    /**
     * Short description of method AddAuthKey
     *
     * @access public
     * @author firstname and lastname of author, <author@example.org>
     * @param  SSHAuthKey authKey
     * @return mixed
     */
    public function AddAuthKey( SSHAuthKey $authKey)
    {
        // section -64--88-103-15-16126094:1473939329b:-8000:0000000000000AB2 begin
        // section -64--88-103-15-16126094:1473939329b:-8000:0000000000000AB2 end
    }

} /* end of class UserProfile */

?>