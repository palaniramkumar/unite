<?php /* Smarty version 2.6.26, created on 2012-09-10 18:10:28
         compiled from password.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		<div id="content">
				<h2 id="password">Change password</h2>
				
				<?php if ($this->_tpl_vars['error']): ?>
					<div class="fail">
						<?php echo $this->_tpl_vars['error']; ?>

					</div>
				<?php endif; ?>
				
				<form id="change_password" action="<?php echo $_SERVER['REQUEST_URI']; ?>
" method="post">
					<div>
						<div class="group<?php if ($this->_tpl_vars['error']): ?> error<?php endif; ?>">
							<label for="new_password">New password</label>
							<input type="password" name="new_password" id="new_password" size="30" />
						</div>
						<div class="group<?php if ($this->_tpl_vars['error']): ?> error<?php endif; ?>">
							<label for="verify_password">Verify password</label>
							<input type="password" name="verify_password" id="verify_password" size="30" />
						</div>
					<div class="group_submit">
						<button type="submit"><span>Change password</span></button>
					</div>
				</form>
		</div><!-- #content -->

	<?php echo '
		<script type="text/javascript">
			$(document).ready(function()
			{
				$(\'#new_password\').focus();
				
				$("#change_password").validate({
					rules: {
						new_password: { required: true },
						verify_password: { equalTo: "#new_password" }
					}
				});
			});
		</script>
		'; ?>


<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>