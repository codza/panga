<?php
//function to build de url
function perm_exits($PermissionsArray, $permToSearch){
    foreach ($PermissionsArray as $perm)
    {
        if (strcmp( strtolower(trim($perm['perm_key'])), strtolower (trim($permToSearch)))==0) {
            return true;
        }
    }
    return false;

}