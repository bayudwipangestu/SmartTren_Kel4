import { chromium } from 'playwright';
import fs from 'fs';
import path from 'path';

const BASE_URL = 'http://127.0.0.1:8011';
const SCREENSHOT_DIR = path.resolve('QA/screenshots');
const RESULTS_DIR = path.resolve('QA/results');

fs.mkdirSync(SCREENSHOT_DIR, { recursive: true });
fs.mkdirSync(RESULTS_DIR, { recursive: true });

const results = [];
const bugs = [];
const consoleErrors = [];
const httpErrors = [];

function recordResult({
  tcId,
  moduleId,
  featureId,
  reqId,
  pageName,
  role,
  objective,
  testType,
  expected,
  actual,
  status,
  screenshot,
  notes = ''
}) {
  console.log(`[${tcId}] ${status} - ${pageName}`);
  results.push({
    testCaseId: tcId,
    moduleId,
    featureId,
    requirementId: reqId,
    page: pageName,
    role,
    testObjective: objective,
    testType,
    expectedResult: expected,
    actualResult: actual,
    status,
    screenshotReference: screenshot,
    executionDate: new Date().toISOString(),
    notes
  });
}

async function run() {
  console.log('Launching browser for Regression & Re-Testing...');
  const browser = await chromium.launch({ headless: true, channel: 'msedge', args: ['--no-proxy-server', '--disable-gpu', '--no-sandbox'] });
  console.log('Browser launched!');

  async function newPageWithListeners(viewport = { width: 1366, height: 768 }) {
    const context = await browser.newContext({ viewport });
    const page = await context.newPage();
    page.setDefaultNavigationTimeout(45000);
    page.setDefaultTimeout(45000);
    page.on('console', (msg) => {
      if (msg.type() === 'error') {
        consoleErrors.push({ url: page.url(), text: msg.text() });
      }
    });
    page.on('response', (res) => {
      if (res.status() >= 500) {
        httpErrors.push({ url: res.url(), status: res.status() });
      }
    });
    return { context, page };
  }

  async function snap(page, filename) {
    const fullPath = path.join(SCREENSHOT_DIR, filename);
    await page.screenshot({ path: fullPath, fullPage: true });
    return `QA/screenshots/${filename}`;
  }

  async function loginAs(page, email, password) {
    await page.goto(`${BASE_URL}/login`, { waitUntil: 'domcontentloaded' });
    await page.fill('input[name="email"]', email);
    await page.fill('input[name="password"]', password);
    await Promise.all([
      page.waitForNavigation({ waitUntil: 'domcontentloaded' }),
      page.click('button[type="submit"]')
    ]);
  }

  let tc005Pass = false, tc009Pass = false, tc016Pass = false, tc017Pass = false, tc018Pass = false, tc024Pass = false;
  let ss005 = '', ss009 = '', ss016 = '', ss017 = '', ss018 = '', ss024 = '';

  try {
    // =========================================================================
    // 1. PUBLIC & AUTHENTICATION TESTING
    // =========================================================================
    {
      const { context, page } = await newPageWithListeners();
      const res = await page.goto(`${BASE_URL}/`, { waitUntil: 'domcontentloaded' });
      const st01 = res.status() === 200 ? 'PASS' : 'FAIL';
      const ss = await snap(page, `TC001_PUBLIC_WELCOME_STEP01_${st01}.png`);
      const title = await page.title();
      recordResult({
        tcId: 'TC-001',
        moduleId: 'MOD-PUB',
        featureId: 'FEAT-PUB-01',
        reqId: 'REQ-PUB-01',
        pageName: 'Welcome Page (/)',
        role: 'Public',
        objective: 'Memverifikasi halaman utama aplikasi dapat diakses dan dirender dengan benar.',
        testType: 'Functional & UI',
        expected: 'HTTP 200, halaman welcome tampil tanpa error.',
        actual: `HTTP ${res.status()}, judul halaman "${title}".`,
        status: st01,
        screenshot: ss
      });

      const resLogin = await page.goto(`${BASE_URL}/login`, { waitUntil: 'domcontentloaded' });
      const hasEmail = await page.locator('input[name="email"]').count();
      const hasPass = await page.locator('input[name="password"]').count();
      const st02 = resLogin.status() === 200 && hasEmail > 0 && hasPass > 0 ? 'PASS' : 'FAIL';
      const ssLogin = await snap(page, `TC002_PUBLIC_LOGIN_PAGE_${st02}.png`);
      recordResult({
        tcId: 'TC-002',
        moduleId: 'MOD-AUTH',
        featureId: 'FEAT-AUTH-01',
        reqId: 'REQ-AUTH-01',
        pageName: 'Login (/login)',
        role: 'Public',
        objective: 'Memverifikasi form login tersedia dengan field email dan password.',
        testType: 'Functional',
        expected: 'Halaman login tampil dengan input email, password, dan tombol submit.',
        actual: `HTTP ${resLogin.status()}, email input: ${hasEmail}, password input: ${hasPass}.`,
        status: st02,
        screenshot: ssLogin
      });

      await page.fill('input[name="email"]', 'salah@smarttren.test');
      await page.fill('input[name="password"]', 'passwordsalah');
      await Promise.all([
        page.waitForNavigation({ waitUntil: 'domcontentloaded' }),
        page.click('button[type="submit"]')
      ]);
      const bodyText = await page.textContent('body');
      const hasErrorMsg = bodyText.includes('These credentials do not match') || bodyText.includes('credentials');
      const st03 = page.url().includes('/login') && hasErrorMsg ? 'PASS' : 'FAIL';
      const ssFailLogin = await snap(page, `TC003_PUBLIC_LOGIN_INVALID_${st03}.png`);
      recordResult({
        tcId: 'TC-003',
        moduleId: 'MOD-AUTH',
        featureId: 'FEAT-AUTH-01',
        reqId: 'REQ-AUTH-02',
        pageName: 'Login (/login)',
        role: 'Public',
        objective: 'Memverifikasi sistem menolak login dengan kredensial tidak valid.',
        testType: 'Negative',
        expected: 'Login gagal, tetap di halaman /login dengan pesan error validasi.',
        actual: `URL saat ini: ${page.url()}, pesan error tampil: ${hasErrorMsg}.`,
        status: st03,
        screenshot: ssFailLogin
      });

      const resAdminGuest = await page.goto(`${BASE_URL}/admin/dashboard`, { waitUntil: 'domcontentloaded' });
      const st04 = page.url().includes('/login') ? 'PASS' : 'FAIL';
      const ssAdminGuest = await snap(page, `TC004_PUBLIC_AUTH_GUARD_ADMIN_${st04}.png`);
      recordResult({
        tcId: 'TC-004',
        moduleId: 'MOD-AUTH',
        featureId: 'FEAT-AUTH-02',
        reqId: 'REQ-SEC-01',
        pageName: 'Admin Dashboard (/admin/dashboard)',
        role: 'Public (Unauthenticated)',
        objective: 'Memverifikasi halaman admin tidak dapat diakses tanpa login.',
        testType: 'Security / Authorization',
        expected: 'Pengguna diarahkan ke halaman /login.',
        actual: `Status: ${resAdminGuest.status()}, diarahkan ke URL: ${page.url()}.`,
        status: st04,
        screenshot: ssAdminGuest
      });

      // TC-005: Retest BUG-001
      const resMhsGuest = await page.goto(`${BASE_URL}/mahasantri/dashboard`, { waitUntil: 'domcontentloaded' });
      tc005Pass = page.url().includes('/login');
      const st05 = tc005Pass ? 'PASS' : 'FAIL';
      ss005 = await snap(page, `TC005_PUBLIC_AUTH_GUARD_MAHASANTRI_${st05}.png`);
      recordResult({
        tcId: 'TC-005',
        moduleId: 'MOD-AUTH',
        featureId: 'FEAT-AUTH-02',
        reqId: 'REQ-SEC-02',
        pageName: 'Mahasantri Dashboard (/mahasantri/dashboard)',
        role: 'Public (Unauthenticated)',
        objective: '[Retest BUG-001] Memverifikasi halaman mahasantri tidak dapat diakses tanpa login.',
        testType: 'Security / Authorization (Retest)',
        expected: 'Pengguna diarahkan ke halaman /login.',
        actual: tc005Pass ? `Status: ${resMhsGuest.status()}, diarahkan ke URL: ${page.url()}.` : `Gagal redirect, status: ${resMhsGuest.status()}, URL: ${page.url()}.`,
        status: st05,
        screenshot: ss005
      });

      await context.close();
    }

    // =========================================================================
    // 2. ADMIN ROLE TESTING
    // =========================================================================
    {
      const { context, page } = await newPageWithListeners();
      await loginAs(page, 'admin@smarttren.test', 'password');
      const dashText = await page.textContent('body');
      const st06 = page.url().includes('/admin/dashboard') ? 'PASS' : 'FAIL';
      const ssDash = await snap(page, `TC006_ADMIN_DASHBOARD_${st06}.png`);
      recordResult({
        tcId: 'TC-006',
        moduleId: 'MOD-ADM',
        featureId: 'FEAT-ADM-01',
        reqId: 'REQ-ADM-01',
        pageName: 'Dashboard Admin (/admin/dashboard)',
        role: 'Admin',
        objective: 'Memverifikasi login Admin berhasil dan diarahkan ke Dashboard Admin.',
        testType: 'Functional',
        expected: 'Diarahkan ke /admin/dashboard dan menampilkan nama Admin SmartTren.',
        actual: `URL: ${page.url()}, teks "Dashboard Admin" tampil: ${dashText.includes('Dashboard Admin')}.`,
        status: st06,
        screenshot: ssDash
      });

      const resUsers = await page.goto(`${BASE_URL}/admin/users`, { waitUntil: 'domcontentloaded' });
      const usersText = await page.textContent('body');
      const st07 = resUsers.status() === 200 && usersText.includes('Admin SmartTren') ? 'PASS' : 'FAIL';
      const ssUsers = await snap(page, `TC007_ADMIN_USERS_INDEX_${st07}.png`);
      recordResult({
        tcId: 'TC-007',
        moduleId: 'MOD-ADM',
        featureId: 'FEAT-ADM-02',
        reqId: 'REQ-ADM-02',
        pageName: 'Manajemen User (/admin/users)',
        role: 'Admin',
        objective: 'Memverifikasi halaman daftar pengguna tampil untuk Admin.',
        testType: 'Functional',
        expected: 'HTTP 200, daftar pengguna tampil beserta tombol tambah/edit/hapus.',
        actual: `HTTP ${resUsers.status()}, menampilkan user Admin SmartTren: ${usersText.includes('Admin SmartTren')}.`,
        status: st07,
        screenshot: ssUsers
      });

      const resUserCreate = await page.goto(`${BASE_URL}/admin/users/create`, { waitUntil: 'domcontentloaded' });
      const st08 = resUserCreate.status() === 200 ? 'PASS' : 'FAIL';
      const ssUserCreate = await snap(page, `TC008_ADMIN_USERS_CREATE_${st08}.png`);
      recordResult({
        tcId: 'TC-008',
        moduleId: 'MOD-ADM',
        featureId: 'FEAT-ADM-02',
        reqId: 'REQ-ADM-03',
        pageName: 'Tambah User (/admin/users/create)',
        role: 'Admin',
        objective: 'Memverifikasi form tambah user tampil dengan field nama, email, password, role.',
        testType: 'Functional',
        expected: 'HTTP 200, form tambah user tampil.',
        actual: `HTTP ${resUserCreate.status()}, URL: ${page.url()}.`,
        status: st08,
        screenshot: ssUserCreate
      });

      // TC-009: Retest BUG-006
      const resMhs = await page.goto(`${BASE_URL}/admin/mahasantri`, { waitUntil: 'domcontentloaded' });
      tc009Pass = resMhs.status() === 200;
      const st09 = tc009Pass ? 'PASS' : 'FAIL';
      ss009 = await snap(page, `TC009_ADMIN_MAHASANTRI_INDEX_${st09}.png`);
      recordResult({
        tcId: 'TC-009',
        moduleId: 'MOD-ADM',
        featureId: 'FEAT-ADM-03',
        reqId: 'REQ-ADM-04',
        pageName: 'Data Mahasantri (/admin/mahasantri)',
        role: 'Admin',
        objective: '[Retest BUG-006] Memverifikasi halaman daftar mahasantri dapat diakses oleh Admin.',
        testType: 'Functional (Retest)',
        expected: 'HTTP 200, halaman daftar mahasantri tampil.',
        actual: `HTTP ${resMhs.status()}, URL: ${page.url()}.`,
        status: st09,
        screenshot: ss009
      });

      const resMhsCreate = await page.goto(`${BASE_URL}/admin/mahasantri/create`, { waitUntil: 'domcontentloaded' });
      const st10 = resMhsCreate.status() === 200 ? 'PASS' : 'FAIL';
      const ssMhsCreate = await snap(page, `TC010_ADMIN_MAHASANTRI_CREATE_${st10}.png`);
      recordResult({
        tcId: 'TC-010',
        moduleId: 'MOD-ADM',
        featureId: 'FEAT-ADM-03',
        reqId: 'REQ-ADM-05',
        pageName: 'Tambah Mahasantri (/admin/mahasantri/create)',
        role: 'Admin',
        objective: 'Memverifikasi form tambah mahasantri tampil.',
        testType: 'Functional',
        expected: 'HTTP 200, form tambah mahasantri tampil.',
        actual: `HTTP ${resMhsCreate.status()}, URL: ${page.url()}.`,
        status: st10,
        screenshot: ssMhsCreate
      });

      const resKeg = await page.goto(`${BASE_URL}/admin/kegiatan`, { waitUntil: 'domcontentloaded' });
      const kegText = await page.textContent('body');
      const st11 = resKeg.status() === 200 && kegText.includes('Sholat Subuh') ? 'PASS' : 'FAIL';
      const ssKeg = await snap(page, `TC011_ADMIN_KEGIATAN_INDEX_${st11}.png`);
      recordResult({
        tcId: 'TC-011',
        moduleId: 'MOD-ADM',
        featureId: 'FEAT-ADM-04',
        reqId: 'REQ-ADM-06',
        pageName: 'Data Kegiatan (/admin/kegiatan)',
        role: 'Admin',
        objective: 'Memverifikasi halaman daftar kegiatan menampilkan data seeder (Sholat Subuh, dll).',
        testType: 'Functional',
        expected: 'HTTP 200, daftar kegiatan tampil.',
        actual: `HTTP ${resKeg.status()}, menampilkan "Sholat Subuh": ${kegText.includes('Sholat Subuh')}.`,
        status: st11,
        screenshot: ssKeg
      });

      const resAdmToPeng = await page.goto(`${BASE_URL}/pengurus/dashboard`, { waitUntil: 'domcontentloaded' });
      const st12 = resAdmToPeng.status() === 403 ? 'PASS' : 'FAIL';
      const ssAdmToPeng = await snap(page, `TC012_ADMIN_TO_PENGURUS_403_${st12}.png`);
      recordResult({
        tcId: 'TC-012',
        moduleId: 'MOD-AUTH',
        featureId: 'FEAT-AUTH-03',
        reqId: 'REQ-SEC-03',
        pageName: 'Dashboard Pengurus (/pengurus/dashboard)',
        role: 'Admin',
        objective: 'Memverifikasi Admin ditolak saat mengakses halaman khusus Pengurus.',
        testType: 'Security / Authorization',
        expected: 'HTTP 403 Forbidden.',
        actual: `HTTP ${resAdmToPeng.status()}.`,
        status: st12,
        screenshot: ssAdmToPeng
      });

      await context.close();
    }

    // =========================================================================
    // 3. PENGURUS ROLE TESTING
    // =========================================================================
    {
      const { context, page } = await newPageWithListeners();
      await loginAs(page, 'pengurus@smarttren.test', 'password');
      const st13 = page.url().includes('/pengurus/dashboard') ? 'PASS' : 'FAIL';
      const ssDash = await snap(page, `TC013_PENGURUS_DASHBOARD_${st13}.png`);
      recordResult({
        tcId: 'TC-013',
        moduleId: 'MOD-PNG',
        featureId: 'FEAT-PNG-01',
        reqId: 'REQ-PNG-01',
        pageName: 'Dashboard Pengurus (/pengurus/dashboard)',
        role: 'Pengurus',
        objective: 'Memverifikasi login Pengurus berhasil dan diarahkan ke Dashboard Pengurus.',
        testType: 'Functional',
        expected: 'Diarahkan ke /pengurus/dashboard.',
        actual: `URL: ${page.url()}.`,
        status: st13,
        screenshot: ssDash
      });

      const resSesi = await page.goto(`${BASE_URL}/pengurus/sesi-presensi`, { waitUntil: 'domcontentloaded' });
      const st14 = resSesi.status() === 200 ? 'PASS' : 'FAIL';
      const ssSesi = await snap(page, `TC014_PENGURUS_SESI_INDEX_${st14}.png`);
      recordResult({
        tcId: 'TC-014',
        moduleId: 'MOD-PNG',
        featureId: 'FEAT-PNG-02',
        reqId: 'REQ-PNG-02',
        pageName: 'Sesi Presensi (/pengurus/sesi-presensi)',
        role: 'Pengurus',
        objective: 'Memverifikasi halaman daftar sesi presensi tampil.',
        testType: 'Functional',
        expected: 'HTTP 200, daftar sesi presensi tampil.',
        actual: `HTTP ${resSesi.status()}.`,
        status: st14,
        screenshot: ssSesi
      });

      const resSesiCreate = await page.goto(`${BASE_URL}/pengurus/sesi-presensi/create`, { waitUntil: 'domcontentloaded' });
      const st15 = resSesiCreate.status() === 200 ? 'PASS' : 'FAIL';
      const ssSesiCreate = await snap(page, `TC015_PENGURUS_SESI_CREATE_${st15}.png`);
      recordResult({
        tcId: 'TC-015',
        moduleId: 'MOD-PNG',
        featureId: 'FEAT-PNG-02',
        reqId: 'REQ-PNG-03',
        pageName: 'Buat Sesi Presensi (/pengurus/sesi-presensi/create)',
        role: 'Pengurus',
        objective: 'Memverifikasi form pembuatan sesi presensi dapat dibuka.',
        testType: 'Functional',
        expected: 'HTTP 200, form pilih kegiatan, tanggal, jam mulai, jam selesai, dan status tampil.',
        actual: `HTTP ${resSesiCreate.status()}.`,
        status: st15,
        screenshot: ssSesiCreate
      });

      // TC-016: Retest BUG-007
      const resRekapSesi = await page.goto(`${BASE_URL}/pengurus/presensi/1/rekap`, { waitUntil: 'domcontentloaded' });
      tc016Pass = resRekapSesi.status() === 200;
      const st16 = tc016Pass ? 'PASS' : 'FAIL';
      ss016 = await snap(page, `TC016_PENGURUS_REKAP_SESI_${st16}.png`);
      recordResult({
        tcId: 'TC-016',
        moduleId: 'MOD-PNG',
        featureId: 'FEAT-PNG-03',
        reqId: 'REQ-PNG-04',
        pageName: 'Rekap Sesi Presensi (/pengurus/presensi/1/rekap)',
        role: 'Pengurus',
        objective: '[Retest BUG-007] Memverifikasi halaman rekap presensi per sesi dapat diakses.',
        testType: 'Functional (Retest)',
        expected: 'HTTP 200, halaman rekap sesi presensi tampil.',
        actual: `HTTP ${resRekapSesi.status()}.`,
        status: st16,
        screenshot: ss016
      });

      // TC-017: Retest BUG-002 (Daftar Presensi)
      const resPresensiIdx = await page.goto(`${BASE_URL}/pengurus/presensi`, { waitUntil: 'domcontentloaded' });
      tc017Pass = resPresensiIdx.status() === 200;
      const st17 = tc017Pass ? 'PASS' : 'FAIL';
      ss017 = await snap(page, `TC017_PENGURUS_PRESENSI_INDEX_${st17}.png`);
      recordResult({
        tcId: 'TC-017',
        moduleId: 'MOD-PNG',
        featureId: 'FEAT-PNG-04',
        reqId: 'REQ-PNG-05',
        pageName: 'Daftar Presensi (/pengurus/presensi)',
        role: 'Pengurus',
        objective: '[Retest BUG-002] Memverifikasi halaman daftar presensi pengurus dapat diakses.',
        testType: 'Functional (Retest)',
        expected: 'HTTP 200, halaman daftar presensi tampil.',
        actual: `HTTP ${resPresensiIdx.status()}.`,
        status: st17,
        screenshot: ss017
      });

      // TC-018: Retest BUG-002 (Laporan Kegiatan)
      const resLapKeg = await page.goto(`${BASE_URL}/pengurus/laporan-kegiatan`, { waitUntil: 'domcontentloaded' });
      tc018Pass = resLapKeg.status() === 200;
      const st18 = tc018Pass ? 'PASS' : 'FAIL';
      ss018 = await snap(page, `TC018_PENGURUS_LAPORAN_KEGIATAN_${st18}.png`);
      recordResult({
        tcId: 'TC-018',
        moduleId: 'MOD-PNG',
        featureId: 'FEAT-PNG-05',
        reqId: 'REQ-PNG-06',
        pageName: 'Laporan Kegiatan (/pengurus/laporan-kegiatan)',
        role: 'Pengurus',
        objective: '[Retest BUG-002] Memverifikasi halaman laporan kegiatan dapat diakses oleh Pengurus.',
        testType: 'Functional (Retest)',
        expected: 'HTTP 200, halaman laporan kegiatan tampil.',
        actual: `HTTP ${resLapKeg.status()}.`,
        status: st18,
        screenshot: ss018
      });

      // TC-026: Regression Baru - Laporan Presensi
      const resLapPres = await page.goto(`${BASE_URL}/pengurus/laporan-presensi`, { waitUntil: 'domcontentloaded' });
      const st26 = resLapPres.status() === 200 ? 'PASS' : 'FAIL';
      const ss26 = await snap(page, `TC026_PENGURUS_LAPORAN_PRESENSI_${st26}.png`);
      recordResult({
        tcId: 'TC-026',
        moduleId: 'MOD-PNG',
        featureId: 'FEAT-PNG-05',
        reqId: 'REQ-PNG-07',
        pageName: 'Laporan Presensi (/pengurus/laporan-presensi)',
        role: 'Pengurus',
        objective: 'Memverifikasi halaman laporan presensi dengan filter periode tampil.',
        testType: 'Functional (Regression)',
        expected: 'HTTP 200, halaman laporan presensi tampil.',
        actual: `HTTP ${resLapPres.status()}.`,
        status: st26,
        screenshot: ss26
      });

      // TC-027: Regression Baru - Scanner QR
      const resScanner = await page.goto(`${BASE_URL}/pengurus/presensi/1/scanner`, { waitUntil: 'domcontentloaded' });
      const st27 = resScanner.status() === 200 ? 'PASS' : 'FAIL';
      const ss27 = await snap(page, `TC027_PENGURUS_SCANNER_QR_${st27}.png`);
      recordResult({
        tcId: 'TC-027',
        moduleId: 'MOD-PNG',
        featureId: 'FEAT-PNG-04',
        reqId: 'REQ-PNG-08',
        pageName: 'Scanner QR (/pengurus/presensi/1/scanner)',
        role: 'Pengurus',
        objective: 'Memverifikasi halaman scanner QR sesi presensi dapat dibuka.',
        testType: 'Functional (Regression)',
        expected: 'HTTP 200, halaman scanner QR tampil.',
        actual: `HTTP ${resScanner.status()}.`,
        status: st27,
        screenshot: ss27
      });

      const resPengToAdm = await page.goto(`${BASE_URL}/admin/dashboard`, { waitUntil: 'domcontentloaded' });
      const st19 = resPengToAdm.status() === 403 ? 'PASS' : 'FAIL';
      const ssPengToAdm = await snap(page, `TC019_PENGURUS_TO_ADMIN_403_${st19}.png`);
      recordResult({
        tcId: 'TC-019',
        moduleId: 'MOD-AUTH',
        featureId: 'FEAT-AUTH-03',
        reqId: 'REQ-SEC-04',
        pageName: 'Dashboard Admin (/admin/dashboard)',
        role: 'Pengurus',
        objective: 'Memverifikasi Pengurus ditolak saat mengakses halaman khusus Admin.',
        testType: 'Security / Authorization',
        expected: 'HTTP 403 Forbidden.',
        actual: `HTTP ${resPengToAdm.status()}.`,
        status: st19,
        screenshot: ssPengToAdm
      });

      await context.close();
    }

    // =========================================================================
    // 4. MAHASANTRI ROLE TESTING
    // =========================================================================
    {
      const { context, page } = await newPageWithListeners();
      await loginAs(page, 'mahasantri@smarttren.test', 'password');
      const st20 = page.url().includes('/mahasantri/dashboard') ? 'PASS' : 'FAIL';
      const ssDash = await snap(page, `TC020_MAHASANTRI_DASHBOARD_${st20}.png`);
      recordResult({
        tcId: 'TC-020',
        moduleId: 'MOD-MHS',
        featureId: 'FEAT-MHS-01',
        reqId: 'REQ-MHS-01',
        pageName: 'Dashboard Mahasantri (/mahasantri/dashboard)',
        role: 'Mahasantri',
        objective: 'Memverifikasi login Mahasantri berhasil dan diarahkan ke Dashboard Mahasantri.',
        testType: 'Functional',
        expected: 'Diarahkan ke /mahasantri/dashboard dengan sidebar menu dan form pengajuan izin.',
        actual: `URL: ${page.url()}.`,
        status: st20,
        screenshot: ssDash
      });

      const resQr = await page.goto(`${BASE_URL}/mahasantri/presensi`, { waitUntil: 'domcontentloaded' });
      const st21 = resQr.status() === 200 ? 'PASS' : 'FAIL';
      const ssQr = await snap(page, `TC021_MAHASANTRI_QR_PRESENSI_${st21}.png`);
      recordResult({
        tcId: 'TC-021',
        moduleId: 'MOD-MHS',
        featureId: 'FEAT-MHS-02',
        reqId: 'REQ-MHS-02',
        pageName: 'Presensi QR (/mahasantri/presensi)',
        role: 'Mahasantri',
        objective: 'Memverifikasi halaman QR Code presensi mahasantri dapat dibuka.',
        testType: 'Functional',
        expected: 'HTTP 200, halaman tampil.',
        actual: `HTTP ${resQr.status()}.`,
        status: st21,
        screenshot: ssQr
      });

      const resRiwayat = await page.goto(`${BASE_URL}/mahasantri/riwayat-presensi`, { waitUntil: 'domcontentloaded' });
      const st22 = resRiwayat.status() === 200 ? 'PASS' : 'FAIL';
      const ssRiwayat = await snap(page, `TC022_MAHASANTRI_RIWAYAT_${st22}.png`);
      recordResult({
        tcId: 'TC-022',
        moduleId: 'MOD-MHS',
        featureId: 'FEAT-MHS-03',
        reqId: 'REQ-MHS-03',
        pageName: 'Riwayat Presensi (/mahasantri/riwayat-presensi)',
        role: 'Mahasantri',
        objective: 'Memverifikasi halaman riwayat presensi mahasantri dapat diakses.',
        testType: 'Functional',
        expected: 'HTTP 200, tabel riwayat atau pesan kosong tampil.',
        actual: `HTTP ${resRiwayat.status()}.`,
        status: st22,
        screenshot: ssRiwayat
      });

      const resRekap = await page.goto(`${BASE_URL}/mahasantri/rekap-presensi`, { waitUntil: 'domcontentloaded' });
      const st23 = resRekap.status() === 200 ? 'PASS' : 'FAIL';
      const ssRekap = await snap(page, `TC023_MAHASANTRI_REKAP_${st23}.png`);
      recordResult({
        tcId: 'TC-023',
        moduleId: 'MOD-MHS',
        featureId: 'FEAT-MHS-04',
        reqId: 'REQ-MHS-04',
        pageName: 'Rekap Kehadiran (/mahasantri/rekap-presensi)',
        role: 'Mahasantri',
        objective: 'Memverifikasi halaman rekap kehadiran dan filter dapat diakses.',
        testType: 'Functional',
        expected: 'HTTP 200, ringkasan Hadir/Izin/Sakit/Alpa dan form filter tampil.',
        actual: `HTTP ${resRekap.status()}.`,
        status: st23,
        screenshot: ssRekap
      });

      // TC-024: Retest BUG-003
      const resAkun = await page.goto(`${BASE_URL}/mahasantri/akun`, { waitUntil: 'domcontentloaded' });
      tc024Pass = resAkun.status() === 200;
      const st24 = tc024Pass ? 'PASS' : 'FAIL';
      ss024 = await snap(page, `TC024_MAHASANTRI_AKUN_${st24}.png`);
      recordResult({
        tcId: 'TC-024',
        moduleId: 'MOD-MHS',
        featureId: 'FEAT-MHS-06',
        reqId: 'REQ-MHS-06',
        pageName: 'Data Akun (/mahasantri/akun)',
        role: 'Mahasantri',
        objective: '[Retest BUG-003] Memverifikasi halaman Data Akun pada menu sidebar Mahasantri dapat diakses.',
        testType: 'Functional (Retest)',
        expected: 'HTTP 200, form edit profil/akun mahasantri tampil.',
        actual: `HTTP ${resAkun.status()}.`,
        status: st24,
        screenshot: ss024
      });

      await page.setViewportSize({ width: 390, height: 844 });
      await page.goto(`${BASE_URL}/mahasantri/dashboard`, { waitUntil: 'domcontentloaded' });
      const hasOverflow = await page.evaluate(() => document.documentElement.scrollWidth > window.innerWidth);
      const st25 = !hasOverflow ? 'PASS' : 'FAIL';
      const ssMobile = await snap(page, `TC025_MAHASANTRI_DASHBOARD_MOBILE_${st25}.png`);
      recordResult({
        tcId: 'TC-025',
        moduleId: 'MOD-UI',
        featureId: 'FEAT-UI-01',
        reqId: 'REQ-UI-01',
        pageName: 'Dashboard Mahasantri (Viewport Mobile 390x844)',
        role: 'Mahasantri',
        objective: 'Memverifikasi layout responsif pada layar mobile 390x844.',
        testType: 'UI / Responsive',
        expected: 'Layout menyesuaikan ke 1 kolom dan tidak terjadi horizontal overflow.',
        actual: `Horizontal overflow terdeteksi: ${hasOverflow}.`,
        status: st25,
        screenshot: ssMobile
      });

      await context.close();
    }

    // =========================================================================
    // 5. UPDATE BUG REPORT WITH RETEST VERIFICATION STATUS
    // =========================================================================
    const updatedBugs = [
      {
        bugId: 'BUG-001',
        title: 'Duplikasi Route Mahasantri di Luar Middleware Auth & Role',
        module: 'Authentication & Access Control',
        feature: 'Proteksi Route Mahasantri',
        affectedPage: '/mahasantri/dashboard, /mahasantri/presensi, /mahasantri/riwayat-presensi, /mahasantri/rekap-presensi, POST /izin',
        affectedRole: 'Public / Admin / Pengurus / Mahasantri',
        environment: 'Localhost Laravel 12 / Edge (Playwright)',
        severity: 'Critical',
        priority: 'P0',
        classification: 'Confirmed Bug',
        description: 'Sebelumnya pada routes/web.php terdapat duplikasi route mahasantri di luar grup middleware(["auth", "role:mahasantri"]).',
        preconditions: 'Pengguna belum login.',
        stepsToReproduce: ['Buka browser tanpa login.', 'Akses /mahasantri/dashboard.'],
        expectedResult: 'Redirect ke /login.',
        actualResult: tc005Pass ? 'RETEST PASS: Pengguna diarahkan ke /login.' : 'Masih gagal redirect.',
        evidence: ss005,
        technicalObservation: 'routes/web.php telah dibersihkan sehingga seluruh route mahasantri berada dalam grup middleware(["auth", "role:mahasantri"]).',
        suggestedRecommendation: 'Pertahankan struktur middleware saat ini.',
        status: tc005Pass ? 'Verified' : 'Reopened'
      },
      {
        bugId: 'BUG-002',
        title: 'Controller App\\Http\\Controllers\\PresensiController Tidak Ditemukan (Crash pada Route Pengurus)',
        module: 'Pengurus - Presensi & Laporan',
        feature: 'Daftar Presensi, Scanner QR, Laporan Kegiatan, Laporan Presensi',
        affectedPage: '/pengurus/presensi, /pengurus/laporan-kegiatan, /pengurus/laporan-presensi, /pengurus/presensi/{id}/scanner',
        affectedRole: 'Pengurus',
        environment: 'Localhost Laravel 12 / Edge (Playwright)',
        severity: 'Critical',
        priority: 'P0',
        classification: 'Confirmed Bug',
        description: 'Sebelumnya 10 rute pengurus mengarah ke App\\Http\\Controllers\\PresensiController yang tidak ada.',
        preconditions: 'Login sebagai Pengurus.',
        stepsToReproduce: ['Login sebagai Pengurus.', 'Akses /pengurus/presensi dan /pengurus/laporan-kegiatan.'],
        expectedResult: 'HTTP 200, halaman tampil.',
        actualResult: (tc017Pass && tc018Pass) ? 'RETEST PASS: Semua rute merespons HTTP 200.' : 'Masih gagal.',
        evidence: `${ss017}, ${ss018}`,
        technicalObservation: 'PengurusPresensiController telah dilengkapi dan dirujuk dengan benar pada routes/web.php.',
        suggestedRecommendation: 'Pertahankan implementasi controller saat ini.',
        status: (tc017Pass && tc018Pass) ? 'Verified' : 'Reopened'
      },
      {
        bugId: 'BUG-003',
        title: 'View [mahasantri.akun.index] Tidak Ditemukan saat Mengakses Menu Data Akun',
        module: 'Mahasantri - Data Akun',
        feature: 'Pengaturan Data Akun Mahasantri',
        affectedPage: '/mahasantri/akun',
        affectedRole: 'Mahasantri',
        environment: 'Localhost Laravel 12 / Edge (Playwright)',
        severity: 'High',
        priority: 'P1',
        classification: 'Confirmed Bug',
        description: 'Sebelumnya file resources/views/mahasantri/akun/index.blade.php belum tersedia.',
        preconditions: 'Login sebagai Mahasantri.',
        stepsToReproduce: ['Login sebagai Mahasantri.', 'Akses /mahasantri/akun.'],
        expectedResult: 'HTTP 200, form data akun tampil.',
        actualResult: tc024Pass ? 'RETEST PASS: Halaman /mahasantri/akun merespons HTTP 200.' : 'Masih gagal.',
        evidence: ss024,
        technicalObservation: 'View resources/views/mahasantri/akun/index.blade.php sudah tersedia.',
        suggestedRecommendation: 'Pertahankan.',
        status: tc024Pass ? 'Verified' : 'Reopened'
      },
      {
        bugId: 'BUG-004',
        title: 'Ketidakcocokan Foreign Key mahasantri_id pada Mahasantri\\PresensiController',
        module: 'Mahasantri - Riwayat & Rekap Presensi',
        feature: 'Riwayat Presensi & Rekap Kehadiran',
        affectedPage: '/mahasantri/riwayat-presensi, /mahasantri/rekap-presensi',
        affectedRole: 'Mahasantri',
        environment: 'Code Verification + Runtime',
        severity: 'High',
        priority: 'P1',
        classification: 'Confirmed Bug',
        description: 'Sebelumnya query menggunakan Auth::id() alih-alih mahasantri.id.',
        preconditions: 'Login sebagai Mahasantri.',
        stepsToReproduce: ['Periksa Mahasantri\\PresensiController::riwayat() dan rekap().'],
        expectedResult: 'Menggunakan Auth::user()->mahasantri?->id.',
        actualResult: 'VERIFIED FIXED: Controller telah diperbarui menggunakan Auth::user()->mahasantri?->id.',
        evidence: 'app/Http/Controllers/Mahasantri/PresensiController.php baris 24 & 40.',
        technicalObservation: 'Query sudah aman dan menangani kasus user yang belum memiliki record mahasantri.',
        suggestedRecommendation: 'Tambahkan data seeder mahasantri untuk pengujian data isi.',
        status: 'Verified'
      },
      {
        bugId: 'BUG-005',
        title: 'Case-Sensitivity Mismatch Status Presensi & Surat Izin',
        module: 'Mahasantri - Rekap Kehadiran & Pengajuan Izin',
        feature: 'Rekap Kehadiran & Pengajuan Surat Izin',
        affectedPage: '/mahasantri/rekap-presensi, POST /izin',
        affectedRole: 'Mahasantri',
        environment: 'Code Verification + Runtime',
        severity: 'Medium',
        priority: 'P2',
        classification: 'Confirmed Bug',
        description: 'Sebelumnya perhitungan rekap di PHP case-sensitive ("Hadir" vs "hadir") dan SuratIzinController menyimpan "Pending" alih-alih "pending".',
        preconditions: 'Data presensi / surat izin.',
        stepsToReproduce: ['Periksa Mahasantri\\PresensiController::rekap() dan SuratIzinController::store().'],
        expectedResult: 'Perbandingan case-insensitive dan status konsisten lowercase.',
        actualResult: 'VERIFIED FIXED: Menggunakan strtolower() dan status "pending".',
        evidence: 'app/Http/Controllers/Mahasantri/PresensiController.php baris 110-113 & SuratIzinController.php baris 28.',
        technicalObservation: 'Konsistensi case telah diperbaiki.',
        suggestedRecommendation: 'Pertahankan.',
        status: 'Verified'
      },
      {
        bugId: 'BUG-006',
        title: 'View [admin.mahasantri.index] Tidak Ditemukan pada Halaman Data Mahasantri',
        module: 'Admin - Manajemen Mahasantri',
        feature: 'Daftar Data Mahasantri',
        affectedPage: '/admin/mahasantri',
        affectedRole: 'Admin',
        environment: 'Localhost Laravel 12 / Edge (Playwright)',
        severity: 'High',
        priority: 'P1',
        classification: 'Confirmed Bug',
        description: 'Sebelumnya file resources/views/admin/mahasantri/index.blade.php belum tersedia.',
        preconditions: 'Login sebagai Admin.',
        stepsToReproduce: ['Login sebagai Admin.', 'Akses /admin/mahasantri.'],
        expectedResult: 'HTTP 200, daftar mahasantri tampil.',
        actualResult: tc009Pass ? 'RETEST PASS: Halaman /admin/mahasantri merespons HTTP 200.' : 'Masih gagal.',
        evidence: ss009,
        technicalObservation: 'View resources/views/admin/mahasantri/index.blade.php sudah dibuat.',
        suggestedRecommendation: 'Pertahankan.',
        status: tc009Pass ? 'Verified' : 'Reopened'
      },
      {
        bugId: 'BUG-007',
        title: 'Undefined Variable $presensi pada View Rekap Sesi Pengurus',
        module: 'Pengurus - Rekap Presensi Sesi',
        feature: 'Rekap Sesi Presensi',
        affectedPage: '/pengurus/presensi/{id}/rekap',
        affectedRole: 'Pengurus',
        environment: 'Localhost Laravel 12 / Edge (Playwright)',
        severity: 'High',
        priority: 'P1',
        classification: 'Confirmed Bug',
        description: 'Sebelumnya Pengurus\\PresensiController::rekap() hanya mengirim $riwayatPresensi.',
        preconditions: 'Login sebagai Pengurus.',
        stepsToReproduce: ['Login sebagai Pengurus.', 'Buka /pengurus/presensi/1/rekap.'],
        expectedResult: 'HTTP 200, halaman rekap sesi tampil.',
        actualResult: tc016Pass ? 'RETEST PASS: Halaman /pengurus/presensi/1/rekap merespons HTTP 200.' : 'Masih gagal.',
        evidence: ss016,
        technicalObservation: 'Controller sekarang mengirim compact("sesi", "presensi", "riwayatPresensi").',
        suggestedRecommendation: 'Pertahankan.',
        status: tc016Pass ? 'Verified' : 'Reopened'
      }
    ];

    fs.writeFileSync(path.join(RESULTS_DIR, 'test-results.json'), JSON.stringify(results, null, 2));
    fs.writeFileSync(path.join(RESULTS_DIR, 'bug-report.json'), JSON.stringify(updatedBugs, null, 2));
    fs.writeFileSync(path.join(RESULTS_DIR, 'browser-logs.json'), JSON.stringify({ consoleErrors, httpErrors }, null, 2));

    console.log('RETEST_DONE', {
      totalTests: results.length,
      passed: results.filter(r => r.status === 'PASS').length,
      failed: results.filter(r => r.status === 'FAIL').length,
      verifiedBugs: updatedBugs.filter(b => b.status === 'Verified').length
    });
  } finally {
    await browser.close();
  }
}

run().catch((err) => {
  console.error('QA_AUTOMATION_ERROR:', err);
  process.exit(1);
});
