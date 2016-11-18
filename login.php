<?php
/*
 *  *********************************************************************************************************
 * Description:
 *      performs the logging-in authorization. First creates a random session_id to be assigned to this session and then
 *      validates the operators credentials in the database
 *
 * Authors: Liran Tal <liran@enginx.com>
 *
 *********************************************************************************************************
 */
echo $_POST;

 
// first we create a random session key
$REMOTE_ADDR = $_SERVER['REMOTE_ADDR'];                         // get client ip address
srand((double)microtime()*1000000 );                            // initialize random seed
$rand = rand(1,9);                                              // generate a random number between 1 to 9
$session_id = $rand.substr(md5($REMOTE_ADDR), 0, 11+$rand);     /* append the random number to the beginning
of the session_id string followed by a substring of the md5 ip address hash with a dynamic length of anything between 11 to 16 digits (the max length of
the md5 hash) */
$session_id .= substr(md5(rand(1,1000000)), rand(1,32-$rand), 21-$rand);    // further add a dynamic length digits to 
                                                                        // to the session_id string composed of the
                                                                        // md5 hash for random number
session_id($session_id);                            // apply the session_id that we created
session_start();                                    // initiate the session



$errorMessage = '';
include 'library/opendb.php';

$login_user = $_POST['email'];
$login_pass = $_POST['password'];


// check if the user id and password combination exist in database
$sql = "SELECT ".$configValues['CONFIG_DB_TBL_DALOUSERINFO'].".UserName FROM ".$configValues['CONFIG_DB_TBL_DALOUSERINFO'].
        " WHERE UserName = '".
        $dbSocket->escapeSimple($login_user)."' AND ".$configValues['CONFIG_DB_TBL_DALOUSERINFO'].".portalloginpassword = '".
        $dbSocket->escapeSimple($login_pass)."'"." AND ".$configValues['CONFIG_DB_TBL_DALOUSERINFO'].".enableportallogin = 1";
$res = $dbSocket->query($sql);


/*
if (PEAR::isError($res)) {
    die($res->getMessage() . ', ' . $res->getDebugInfo());
}
*/

if ($res->numRows() == 1) {
    // the user id and password match,
    // set the session

    $_SESSION['logged_in'] = true;
    $_SESSION['login_user'] = $login_user;

    // after login we move to the main page
    // header('Location: index.php');
    echo 1;
    exit;
} else {
    //header('Location: login.php?error=an error occured');
    echo 0;
    exit;
}

include 'library/closedb.php';

?>
