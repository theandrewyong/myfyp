<?php $curPageName = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);   ?>
<div class="bg-primary border-right" id="sidebar-wrapper">
    <div class="sidebar-heading text-white">
        Payroll Software
    </div>
    <div class="list-group list-group-flush">

    <a href="dashboard.php" class="<?php if($curPageName == 'dashboard.php'){echo "list-group-item list-group-item-action sidebar_color_active";}else{echo "list-group-item list-group-item-action sidebar_color";} ?>">Dashboard</a>

    <a href="maintainemployee.php" class="<?php if($curPageName == 'maintainemployee.php'){echo "list-group-item list-group-item-action sidebar_color_active";}else{echo "list-group-item list-group-item-action sidebar_color";} ?>">Maintain Employee</a>

    <a href="newpayroll.php" class="<?php if($curPageName == 'newpayroll.php'){echo "list-group-item list-group-item-action sidebar_color_active";}else{echo "list-group-item list-group-item-action sidebar_color";} ?>">New Payroll</a>      

    <a href="historypayroll.php" class="<?php if($curPageName == 'historypayroll.php'){echo "list-group-item list-group-item-action sidebar_color_active";}else{echo "list-group-item list-group-item-action sidebar_color";} ?>">Payroll History</a>

    <a href="reports.php" class="<?php if($curPageName == 'reports.php'){echo "list-group-item list-group-item-action sidebar_color_active";}else{echo "list-group-item list-group-item-action sidebar_color";} ?>">Reports</a>

    <a href="view.php" class="<?php if($curPageName == 'view.php'){echo "list-group-item list-group-item-action sidebar_color_active";}else{echo "list-group-item list-group-item-action sidebar_color";} ?>">View</a>

    <a href="adminpanel.php" class="<?php if($curPageName == 'adminpanel.php'){echo "list-group-item list-group-item-action sidebar_color_active";}else{echo "list-group-item list-group-item-action sidebar_color";} ?>">Admin Panel</a>

    <a href="tools.php" class="<?php if($curPageName == 'tools.php'){echo "list-group-item list-group-item-action sidebar_color_active";}else{echo "list-group-item list-group-item-action sidebar_color";} ?>">Tools</a>

    </div>
</div>