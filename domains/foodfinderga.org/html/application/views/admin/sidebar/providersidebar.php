<!--  Manage products side menu -->
<ul class="nav nav-tabs nav-stacked">
    <li class="<?php if ($pageName == "manageprovider") {
        echo "active";
    } ?>">
        <a href="<?php echo site_url('admin/manageprovider'); ?>">
            <i class="icon-table"></i>
            Manage Providers
            <i class="icon-chevron-right"></i>

        </a>
    </li>
    <li class="<?php if ($pageName == "addprovider") {
        echo "active";
    } ?>">
        <a href="<?php echo site_url('admin/addprovider'); ?>">
            <i class="icon-plus"></i>
            Add Provider
            <i class="icon-chevron-right"></i>
        </a>
    </li>
</ul>
