<?php
/**
 * @version		$Id: default.php 20196 2011-01-09 02:40:25Z ian $
 * @package		Joomla.Site
 * @subpackage	mod_footer
 * @copyright	Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;
?>
<ul class="category-module">
<?php foreach ($articles as $item) : ?>            
  <li>
	 	<h4>
	   	<div class="photo">
  	   	<img src="/<?php echo $item->primaryimage; ?>" alt="">
  	  </div>
 			<a class="mod-articles-category-title active" href="<?php echo JRoute::_(ContentHelperRoute::getArticleRoute($item->slug, $item->catid)); ?>">
		    <?php echo $item->title; ?>
		  </a>
    </h4>
    <span class="mod-articles-category-writtenby">
			by <?php echo $item->author; ?>
		</span>
	</li>
<?php endforeach; ?>