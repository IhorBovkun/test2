<?php

class News
{

	/**
	*	Returns an array of news items
	*/
	public static function getNewsList()
	{
		$db = Db::getConnection();

		$newList = array();

		$result = $db->query('SELECT id, title, `date`, short_content, author_name'
			.' FROM news'
			.' ORDER by date DESC'
			.' LIMIT 10');

		$i = 0;
		while ($row = $result->fetch()) {
			$newsList[$i]['id'] = $row['id'];
			$newsList[$i]['title'] = $row['title'];
			$newsList[$i]['date'] = $row['date'];
			$newsList[$i]['short_content'] = $row['short_content'];
			$newsList[$i]['author_name'] = $row['author_name'];
			$i++;
		}

		return $newsList;
	}


	/**
	*	Returns single news item with specified ID
	*	@param integer $id
	*/
	public static function getNewsItemById($id)
	{
		$id = intval($id);

		if ($id) {

			$db = Db::getConnection();

			$result = $db->query('SELECT * FROM news WHERE id='.$id);

			// $result->setFetchMode(PDO::FETCH_NUM);			
			$result->setFetchMode(PDO::FETCH_ASSOC);

			$newsItem = $result->fetch();

			return $newsItem;

		}
	}


}