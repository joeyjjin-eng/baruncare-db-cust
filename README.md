# baruncare-db-cust

바른케어플러스 · 간병비 청구 도우미 (고객용)

## 스택

- Rocky Linux 8.1
- Apache 2.4.37
- PHP 8.2.30 (PDO, mbstring, json 필요)
- MariaDB 10.3.39 (utf8mb4)

## 디렉토리 구조

```
/
├── index.html              ← 프론트엔드 (React SPA · Tailwind CDN)
├── assets/                 ← 이미지·아이콘
├── fonts/                  ← Pretendard woff2
├── api/
│   ├── _db.php             ← PDO/JSON 헬퍼
│   └── submit.php          ← 신청 POST 엔드포인트
├── admin/
│   ├── index.php           ← 관리자 신청 내역 리스트
│   └── .htaccess           ← Basic Auth
├── config/
│   └── db.php              ← DB 접속정보 (운영에서 git 제외)
├── sql/
│   └── schema.sql          ← 테이블 생성 스크립트
├── .htaccess               ← /config 직접 접근 차단
└── .gitignore
```

## 배포 절차

### 1) DB 준비

```bash
mysql -u root -p < sql/schema.sql
```

> `sql/schema.sql` 안에 있는 `CREATE USER ... GRANT ...` 주석을 풀고 비밀번호를 바꿔 실행하세요.

### 2) DB 접속 설정

`config/db.php`의 `password`를 위에서 만든 계정 비밀번호로 변경.

### 3) Apache 설치/확인

```bash
sudo dnf install -y httpd php php-pdo php-mysqlnd php-mbstring php-json
sudo systemctl enable --now httpd
```

`/etc/httpd/conf/httpd.conf`에서 `AllowOverride All` (또는 최소 `AuthConfig FileInfo`)이 켜져 있어야 `.htaccess`가 동작합니다.

### 4) 코드 배포

전체 폴더를 DocumentRoot (예: `/var/www/baruncare/`)에 업로드. 권한:

```bash
sudo chown -R apache:apache /var/www/baruncare
sudo chmod -R 750 /var/www/baruncare
sudo chmod 640 /var/www/baruncare/config/db.php
```

SELinux를 사용 중이라면:

```bash
sudo chcon -R -t httpd_sys_content_t /var/www/baruncare
sudo setsebool -P httpd_can_network_connect_db on
```

### 5) 관리자 Basic Auth

```bash
sudo htpasswd -c /var/www/baruncare/.htpasswd admin
```

`admin/.htaccess`의 `AuthUserFile` 경로가 위와 일치하는지 확인.

## 사용

| URL | 설명 |
|-----|------|
| `https://도메인/` | 고객용 신청 페이지 |
| `https://도메인/admin/` | 신청 내역 관리 (Basic Auth) |
| `https://도메인/api/submit.php` | POST endpoint (프론트가 호출) |

## 신청 데이터 흐름

1. 고객이 폼 입력 → 약관 동의 시트 → "다음" 클릭
2. 프론트가 `POST /api/submit.php` (JSON)
3. PHP가 검증 후 `applications` 테이블에 INSERT
4. 성공 시 `{ok:true, id:N}` 반환 → 완료 화면으로 이동
5. 관리자는 `/admin/`에서 신규 신청 확인

## 입력 검증

서버(`api/submit.php`)에서 다시 검증:
- 이름: 한글·영문·공백, 최대 50자
- 휴대폰: 숫자 10~11자리
- 성별: `male` / `female`
- 생년월일: 1900년~당해, `checkdate()` 통과
- 동의: `privacy` & `thirdParty` 필수
