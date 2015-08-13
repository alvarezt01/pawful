        <header>
        
            <div class="row">
                
                <div class="column7" id="header-nav">
                
                    <a href="url_of_website"><img src="images/logo.png"
                        <?php
                            if (isset($align_logo)) {
                        ?>
                            class="al"
                        <?php
                            }
                        ?>
                    ></a>
                    
                </div>
                
                <div class="column5">
                
                    <ul>
                        
                        <?php
                            
                            $_SESSION['client_id'] = '1';
                            if (!isset($_SESSION['client_id'])) {

                        ?>
                    
                        <li><a href="/login">Login Here</a></li>
                        
                        <?php
                            } else { 
                        ?>
                        
                            <li class="important_link"><a href="/login">Edit My Dog</a></li>
                            <li><a href="/login">My Account</a></li>
                            <li><a href="/login">Logout</a></li>
                        
                        <?php
                            }
                        ?>
                        
                        
                    </ul>
                    
                </div>
                    
            </div>
            
        </header>