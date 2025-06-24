<?php
$departure = $_POST['departure'] ?? '';
$destination = $_POST['destination'] ?? '';
$departure_time = $_POST['departure_time'] ?? '';

// デモ用のルート情報
$routes = [
  // ロビー→教室
  'ロビー-教室204' => ['経路' => 'ロビー → エレベーター → 2階 → 教室204', '所要時間' => 4],
  'ロビー-教室199' => ['経路' => 'ロビー → 階段 → 1階 → 教室199', '所要時間' => 5],
  'ロビー-教室191' => ['経路' => 'ロビー → エレベーター → 1階 → 教室191', '所要時間' => 3],
  'ロビー-教室197' => ['経路' => 'ロビー → 階段 → 地下1階 → 教室197', '所要時間' => 6],
  'ロビー-教室294' => ['経路' => 'ロビー → エレベーター → 2階 → 教室294', '所要時間' => 5],

  // 教室→ロビー
  '教室204-ロビー' => ['経路' => '教室204 → 2階 → エレベーター → ロビー', '所要時間' => 4],
  '教室199-ロビー' => ['経路' => '教室199 → 1階 → 階段 → ロビー', '所要時間' => 5],
  '教室191-ロビー' => ['経路' => '教室191 → 1階 → エレベーター → ロビー', '所要時間' => 3],
  '教室197-ロビー' => ['経路' => '教室197 → 地下1階 → 階段 → ロビー', '所要時間' => 6],
  '教室294-ロビー' => ['経路' => '教室294 → 2階 → エレベーター → ロビー', '所要時間' => 5],
];

// 到着予定時刻の計算関数
function add_minutes($time, $minutes) {
  $time_obj = DateTime::createFromFormat('H:i', $time);
  if ($time_obj === false) return '';
  $time_obj->modify("+{$minutes} minutes");
  return $time_obj->format('H:i');
}

$route_key = "{$departure}-{$destination}";
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>ルート案内結果</title>
  <style>
    body { font-family: sans-serif; margin: 2em; }
    .result { background: #f0f0f0; padding: 1em; border-radius: 8px; }
    .back { margin-top: 2em; }
  </style>
</head>
<body>
  <h1>ルート案内結果</h1>

  <?php if (isset($routes[$route_key])): ?>
    <?php $info = $routes[$route_key]; ?>
    <div class="result">
      <p><strong>出発地：</strong><?= htmlspecialchars($departure) ?></p>
      <p><strong>目的地：</strong><?= htmlspecialchars($destination) ?></p>
      <p><strong>出発時刻：</strong><?= htmlspecialchars($departure_time) ?></p>
      <p><strong>経路：</strong><?= htmlspecialchars($info['経路']) ?></p>
      <p><strong>所要時間：</strong><?= $info['所要時間'] ?>分</p>
      <p><strong>到着予定時刻：</strong><?= add_minutes($departure_time, $info['所要時間']) ?></p>
    </div>
  <?php else: ?>
    <p>ルート「<?= htmlspecialchars($departure) ?> → <?= htmlspecialchars($destination) ?>」は登録されていません。</p>
  <?php endif; ?>

  <div class="back">
    <a href="index.html">戻る</a>
  </div>
</body>
</html>
