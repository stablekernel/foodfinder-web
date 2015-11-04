<div id="content">
    <div class="container">
        <div class="row">
            <div class="tabbable">
                <div class="span3">
                    <?php $this->load->view('admin/sidebar/schoolsidebar'); ?>
                </div>
                <!-- /.span3 -->
                <div class="span9">
                    <h2>Edit School</h2>

                    <form action="" id="product-form" method="post" class="form-horizontal" novalidate="novalidate">
                        <fieldset>
                            <div class="control-group">
                                <label class="control-label" for="product_name">School Name
                                    <Mandatory>*</Mandatory>
                                </label>

                                <div class="controls">
                                    <input type="text" class="input-large" name="schoolname" maxlength="100"
                                           id="schoolname" value="<?php echo $results[0]->school_name; ?>"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="supplier_name">School Address1
                                    <Mandatory>*</Mandatory>
                                </label>

                                <div class="controls">
                                    <input type="text" class="input-large" name="schooladdress1" id="schooladdress1"
                                           maxlength="100" value="<?php echo $results[0]->school_address1; ?>"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="name">School Address2</label>

                                <div class="controls">
                                    <input type="text" class="input-large" name="schooladdress2" id="schooladdress2"
                                           maxlength="100" value="<?php echo $results[0]->school_address2; ?>"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="name">State
                                    <Mandatory>*</Mandatory>
                                </label>

                                <div class="controls"><?php $state = $results[0]->state; ?>
                                    <select id="state" name="state" onchange="getcitylist(this.value)" onload="getcitylist(this.value)">
                                        <option value="">Select state</option>
                                        <?php foreach ($allstatelist as $fields) { ?>
                                            <option
                                                value="<?php echo $statecode = $fields["state_code"]; ?>"<?php if ($state == $statecode) { ?> selected="selected"<?php } ?>><?php echo $fields["state"]; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="group">City
                                    <Mandatory>*</Mandatory>
                                </label>

                                <div class="controls" id="citynamediv">
                                    <?php $city = $results[0]->city;
                                        echo $allcitylist;
                                    ?>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="name">County</label>

                                <div class="controls">
                                    <input type="text" class="input-large" name="county" id="county" maxlength="100"
                                           value="<?php echo $results[0]->county; ?>"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="store">Zipcode
                                    <Mandatory>*</Mandatory>
                                </label>

                                <div class="controls">
                                    <input type="text" class="input-large" name="zipcode" id="zipcode" maxlength="100"
                                           value="<?php echo $results[0]->zipcode; ?>"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="store">Phone Number</label>

                                <div class="controls">
                                    <input type="text" class="input-large" name="phonenumber" id="phonenumber"
                                           maxlength="100" value="<?php echo $results[0]->phonenumber; ?>"/>
                                </div>
                            </div>
                            <div class="form-actions">
                                <button type="submit" name="updateschool" id="updateschool"
                                        class="btn btn-primary btn-large">Save
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
<script>
    function getXMLHTTP() {
        var xmlhttp = false;
        try {
            xmlhttp = new XMLHttpRequest();
        }
        catch (e) {
            try {
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            catch (e) {
                try {
                    xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
                }
                catch (e1) {
                    xmlhttp = false;
                }
            }
        }
        return xmlhttp;
    }
    function getcitylist(x) {
        var statecode = x;
        var strURL = "<?php echo site_url();?>/admin/getcitilist/" + statecode;
        var req = getXMLHTTP();
        if (req) {
            req.onreadystatechange = function () {
                if (req.readyState == 4) {
                    if (req.status == 200) {
                        document.getElementById('citynamediv').innerHTML = req.responseText;
                    } else {
                        alert("There was a problem while using XMLHTTP:\n" + req.statusText);
                    }
                }
            }
            req.open("GET", strURL, true);
            req.send(null);
        }
    }
</script>