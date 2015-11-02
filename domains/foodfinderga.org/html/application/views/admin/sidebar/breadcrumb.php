<div id="masthead">
    <div class="container">
        <div class="masthead-pad">
            <div class="masthead-text">
                <?php
                if ($pageName == "dashboard") {
                    echo "<h2>Dashboard</h2><p><i>Dashboard details</i></p>";
                }
                if ($pageName == "addschool" or $pageName == "manageschool") {
                    echo "<h2>School</h2><p><i>Add and manage information about school details</i></p>";
                }
                if ($pageName == "addprovider" or $pageName == "manageprovider") {
                    echo "<h2>Provider</h2><p><i>Add and manage information about provider details</i></p>";
                }
                if ($pageName == "changepassword") {
                    echo "<h2>Change Password</h2><p><i>Admin change password details</i></p>";
                }
                ?>
            </div>
            <!-- /.masthead-text -->
        </div>
    </div>
    <!-- /.container -->
</div> <!-- /#masthead -->