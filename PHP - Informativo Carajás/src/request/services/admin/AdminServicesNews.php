<?php
/**
 * Created by PhpStorm.
 * User: dsisconeto
 * Date: 31/08/16
 * Time: 15:03
 */
sysLoadClass("News");

class AdminServicesNews
{


	public function __construct()
	{
		$login = SystemLogin::getLogin();
		if (!$login->validateLogIn() || !$login->getSystemUserPermissionNews()) {
			exit();
		}

	}

	public function search()
	{

		$categoryIdFilter = DjRequest::get("news_category_id", "int", 0);
		$filterStatus = DjRequest::get("news_status", "int", 0);
		$searchTitle = DjRequest::get("news_title", "string", null);
		$orderBy = DjRequest::get("order_by", "string");
		$order = DjRequest::get("order", "string");
		$page = DjRequest::get("page", "int", 1);
		$limitByPage = DjRequest::get("limitByPage", "int", 10);

		$login = SystemLogin::getLogin();
		$cri = new Criteria();
		$news = new News();
		$res["items"] = null;

		/// searchTitle
		if ($news->validateCounterString($searchTitle, 1)):
			$cri->add(New Filter("news_title", "LIKE", "%$searchTitle%"));
		endif;
		// filtrando por categoria caso seja necessario
		if ($categoryIdFilter > 0):
			$cri->add(New Filter("news_tag.news_category_id_fk", "=", intval($categoryIdFilter)));
		endif;

		// definindo usuario
		$cri->add(New Filter("system_user_id_fk", "=", $login->getSystemUserId()));

		if ($orderBy == 1):
			$cri->setProperty("order", "news_title" . $news->defineOrder($order));
		elseif ($orderBy == 2):
			$cri->setProperty("order", "news_date_insert" . $news->defineOrder($order));
		elseif ($orderBy == 3):
			$cri->setProperty("order", "news_date_update" . $news->defineOrder($order));
		elseif ($orderBy == 4):
			$cri->setProperty("order", "news_counter_view" . $news->defineOrder($order));
		else:
			$cri->setProperty("order", "news_title" . $news->defineOrder($order));
		endif;

		// definindo filtro por status
		if ($filterStatus <= 3 && $filterStatus >= 1) {
			$cri->add(new Filter("news_status", "=", $filterStatus));
		}
		// sistema de pagaginacao
		if (!isset($_COOKIE[md5("search_news" . $cri)])) {
			$resNews = $news->sqlSelect($cri);
			$pageNumber = ceil(count($resNews) / $limitByPage);
			setcookie(md5("search_news" . $cri), $pageNumber, 60);
		} else {
			$pageNumber = $_COOKIE[md5("search_news" . $cri)];
		}
		// setando prorpriedade de paginacao
		$cri->setProperty("limit", DjWork::paginate($page, $limitByPage));
		$resNews = $news->sqlSelect($cri);
		$count = 0;


		if ($resNews) {

			foreach ($resNews as $key):
				$res["items"][$count]["news_id"] = $key["news_id"];
				$res["items"][$count]["news_title"] = $key["news_title"];
				$res["items"][$count]["news_cover"] = $key["news_cover"];
				$res["items"][$count]["news_status"] = $key["news_status"];
				$res["items"][$count]["news_notification_app"] = $key["news_notification_app"];
				$res["items"][$count]["news_counter_view"] = $key["news_counter_view"];
				$res["items"][$count]["news_date_insert"] = $news->dateToBr($key["news_date_insert"], true);
				$res["items"][$count]["news_date_update"] = $news->dateToBr($key["news_date_update"], true);
				$res["items"][$count]["news_category_name"] = $key["news_category_name"];
				$res["items"][$count]["system_url_url"] = DjWork::getHost() . $key["system_url_url"];
				$res["items"][$count]["news_local_name"] = $key["news_local_name"];
				$res["items"][$count]["news_order"] = $key["news_order"];
				$count++;
			endforeach;
			$res["count"] = $count-1;
			$res["numberPage"] = $pageNumber;
		}

		return $res;
	}

	public function showDisplayByUrl($url, $app = false)
	{
		$news = new News();
		$systemUrl = new SystemUrl();
		$trafficView = new TrafficView();

		if ($systemUrl->sqlLoadByUrl($url)):

			$cri = new Criteria();
			$cri->add(new Filter("system_url_id_fk", "=", $systemUrl->getId()));
			$cri->setProperty("limit", "1");
			$res = $news->sqlSelect($cri);

			if ($res):
				$res = $res[0];
				$result["news_id"] = $res["news_id"];
				$result["news_title"] = $res["news_title"];
				$result["news_category_name"] = $res["news_category_name"];
				$result["news_category_nickname"] = $res["news_category_nickname"];
				$result["news_tag_nickname"] = $res["news_tag_nickname"];
				$result["news_tag_name"] = $res["news_tag_name"];
				$result["news_category_color"] = $res["news_category_color"];
				$result["news_date_insert"] = $res["news_date_insert"];
				$result["news_counter_view"] = $res["news_counter_view"];
				$result["system_url_url"] = $res["system_url_url"];
				$result["news_preview"] = $res["news_preview"];
				$result["news_keywords"] = $res["news_keywords"];
				$result["system_user_name"] = $res["system_user_name"];
				$result["news_cover"] = DjWork::getHost() . $news->getImgFolder() . $res["news_cover"];
				$result["news_cover_thumb"] = DjWork::getHost() . $news->getImgFolderThumbnail() . $res["news_cover"];

				$contet = explode("</p>", $res["news_post"]);
				$count = count($contet);
				$post = "";

				$count = ($count - 1);
				if ($count <= 5):
					$countAdsVIew = 2;
				else:
					$countAdsVIew = intval($count / 3);
				endif;
				$result["count_ads_view"] = $countAdsVIew;


				for ($i = 0; $count >= $i; $i++):

					$post .= $contet[$i] . "</p>";

					if (is_int(($i / 7)) && $i != 0 || $i == 1):

						if ($news->isMobileDevice() || $app):
							$post .= $ads = "<div class=\"ads\"><script src=\"{$this->getHost()}ads/1/js/{$i}\"></script></div>";
						else:
							$post .= $ads = "<div class=\"ads\"><script src=\"{$this->getHost()}ads/2/js/{$i}\"></script></div>";
						endif;


					endif;

				endfor;

				$result["news_post"] = $post;

				if ($res["news_status"] == 3):

					$news->updateCounterView($res["news_id"], $trafficView->counterViewUrl($systemUrl->getId()));

					return $result;

				elseif ($news->validateUser($res["news_id"])):

					return $result;
				else:
					false;
				endif;

			else:
				return false;
			endif;

		else:
			return false;
		endif;
	}


}