<?php
if($logged_in){
    $username = $this->session->userdata('username');
    echo"<h1>Welcome, To Home Page, {$username}</h1>";
}else{
    echo "<h3>Visitor Home Page</h3>";
}

