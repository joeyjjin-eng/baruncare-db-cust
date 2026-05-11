<?php
declare(strict_types=1);
require __DIR__ . '/../api/_db.php';

// .htaccess Basic Auth로 보호하는 것을 권장
$pdo = get_pdo();

// 페이지네이션
$per   = 50;
$page  = max(1, (int)($_GET['page'] ?? 1));
$total = (int)$pdo->query('SELECT COUNT(*) FROM applications')->fetchColumn();
$pages = max(1, (int)ceil($total / $per));
$off   = ($page - 1) * $per;

$stmt = $pdo->prepare(
    'SELECT id, name, phone, gender, birth_date,
            agree_privacy, agree_third_party, agree_marketing,
            status, created_at
       FROM applications
   ORDER BY created_at DESC
      LIMIT :lim OFFSET :off'
);
$stmt->bindValue(':lim', $per, PDO::PARAM_INT);
$stmt->bindValue(':off', $off, PDO::PARAM_INT);
$stmt->execute();
$rows = $stmt->fetchAll();

function h($s): string {
    return htmlspecialchars((string)$s, ENT_QUOTES, 'UTF-8');
}
function fmt_phone(string $p): string {
    $d = preg_replace('/\D/', '', $p);
    if (strlen($d) === 11) return substr($d, 0, 3) . '-' . substr($d, 3, 4) . '-' . substr($d, 7);
    if (strlen($d) === 10) return substr($d, 0, 3) . '-' . substr($d, 3, 3) . '-' . substr($d, 6);
    return $p;
}
function status_label(string $s): string {
    return [
        'new'       => '신규',
        'contacted' => '연락완료',
        'completed' => '처리완료',
        'cancelled' => '취소',
    ][$s] ?? $s;
}
?>
<!DOCTYPE html>
<html lang="ko">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>신청 내역 · 바른케어플러스 관리</title>
<style>
  *, *::before, *::after { box-sizing: border-box; }
  body { margin: 0; background: #F5F5F5; color: #1A1A1A;
         font-family: -apple-system, "Pretendard", "Apple SD Gothic Neo", system-ui, sans-serif; }
  header { background: #2D7A4F; color: #fff; padding: 18px 24px;
           display: flex; align-items: center; justify-content: space-between; }
  header h1 { margin: 0; font-size: 18px; font-weight: 700; letter-spacing: -.3px; }
  header .count { font-size: 14px; opacity: .85; }
  .wrap { padding: 24px; max-width: 1280px; margin: 0 auto; }
  .empty { padding: 80px 0; text-align: center; color: #999; font-size: 15px; }
  table { width: 100%; border-collapse: collapse; background: #fff;
          border-radius: 12px; overflow: hidden; box-shadow: 0 1px 3px rgba(0,0,0,.06); }
  th, td { padding: 12px 14px; text-align: left; font-size: 14px;
           border-bottom: 1px solid #E0E0E0; white-space: nowrap; }
  th { background: #FAFAFA; font-weight: 600; color: #555; font-size: 13px; }
  tr:last-child td { border-bottom: 0; }
  tr:hover td { background: #FAFCFB; }
  .pill { display: inline-block; padding: 2px 8px; border-radius: 999px;
          font-size: 12px; font-weight: 600; }
  .g-male   { background: #E0EEF8; color: #1F5A8A; }
  .g-female { background: #F8E0E8; color: #8A1F4A; }
  .a-on  { background: #E8F5EE; color: #2D7A4F; }
  .a-off { background: #F4F4F4; color: #999; }
  .s-new       { background: #FFF1E0; color: #B5651D; }
  .s-contacted { background: #E0F4FF; color: #1F6FB5; }
  .s-completed { background: #E8F5EE; color: #2D7A4F; }
  .s-cancelled { background: #F4F4F4; color: #888; }
  .pager { display: flex; gap: 6px; justify-content: center; margin: 20px 0 8px; }
  .pager a, .pager span { padding: 6px 10px; border-radius: 6px;
            background: #fff; border: 1px solid #E0E0E0; text-decoration: none;
            color: #555; font-size: 13px; min-width: 32px; text-align: center; }
  .pager .on { background: #2D7A4F; color: #fff; border-color: #2D7A4F; }
</style>
</head>
<body>
  <header>
    <h1>신청 내역 — 바른케어플러스</h1>
    <span class="count">총 <?= number_format($total) ?>건</span>
  </header>

  <div class="wrap">
    <?php if (!$rows): ?>
      <div class="empty">신청 내역이 없습니다.</div>
    <?php else: ?>
    <table>
      <thead>
        <tr>
          <th>#</th>
          <th>이름</th>
          <th>연락처</th>
          <th>성별</th>
          <th>생년월일</th>
          <th>개인정보</th>
          <th>제3자</th>
          <th>마케팅</th>
          <th>상태</th>
          <th>신청일시</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($rows as $r): ?>
        <tr>
          <td><?= (int)$r['id'] ?></td>
          <td><?= h($r['name']) ?></td>
          <td><?= h(fmt_phone($r['phone'])) ?></td>
          <td><span class="pill g-<?= h($r['gender']) ?>"><?= $r['gender'] === 'male' ? '남성' : '여성' ?></span></td>
          <td><?= h($r['birth_date']) ?></td>
          <td><span class="pill <?= $r['agree_privacy']     ? 'a-on' : 'a-off' ?>"><?= $r['agree_privacy']     ? '동의' : '미동의' ?></span></td>
          <td><span class="pill <?= $r['agree_third_party'] ? 'a-on' : 'a-off' ?>"><?= $r['agree_third_party'] ? '동의' : '미동의' ?></span></td>
          <td><span class="pill <?= $r['agree_marketing']   ? 'a-on' : 'a-off' ?>"><?= $r['agree_marketing']   ? '동의' : '미동의' ?></span></td>
          <td><span class="pill s-<?= h($r['status']) ?>"><?= h(status_label($r['status'])) ?></span></td>
          <td><?= h($r['created_at']) ?></td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>

    <?php if ($pages > 1): ?>
    <div class="pager">
      <?php for ($i = 1; $i <= $pages; $i++): ?>
        <?php if ($i === $page): ?>
          <span class="on"><?= $i ?></span>
        <?php else: ?>
          <a href="?page=<?= $i ?>"><?= $i ?></a>
        <?php endif; ?>
      <?php endfor; ?>
    </div>
    <?php endif; ?>

    <?php endif; ?>
  </div>
</body>
</html>
