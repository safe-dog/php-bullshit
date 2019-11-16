<?php
/**
 *
 * @author vPush，微信：hack_fish
 * @url
 */
defined('IN_IA') or exit('Access Denied');

class Weapp_goupibutongModuleWxapp extends WeModuleWxapp {

	public $tableSettings = "weapp_goupibutong_settings";
	public $tableAds = "weapp_goupibutong_ads";

	// 获取设置信息
	public function doPageGetSettings() {
		global $_GPC, $_W;

    $query = load()->object("query");
    $settings = $query->from($this->tableSettings)->where("key", $_W["account"]["key"])->orderby("created_at", "DESC")->get();
		$this->result(0, "获取系统设置成功", array(
			"attachurl" => $_W["attachurl"],
			"settings" => $settings
		));
	}

	// 获取广告列表
	public function doPageGetAds() {
		global $_GPC, $_W;

    $query = load()->object("query");
		$ads = $query->from($this->tableAds)->where("key", $_W["account"]["key"])->orderby("created_at", "DESC")->get();
		if ($ads && $ads["enabled"]==0) {
			$this->result(0, "关闭了广告", false);
		}
		$this->result(0, "获取广告列表成功", $ads);
	}
}