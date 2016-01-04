<?php

/**
 * @package DataTypes
 */

class DataType_UUID extends DataTypePlugin {
	protected $isEnabled = true;
	protected $dataTypeName = "UUID";
	protected $dataTypeFieldGroup = "numeric";
	protected $dataTypeFieldGroupOrder = 55;
	private $generatedGUIDs = array();


	public function generate($generator, $generationContextData) {
		$placeholderStr = "hhhhhhhh-hhhh-4hhh-fhhh-hhhhhhhhhhhh";
		$uuid = Utils::generateRandomAlphanumericStr($placeholderStr);

		// pretty sodding unlikely, but just in case!
		while (in_array($uuid, $this->generatedGUIDs)) {
			$uuid = Utils::generateRandomAlphanumericStr($placeholderStr);
		}
		$this->generatedGUIDs[] = $uuid;
		return array(
			"display" => $uuid
		);
	}

	public function getHelpHTML() {
		return "<p>{$this->L["help"]}</p>";
	}

	public function getDataTypeMetadata() {
		return array(
			"SQLField" => "varchar(36) NOT NULL",
			"SQLField_Oracle" => "varchar2(36) NOT NULL",
			"SQLField_MSSQL" => "UNIQUEIDENTIFIER NULL"
		);
	}
}