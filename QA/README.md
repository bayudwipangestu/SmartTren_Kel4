# SmartTren QA & Application Discovery Documentation

Folder ini berisi seluruh hasil **Application Discovery** dan **QA Automation Testing** untuk aplikasi web **SmartTren (SmartTren_Kel4)**.

## Struktur Folder

- `discovery/`
  - `SmartTren_Application_Discovery_Report.docx` — Laporan analisis sistem, modul, role, alur bisnis, dan aturan bisnis aktual.
  - `SmartTren_Feature_and_QA_Requirements.xlsx` — Inventaris fitur & matriks kebutuhan pengujian QA (dengan filter & traceability ID).
  - `Discovery_Data_SmartTren.json` — Data discovery terstruktur.
  - `diagrams/` — Diagram Mermaid (`application_flow.mmd`, `erd_smarttren.mmd`).
- `tests/`
  - `qa_automation.mjs` — Skrip pengujian otomatis menggunakan Playwright.
- `screenshots/`
  - Bukti screenshot aktual format PNG dengan penamaan `TC_ID_ROLE_FEATURE_STATUS.png`.
- `results/`
  - `test-results.json` — Hasil eksekusi seluruh test case dalam format JSON.
  - `bug-report.json` — Daftar bug terverifikasi dalam format JSON.
  - `qa-summary.html` — Ringkasan hasil pengujian dalam format HTML.
  - `browser-logs.json` — Catatan console error dan HTTP 500 dari browser.
- `reports/`
  - `Website_QA_Testing_Report.docx` — Laporan resmi hasil QA Testing lengkap dengan statistik, bug report, dan screenshot bukti.
  - `Website_User_Tutorial.docx` — Panduan penggunaan aplikasi untuk role Admin, Pengurus, dan Mahasantri.

## Ringkasan Hasil Pengujian Terbaru

- **Total Test Case**: 27
- **Passed**: 25
- **Failed**: 2
- **Pass Rate**: 92.6%
- **Total Bug Ditemukan**: 8 (2 Critical, 5 High, 1 Medium)
