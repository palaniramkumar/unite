<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
header("Content-type","application/vnd.ms-excel");
header("Content-Disposition: attachment;filename=\"download.xls\"");
header("Cache-Control: max-age=0");

    
   /*     header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
        header("Content-Disposition: attachment;filename=\"download.csv\"");
        header("Cache-Control: max-age=0");    
*/
echo "<table>";
echo $_REQUEST["data"];
echo "</table>";
?>
