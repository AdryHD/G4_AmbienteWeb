<?php

function OpenDatabase()
{
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    return mysqli_connect("127.0.0.1:3307","root","root","power_zone");
}

function CloseDatabase($context)
{
    mysqli_close($context);
}




