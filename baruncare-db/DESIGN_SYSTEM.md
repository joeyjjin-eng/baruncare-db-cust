# 바른케어플러스 디자인 시스템

> DB손해보험 간병비 청구 도우미 앱 퍼블리싱 가이드

---

## 1. 색상 (Colors)

```css
/* Primary */
--color-primary: #2D7A4F;          /* 메인 그린 (CTA 버튼, 활성 탭, 헤더 포인트) */
--color-primary-dark: #1F5E3A;     /* 호버/프레스 상태 */
--color-primary-bg: #E8F5EE;       /* 연한 그린 배경 (HeroCard 배경) */

/* Accent */
--color-accent-orange: #F4845F;    /* 로고 아이콘 포인트 색상 */

/* Neutral */
--color-text-primary: #1A1A1A;     /* 본문 제목 텍스트 */
--color-text-secondary: #555555;   /* 서브 텍스트, 설명 문구 */
--color-text-placeholder: #AAAAAA; /* 인풋 placeholder */
--color-text-white: #FFFFFF;       /* 버튼 위 텍스트 */

/* Background */
--color-bg-page: #F5F5F5;          /* 전체 페이지 배경 (연회색) */
--color-bg-card: #FFFFFF;          /* 카드, 인풋, 메뉴 아이템 배경 */
--color-bg-overlay: rgba(0,0,0,0.3); /* 모달/바텀시트 딤 처리 */

/* Border */
--color-border: #E0E0E0;           /* 인풋 테두리, 구분선 */
--color-border-active: #2D7A4F;    /* 포커스/활성 인풋 테두리 */

/* State */
--color-disabled-bg: #CCCCCC;      /* 비활성 버튼 배경 */
--color-check-active: #2D7A4F;     /* 체크리스트 활성 아이콘 색상 */
--color-check-inactive: #AAAAAA;   /* 체크리스트 비활성 아이콘 색상 */
```

---

## 2. 타이포그래피 (Typography)

> **기본 폰트**: `Noto Sans KR` (Korean 기반 앱)
> **숫자/영문 보조**: `Noto Sans` 또는 동일 패밀리

```css
/* Font Family */
--font-base: 'Noto Sans KR', sans-serif;

/* Font Size Scale */
--text-xs:   12px;   /* 보조 설명, 캡션 */
--text-sm:   13px;   /* 체크리스트 항목, 작은 레이블 */
--text-base: 14px;   /* 본문, 폼 레이블, 메뉴 아이템 */
--text-md:   15px;   /* 서브 설명 텍스트 */
--text-lg:   16px;   /* 인풋 입력값, 버튼 텍스트 */
--text-xl:   18px;   /* 섹션 소제목 (예: "1. 간병인 등록 및 매칭") */
--text-2xl:  22px;   /* 페이지 타이틀 (예: "간병비 청구 도우미") */
--text-3xl:  26px;   /* 완료 화면 타이틀 (예: "서비스 신청 완료!") */

/* Font Weight */
--font-regular:    400;
--font-medium:     500;
--font-semibold:   600;
--font-bold:       700;

/* Line Height */
--leading-tight:   1.3;
--leading-normal:  1.5;
--leading-relaxed: 1.7;

/* Letter Spacing */
--tracking-normal: 0;
--tracking-wide:   0.02em;  /* 버튼 텍스트에 사용 */
```

### 타이포 사용 규칙

| 용도 | Size | Weight | Color |
|------|------|--------|-------|
| 페이지 타이틀 | `--text-2xl` | Bold (700) | `--color-text-primary` |
| 섹션 소제목 | `--text-xl` | SemiBold (600) | `--color-text-primary` |
| 본문 / 설명 | `--text-base` | Regular (400) | `--color-text-secondary` |
| 폼 레이블 | `--text-base` | Medium (500) | `--color-text-primary` |
| 인풋 입력값 | `--text-lg` | Regular (400) | `--color-text-primary` |
| Placeholder | `--text-lg` | Regular (400) | `--color-text-placeholder` |
| 버튼 텍스트 | `--text-lg` | SemiBold (600) | `--color-text-white` |
| 체크리스트 | `--text-sm` | Regular (400) | `--color-text-secondary` |
| 로고 텍스트 | `--text-md` | Bold (700) | `--color-text-primary` |

---

## 3. 간격 (Spacing)

> 4px 기반 배수 시스템 사용

```css
--space-1:  4px;
--space-2:  8px;
--space-3:  12px;
--space-4:  16px;
--space-5:  20px;
--space-6:  24px;
--space-8:  32px;
--space-10: 40px;
--space-12: 48px;
```

### 컴포넌트별 패딩 규칙

| 영역 | 값 |
|------|-----|
| 페이지 좌우 패딩 | `20px` (`--space-5`) |
| 섹션 간 세로 간격 | `24px` (`--space-6`) |
| 카드 내부 패딩 | `16px` (`--space-4`) |
| 인풋 내부 패딩 | `14px 16px` |
| 버튼 내부 패딩 | `16px 24px` |
| 폼 필드 간 간격 | `20px` (`--space-5`) |
| 레이블 → 인풋 간격 | `8px` (`--space-2`) |
| 메뉴 아이템 내부 패딩 | `16px` (`--space-4`) |

---

## 4. Border Radius

```css
--radius-sm:   8px;   /* 인풋 필드, SelectBox */
--radius-md:   12px;  /* 메뉴 아이템 카드, 체크리스트 카드 */
--radius-lg:   16px;  /* HeroCard (녹색 배경 카드) */
--radius-xl:   20px;  /* 바텀시트, 약관 동의 패널 */
--radius-full: 9999px; /* GenderButton (pill 형태) */
--radius-btn:  12px;  /* CTA 버튼 (대형) */
```

---

## 5. 그림자 (Shadow)

```css
--shadow-none:  none;
--shadow-sm:    0 1px 3px rgba(0, 0, 0, 0.06);   /* 미세한 카드 그림자 */
--shadow-md:    0 2px 8px rgba(0, 0, 0, 0.08);   /* 메뉴 아이템 카드 */
--shadow-lg:    0 4px 16px rgba(0, 0, 0, 0.10);  /* 바텀시트 */
```

---

## 6. 레이아웃 (Layout)

```css
/* 모바일 컨테이너 */
--layout-max-width: 390px;   /* iPhone 14 기준 */
--layout-min-height: 100vh;

/* Header */
--header-height: 56px;
--header-padding: 0 20px;

/* Bottom CTA 버튼 영역 */
--cta-area-padding-bottom: 32px; /* Safe area 고려 */
--cta-btn-height: 56px;
--cta-btn-width: 100%;           /* 좌우 패딩 20px 적용 후 full */
```

---

## 7. 컴포넌트 스펙

### Header
```
높이: 56px
배경: #FFFFFF
로고: 텍스트 + 아이콘 조합
  - 텍스트: "바른케어플러스" — font-size: 15px, font-weight: 700
  - 아이콘 색상: --color-accent-orange (하트/케어 아이콘)
정렬: center (수평 중앙)
하단 구분선: 없음 (페이지 배경색으로 구분)
```

### HeroCard
```
배경색: --color-primary (진한 녹색 #2D7A4F)
Border-radius: --radius-lg (16px)
내부 이미지: 일러스트 (간병사 + 노인)
높이: ~180px
좌우 여백: 20px (페이지 패딩 적용)
```

### HeroContent
```
타이틀: font-size: 22px, font-weight: 700, color: --color-text-primary
설명: font-size: 14px, font-weight: 400, color: --color-text-secondary
타이틀-설명 간격: 8px
상단 여백: 24px
```

### MenuItem (메뉴 아이템 카드)
```
배경: #FFFFFF
Border: 1px solid --color-border
Border-radius: --radius-md (12px)
패딩: 16px
높이: 56px
아이콘 영역: 32px × 32px, 좌측
텍스트: font-size: 14px, font-weight: 500, color: --color-text-primary
화살표(>): 우측 정렬, color: --color-text-secondary
아이템 간 간격: 8px
```

### CTAButton (주요 액션 버튼)
```
배경: --color-primary (#2D7A4F)
텍스트: font-size: 16px, font-weight: 600, color: #FFFFFF
높이: 56px
Border-radius: --radius-btn (12px)
좌우 마진: 20px (또는 full width with padding)
활성 상태: --color-primary
비활성 상태: --color-disabled-bg (#CCCCCC)
프레스 상태: --color-primary-dark (#1F5E3A)
하단 여백: 32px (safe area 고려)
```

### TextInput (인풋 필드)
```
배경: #FFFFFF (포커스 전) / #FFFFFF (포커스 후)
Border: 1px solid --color-border (#E0E0E0)
Border 포커스: 1px solid --color-border-active (#2D7A4F)
Border-radius: --radius-sm (8px)
높이: 52px
패딩: 14px 16px
font-size: 16px
font-weight: 400
Placeholder color: --color-text-placeholder (#AAAAAA)
입력값 color: --color-text-primary (#1A1A1A)
```

### GenderButton (성별 토글)
```
컨테이너: flex row, gap: 8px
버튼 크기: 각 50% width, 48px height
Border-radius: --radius-full (9999px) — pill 형태

[비활성 상태]
배경: #FFFFFF
Border: 1px solid --color-border (#E0E0E0)
텍스트: font-size: 16px, color: --color-text-secondary

[활성 상태]
배경: #FFFFFF
Border: 2px solid --color-primary (#2D7A4F)
텍스트: font-size: 16px, font-weight: 600, color: --color-primary
```

### SelectBox (날짜 드롭다운)
```
컨테이너: flex row, gap: 8px (년/월/일 3등분)
배경: #FFFFFF
Border: 1px solid --color-border
Border-radius: --radius-sm (8px)
높이: 48px
패딩: 12px
화살표 아이콘: ▾ 우측 정렬, color: --color-text-secondary
font-size: 14px
Placeholder color: --color-text-placeholder
```

### CheckList (필수 서류 체크리스트)
```
배경: --color-bg-page (#F5F5F5)
Border-radius: --radius-md (12px)
패딩: 16px
아이템 간격: 10px
체크 아이콘: ✓ — color: --color-check-active or --color-check-inactive
텍스트: font-size: 13px, color: --color-text-secondary
```

### BottomSheet / 약관동의 패널
```
배경: #FFFFFF
Border-radius: --radius-xl (20px) — 상단만 적용
상단 패딩: 24px
좌우 패딩: 20px
하단 패딩: 40px (safe area)
딤 처리: rgba(0,0,0,0.3)

[전체동의 행]
높이: 52px
Border: 1px solid --color-border
Border-radius: --radius-sm (8px)
배경: #FFFFFF (비활성) / #F0F9F4 (활성, 연한 그린)
체크 아이콘: --color-check-active

[개별 항목 행]
높이: 44px
Border 없음
텍스트: font-size: 14px
화살표(>): 우측 정렬, color: --color-text-secondary

[버튼 영역]
flex row, gap: 12px

[뒤로 버튼]
배경: #CCCCCC
텍스트: #FFFFFF
flex: 1

[다음 버튼]
배경: --color-primary
텍스트: #FFFFFF
flex: 2
```

### 완료 화면 카드 (서비스 신청 완료)
```
배경: #FFFFFF
Border-radius: --radius-md (12px)
패딩: 24px
내부 구분선: 1px solid --color-border (이름/연락처 위)
텍스트 정렬: 이름, 연락처 → 키: 좌측, 값: 우측 (space-between)
font-size: 14px
메시지 텍스트: 중앙 정렬, font-size: 14px, color: --color-text-secondary, line-height: 1.7
```

---

## 8. 섹션 타이틀 스타일 (청구 프로세스 등)

```
번호 포함 소제목: e.g. "1. 간병인 등록 및 매칭"
font-size: 16px ~ 18px
font-weight: 600
color: --color-text-primary
하단 여백: 8px
상단 여백 (섹션 간): 24px

섹션 구분선: 1px solid --color-border, margin-bottom: 16px (제목 하단)

본문: font-size: 14px, line-height: 1.7, color: --color-text-secondary
```

---

## 9. 아이콘

- 스타일: **Outline / Line** 계열 (Heroicons, Phosphor Icons 권장)
- 크기: `20px` (메뉴 아이콘), `16px` (인라인 아이콘), `14px` (체크 아이콘)
- 색상: 컨텍스트에 따라 `--color-primary` 또는 `--color-text-secondary`
- 메뉴 아이템 아이콘: 컬러 (멀티 컬러 이모지형), 사이즈 24~28px

---

## 10. 전체 페이지 구조 패턴

```
MobileLayout
  max-width: 390px
  margin: 0 auto
  min-height: 100vh
  background: --color-bg-page (#F5F5F5)
  font-family: --font-base
  position: relative

  > Header (fixed or static, height: 56px, bg: #FFFFFF)
  > PageContent (padding: 0 20px, padding-top: 16px)
  > BottomCTA (position: fixed or sticky bottom, padding: 0 20px 32px)
```

---

## 11. CSS 변수 전체 요약

```css
:root {
  /* Colors */
  --color-primary:          #2D7A4F;
  --color-primary-dark:     #1F5E3A;
  --color-primary-bg:       #E8F5EE;
  --color-accent-orange:    #F4845F;
  --color-text-primary:     #1A1A1A;
  --color-text-secondary:   #555555;
  --color-text-placeholder: #AAAAAA;
  --color-text-white:       #FFFFFF;
  --color-bg-page:          #F5F5F5;
  --color-bg-card:          #FFFFFF;
  --color-border:           #E0E0E0;
  --color-border-active:    #2D7A4F;
  --color-disabled-bg:      #CCCCCC;
  --color-check-active:     #2D7A4F;
  --color-check-inactive:   #AAAAAA;

  /* Typography */
  --font-base:        'Noto Sans KR', sans-serif;
  --text-xs:          12px;
  --text-sm:          13px;
  --text-base:        14px;
  --text-md:          15px;
  --text-lg:          16px;
  --text-xl:          18px;
  --text-2xl:         22px;
  --text-3xl:         26px;
  --font-regular:     400;
  --font-medium:      500;
  --font-semibold:    600;
  --font-bold:        700;
  --leading-tight:    1.3;
  --leading-normal:   1.5;
  --leading-relaxed:  1.7;

  /* Spacing */
  --space-1:  4px;
  --space-2:  8px;
  --space-3:  12px;
  --space-4:  16px;
  --space-5:  20px;
  --space-6:  24px;
  --space-8:  32px;
  --space-10: 40px;
  --space-12: 48px;

  /* Border Radius */
  --radius-sm:   8px;
  --radius-md:   12px;
  --radius-lg:   16px;
  --radius-xl:   20px;
  --radius-full: 9999px;
  --radius-btn:  12px;

  /* Shadow */
  --shadow-sm:   0 1px 3px rgba(0, 0, 0, 0.06);
  --shadow-md:   0 2px 8px rgba(0, 0, 0, 0.08);
  --shadow-lg:   0 4px 16px rgba(0, 0, 0, 0.10);

  /* Layout */
  --layout-max-width:  390px;
  --header-height:     56px;
  --cta-btn-height:    56px;
  --page-padding-x:    20px;
}
```

---

## 12. 주의사항 & 공통 규칙

1. **Safe Area**: iOS 홈 인디케이터 영역 고려 → `padding-bottom: env(safe-area-inset-bottom)` 또는 최소 32px 확보
2. **터치 타겟**: 최소 44px × 44px 이상 유지 (버튼, 메뉴 아이템, 체크박스)
3. **폰트 로딩**: Noto Sans KR은 Google Fonts CDN 사용 (`weights: 400, 500, 600, 700`)
4. **인풋 zoom 방지**: `font-size: 16px` 이상으로 설정 (iOS 자동 줌 방지)
5. **색상 일관성**: 그린 계열은 `#2D7A4F` 단일 값만 사용 (다른 그린 혼용 금지)
6. **비활성 버튼**: opacity 사용하지 않고 `--color-disabled-bg` 배경색으로 처리
