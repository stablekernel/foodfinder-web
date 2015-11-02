<div id="content">
    <div class="container">
        <div class="row">
            <div class="tabbable" style="min-height:550px;">
                <div class="span3">
                    <?php $this->load->view('admin/sidebar/myaccountsidebar'); ?>
                </div>
                <!-- /.span3 -->
                <div class="span9">
                    <h2>Change Password</h2>

                    <form id="trainer-form" method="post" class="form-horizontal" novalidate="novalidate">
                        <fieldset>
                            <div class="control-group">
                                <label class="control-label" for="name">Old Password
                                    <Mandatory>*</Mandatory>
                                </label>

                                <div class="controls">
                                    <input type="password" class="input-large" name="o_password" maxlength="100"
                                           id="o_password">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="department">New Password
                                    <Mandatory>*</Mandatory>
                                </label>

                                <div class="controls">
                                    <input type="password" class="input-large" maxlength="100" name="n_password"
                                           id="n_password">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="name">Confirm Password
                                    <Mandatory>*</Mandatory>
                                </label>

                                <div class="controls">
                                    <input type="password" class="input-large" name="c_password" maxlength="100"
                                           id="c_password">
                                </div>
                            </div>
                            <div class="form-actions">
                                <button type="submit" name="submit" class="btn btn-primary btn-large">Change Password
                                </button>
                            </div>
                        </fieldset>
                    </form>
                </div>
                <!-- /.span9 -->
            </div>
            <!-- /.tabbable -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
</div>