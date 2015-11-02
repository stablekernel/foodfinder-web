<!--  Manage products side menu -->
<ul class="nav nav-tabs nav-stacked">
    <li class="<?php if ($pageName == "manageschool") {
        echo "active";
    } ?>">
        <a href="<?php echo site_url('admin/manageschool'); ?>">
            <i class="icon-table"></i>
            Manage Schools
            <i class="icon-chevron-right"></i>

        </a>
    </li>
    <li class="<?php if ($pageName == "addschool") {
        echo "active";
    } ?>">
        <a href="<?php echo site_url('admin/addschool'); ?>">
            <i class="icon-plus"></i>
            Add School
            <i class="icon-chevron-right"></i>
        </a>
    </li>
</ul>
