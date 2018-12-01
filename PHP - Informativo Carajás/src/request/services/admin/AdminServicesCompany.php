<?php
sysLoadClass("Company");
use Respect\Validation\Validator as respect;

class AdminServicesCompany
{
	public function searchForAds()
	{
		$company = new Company();
		$systemLogin = SystemLogin::getLogin();

		if ($systemLogin->getSystemUserPermissionAds() && $systemLogin->validateLogIn() && $systemLogin->getSystemUserPermissionAds()) {
			$q = DjRequest::get("q");
			$cri = new Criteria();
			$cri->add(new Filter("company_fantasy_name", "LIKE", "%{$q}%"));
			$cri->add(new Filter("company_nivel", ">=", 2));
			$res = $company->sqlSelect($cri);
			$count = 0;

			if ($res):

				foreach ($res as $key):
					$json[$count]["id"] = $key["company_id"];
					$json[$count]["text"] = $key["company_cnpj_or_cpf"] . " - " . $key["company_fantasy_name"];
					$count++;
				endforeach;

				echo json_encode($json);

			endif;

			exit;
		}
	}

	public function search()
	{

		$arg = DjRequest::get("company_search_arg", "str", "");
		$companyStatus = DjRequest::get("company_status", "int", 3);
		$geoRegionId = DjRequest::get("geo_region_id", "int", 0);
		$page = DjRequest::get("page", "int", 1);
		$limitByPage = DjRequest::get("limit_by_page", "int", 10);

		$company = new Company();
		$return["items"] = NULL;
		$return["pageNumber"] = 0;
		$cri = new Criteria();
		$cri2 = new Criteria();
		$cri3 = new Criteria();
		// pesquisar pelo nome, e pelo nome do segmento
		if (respect::length(1)->validate($arg)) {
			$cri->add(new Filter("company_fantasy_name", "LIKE", "%$arg%"), Filter::OR_OPERATOR);
			$cri->add(new Filter("company_segment_name", "LIKE", "%$arg%"), Filter::OR_OPERATOR);
		}
		// filtrar por status
		if ($companyStatus == 0 || $companyStatus == 1) {
			$cri2->add(new Filter("company_status", "=", $companyStatus));
		}
		// filtrar por região
		if ($geoRegionId > 0) {
			$cri2->add(new Filter("company_relationship_geo_region.geo_region_id_fk", "=", $geoRegionId));
		}


		if ($cri->dump()) {

			$cri3->add($cri);

		}

		if ($cri2->dump()) {
			$cri3->add($cri2);
		}
		// definindo dados a serem retornandos
		$col[] = "company_id";
		$col[] = "company_address";
		$col[] = "company_fantasy_name";
		$col[] = "company_logo";
		$col[] = "company_nivel";
		$col[] = "system_url_url";
		$col[] = "company_status";

		// sistema de pagaginacao
		if (!isset($_COOKIE[md5("search_company" . $cri3->dump())])) {
			// cookie para não ficar repedindo a buscar o tempo momento
			$resultCompany = $company->sqlSelectSearchAdmin($cri3, $col);
			$pageNumber = ceil(count($resultCompany) / $limitByPage);
			setcookie(md5("search_company" . $cri3->dump()), $pageNumber, 60);
		} else {
			$pageNumber = $_COOKIE[md5("search_company" . $cri3->dump())];
		}

		$cri3->setProperty("limit", DjWork::paginate($page, $limitByPage));
		$res = $company->sqlSelectSearchAdmin($cri3, $col);

		$result = "";
		$index = array();
		/// retirando resultados repeditos
		foreach ($res as $key) {
			if (!isset($index[$key["company_id"]])) {
				$result[] = $key;
				$index[$key["company_id"]] = $key["company_id"];
			}
		}
		$return["pageNumber"] = $pageNumber;
		$return["items"] = $result;

		$return = $result ? $return : NUll;
		return $return;
	}

}