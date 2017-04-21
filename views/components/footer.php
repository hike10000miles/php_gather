<footer>
    <div class="row">
        <div class="col-xs-4 col-xs-offset-1">
            <p id="copyright">© Copyright Gather, 2017. All rights reserved.</p>
        </div>
        <div class="col-xs-7">
            <nav id="footer-navigation">
                <ul class="menu">
                    <div class="col-sm-4">
                        <li><a href="#">Pre-Planning</a>
                            <ul>
                                <li><a href="#">Most Popular</a></li>
                                <li><a href="<?php echo __httpRoot . "Business/suggestion.php" ?>">Suggestions</a></li>
                                <li><a href="<?php echo __httpRoot . "Blog/blog.php" ?>">Blog</a></li>
                            </ul>
                        </li>
                    </div>
                    <div class="col-sm-4">
                        <li><a href="#">Planning</a>
                            <ul>
                                <li><a href="#">Want-To-Do List</a></li>
                                <li><a href="#">Car-Pooling</a></li>
                                <li><a href="#">Split The Bill</a></li>
                            </ul>
                        </li>
                    </div>
                    <div class="col-sm-4">
                        <?php if($_SESSION['LoggedIn']['UserRole'] == 'business'): ?>
                        <li><a href="#">Business Tools</a>
                            <ul>
                                <li><a href="#">Offer Discounts</a></li>
                                <li><a href="<?php echo __httpRoot . "Blog/blogAdmin.php" ?>">Blog Admin</a></li>
                                <li><a href="#">Manage Payments</a></li>
                            </ul>
                        </li>
                        <?php endif; ?>
                    </div>
                </ul>
            </nav>
        </div>
    </div>
</footer>