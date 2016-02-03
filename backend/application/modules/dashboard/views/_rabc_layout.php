<?php
$this->load->view('admin/components/page_header');
?>

<?php
$this->load->view('admin/components/_nav_bar');
?>

<div id="page-wrapper">

    <div class="container-fluid">      
        <!--Body content-->

        <?php
        if ($subview != null) {
            $this->load->view($subview);
        } else {

            $this->load->view('admin/components/_rabc_menu');
        }
        ?>
        <!--Body content-->
    </div>
</div>

<?php $this->load->view('admin/components/page_footer'); ?>