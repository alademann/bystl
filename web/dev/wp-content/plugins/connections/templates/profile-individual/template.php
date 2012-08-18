<div class="cn-entry" style="-moz-border-radius:4px; background-color:#FFFFFF; border:1px solid #E3E3E3; color: #000000; margin:8px 0px; padding:6px; position: relative;">
	<div>
		<span style="float: left; margin-right: 10px;"><?php $entry->getImage( array( 'preset' => 'profile-individual' ) ); ?></span>

		<div style="margin-left: 10px;">
			<h1><?php $entry->getSingleNameBlock(); ?></h1>
			<div style="margin-bottom: 20px;">
				<?php $entry->getTitleBlock() ?>
				<?php $entry->getOrgUnitBlock(); ?>
			</div>
			<?php echo $entry->getBioBlock(); ?>
		</div>

	</div>
	<div style="clear:both"></div>
</div>