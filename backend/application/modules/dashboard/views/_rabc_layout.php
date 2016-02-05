<?php
$this->load->view('dashboard/components/page_header');
?>

<?php
$this->load->view('dashboard/components/_admin_nav');
?>
    <div class="container-fluid">
		<div class="row">
			<div class="col-lg-12" align="left">
			  <!--Body content-->
                                <?php
                                if ($subview != null) {
                                    $this->load->view($subview);
                                } else {

                                    $this->load->view('dashboard/components/_rabc_menu');
                                }
                                ?>
			  <!--Body content-->
			</div>
		</div>
	</div>
<div id="footer">
        <div class="container">
            <p class="text-muted">&copy; <?php echo date("Y");?></p>
		</div>
</div>
<?php $this->load->view('dashboard/components/page_footer'); ?>