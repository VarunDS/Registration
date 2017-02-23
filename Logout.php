<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 23/02/17
 * Time: 7:37 PM
 */

if(session_status()==1) {
    session_destroy ();
    header('Location: index.html', true);
}