<?php

error_reporting(E_ALL);

/**
 * For now, we will only manage adding One Key to authorized Key file
 *
 * @author firstname and lastname of author, <author@example.org>
 */

if (0 > version_compare(PHP_VERSION, '5')) {
    die('This file was generated for PHP 5');
}

/**
 * include
 *
 * @author firstname and lastname of author, <author@example.org>
 */
require_once('class..php');

/**
 * include UserProfile
 *
 * @author firstname and lastname of author, <author@example.org>
 */
require_once('class.UserProfile.php');

/* user defined includes */
// section -64--88-103-15-16126094:1473939329b:-8000:0000000000000AB1-includes begin
// section -64--88-103-15-16126094:1473939329b:-8000:0000000000000AB1-includes end

/* user defined constants */
// section -64--88-103-15-16126094:1473939329b:-8000:0000000000000AB1-constants begin
// section -64--88-103-15-16126094:1473939329b:-8000:0000000000000AB1-constants end

/**
 * For now, we will only manage adding One Key to authorized Key file
 *
 * @access public
 * @author firstname and lastname of author, <author@example.org>
 */
class SSHProfile
    extends 
{
    // --- ASSOCIATIONS ---
    // generateAssociationEnd : 

    // --- ATTRIBUTES ---

    /**
     * Short description of attribute strProfileDir
     *
     * @access private
     * @var String
     */
    private $strProfileDir = null;

    /**
     * Short description of attribute strAuthKeyFile
     *
     * @access private
     * @var String
     */
    private $strAuthKeyFile = null;

    // --- OPERATIONS ---

    /**
     * Short description of method SSHProfile
     *
     * @access public
     * @author firstname and lastname of author, <author@example.org>
     * @return mixed
     */
    public function SSHProfile()
    {
        // section -64--88-103-15-16126094:1473939329b:-8000:0000000000000AC1 begin
        // section -64--88-103-15-16126094:1473939329b:-8000:0000000000000AC1 end
    }

    /**
     * Short description of method SSHProfile
     *
     * @access public
     * @author firstname and lastname of author, <author@example.org>
     * @param  String strProfileDir
     * @param  String strAuthKeyFile
     * @return mixed
     */
    public function SSHProfile( String $strProfileDir,  String $strAuthKeyFile)
    {
        // section -64--88-103-15-16126094:1473939329b:-8000:0000000000000AC3 begin
        // section -64--88-103-15-16126094:1473939329b:-8000:0000000000000AC3 end
    }

    /**
     * Short description of method AddAuthKey
     *
     * @access public
     * @author firstname and lastname of author, <author@example.org>
     * @param  SSHAuthKey authkey
     * @return mixed
     */
    public function AddAuthKey( SSHAuthKey $authkey)
    {
        // section -64--88-103-15-16126094:1473939329b:-8000:0000000000000AC7 begin
        // section -64--88-103-15-16126094:1473939329b:-8000:0000000000000AC7 end
    }

} /* end of class SSHProfile */

?>