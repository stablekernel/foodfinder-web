<div id="content">
    <div class="container">
        <div class="row">
            <div class="tabbable">
                <div class="span3">
                    <?php $this->load->view('admin/sidebar/providersidebar'); ?>
                </div>
                <!-- /.span3 -->
                <div class="span9">
                    <h2>Add Provider</h2>

                    <form action="" id="product-form" method="post" class="form-horizontal" novalidate="novalidate">
                        <fieldset>
                            <div class="control-group">
                                <label class="control-label" for="product_name">Provider Name
                                    <Mandatory>*</Mandatory>
                                </label>

                                <div class="controls">
                                    <input type="text" class="input-large" name="providername" maxlength="100"
                                           id="providername">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="supplier_name">Provider Address1
                                    <Mandatory>*</Mandatory>
                                </label>

                                <div class="controls">
                                    <input type="text" class="input-large" name="streetaddress1" id="streetaddress1"
                                           maxlength="100">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="name">Provider Address2</label>

                                <div class="controls">
                                    <input type="text" class="input-large" name="streetaddress2" id="streetaddress2"
                                           maxlength="100">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="name">State
                                    <Mandatory>*</Mandatory>
                                </label>

                                <div class="controls">
                                    <select id="state" name="state" onchange="getcitylist(this.value)">
                                        <option value="">Select state</option>
                                        <?php foreach ($allstatelist as $fields) { ?>
                                            <option
                                                value="<?php echo $fields["state_code"]; ?>"><?php echo $fields["state"]; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="group">City
                                    <Mandatory>*</Mandatory>
                                </label>

                                <div class="controls" id="citynamediv">
                                    <select id="city" name="city">
                                        <option value="">Select city</option>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="name">County</label>

                                <div class="controls">
                                    <input type="text" class="input-large" name="county" id="county" maxlength="100"
                                           value=""/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="store">Zipcode
                                    <Mandatory>*</Mandatory>
                                </label>

                                <div class="controls">
                                    <input type="text" class="input-large" name="zipcode" id="zipcode" maxlength="100">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="store">Email
                                    <Mandatory></Mandatory>
                                </label>

                                <div class="controls">
                                    <input type="text" class="input-large" name="pemail" id="pemail" maxlength="100">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="store">Phone Number</label>

                                <div class="controls">
                                    <input type="text" class="input-large" name="phonenumber" id="phonenumber"
                                           maxlength="100">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="store">URL</label>

                                <div class="controls">
                                    <input type="text" class="input-large" name="url" id="url" maxlength="100">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="store">Contact Person</label>

                                <div class="controls">
                                    <input type="text" class="input-large" name="contactperson" id="contactperson"
                                           maxlength="100">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="store">Operating Days</label>

                                <div class="controls">
                                    <input type="text" class="input-large" name="operatingdays" id="operatingdays"
                                           maxlength="100">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="store">Operating Hours</label>

                                <div class="controls">
                                    <input type="text" class="input-large" name="operatinghours" id="operatinghours"
                                           maxlength="100">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="store">Service Area</label>

                                <div class="controls">
                                    <input type="text" class="input-large" name="servicearea" id="servicearea"
                                           maxlength="100">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="store">Languages</label>

                                <div class="controls">
                                    <input type="text" class="input-large" name="languages" id="languages"
                                           maxlength="100">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="store">Services1</label>

                                <div class="controls">
                                    <input type="text" class="input-large" name="services1" id="services1"
                                           maxlength="100">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="store">Services2</label>

                                <div class="controls">
                                    <input type="text" class="input-large" name="services2" id="services2"
                                           maxlength="100">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="store">Services3</label>

                                <div class="controls">
                                    <input type="text" class="input-large" name="services3" id="services3"
                                           maxlength="100">
                                </div>
                            </div>
                            <div class="form-actions">
                                <button type="submit" name="submit" id="submit" class="btn btn-primary btn-large">Add
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
<link rel="stylesheet" href="<?php echo base_url(); ?>css/chosen/chosen.css">
<script src="<?php echo base_url(); ?>css/chosen/js/chosen.jquery.js"></script>
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
        var strURL = "<?php echo site_url();?>admin/getcitilist/" + statecode;
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