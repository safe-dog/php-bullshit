<?php
/**
 *
 * @author vPush
 * @url
 */
defined('IN_IA') or exit('Access Denied');

class Weapp_goupibutongModuleSite extends WeModuleSite {

  public $tableSettings = "weapp_goupibutong_settings";
  public $tableAds = "weapp_goupibutong_ads";

  public function doWebSetting () {
    global $_GPC, $_W;

    $query = load()->object("query");
    $settings = $query->from($this->tableSettings)->where("key", $_W["account"]["key"])->orderby("created_at", "DESC")->get();
    include $this->template("setting");
  }


  public function doWebSaveSetting() {
    global $_GPC, $_W;
    // 如果有id
    $ID = intval($_GPC["id"]);
    if ($ID && $ID > 0) {
      $res = pdo_update($this->tableSettings, array(
        "title" => $_GPC["title"],
        "logo" => $_GPC["logo"],
        "share_img" => $_GPC["share_img"],
        "share_txt" => $_GPC["share_txt"],
        "keywords" => $_GPC["keywords"],
        "updated_at" => strtotime("now")
      ), array(
        "id" => $ID,
        "key" => $_W["account"]["key"]
      ));
    } else {
      $res = pdo_insert($this->tableSettings, array(
        "title" => $_GPC["title"],
        "key" => $_W["account"]["key"],
        "logo" => $_GPC["logo"],
        "share_img" => $_GPC["share_img"],
        "share_txt" => $_GPC["share_txt"],
        "keywords" => $_GPC["keywords"],
        "created_at" => strtotime("now")
      ));
    }
    if (!empty($res)) {
      message("更新设置成功！", referer(), "success");
    } else {
      message("更新失败！请重试！", "", "warning");
    }
  }

  public function doWebAd() {
    global $_GPC, $_W;
    $query = load()->object("query");
    $ads = $query->from($this->tableAds)->where("key", $_W["account"]["key"])->orderby("created_at", "DESC")->get();

    include $this->template("ads");
  }

  public function doWebSaveAds() {
    global $_GPC, $_W;

    // 如果有id
    $ID = intval($_GPC["id"]);
    if ($ID && $ID > 0) {
      $res = pdo_update($this->tableAds, array(
        "ad01" => $_GPC["ad01"],
        "enabled" => $_GPC["enabled"] ? 1 : 0,
        "updated_at" => strtotime("now")
      ), array(
        "id" => $ID,
        "key" => $_W["account"]["key"]
      ));
    } else {
      $res = pdo_insert($this->tableAds, array(
        "key" => $_W["account"]["key"],
        "ad01" => $_GPC["ad01"],
        "enabled" => $_GPC["enabled"] ? 1 : 0,
        "created_at" => strtotime("now")
      ));
    }
    if (!empty($res)) {
      message("更新设置成功！", referer(), "success");
    } else {
      message("更新失败！请重试！", "", "warning");
    }
  }

  public function doWebContact() {
    global $_GPC, $_W;
    include $this->template("contact");
  }
}