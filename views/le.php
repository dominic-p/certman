<?php
if(!empty($message)) {
	$messagehtml = '<div class="alert alert-' . $message['type'] .'">'. $message['message'] . '</div>';
}
?>

<div class="container-fluid">
	<h1><?php echo !empty($cert['cid']) ? _("Edit Let's Encrypt Certificate") : _("New Let's Encrypt Certificate")?></h1>
	<?php echo !empty($messagehtml) ? $messagehtml : "" ?>
	<div class="alert alert-info"><?php echo sprintf(_("For this to work properly you will need to allow inbound http access to %s"),"outbound1.letsencrypt.org, outbound2.letsencrypt.org, mirror1.freepbx.org, mirror2.freepbx.org")?></div>
	<div class = "display full-border">
		<div class="row">
			<div class="col-sm-12">
				<div class="fpbx-container">
					<div class="display full-border" id='certpage'>
						<form class="fpbx-submit" name="frm_certman" action="config.php?display=certman" method="post" enctype="multipart/form-data">
							<input id="certaction" type="hidden" name="certaction" value="<?php echo !empty($cert['cid']) ? 'edit' : 'add'?>">
							<input id="certtype" type="hidden" name="type" value="le">
							<input id="cid" type="hidden" name="cid" value="<?php echo !empty($cert['cid']) ? $cert['cid'] : ''?>">
							<div class="element-container">
								<div class="row">
									<div class="col-md-12">
										<div class="row">
											<div class="form-group">
												<div class="col-md-3">
													<label class="control-label" for="host"><?php echo _("Host Name")?></label>
												</div>
												<div class="col-md-9">
													<?php if (empty($cert['cid'])) { ?>
														<input type="text" class="form-control" id="host" name="host" placeholder="server.example.com" required value="<?php echo $hostname?>">
													<?php } else { ?>
														<?php echo !empty($cert['basename']) ? $cert['basename'] : ""?>
													<?php } ?>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<?php if(!empty($cert['cid'])) { ?>
								<div class="element-container">
									<div class="row">
										<div class="col-md-12">
											<div class="row">
												<div class="form-group">
													<div class="col-md-3">
														<label class="control-label" for="expires"><?php echo _("Valid Until")?></label>
													</div>
													<div class="col-md-9">
														<?php echo date('m/d/Y',$certinfo['validTo_time_t'])?>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="element-container">
									<div class="row">
										<div class="col-md-12">
											<div class="row">
												<div class="form-group">
													<div class="col-md-3">
														<label class="control-label" for="cn"><?php echo _("Common Name")?></label>
													</div>
													<div class="col-md-9">
														<?php echo $certinfo['subject']['CN']?>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<?php if(!empty($certinfo['extensions']['certificatePolicies'])) {?>
									<div class="element-container">
										<div class="row">
											<div class="col-md-12">
												<div class="row">
													<div class="form-group">
														<div class="col-md-3">
															<label class="control-label" for="cp"><?php echo _("Certificate Policies")?></label>
															<i class="fa fa-question-circle fpbx-help-icon" data-for="cp"></i>
														</div>
														<div class="col-md-9">
															<textarea class="form-control" readonly><?php echo $certinfo['extensions']['certificatePolicies']?></textarea>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12">
												<span id="cp-help" class="help-block fpbx-help-block" style=""><?php echo _('A certificate policy (CP) is a document which aims to state what are the different actors of a public key infrastructure (PKI), their roles and their duties')?></span>
											</div>
										</div>
									</div>
								<?php } ?>
							<?php } ?>
							<!--Description-->
							<div class="element-container">
								<div class="row">
									<div class="col-md-12">
										<div class="row">
											<div class="form-group">
												<div class="col-md-3">
													<label class="control-label" for="description"><?php echo _("Description")?></label>
													<i class="fa fa-question-circle fpbx-help-icon" data-for="description"></i>
												</div>
												<div class="col-md-9">
													<input type="text" class="form-control" autocomplete="off" name="description" id="description" value="<?php echo !empty($cert['description']) ? $cert['description'] : ""?>">
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<span id="description-help" class="help-block fpbx-help-block"><?php echo _("The Description of this certificate. Used in the module only")?></span>
									</div>
								</div>
							</div>
							<!--END Description-->
							<div class="element-container">
								<div class="row">
									<div class="col-md-12">
										<div class="row">
											<div class="form-group">
												<div class="col-md-3">
													<label class="control-label" for="c"><?php echo _("Country")?></label>
													<i class="fa fa-question-circle fpbx-help-icon" data-for="C"></i>
												</div>
												<div class="col-md-9">
													<input type="text" class="form-control" id="C" name="C" placeholder="US" value="<?php echo !empty($cert['additional']['C']) ? $cert['additional']['C'] : "US"?>">
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<span id="C-help" class="help-block fpbx-help-block"><?php echo _('Two letter country code, such as "US", "CA", or "AU".')?></span>
									</div>
								</div>
							</div>
							<div class="element-container">
								<div class="row">
									<div class="col-md-12">
										<div class="row">
											<div class="form-group">
												<div class="col-md-3">
													<label class="control-label" for="st"><?php echo _("State/Province")?></label>
													<i class="fa fa-question-circle fpbx-help-icon" data-for="ST"></i>
												</div>
												<div class="col-md-9">
													<input type="text" class="form-control" id="ST" name="ST" placeholder="Wisconsin" value="<?php echo $cert['additional']['ST']?>">
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<span id="ST-help" class="help-block fpbx-help-block" style=""><?php echo _('State or province such as "Queensland" or "Wisconsin" or "Ontario." Do not abbreviate. Enter the full name.')?></span>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>