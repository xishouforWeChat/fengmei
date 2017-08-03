<?php
defined('IN_IA') or exit('Access Denied');
global $_W, $_GPC;
$do = 'search';
$op = trim($_GPC['op']) ? trim($_GPC['op']) : 'index';
$discounts = store_discounts();
$categorys = store_fetchall_category();
// $slides = sys_fetch_store_slide(2);var_dump(123);exit();
$orderbys = store_orderbys();
$lat = $_GPC['__lat'];
$lng = $_GPC['__lng'];
$force = intval($_GPC['force']);
if ($op == 'list') {
    $lat = trim($_GPC['lat']);
    $lng = trim($_GPC['lng']);
    if (!empty($lat) && !empty($lng)) {
        isetcookie('__lat', $lat, 120);
        isetcookie('__lng', $lng, 120);
    }
    $condition = ' where uniacid = :uniacid and status = 1';
    $params = array(':uniacid' => $_W['uniacid']);
    if ($_GPC['cid'] > 0) {
        $condition .= ' and cid = :cid';
        $params[':cid'] = intval($_GPC['cid']);
    }
    $dis = trim($_GPC['dis']);
    if (!empty($dis)) {
        $condition .= " and {$dis} = {$discounts[$dis]['val']}";
    }
    $order = trim($_GPC['order']);
    if (!empty($order)) {
        $condition .= " order by {$order} {$orderbys[$order]['val']}";
    } else {
        $condition .= " order by displayorder desc";
    }
    if ($order == 'dist') {
        $params[':lat'] = $lat;
        $params[':lng'] = $lng;
        $stores = pdo_fetchall('select id,title,logo,score,business_hours,delivery_price,delivery_free_price,send_price,delivery_time,delivery_mode,token_status,invoice_status,location_x,location_y,(location_y-:lat) * (location_y-:lat) + (location_x-:lng) * (location_x-:lng) as dist,address from ' . tablename('tiny_wmall_store') . $condition, $params);
    } else {
        $stores = pdo_fetchall('select id,title,logo,score,business_hours,delivery_price,delivery_free_price,send_price,delivery_time,delivery_mode,token_status,invoice_status,location_x,location_y,forward_mode,address from ' . tablename('tiny_wmall_store') . $condition, $params);
    }
    $min = 0;
    if (!empty($stores)) {
        foreach ($stores as &$row) {
            $row['logo'] = tomedia($row['logo']);
            $row['business_hours'] = (array) iunserializer($row['business_hours']);
            $row['is_in_business_hours'] = store_is_in_business_hours($row['business_hours']);
            $row['hot_goods'] = pdo_fetchall('select title from ' . tablename('tiny_wmall_goods') . ' where uniacid = :uniacid and sid = :sid and is_hot = 1 limit 3', array(':uniacid' => $_W['uniacid'], ':sid' => $row['id']));
            $row['activity'] = store_fetch_activity($row['id']);
            $row['activity']['activity_num'] += $row['delivery_free_price'] > 0 ? 1 : 0;
            $row['score_cn'] = round($row['score'] / 5, 2) * 100;
            $row['url'] = store_forward_url($row['id'], $row['forward_mode']);
        }
        $min = min(array_keys($stores));
    }
    $stores = array_values($stores);
    $respon = array('error' => 0, 'message' => $stores, 'min' => $min);
    message($respon, '', 'ajax');
}
include $this->template('search');
?>