<?php

function nav($user = '', $pic = '')
{
    if ($_SESSION['login']) {
        if ($user == 'admin') {
            echo <<<nav
                <nav >
                <img src="./img/x.png" alt="close" class="close">
                <div class="avatar-wrapper">
                <img src="./user_pic/$pic" alt="admin" class="avatar">
                <span class="say">Welcoe Back !!</span>
                <span class="username">$user</span>
                </div>
        
                <ul>
                <li><a href="dashboard.php">dashboard</a></li>
                <li><a href="logout.php">Logout</a> </li>
                </ul>
            </nav>
            nav;
        } else {
            echo <<<nav
                <nav>
                <img src="./img/x.png" alt="close" class="close">
                <div class="avatar-wrapper">
                <img src="./user_pic/$pic" alt="" class="avatar">
                <span class="say">Welcome Back !!</span>
                <span class="username">$user</span>
                </div>
        
                <ul>
                <li><a href="home.php">Home</a> </li>
                <li><a href="profile.php">Profile</a> </li>
                <li><a href="logout.php">Logout</a> </li>
                
                </ul>
            </nav>
            nav;
        }
        return;
    } else {
        echo <<<nav
            <nav>
            <img src="./img/x.png" alt="close" class="close">
            <div class="avatar-wrapper">
            <span class="say">Kamu Belum login</span>
            
            </ul>
        </nav>
        nav;
    }
}
