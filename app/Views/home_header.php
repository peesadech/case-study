    <div class="menu" style="margin-bottom:10px">
        <ul>
            <li class="logo">
                <a href="" target="_blank">
                  <span style="color:darkgreen;">  <?php echo APP_PROJECT_NAME; ?> </span>
                  <?php  
                        if (!empty($authData['user_name'])){
                            echo 'Hi ,' .$authData['user_name'];
                        ?>
                        
                      <?php } ?>  
                </a>
            </li>
            <li class="menu-toggle">
                <button onclick="toggleMenu();">&#9776;</button>
            </li>
            <?php  
             if (!empty($authData['user_logged_in'])){
            ?>
             <li class="menu-item hidden"><a href="/logout">Logout</a></li>
            <?php
             }else {
             ?>
            <li class="menu-item hidden"><a href="/login">Login</a></li>
            <li class="menu-item hidden"><a href="/register">Register</a></li>
            <!-- <li class="menu-item hidden"><a href="/admin">Admin</a></li> -->
            <?php } ?>
<!--            
            <li class="menu-item hidden"><a href="https://forum.codeigniter.com/" target="_blank">Community</a></li>
            <li class="menu-item hidden"><a
                    href="https://github.com/codeigniter4/CodeIgniter4/blob/develop/CONTRIBUTING.md" target="_blank">Contribute</a>
            </li> -->
        </ul>
    </div>


