<?php
// no direct access
defined('_JEXEC') or die;

class modAuthorArticles
{
	static function getArticles(&$params)
	{
		//get database
		$db		= JFactory::getDbo();
		$query	= $db->getQuery(true);
		$query->select('DISTINCT a.id, a.title, a.introtext, a.primaryimage, a.primaryimagealign, CASE WHEN CHAR_LENGTH(a.alias) THEN CONCAT_WS(":", a.id, a.alias) ELSE a.id END as slug, u.name AS author, u.id AS user_id');
		$query->from('#__content a INNER JOIN #__users u ON a.created_by=u.id');
		$query->where("a.state = 1 AND a.checked_out = 0 AND LCASE(a.created_by)='".addslashes(strtolower($params->get('created_by')))."'");
		$query->order($params->get('sort').' '.$params->get('order'));

		$db->setQuery($query, 0, intval($params->get('count')));
		$rows = (array) $db->loadObjectList();

		$app	= JFactory::getApplication();
		$menu	= $app->getMenu();
		$item	= $menu->getItems('link', 'index.php?option=com_content&view=archive', true);
		$itemid = isset($item) ? '&Itemid='.$item->id : '';

		$i		= 0;
		$lists	= array();
		foreach ($rows as $row) {
			$date = JFactory::getDate($row->created);

			$lists[$i] = new stdClass;

      $lists[$i]->id = $row->id;
      $lists[$i]->slug = $row->slug;
      $lists[$i]->catid = $row->catid;
      $lists[$i]->title = $row->title;
      $lists[$i]->primaryimage = $row->primaryimage;
      $lists[$i]->primaryimagecaption = $row->primaryimagecaption;
      $lists[$i]->primaryimagealign = $row->primaryimagealign;
      $lists[$i]->introtext = $row->introtext;
			$lists[$i]->link	= JRoute::_('index.php?option=com_content&id='.$row->id);
			$lists[$i]->author = $row->author;
			$lists[$i]->catslug = $row->catslug;

			if (++$i > $params->get('count')) break;
		}
		return $lists;
	}
}
