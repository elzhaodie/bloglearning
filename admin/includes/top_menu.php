<?php

?>


<ul class="nav navbar-right top-nav">
                <li>
                <a href="../index.php"><i class="fa fa-home"></i></a>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"><?php echo "&nbsp"?></i><?php 
                     if(empty($_SESSION['username'])){
                        echo "";
                     } else {
                        echo $_SESSION['username'];
                     }
                    ?><b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="#"><i class="fa fa-fw fa-user"></i> Profile</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>