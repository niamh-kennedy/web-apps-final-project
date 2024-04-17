<?php

/* reused code from sessions_lab */
class functions
{
    function clean ($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}