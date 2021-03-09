<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-medal"></i>
        </div>
        <div class="sidebar-brand-text mx-3">E-PORTFOLIO</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="<?php echo site_url(); ?>dashboard">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>แดชบอร์ด</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        จัดการผู้ใช้งาน
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseMember" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-user-friends"></i>
            <span>จัดการสมาชิก</span>
        </a>
        <div id="collapseMember" class="collapse" aria-labelledby="headingOne" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">เมนูจัดการสมาชิก:</h6>
                <a class="collapse-item" href="<?php echo site_url(); ?>adminmanagement/getlistmember"><i class="fas fa-fw fa-user-friends"></i> รายชื่อสมาชิก</a>
                <a class="collapse-item" href="<?php echo site_url(); ?>adminmanagement/approvemember"><i class="fas fa-fw fa-clipboard-check"></i> อนุมัติสมาชิก</a>
                <a class="collapse-item" href="<?php echo site_url(); ?>adminmanagement/hismember"><i class="fas fa-fw fa-history"></i> ประวัติการอนุมัติ</a>
                <a class="collapse-item" href="<?php echo site_url(); ?>adminmanagement/banmember"><i class="fas fa-fw fa-ban"></i> บัญชีที่ถูกระงับ</a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCompany" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-briefcase"></i>
            <span>จัดการบริษัท</span>
        </a>
        <div id="collapseCompany" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">เมนูจัดการบริษัท:</h6>
                <a class="collapse-item" href="<?php echo site_url(); ?>adminmanagement/getcompanylist"><i class="fas fa-fw fa-briefcase"></i> รายชื่อบริษัท</a>
                <a class="collapse-item" href="<?php echo site_url(); ?>adminmanagement/approvecompany"><i class="fas fa-fw fa-clipboard-check"></i> อนุมัติบริษัท</a>
                <a class="collapse-item" href="<?php echo site_url(); ?>adminmanagement/hiscompany"><i class="fas fa-fw fa-history"></i> ประวัติการอนุมัติ</a>
                <a class="collapse-item" href="<?php echo site_url(); ?>adminmanagement/bancompany"><i class="fas fa-fw fa-ban"></i> บัญชีที่ถูกระงับ</a>
                <!-- <a class="collapse-item" href="cards.html">Cards</a> -->
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUniversity" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-graduation-cap"></i>
            <span>จัดการสถาบัน</span>
        </a>
        <div id="collapseUniversity" class="collapse" aria-labelledby="headingThree" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">เมนูจัดการสถาบัน:</h6>
                <a class="collapse-item" href="<?php echo site_url(); ?>adminmanagement/getuniversitylist"><i class="fas fa-fw fa-graduation-cap"></i> รายชื่อสถาบัน</a>
                <a class="collapse-item" href="<?php echo site_url(); ?>adminmanagement/approveuniversity"><i class="fas fa-fw fa-clipboard-check"></i> อนุมัติสถาบัน</a>
                <a class="collapse-item" href="<?php echo site_url(); ?>adminmanagement/hisuniversity"><i class="fas fa-fw fa-history"></i> ประวัติการอนุมัติ</a>
                <a class="collapse-item" href="<?php echo site_url(); ?>adminmanagement/banuniversity"><i class="fas fa-fw fa-ban"></i> บัญชีที่ถูกระงับ</a>
                <!-- <a class="collapse-item" href="cards.html">Cards</a> -->
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseJob" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-scroll"></i>
            <span>จัดการข้อมูลประกาศ</span>
        </a>
        <div id="collapseJob" class="collapse" aria-labelledby="headingThree" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">เมนูจัดการข้อมูลประกาศ:</h6>
                <a class="collapse-item" href="<?php echo site_url(); ?>adminmanagement/getjoblist"><i class="fas fa-fw fa-scroll"></i> รายชื่อประกาศ</a>
                <a class="collapse-item" href="<?php echo site_url(); ?>adminmanagement/approvejob"><i class="fas fa-fw fa-clipboard-check"></i> อนุมัติประกาศ</a>
                <a class="collapse-item" href="<?php echo site_url(); ?>adminmanagement/hisjob"><i class="fas fa-fw fa-history"></i> ประวัติการประกาศ</a>
                <a class="collapse-item" href="<?php echo site_url(); ?>adminmanagement/banjob"><i class="fas fa-fw fa-ban"></i> บัญชีที่ถูกระงับประกาศ</a>
                <!-- <a class="collapse-item" href="cards.html">Cards</a> -->
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        จัดการผู้ดูแลระบบ
    </div>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAdmin" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-user-friends"></i>
            <span>จัดการผู้ดูแลระบบ</span>
        </a>
        <div id="collapseAdmin" class="collapse" aria-labelledby="headingOne" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">เมนูจัดการผู้ดูแลระบบ:</h6>
                <a class="collapse-item" href="<?php echo site_url(); ?>adminmanagement"><i class="fas fa-fw fa-user-friends"></i> รายชื่อผู้ดูแล</a>
                <a class="collapse-item" href="<?php echo site_url(); ?>adminmanagement/add"><i class="fas fa-fw fa-user-plus"></i> เพิ่มผู้ดูแล</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        จัดการเนื้อหา
    </div>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePage" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-folder"></i>
            <span>เนื้อหาเพจ</span>
        </a>
        <div id="collapsePage" class="collapse" aria-labelledby="headingOne" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">จัดการเนื้อหาเพจ:</h6>
                <a class="collapse-item" href="<?php echo site_url(); ?>adminmanagement/about"><i class="fas fa-fw fa-file-alt"></i> เกี่ยวกับเรา</a>
                <a class="collapse-item" href="<?php echo site_url(); ?>adminmanagement/policy"><i class="fas fa-fw fa-file-alt"></i> นโยบายความเป็นส่วนตัว</a>
                <a class="collapse-item" href="<?php echo site_url(); ?>adminmanagement/provision"><i class="fas fa-fw fa-file-alt"></i> ข้อกำหนดและเงื่อนไข</a>
                <a class="collapse-item" href="<?php echo site_url(); ?>adminmanagement/help"><i class="fas fa-fw fa-file-alt"></i> ช่วยเหลือ</a>
                <a class="collapse-item" href="<?php echo site_url(); ?>adminmanagement/contact"><i class="fas fa-fw fa-file-alt"></i> ติดต่อเรา</a>
            </div>
        </div>
    </li>

    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        อื่นๆ
    </div>

    <!-- Nav Item - Charts -->
    <li class="nav-item">
        <a class="nav-link" href="#">
            <i class="fas fa-fw fa-cog"></i>
            <span>ตั้งค่าระบบ</span></a>
    </li>



    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>