<?
$CurrentSecc = $this->uri->segment(1, 0);
if($CurrentSecc===0){
	$CurrentSecc = "front";
}
$user = $this->ion_auth->user()->row();
?>
<!-- navbar -->
<div class="navbar navbar-inverse">
    <div class="navbar-inner">
        <button type="button" class="btn btn-navbar visible-phone" id="menu-toggler">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>

        <h1><a class="brand" href="<? echo base_url(); ?>">The Magnes</a></h1>
        <ul class="nav pull-right">

            <li class="hidden-phone">
                <input class="search" type="text" id="search_input" name="search_input" />
            </li>

            <li class="dropdown">

                <? if (!$this->ion_auth->logged_in())
                {
                    ?>
                    <a href="#" class="dropdown-toggle hidden-phone" data-toggle="dropdown" style="font-size:18px;">
                        Your account
                        <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="<? echo base_url('auth/login'); ?>">Login</a></li>
                        <li><a href="<? echo base_url('auth/register'); ?>">Sign in</a></li>
                    </ul>
                    <? 
                }
                else{
                    ?>
                    <a href="#" class="dropdown-toggle hidden-phone" data-toggle="dropdown" style="font-size:18px;">
                        <i class="icon-user" style="margin-right:10px;"></i>
                        <? echo  $user->username; ?>
                        <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="<? echo base_url('user'); ?>">Edit your account</a></li>
                        <li><a target="_blank" href="<? echo base_url('users/v/'.$user->username); ?>" >Your public profile</a></li>
                        <li class="divider"></li>
                        <li><a href="<? echo base_url('/auth/logout'); ?>">Logout</a></li>
                    </ul>

                    <?
                }
                ?>
            </li>

        </ul>            
    </div>
</div>
<!-- end navbar -->

<!-- sidebar -->
<div id="sidebar-nav">
    <ul id="dashboard-menu">
        <li <?if ($CurrentSecc=="front") echo "class='active'"; ?> >

           <?if ($CurrentSecc=="front"){ ?>
           <div class="pointer">
            <div class="arrow"></div>
            <div class="arrow_border"></div>
        </div>
        <? } ?>
        <a href="<? echo base_url(); ?>">
            <i class="icon-home"></i>
            <span>Home</span>
        </a>
    </li>            
    <li <?if ($CurrentSecc=="send") echo "class='active'"; ?> >

        <?if ($CurrentSecc=="send"){ ?>
        <div class="pointer">
            <div class="arrow"></div>
            <div class="arrow_border"></div>
        </div>
        <? } ?>
        <a href="<? echo base_url('/send/'); ?>">
            <i class="icon-edit"></i>
            <span>Send Release</span>
        </a>
    </li>
    <?if ($CurrentSecc=="release"){ ?>

    <li class='active' >
        <div class="pointer">
            <div class="arrow"></div>
            <div class="arrow_border"></div>
        </div>

        <a href="">
            <i class="icon-download"></i>
            <span>View Release</span>
        </a>
    </li>

    <? } ?>

    <li <?if ($CurrentSecc=="artist") echo "class='active'"; ?> >

        <?if ($CurrentSecc=="artist"){ ?>

        <div class="pointer">
            <div class="arrow"></div>
            <div class="arrow_border"></div>
        </div>
        <? } ?>

        <a href="<? echo base_url('/artist'); ?>">
            <i class="icon-music"></i>
            <span>Artists</span>
        </a>
    </li>
    <li <?if ($CurrentSecc=="label") echo "class='active'"; ?> >

        <?if ($CurrentSecc=="label"){ ?>

        <div class="pointer">
            <div class="arrow"></div>
            <div class="arrow_border"></div>
        </div>
        <? } ?>

        <a href="<? echo base_url('/label'); ?>">
            <i class="icon-archive"></i>
            <span>Labels</span>
        </a>
    </li>

    <?if ($CurrentSecc=="search"){ ?>
    <li class='active' >
        <div class="pointer">
            <div class="arrow"></div>
            <div class="arrow_border"></div>
        </div>
        <a href="">
            <i class="icon-search"></i>
            <span>Search</span>
        </a>
    </li>
    <? } ?>

    <? if (!$this->ion_auth->logged_in())
    {
        ?>
        <li <?if ($CurrentSecc=="auth") echo "class='active'"; ?> >
            <?if ($CurrentSecc=="auth"){ ?>
            <div class="pointer">
                <div class="arrow"></div>
                <div class="arrow_border"></div>
            </div>
            <? } ?>

            <a class="dropdown-toggle" href="#">
                <i class="icon-user"></i>
                <span>Account</span>
                <i class="icon-chevron-down"></i>
            </a>
            <ul class="submenu" id="account_submenu">
                <li><a href="<? echo base_url('/auth/register'); ?>">Sign in</a></li>
                <li><a href="<? echo base_url('/auth/login'); ?>">Login</a></li>
            </ul>
        </li>
        <? 
    }else{ ?>

    <li <?if ($CurrentSecc=="user") echo "class='active'"; ?> >
        <?if ($CurrentSecc=="user"){ ?>
        <div class="pointer">
            <div class="arrow"></div>
            <div class="arrow_border"></div>
        </div>
        <? } ?>
        <a href="<? echo base_url('/user/'); ?>">
            <i class="icon-user"></i>
            <span>Your account</span>
        </a>
    </li>
    <?
}
?>
<? if($this->ion_auth->is_admin()){
?>
<li <?if ($CurrentSecc=="users") echo "class='active'"; ?> >
        <?if ($CurrentSecc=="users"){ ?>
        <div class="pointer">
            <div class="arrow"></div>
            <div class="arrow_border"></div>
        </div>
        <? } ?>
        <a href="<? echo base_url('/users/listAll'); ?>">
            <i class="icon-group"></i>
            <span>Users list</span>
        </a>
    </li>
<?
}
?>


<li>
    <ul class="submenu" id="about_menu" style="display: block; margin-top: 20px;">
       <li>
            <a href="<?= base_url('rss/feed'); ?>"><i class="icon-rss"></i>RSS</a>
        </li>
        <li>
            <a href="http://facebook.com/TheMagnes" target="_blank"> <i class="icon-facebook"></i>Facebook</a>
        </li>
        <li>
            <a href="http://twitter.com/TheMagnesCom" target="_blank"> <i class="icon-twitter"></i>Twitter</a>
        </li>
        <li>    
            <a href="https://plus.google.com/106460761172483340167?rel=author"><i class="icon-google-plus"></i>Google</a>
        </li>
        <li>
            <a href="mailto:info@themagnes.com"><i class="icon-file-text"></i>Contact Us</a>
        </li>
    </ul>
</li>
</ul>

</div>
<!-- end sidebar -->

