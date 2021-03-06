<?php /* Smarty version 2.6.26, created on 2012-07-23 14:44:40
         compiled from stats.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		
		<div id="content">
			<h2 id="stats">Stats</h2>
			<div class="clearfix">
				<div class="right span1 block">
					<h3>Extending your scope</h3>
					<div class="block_inner clearfix">
						<p>Statistics are very important for a website. They tell you a lot about your visitors and also about your website and popular pages.</p>
						<p>If the default statistics are not enough we advice you to start using one of the following analytics services<sup>*</sup>.</p>
						<ul>
							<li><a href="http://www.google.com/analytics/" target="_blank">Google Analytics</a>: hosted by Google and has some very advanced features;</li>
							<li><a href="http://www.piwik.org/" target="_blank">Piwik</a>: open source and you must host it on your own server;</li>
							<li><a href="http://www.woopra.com/" target="_blank">Woopra</a>: hosted by Woopra. It is web and desktop based and you can see live who is on your site.</li>
						</ul>
						<div class="bold mb03">You decided to extend your scope?</div>
						<p>Paste your code in footer.tpl of the template you're using right above &lt;/body&gt; and wrap it in <span class="light">&#123;literal&#125;&hellip;&#123;/literal&#125;</span>. For example:</p>
						<pre>&#123;literal&#125;
	&lt;script&gt;
		&hellip;
	&lt;/script&gt;
&#123;/literal&#125;
&lt;/body&gt;</pre>
						
						<span class=" right small light">* There are <a href="http://www.bing.com/search?q=analytics&go=&form=QBLH&filt=all" title="Search results for &quot;analytics&quot;">loads</a> and <a href="http://www.bing.com/search?q=web+statistics&go=&form=QBRE&filt=all" title="Search results for &quot;web statistics&quot;">loads</a> more&hellip;</span>
					</div>
				</div>

				<div class="left span2 block">
					<h3><?php echo $this->_tpl_vars['translations']['stats']['last_50_posts']; ?>
</h3>
					<div class="block_inner">
						<div class="tcenter suggestion mb1">
							Total online application: <?php echo $this->_tpl_vars['applications']['count']; ?>
, Average last week: <?php echo $this->_tpl_vars['applications']['avg']; ?>
, Maximum last week: <?php echo $this->_tpl_vars['applications']['max']; ?>

						</div>
						<div class="mb1 stats_list"><?php echo $this->_tpl_vars['applications']['stats']; ?>
</div>
					</div>
				</div>

				<div class="left span2 block mt2">
					<h3><?php echo $this->_tpl_vars['translations']['stats']['last_50_searches']; ?>
</h3>
					<div class="block_inner">
						<div class="tcenter suggestion mb1">
							Total searches: <?php echo $this->_tpl_vars['keywordz']['count']; ?>
, Average last week: <?php echo $this->_tpl_vars['keywordz']['avg']; ?>
, Maximum last week: <?php echo $this->_tpl_vars['keywordz']['max']; ?>

						</div>
						<div class="stats_list"><?php echo $this->_tpl_vars['keywordz']['stats']; ?>
</div>
					</div>
				</div>
			</div>		
		</div><!-- #content -->

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>