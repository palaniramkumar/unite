<?php /* Smarty version 2.6.26, created on 2013-11-25 17:49:23
         compiled from categories.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		<div id="content">
				
				<h2 id="categories">Categories</h2>
				
				<div id="categoriesContainer">
				<?php $_from = $this->_tpl_vars['categories']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['category']):
?>
					<div class="categoryItem" rel="<?php echo $this->_tpl_vars['category']['id']; ?>
">
						<div class="categoryHandle"></div>
						<div class="categoryWrapper">
							<a href="#" title="Delete this category" class="deleteCategory"><img src="<?php echo $this->_tpl_vars['BASE_URL_ADMIN']; ?>
_templates/img/bin.png" alt="Delete" /></a>
							<label><span>Name:</span><input type="text" size="60" name="name[<?php echo $this->_tpl_vars['category']['id']; ?>
]" value="<?php echo $this->_tpl_vars['category']['name']; ?>
" /></label>
							<a href="#" title="Save changes" class="saveCategory"><img src="<?php echo $this->_tpl_vars['BASE_URL_ADMIN']; ?>
_templates/img/disk.png" alt="Save" /></a>
							<label><span>Title:</span><input type="text" size="60" name="title[<?php echo $this->_tpl_vars['category']['id']; ?>
]" value="<?php echo $this->_tpl_vars['category']['title']; ?>
" /></label>
							<label><span>Description:</span><input type="text" size="60" name="desc[<?php echo $this->_tpl_vars['category']['id']; ?>
]" value="<?php echo $this->_tpl_vars['category']['description']; ?>
"/></label>
							<label><span>Keywords:</span><input type="text" size="60" name="keys[<?php echo $this->_tpl_vars['category']['id']; ?>
]" value="<?php echo $this->_tpl_vars['category']['keywords']; ?>
" /></label>
							<label><span>URL:</span><input type="text" size="60" name="url[<?php echo $this->_tpl_vars['category']['id']; ?>
]" value="<?php echo $this->_tpl_vars['category']['var_name']; ?>
" /></label>
						</div>
					</div>
				<?php endforeach; endif; unset($_from); ?>
				</div>
				<p></p>
				<p>
					<a href="#" title="Add new category"><img src="<?php echo $this->_tpl_vars['BASE_URL_ADMIN']; ?>
_templates/img/plus-button.png" alt="Add new category" /></a>
		</div><!-- #content -->

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>