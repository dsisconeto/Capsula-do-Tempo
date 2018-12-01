<?php

sysLoadClass("ModelCompany");

class ActionCompany extends ModelCompany
{

	public function sqlInsert()
	{
		$sql = new SqlInsert();
		$sql->setEntity("company");


		$sql->setRowData("company_name", $this->getCompanyName());
		$sql->setRowData("company_fantasy_name", $this->getCompanyFantasyName());
		$sql->setRowData("company_address", $this->getCompanyAddress());
		$sql->setRowData("company_address_embed", $this->getCompanyAddressEmbed());

		$sql->setRowData("company_cnpj_or_cpf", $this->getCompanyCnpjOrCpf());
		$sql->setRowData("company_nivel", $this->getCompanyNivel());
		$sql->setRowData("company_description", $this->getCompanyDescription());
		$sql->setRowData("system_user_id_fk", $this->getCompanySystemUserIdFk());
		$sql->setRowData("system_user_id_register_fk", $this->getCompanySystemUserIdRegisterFk());
		$sql->setRowData("system_url_id_fk", $this->getSystemUrlIdFk());
		$sql->setRowData("company_status", $this->getCompanyStatus());
		$sql->setRowData("company_date_insert", $this->currentTime());

		return $this->runQuery($sql);

	}

	public function sqlUpdateLogo()
	{
		$sql = new SqlUpdate();
		$criteria = new Criteria();
		$sql->setEntity('company');
		$criteria->add(New Filter('company_id', '=', "{$this->getCompanyId()}"));
		$sql->setRowData("company_logo", $this->getCompanyLogo());

		$sql->setCriteria($criteria);

		return $this->runQuery($sql);

	}


	public function sqlUpdateCover()
	{
		$sql = new SqlUpdate();
		$criteria = new Criteria();
		$sql->setEntity('company');
		$criteria->add(New Filter('company_id', '=', "{$this->getCompanyId()}"));
		$sql->setRowData("company_cover", $this->getCompanyCover());

		$sql->setCriteria($criteria);

		return $this->runQuery($sql);

	}


	public function sqlUpdate()
	{
		$sql = new SqlUpdate();
		$criteria = new Criteria();
		$sql->setEntity('company');
		$criteria->add(New Filter('company_id', '=', "{$this->getCompanyId()}"));


		$sql->setRowData("company_name", $this->getCompanyName());
		$sql->setRowData("company_fantasy_name", $this->getCompanyFantasyName());
		$sql->setRowData("company_address", $this->getCompanyAddress());
		$sql->setRowData("company_address_embed", $this->getCompanyAddressEmbed());
		$sql->setRowData("company_logo", $this->getCompanyLogo());
		$sql->setRowData("company_cover", $this->getCompanyCover());
		$sql->setRowData("company_cnpj_or_cpf", $this->getCompanyCnpjOrCpf());
		$sql->setRowData("company_nivel", $this->getCompanyNivel());
		$sql->setRowData("company_description", $this->getCompanyDescription());
		$sql->setRowData("company_date_update", $this->currentTime());

		$sql->setCriteria($criteria);

		return $this->runQuery($sql);

	}

	public function sqlUpdateStatus()
	{


		$sql = new SqlUpdate();
		$criteria = new Criteria();
		$sql->setEntity('company');
		$criteria->add(New Filter('company_id', '=', "{$this->getCompanyId()}"));

		$sql->setRowData("company_status", $this->getCompanyStatus());
		$sql->setCriteria($criteria);

		return $this->runQuery($sql);

	}

	public function sqlSelect($criteria = NULL, $col = false)
	{
		$sql = new SqlSelect();
		$sql->setEntity("company");
		$sql->addColumn($col);

		$sql->setJoin("company", "system_url", "system_url_id_fk", "system_url_id");

		if ($criteria):
			$sql->setCriteria($criteria);
		endif;


		return $this->runSelect($sql);
	}

	public function sqlSelectSearchAdmin(Criteria $criteria, $col = false)
	{
		$sql = new SqlSelect();
		$sql->setEntity("company");
		$sql->addColumn($col);

		$sql->setCriteria($criteria);

		$sql->setJoin("company", "system_url", "system_url_id_fk", "system_url_id");
		$sql->setJoin("company", "company_relationship_segment", "company_id", "company_id_fk", "left");
		$sql->setJoin("company_relationship_segment", "company_segment", "company_segment_id_fk", "company_segment_id", "left");

		return $this->runSelect($sql->distinct());
	}


	public function sqlSelectSearch(Criteria $criteria)
	{
		$sql = new SqlSelect();
		$sql->setEntity("company");
		$sql->addColumn("*");

		$sql->setCriteria($criteria);

		$sql->setJoin("company", "system_url", "system_url_id_fk", "system_url_id");
		$sql->setJoin("company", "company_relationship_segment", "company_id", "company_id_fk", "left");
		$sql->setJoin("company_relationship_segment", "company_segment", "company_segment_id_fk", "company_segment_id", "left");

		$sql->setJoin("company", "company_relationship_geo_region", "company_id", "company_id_fk", "left");


		return $this->runSelect($sql);
	}


	public function sqlLoad($companyId)
	{
		$criteria = new Criteria();
		$criteria->add(New Filter('company_id', '=', $companyId));
		$criteria->setProperty("limit", 1);
		$res = $this->sqlSelect($criteria);
		if ($res):
			$res = $res[0];
			$this->setCompanyId($res["company_id"]);
			$this->setCompanyName($res["company_name"]);
			$this->setCompanyFantasyName($res["company_fantasy_name"]);
			$this->setCompanyLogo($res["company_logo"]);
			$this->setCompanyCover($res["company_cover"]);
			$this->setCompanyAddress($res["company_address"]);
			$this->setCompanyAddressEmbed($res["company_address_embed"]);
			$this->setSystemUrlIdFk($res["system_url_id_fk"]);
			$this->setCompanyCnpjOrCpf($res["company_cnpj_or_cpf"]);
			$this->setCompanyNivel($res["company_nivel"]);
			$this->setCompanyDescription($res["company_description"]);
			$this->setCompanySystemUserIdFk($res["system_user_id_fk"]);
			$this->setCompanySystemUserIdRegisterFk($res["system_user_id_register_fk"]);
			$this->setCompanyDateInsert($res["company_date_insert"]);
			$this->setCompanyDateUpdate($res["company_date_update"]);
			$this->setCompanyStatus($res["company_status"]);

		endif;

		return $res;
	}


}
