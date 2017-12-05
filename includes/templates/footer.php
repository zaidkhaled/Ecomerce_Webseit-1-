    <!-- footer -->
    <footer class="page-footer">
      <div class="container">
        <div class="row">
          <div class="col l6 s12">

          </div>
          <div class="col l4 offset-l2 s12">
            <h5 class="white-text"><?php echo lang("CHANGE_LANG");?></h5>
            <form action = "<?php $_SERVER['PHP_SELF'];?>" id="lang-form" method="POST">
              <!--start lang selector-->
              <?php 
                
                //chack which lang has been selected
                
                if(isset($_COOKIE['lang'])){
                    
                    if($_COOKIE['lang'] == "Eng"){
                        
                        $Eng_selected = "selected = 'true'";
                        
                    } else {
                        
                        $Ger_selected = "selected = 'true'";
                        
                    }
                }
                
                ?>
              <select id="select-lang" class="select browser-default" name="lang">
                <option value="Eng" <?php if(isset($Eng_selected)){echo $Eng_selected; } ?> >Engilsh</option> 
                <option value="Ger" <?php if(isset($Ger_selected)){echo $Ger_selected; } ?> >Deutsch</option> 
              </select>
            </form>
          </div>
        </div>
      </div>
      <div class="footer-copyright">
        <div class="container">
        © 2018 Copyright Text
        <a class="grey-text text-lighten-4 right">More </a>
        </div>
      </div>
    </footer>
    <script src="<?php echo $js;?>jquery-1.12.1.min.js"></script>
    <script src="<?php echo $js;?>materialize.min.js"></script>
    <script src="<?php echo $js;?>frontend.js"></script>
  </body>
</html>