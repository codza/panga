<?php 
$this->load->view('dashboard/components/page_header');
?>

<?php
$this->load->view('dashboard/components/_admin_nav');
?>

<?php
if($body_header != null || $body_header != "" ){
$this->load->view($body_header);
}
?>
    <div class="container-fluid">
		<div class="row">
			<div class="col-lg-12" align="left">
			  <!--Body content-->
				<?php

					if($subview != null){
						$this->load->view($subview);
					}// Subview is set in controller
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