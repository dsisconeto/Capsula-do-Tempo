<?php

sysLoadClass("ModelNews");


class ActionNews extends ModelNews
{


	private $sqlUpdateLocal;

	public function sqlInsert()
	{
		$sql = new SqlInsert();
		$sql->setEntity("news");

		$sql->setRowData("news_title", $this->getNewsTitle());
		$sql->setRowData("news_post", $this->getNewsPost());
		$sql->setRowData("news_preview", $this->getNewsPreview());
		$sql->setRowData("news_keywords", $this->getNewsKeywords());
		$sql->setRowData("news_status", $this->getNewsStatus());
		$sql->setRowData("news_notification_app", $this->getNewsNotificationApp());
		$sql->setRowData("system_user_id_fk", $this->getSystemUserIdFk());
		$sql->setRowData("system_url_id_fk", $this->getSystemUrlIdFk());
		$sql->setRowData("system_user_id_permission_fk", $this->getSystemUserIdPermissionFk());
		$sql->setRowData("news_date_insert", $this->currentTime());
		$sql->setRowData("news_tag_id_fk", $this->getNewsTagIdFk());
		$sql->setRowData("news_order", $this->getNewsOrder());
		$sql->setRowData("news_local_id_fk", $this->getNewsLocalId());
		$sql->setRowData("session", session_id());

		return $this->runQuery($sql);

	}

	public function sqlUpdate()
	{
		$sql = new SqlUpdate();
		$criteria = new Criteria();
		$sql->setEntity('news');

		$criteria->add(New Filter('news_id', '=', "{$this->getNewsId()}"));

		$sql->setRowData("news_title", $this->getNewsTitle());
		$sql->setRowData("news_post", $this->getNewsPost());
		$sql->setRowData("news_preview", $this->getNewsPreview());
		$sql->setRowData("news_keywords", $this->getNewsKeywords());
		$sql->setRowData("news_tag_id_fk", $this->getNewsTagIdFk());
		$sql->setRowData("news_notification_app", $this->getNewsNotificationApp());
		$sql->setRowData("system_user_id_permission_fk", $this->getSystemUserIdPermissionFk());
		$sql->setRowData("news_date_update", $this->currentTime());
		$sql->setRowData("news_tag_id_fk", $this->getNewsTagIdFk());
		$sql->setRowData("news_order", $this->getNewsOrder());
		$sql->setRowData("news_local_id_fk", $this->getNewsLocalId());

		$sql->setCriteria($criteria);

		return $this->runQuery($sql);

	}

	public function sqlUpdateCover()
	{

		$sql = new SqlUpdate();
		$criteria = new Criteria();
		$sql->setEntity('news');

		$criteria->add(New Filter('news_id', '=', "{$this->getNewsId()}"));
		$sql->setRowData("news_cover", $this->getNewsCover());
		$sql->setCriteria($criteria);
		return $this->runQuery($sql);

	}

	public function sqlUpdateStatus()
	{
		$sql = new SqlUpdate();
		$criteria = new Criteria();
		$sql->setEntity('news');

		$criteria->add(New Filter('news_id', '=', "{$this->getNewsId()}"));
		$sql->setRowData("news_status", $this->getNewsStatus());
		$sql->setCriteria($criteria);

		return $this->runQuery($sql);

	}

	public function sqlUpdateCounterView()
	{

		$sql = new SqlUpdate();
		$criteria = new Criteria();
		$sql->setEntity('news');

		$criteria->add(New Filter('news_id_fk', '=', "{$this->getNewsId()}"));
		$sql->setRowData("news_counter_view", $this->getNewsCounterView());

		$sql->setCriteria($criteria);

		return $this->runQuery($sql);

	}

	public function sqlUpdateLocal($exe = true)
	{


		if ($exe) {

			return $this->runQuery($this->sqlUpdateLocal);

		} else {

			$sql = new SqlUpdate();
			$criteria = new Criteria();
			$sql->setEntity('news');

			$criteria->add(New Filter('news_id_fk', '=', "{$this->getNewsId()}"));
			$sql->setRowData("news_local_id_fk", $this->getNewsLocalId());
			$sql->setRowData("news_order", $this->getNewsOrder());
			$sql->setCriteria($criteria);


			if ($this->sqlUpdateLocal) {

				$this->sqlUpdateLocal .= "$sql";

			} else {

				$this->sqlUpdateLocal = "$sql";

			}


//            echo "<b>{$this->getNewsTitle()}</b><br>$sql <br><hr>";
			return true;
		}
	}

	public function sqlDelete()
	{

		$sql = new SqlDelete();
		$criteria = new Criteria();

		$sql->setEntity('news');
		$criteria->add(New Filter('news_id', '=', "{$this->getNewsId()}"));

		$sql->setCriteria($criteria);

		return $this->runQuery($sql);
	}

	public function sqlSelect($criteria = false, $col = false)
	{
		$sql = new SqlSelect();
		$sql->setEntity("news");
		$sql->addColumn($col);

		$sql->setJoin("news", "news_local", "news_local_id_fk", "news_local_id");
		$sql->setJoin("news", "news_tag", "news_tag_id_fk", "news_tag_id");
		$sql->setJoin("news_tag", "news_category", "news_category_id_fk", "news_category_id");
		$sql->setJoin("news", "system_url", "system_url_id_fk", "system_url_id");
		$sql->setJoin("news", "system_user", "system_user_id_fk", "system_user_id");
		$sql->setJoin("news", "news_relationship_region", "news_id", "news_id_fk", "LEFT");

		if ($criteria):
			$sql->setCriteria($criteria);
		endif;

		return $this->runSelect($sql);
	}


	public function sqlLoad($newsId)
	{
		$criteria = new Criteria();
		$criteria->add(New Filter('news_id', '=', $newsId));
		$criteria->setProperty("limit", 1);
		$res = $this->sqlSelect($criteria);
		if ($res):
			$res = $res[0];
			$this->setNewsId($res["news_id"]);
			$this->setNewsTitle($res["news_title"]);
			$this->setNewsPost($res["news_post"]);
			$this->setNewsPreview($res["news_preview"]);
			$this->setNewsKeywords($res["news_keywords"]);
			$this->setNewsTagIdFk($res["news_tag_id_fk"]);
			$this->setNewsLocalId($res["news_local_id_fk"]);
			$this->setNewsOrder($res["news_order"]);
			$this->setNewsCover($res["news_cover"]);
			$this->setNewsStatus($res["news_status"]);
			$this->setNewsNotificationApp($res["news_notification_app"]);
			$this->setNewsCounterView($res["news_counter_view"]);
			$this->setSystemUserIdPermissionFk($res["system_user_id_permission_fk"]);
			$this->setSystemUserIdFk($res["system_user_id_fk"]);
			$this->setSystemUrlIdFk($res["system_url_id_fk"]);
			$this->setNewsDateInsert($res["news_date_insert"]);
			$this->setNewsDateUpdate($res["news_date_update"]);
		endif;

		return $res;
	}

	public function sqlLoadByUrl($systemUrl)
	{
		$criteria = new Criteria();
		$criteria->add(New Filter('system_url_url', '=', $systemUrl));
		$criteria->setProperty("limit", 1);
		$res = $this->sqlSelect($criteria);
		if ($res):
			$res = $res[0];
			$this->setNewsId($res["news_id"]);
			$this->setNewsTitle($res["news_title"]);
			$this->setNewsPost($res["news_post"]);
			$this->setNewsPreview($res["news_preview"]);
			$this->setNewsKeywords($res["news_keywords"]);
			$this->setNewsTagIdFk($res["news_tag_id_fk"]);
			$this->setNewsLocalId($res["news_local_id_fk"]);
			$this->setNewsOrder($res["news_order"]);
			$this->setNewsCover($res["news_cover"]);
			$this->setNewsStatus($res["news_status"]);
			$this->setNewsNotificationApp($res["news_notification_app"]);
			$this->setNewsCounterView($res["news_counter_view"]);
			$this->setSystemUserIdPermissionFk($res["system_user_id_permission_fk"]);
			$this->setSystemUserIdFk($res["system_user_id_fk"]);
			$this->setSystemUrlIdFk($res["system_url_id_fk"]);
			$this->setNewsDateInsert($res["news_date_insert"]);
			$this->setNewsDateUpdate($res["news_date_update"]);
		endif;

		return $res;
	}
}
