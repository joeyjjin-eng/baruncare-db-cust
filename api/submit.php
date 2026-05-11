<?php
declare(strict_types=1);

require __DIR__ . '/_db.php';

// 동일 출처면 굳이 CORS 필요 없으나, 다른 서브도메인/페이지에서 호출할 경우를 위해 명시
$origin = $_SERVER['HTTP_ORIGIN'] ?? '';
$allowed = [
    // 운영 도메인을 추가하세요
    'http://localhost',
    'http://localhost:3456',
];
if ($origin && in_array($origin, $allowed, true)) {
    header('Access-Control-Allow-Origin: ' . $origin);
    header('Vary: Origin');
}
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if (($_SERVER['REQUEST_METHOD'] ?? '') === 'OPTIONS') {
    http_response_code(204);
    exit;
}

if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') {
    json_response(405, ['ok' => false, 'error' => 'METHOD_NOT_ALLOWED']);
}

// JSON 본문 파싱
$raw  = file_get_contents('php://input') ?: '';
$body = json_decode($raw, true);
if (!is_array($body)) {
    json_response(400, ['ok' => false, 'error' => 'INVALID_JSON']);
}

// 입력 정제
$name             = trim((string)($body['name']  ?? ''));
$phone            = preg_replace('/\D/', '', (string)($body['phone'] ?? ''));
$gender           = (string)($body['gender'] ?? '');
$year             = (int)($body['year']  ?? 0);
$month            = (int)($body['month'] ?? 0);
$day              = (int)($body['day']   ?? 0);
$agreePrivacy     = !empty($body['agreePrivacy']);
$agreeThirdParty  = !empty($body['agreeThirdParty']);
$agreeMarketing   = !empty($body['agreeMarketing']);

// 검증
$fields = [];
if ($name === '' || mb_strlen($name) > 50) {
    $fields[] = 'name';
} elseif (!preg_match('/^[\x{AC00}-\x{D7A3}\x{1100}-\x{11FF}\x{3130}-\x{318F}A-Za-z\s]+$/u', $name)) {
    $fields[] = 'name';
}
if (!preg_match('/^\d{10,11}$/', $phone)) {
    $fields[] = 'phone';
}
if (!in_array($gender, ['male', 'female'], true)) {
    $fields[] = 'gender';
}
if (!checkdate($month, $day, $year) || $year < 1900 || $year > (int)date('Y')) {
    $fields[] = 'birth_date';
}
if (!$agreePrivacy || !$agreeThirdParty) {
    $fields[] = 'required_agreements';
}

if ($fields) {
    json_response(422, ['ok' => false, 'error' => 'VALIDATION', 'fields' => $fields]);
}

$birth = sprintf('%04d-%02d-%02d', $year, $month, $day);

try {
    $pdo = get_pdo();
    // 휴대폰 표시 형식 통일 (011-1234-5678 / 010-1234-5678)
    $phoneFmt = (function ($d) {
        if (preg_match('/^(\d{3})(\d{4})(\d{4})$/', $d, $m)) return "{$m[1]}-{$m[2]}-{$m[3]}";
        if (preg_match('/^(\d{3})(\d{3})(\d{4})$/', $d, $m)) return "{$m[1]}-{$m[2]}-{$m[3]}";
        return $d;
    })($phone);

    $stmt = $pdo->prepare(
        'INSERT INTO claim_applications
           (customer_name, customer_phone, gender, birth_date,
            agree_privacy, agree_third_party, agree_marketing,
            current_status, ip_address, user_agent)
         VALUES
           (:name, :phone, :gender, :birth,
            :p1, :p2, :p3,
            :status, :ip, :ua)'
    );
    $stmt->execute([
        ':name'   => $name,
        ':phone'  => $phoneFmt,
        ':gender' => $gender,
        ':birth'  => $birth,
        ':p1'     => $agreePrivacy    ? 1 : 0,
        ':p2'     => $agreeThirdParty ? 1 : 0,
        ':p3'     => $agreeMarketing  ? 1 : 0,
        ':status' => '확인전',
        ':ip'     => client_ip(),
        ':ua'     => mb_substr($_SERVER['HTTP_USER_AGENT'] ?? '', 0, 500),
    ]);

    json_response(200, ['ok' => true, 'id' => (int)$pdo->lastInsertId()]);
} catch (Throwable $e) {
    // 사용자에게는 일반 메시지만, 서버에는 자세히 로그
    error_log('[submit.php] ' . $e->getMessage());
    json_response(500, ['ok' => false, 'error' => 'SERVER_ERROR']);
}
