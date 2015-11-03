<style type="text/css" media="all">
    @import "<?php echo base_url();?>grid/js/demo_table_jui.css";
    @import "<?php echo base_url();?>grid/js/jquery-ui-1.7.2.custom.css";

    table.display td {
        padding: 0px !important;
    }
</style>
<script type="text/javascript" src="<?php echo base_url(); ?>grid/js/jquery-1.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>grid/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
    function fnFeaturesInit() {
        /* Not particularly modular this - but does nicely :-) */
        $('ul.limit_length>li').each(function (i) {
            if (i > 10) {
                this.style.display = 'none';
            }
        });
        $('ul.limit_length').append('<li class="css_link">Show more<\/li>');
        $('ul.limit_length li.css_link').click(function () {
            $('ul.limit_length li').each(function (i) {
                if (i > 6) {
                    this.style.display = 'list-item';
                }
            });
            $('ul.limit_length li.css_link').css('display', 'none');
        });
    }
</script>
<div id="content">
    <div class="container">
        <div class="row">
            <div class="tabbable">
                <div class="span3">
                    <?php $this->load->view('admin/sidebar/schoolsidebar'); ?>
                </div>
                <!-- /.span3 -->
                <div class="span12">
                    <div id="printablediv" style="display:none;">
                        <div align="left" style="font-size:14px; font-weight:bold;">RK INTERNATIONAL SERVICES PVT LTD
                        </div>
                        <div style="clear:both; height:10px;"><!-- --></div>
                        <div align="left" style="font-size:14px; font-weight:bold;">MATERIALS DETAILS
                            - <?php if (isset($selectedgroup)) {
                                for ($t = 0; $t < count($selectedgroup); $t++) {
                                    echo $group[$t]["groupname"] . " ";
                                }
                            } else {
                                echo "All GROUPS";
                            } ?></div>
                        <div style="clear:both; height:10px;"><!-- --></div>
                        <table width="100%" border="0" cellspacing="0" cellpadding="0"
                               class="table table-bordered datagrid">
                            <thead>
                            <tr>
                                <th>SLNO</th>
                                <th>DESCRIPTION OF MATERIAL</th>
                                <th>ORDER</th>
                                <th>UOM</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php for ($t = 0; $t < count($members); $t++) { ?>
                                <tr>
                                    <td align="left" valign="middle"><?php echo $t + 1; ?></td>
                                    <td align="left" valign="middle"><?php echo $members[$t]["product_name"]; ?></td>
                                    <td align="left" valign="middle">&nbsp;</td>
                                    <td align="left"
                                        valign="middle"><?php echo strtoupper($members[$t]["units"]); ?></td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>

                    <table cellpadding="0" cellspacing="0" border="0" class="table table-bordered datagrid"
                           id="schooltable" style="width:100%">
                        <thead>
                        <tr>
                            <th align="center" valign="middle">SNo</th>
                            <th align="center" valign="middle">School name</th>
                            <th align="center" valign="middle">Address</th>
                            <th align="center" valign="middle">State</th>
                            <th align="center" valign="middle">City</th>
                            <th align="center" valign="middle">County</th>
                            <th align="center" valign="middle">Zipcode</th>
                            <th align="center" valign="middle">Phone Number</th>
                            <th align="center" valign="middle">Edit</th>
                            <th align="center" valign="middle">Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php for ($t = 0; $t < count($schooldetails); $t++) { ?>
                            <tr id="row<?php echo $schooldetails[$t]["school_id"]; ?>">
                                <td align="left" valign="middle"><?php echo $t + 1; ?></td>
                                <td align="left" valign="middle"><?php echo $schooldetails[$t]["school_name"]; ?></td>
                                <td align="left"
                                    valign="middle"><?php echo $schooldetails[$t]["school_address1"] . "<br>" . $schooldetails[$t]["school_address2"]; ?></td>
                                <td align="left" valign="middle"><?php echo $schooldetails[$t]["state"]; ?></td>
                                <td align="left" valign="middle"><?php echo $schooldetails[$t]["city"]; ?></td>
                                <td align="left" valign="middle"><?php echo $schooldetails[$t]["county"]; ?></td>
                                <td align="left" valign="middle"><?php echo $schooldetails[$t]["zipcode"]; ?></td>
                                <td align="left" valign="middle"><?php echo $schooldetails[$t]["phonenumber"]; ?></td>
                                <td align="center"><a
                                        href="<?php echo site_url(); ?>admin/schooledit/<?php echo $schooldetails[$t]["school_id"]; ?>"
                                        class='custedit' rel='tooltip' title='Click here to Edit'> </a></td>
                                <td align="center"><a href='javascript:void(0);' rel='tooltip'
                                                      class='school-delete custdeactiveie' title="Click here to delete"
                                                      id="<?php echo $schooldetails[$t]["school_id"]; ?>"> </a></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>

                </div>
                <!-- /.span9 -->

            </div>
            <!-- /.tabbable -->

        </div>
        <!-- /.row -->

    </div>
    <!-- /.container -->
    <script type="text/javascript">
        $(document).ready(function () {
            $(".school-delete").click(function () {
                uid = $(this).attr("id");
                var answer = confirm("Do you want to delete this school?");
                if (answer == false) {
                    return false;
                }
                $.post("<?php echo site_url();?>admin/deleteschool", {school_id: uid},
                    function (data) {
                        id = "row" + uid;
                        $("tr").each(function () {
                            window.location.href = "<?php echo site_url();?>admin/manageschool";
                        });
                    });
            });

            fnFeaturesInit();
            $('#schooltable').dataTable({
                "bJQueryUI": true,
                "bSort": false,
                "sDom": '<"top"il<"clear">>rt<"bottom"ip<"clear">',
                'bProcessing': true,
                'bFilter': true,
                "sPaginationType": "full_numbers"
            });
        });
    </script>
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/chosen/chosen.css">
    <script src="<?php echo base_url(); ?>css/chosen/js/chosen.jquery.js"></script>
</div>