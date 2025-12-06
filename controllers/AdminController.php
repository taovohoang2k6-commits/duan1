<?php

class AdminController
{
    public function sidebar()
    {
        $title = "Sidebar Admin";
        require_once PATH_VIEW . 'admin/sidebar.php';
    }
}