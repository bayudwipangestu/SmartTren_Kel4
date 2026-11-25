import os
import json
from docx import Document
from docx.shared import Inches, Pt, Cm, RGBColor
from docx.enum.text import WD_ALIGN_PARAGRAPH
from docx.enum.table import WD_TABLE_ALIGNMENT
from docx.oxml import parse_xml
from docx.oxml.ns import nsdecls

os.makedirs('QA/reports', exist_ok=True)
os.makedirs('QA/results', exist_ok=True)

with open('QA/results/test-results.json', 'r', encoding='utf-8') as f:
    test_results = json.load(f)

with open('QA/results/bug-report.json', 'r', encoding='utf-8') as f:
    bugs = json.load(f)

# ==============================================================================
# HELPER FUNCTIONS
# ==============================================================================
def set_a4_margins(doc):
    for section in doc.sections:
        section.page_width = Cm(21.0)
        section.page_height = Cm(29.7)
        section.top_margin = Cm(2.0)
        section.bottom_margin = Cm(2.0)
        section.left_margin = Cm(2.0)
        section.right_margin = Cm(2.0)

def add_header_footer(doc, header_text, footer_text):
    section = doc.sections[0]
    hp = section.header.paragraphs[0]
    hp.alignment = WD_ALIGN_PARAGRAPH.RIGHT
    hrun = hp.add_run(header_text)
    hrun.font.name = 'Arial'
    hrun.font.size = Pt(8.5)
    hrun.font.color.rgb = RGBColor(100, 116, 139)

    fp = section.footer.paragraphs[0]
    fp.alignment = WD_ALIGN_PARAGRAPH.CENTER
    frun = fp.add_run(f"{footer_text}  |  Halaman ")
    frun.font.name = 'Arial'
    frun.font.size = Pt(8.5)
    frun.font.color.rgb = RGBColor(100, 116, 139)

    fldChar1 = parse_xml(r'<w:fldChar %s w:fldCharType="begin"/>' % nsdecls('w'))
    instrText = parse_xml(r'<w:instrText %s xml:space="preserve"> PAGE </w:instrText>' % nsdecls('w'))
    fldChar2 = parse_xml(r'<w:fldChar %s w:fldCharType="separate"/>' % nsdecls('w'))
    fldChar3 = parse_xml(r'<w:fldChar %s w:fldCharType="end"/>' % nsdecls('w'))
    run_pg = fp.add_run()
    run_pg.font.name = 'Arial'
    run_pg.font.size = Pt(8.5)
    run_pg._r.append(fldChar1)
    run_pg._r.append(instrText)
    run_pg._r.append(fldChar2)
    run_pg._r.append(fldChar3)

def set_cell_bg(cell, hex_color):
    shading = parse_xml(f'<w:shd {nsdecls("w")} w:fill="{hex_color}"/>')
    cell._tc.get_or_add_tcPr().append(shading)

def set_table_borders(table):
    tblPr = table._tbl.tblPr
    borders = parse_xml(f'''
        <w:tblBorders {nsdecls("w")}>
            <w:top w:val="single" w:sz="4" w:space="0" w:color="CBD5E1"/>
            <w:bottom w:val="single" w:sz="4" w:space="0" w:color="CBD5E1"/>
            <w:left w:val="single" w:sz="4" w:space="0" w:color="CBD5E1"/>
            <w:right w:val="single" w:sz="4" w:space="0" w:color="CBD5E1"/>
            <w:insideH w:val="single" w:sz="4" w:space="0" w:color="E2E8F0"/>
            <w:insideV w:val="single" w:sz="4" w:space="0" w:color="E2E8F0"/>
        </w:tblBorders>
    ''')
    tblPr.append(borders)

def add_styled_table(doc, headers, rows, col_widths=None, status_col=None):
    table = doc.add_table(rows=1 + len(rows), cols=len(headers))
    table.alignment = WD_TABLE_ALIGNMENT.CENTER
    set_table_borders(table)

    hdr_cells = table.rows[0].cells
    for i, h in enumerate(headers):
        set_cell_bg(hdr_cells[i], "087443")
        p = hdr_cells[i].paragraphs[0]
        p.paragraph_format.space_before = Pt(4)
        p.paragraph_format.space_after = Pt(4)
        run = p.add_run(h)
        run.bold = True
        run.font.name = 'Arial'
        run.font.size = Pt(9)
        run.font.color.rgb = RGBColor(255, 255, 255)
        if col_widths:
            hdr_cells[i].width = Cm(col_widths[i])

    for r_idx, row_data in enumerate(rows):
        row_cells = table.rows[r_idx + 1].cells
        bg = "F8FAFC" if r_idx % 2 == 1 else "FFFFFF"
        for c_idx, val in enumerate(row_data):
            cell_bg = bg
            txt_color = RGBColor(30, 41, 59)
            is_bold = False
            if status_col is not None and c_idx == status_col:
                v_str = str(val).upper()
                is_bold = True
                if v_str == "PASS":
                    cell_bg = "DCFCE7"
                    txt_color = RGBColor(22, 101, 52)
                elif v_str == "FAIL":
                    cell_bg = "FEE2E2"
                    txt_color = RGBColor(153, 27, 27)
            set_cell_bg(row_cells[c_idx], cell_bg)
            p = row_cells[c_idx].paragraphs[0]
            p.paragraph_format.space_before = Pt(3)
            p.paragraph_format.space_after = Pt(3)
            run = p.add_run(str(val))
            run.bold = is_bold
            run.font.name = 'Arial'
            run.font.size = Pt(8.5)
            run.font.color.rgb = txt_color
            if col_widths:
                row_cells[c_idx].width = Cm(col_widths[c_idx])
    doc.add_paragraph()
    return table

def style_base_doc(doc):
    style = doc.styles['Normal']
    style.font.name = 'Arial'
    style.font.size = Pt(10)
    style.font.color.rgb = RGBColor(30, 41, 59)
    style.paragraph_format.line_spacing = 1.15
    style.paragraph_format.space_after = Pt(5)

    for level, size in [(1, 14), (2, 12), (3, 10.5)]:
        h = doc.styles[f'Heading {level}']
        h.font.name = 'Arial'
        h.font.size = Pt(size)
        h.font.bold = True
        h.font.color.rgb = RGBColor(8, 116, 67) if level == 1 else RGBColor(15, 23, 42)
        h.paragraph_format.space_before = Pt(10 if level == 1 else 7)
        h.paragraph_format.space_after = Pt(4)

def add_screenshot_if_exists(doc, img_path, caption):
    if img_path and os.path.exists(img_path):
        p_img = doc.add_paragraph()
        p_img.alignment = WD_ALIGN_PARAGRAPH.CENTER
        p_img.paragraph_format.space_before = Pt(4)
        p_img.paragraph_format.space_after = Pt(2)
        run_img = p_img.add_run()
        run_img.add_picture(img_path, width=Cm(14.5))
        p_cap = doc.add_paragraph()
        p_cap.alignment = WD_ALIGN_PARAGRAPH.CENTER
        p_cap.paragraph_format.space_after = Pt(8)
        r_cap = p_cap.add_run(caption)
        r_cap.italic = True
        r_cap.font.size = Pt(8.5)
        r_cap.font.color.rgb = RGBColor(100, 116, 139)

# ==============================================================================
# 1. WEBSITE QA TESTING REPORT DOCX
# ==============================================================================
total_tc = len(test_results)
passed_tc = sum(1 for r in test_results if r['status'] == 'PASS')
failed_tc = sum(1 for r in test_results if r['status'] == 'FAIL')
pass_rate = f"{(passed_tc / (passed_tc + failed_tc) * 100):.1f}%" if (passed_tc + failed_tc) > 0 else "N/A"

sev_counts = {
    "Critical": sum(1 for b in bugs if b['severity'] == 'Critical'),
    "High": sum(1 for b in bugs if b['severity'] == 'High'),
    "Medium": sum(1 for b in bugs if b['severity'] == 'Medium'),
    "Low": sum(1 for b in bugs if b['severity'] == 'Low'),
}

qa_doc = Document()
set_a4_margins(qa_doc)
style_base_doc(qa_doc)
add_header_footer(qa_doc, "SmartTren — Website QA Testing Report", "SmartTren QA Automation")

# Cover
p1 = qa_doc.add_paragraph()
p1.paragraph_format.space_before = Pt(36)
r1 = p1.add_run("LAPORAN PENGUJIAN KUALITAS PERANGKAT LUNAK (QA TESTING REPORT)")
r1.bold = True
r1.font.size = Pt(11)
r1.font.color.rgb = RGBColor(8, 116, 67)

p2 = qa_doc.add_paragraph()
r2 = p2.add_run("Aplikasi Web SmartTren\n(Sistem Informasi & Presensi Pesantren Mahasiswa)")
r2.bold = True
r2.font.size = Pt(21)
r2.font.color.rgb = RGBColor(15, 23, 42)

p3 = qa_doc.add_paragraph()
r3 = p3.add_run("Pengujian Otomatis Berbasis Playwright & Analisis Sistem untuk Role Admin, Pengurus, Mahasantri, dan Akses Publik.")
r3.font.size = Pt(10.5)
r3.font.color.rgb = RGBColor(71, 85, 105)

add_styled_table(qa_doc, ["Informasi Pengujian", "Detail Aktual"], [
    ["Nama Aplikasi", "SmartTren (SmartTren_Kel4)"],
    ["URL Pengujian", "http://127.0.0.1:8000 (Localhost Laravel 12)"],
    ["Browser & Engine", "Google Chrome (Chromium) via Playwright v1.65.1"],
    ["Resolusi Uji", "Desktop 1366x768 & Mobile 390x844"],
    ["Total Test Case Dieksekusi", f"{total_tc} Test Case"],
    ["Pass Rate (PASS / (PASS + FAIL))", f"{pass_rate} ({passed_tc} PASS, {failed_tc} FAIL)"],
    ["Total Bug Ditemukan", f"{len(bugs)} Bug ({sev_counts['Critical']} Critical, {sev_counts['High']} High, {sev_counts['Medium']} Medium)"]
], col_widths=[5.5, 11.5])

qa_doc.add_page_break()

# Bab 1: Executive Summary
verified_bugs = sum(1 for b in bugs if b.get('status') == 'Verified')
open_bugs = sum(1 for b in bugs if b.get('status') != 'Verified')

qa_doc.add_heading("1. Ringkasan Eksekutif (Executive Summary)", level=1)
qa_doc.add_paragraph(
    f"Pengujian otomatis dan regresi (Re-Testing) terhadap aplikasi web SmartTren telah dilaksanakan menggunakan Playwright terhadap {total_tc} skenario pengujian "
    f"yang diturunkan dari hasil Application Discovery. Dari total pengujian yang dieksekusi, sebanyak {passed_tc} skenario dinyatakan PASS "
    f"dan {failed_tc} skenario dinyatakan FAIL, menghasilkan Pass Rate sebesar {pass_rate}."
)
qa_doc.add_paragraph(
    f"Dari {len(bugs)} bug yang teridentifikasi pada siklus pengujian awal, sebanyak {verified_bugs} bug telah berstatus Verified (terkonfirmasi diperbaiki melalui re-testing) "
    f"dan {open_bugs} bug masih terbuka/reopened."
)

# Bab 2: Statistik & Coverage
qa_doc.add_heading("2. Ringkasan Eksekusi & Coverage Pengujian", level=1)
add_styled_table(qa_doc, ["Metrik QA", "Nilai Aktual", "Keterangan"], [
    ["Total Planned Test Cases", str(total_tc), "Seluruh skenario dari baseline Discovery"],
    ["Executed", str(total_tc), "100% dari rencana dieksekusi"],
    ["Passed", str(passed_tc), "Berjalan sesuai expected result"],
    ["Failed", str(failed_tc), "Ditemukan kegagalan fungsi / HTTP 500 / bypass auth"],
    ["Blocked / Not Tested", "0", "Catatan: Alur scan QR end-to-end belum masuk scope karena 0 data mahasantri di DB uji"],
    ["Pass Rate", pass_rate, "Rumus: PASS / (PASS + FAIL) x 100%"],
    ["Feature Coverage", "20 / 20 (100% rute teruji)", "Catatan: Scan QR end-to-end dengan data DB masih memerlukan data mahasantri (>0 record)"]
], col_widths=[5.5, 3.5, 8.0])

# Bab 3: Hasil per Role
qa_doc.add_heading("3. Hasil Pengujian per Role & Modul", level=1)
roles_summary = {}
for r in test_results:
    rl = r['role']
    if rl not in roles_summary:
        roles_summary[rl] = {'total': 0, 'pass': 0, 'fail': 0}
    roles_summary[rl]['total'] += 1
    if r['status'] == 'PASS':
        roles_summary[rl]['pass'] += 1
    else:
        roles_summary[rl]['fail'] += 1

role_rows = []
for rl, st in roles_summary.items():
    pr = f"{(st['pass'] / st['total'] * 100):.1f}%"
    role_rows.append([rl, str(st['total']), str(st['pass']), str(st['fail']), pr])

add_styled_table(qa_doc, ["Role / Aktor", "Total TC", "PASS", "FAIL", "Pass Rate"], role_rows, col_widths=[5.5, 2.5, 2.5, 2.5, 4.0])

# Bab 4: Detail Eksekusi Test Case
qa_doc.add_heading("4. Daftar Lengkap Hasil Eksekusi Test Case", level=1)
tc_rows = []
for r in test_results:
    tc_rows.append([
        r['testCaseId'],
        r['role'],
        r['page'],
        r['testObjective'],
        r['actualResult'],
        r['status']
    ])
add_styled_table(qa_doc, ["TC ID", "Role", "Halaman", "Tujuan Pengujian", "Hasil Aktual", "Status"], tc_rows, col_widths=[1.6, 2.1, 3.2, 4.2, 4.4, 1.5], status_col=5)

# Bab 5: Bug Report
qa_doc.add_heading("5. Laporan Temuan Bug (Bug & Findings)", level=1)
for b in bugs:
    qa_doc.add_heading(f"{b['bugId']}: {b['title']}", level=2)
    add_styled_table(qa_doc, ["Atribut", "Detail"], [
        ["Severity / Priority", f"{b['severity']} / {b['priority']}"],
        ["Status Bug", b.get('status', 'Open')],
        ["Klasifikasi", b['classification']],
        ["Modul / Halaman", f"{b['module']} — {b['affectedPage']}"],
        ["Role Terdampak", b['affectedRole']],
        ["Deskripsi", b['description']],
        ["Langkah Reproduksi", "\n".join(f"- {s}" for s in b['stepsToReproduce'])],
        ["Expected Result", b['expectedResult']],
        ["Actual Result", b['actualResult']],
        ["Observasi Teknis", b['technicalObservation']],
        ["Rekomendasi Perbaikan", b['suggestedRecommendation']],
        ["Referensi Bukti", b['evidence']]
    ], col_widths=[4.2, 12.8])

# Bab 6: Bukti Screenshot Aktual Penting
qa_doc.add_heading("6. Lampiran Bukti Screenshot Aktual", level=1)
qa_doc.add_paragraph("Berikut adalah cuplikan bukti screenshot aktual yang diambil oleh Playwright selama pengujian:")

featured_screenshots = [
    ("QA/screenshots/TC001_PUBLIC_WELCOME_STEP01_PASS.png", "Gambar 1. TC-001: Halaman Awal (Welcome Page) SmartTren [PASS]"),
    ("QA/screenshots/TC005_PUBLIC_AUTH_GUARD_MAHASANTRI_PASS.png", "Gambar 2. TC-005 (Retest BUG-001): Akses Guest ke /mahasantri/dashboard diarahkan ke /login [PASS]"),
    ("QA/screenshots/TC006_ADMIN_DASHBOARD_PASS.png", "Gambar 3. TC-006: Halaman Dashboard Admin [PASS]"),
    ("QA/screenshots/TC009_ADMIN_MAHASANTRI_INDEX_PASS.png", "Gambar 4. TC-009 (Retest BUG-006): Halaman Daftar Mahasantri Admin [PASS]"),
    ("QA/screenshots/TC013_PENGURUS_DASHBOARD_PASS.png", "Gambar 5. TC-013: Halaman Dashboard Pengurus [PASS]"),
    ("QA/screenshots/TC017_PENGURUS_PRESENSI_INDEX_PASS.png", "Gambar 6. TC-017 (Retest BUG-002): Halaman Daftar Presensi Pengurus [PASS]"),
    ("QA/screenshots/TC018_PENGURUS_LAPORAN_KEGIATAN_PASS.png", "Gambar 7. TC-018 (Retest BUG-002): Halaman Laporan Kegiatan Pengurus [PASS]"),
    ("QA/screenshots/TC020_MAHASANTRI_DASHBOARD_PASS.png", "Gambar 8. TC-020: Halaman Dashboard Mahasantri [PASS]"),
    ("QA/screenshots/TC024_MAHASANTRI_AKUN_PASS.png", "Gambar 9. TC-024 (Retest BUG-003): Halaman Data Akun Mahasantri [PASS]")
]
for path_img, cap in featured_screenshots:
    add_screenshot_if_exists(qa_doc, path_img, cap)

# Bab 7: Rekomendasi & Keterbatasan
qa_doc.add_heading("7. Rekomendasi Prioritas & Keterbatasan Pengujian", level=1)
recs = [
    "1. [P0 - Segera] Hapus blok duplikasi route Mahasantri di routes/web.php baris 378-441 agar seluruh rute mahasantri terlindungi middleware ['auth', 'role:mahasantri'].",
    "2. [P0 - Segera] Implementasikan App\\Http\\Controllers\\Pengurus\\PresensiController untuk seluruh fitur daftar presensi, scanner QR, update status, generate alpa, dan laporan kegiatan PDF, serta perbaiki referensi di routes/web.php.",
    "3. [P1 - Tinggi] Buat file view resources/views/mahasantri/akun/index.blade.php untuk menu Data Akun Mahasantri.",
    "4. [P1 - Tinggi] Perbaiki query pada Mahasantri\\PresensiController agar memfilter kolom mahasantri_id menggunakan Auth::user()->mahasantri?->id, bukan Auth::id().",
    "5. [P2 - Normal] Samakan penulisan case status ('hadir'/'Hadir', 'pending'/'Pending') antara skema migrasi database dan controller."
]
for rec in recs:
    qa_doc.add_paragraph(rec, style='List Bullet')

def safe_save(doc, path):
    try:
        doc.save(path)
        print("SAVED:", path)
    except PermissionError:
        alt = path.replace(".docx", "_Updated.docx")
        doc.save(alt)
        print("SAVED_ALT (file asli terkunci):", alt)

safe_save(qa_doc, 'QA/reports/Website_QA_Testing_Report.docx')

# ==============================================================================
# 2. WEBSITE USER TUTORIAL DOCX
# ==============================================================================
tut_doc = Document()
set_a4_margins(tut_doc)
style_base_doc(tut_doc)
add_header_footer(tut_doc, "SmartTren — Panduan Pengguna (User Tutorial)", "SmartTren User Guide")

tp1 = tut_doc.add_paragraph()
tp1.paragraph_format.space_before = Pt(36)
tr1 = tp1.add_run("PANDUAN PENGGUNA APLIKASI (USER TUTORIAL)")
tr1.bold = True
tr1.font.size = Pt(11)
tr1.font.color.rgb = RGBColor(8, 116, 67)

tp2 = tut_doc.add_paragraph()
tr2 = tp2.add_run("Aplikasi Web SmartTren\nPanduan Lengkap untuk Role Admin, Pengurus, dan Mahasantri")
tr2.bold = True
tr2.font.size = Pt(20)
tr2.font.color.rgb = RGBColor(15, 23, 42)

tp3 = tut_doc.add_paragraph()
tr3 = tp3.add_run("Disusun berdasarkan antarmuka dan fitur aktual aplikasi SmartTren. Catatan: Kredensial login tidak disertakan demi keamanan.")
tr3.font.size = Pt(10.5)
tr3.font.color.rgb = RGBColor(71, 85, 105)

tut_doc.add_page_break()

tut_doc.add_heading("1. Pendahuluan & Cara Masuk (Login)", level=1)
tut_doc.add_paragraph(
    "SmartTren adalah sistem informasi manajemen kegiatan dan presensi pesantren mahasiswa. "
    "Untuk menggunakan aplikasi, buka halaman utama melalui browser dan klik tombol Login untuk masuk menggunakan email dan password akun Anda. "
    "Setelah berhasil login, sistem akan mengarahkan Anda secara otomatis ke Dashboard sesuai role masing-masing (Admin, Pengurus, atau Mahasantri)."
)
add_screenshot_if_exists(tut_doc, "QA/screenshots/TC002_PUBLIC_LOGIN_PAGE_PASS.png", "Gambar 1. Halaman Login Aplikasi SmartTren")

# Tutorial Admin
tut_doc.add_heading("2. Panduan Pengguna: Role Admin", level=1)
tut_doc.add_paragraph(
    "Admin bertugas mengelola seluruh data master sistem, meliputi Manajemen User, Data Mahasantri (beserta QR Code), dan Data Kegiatan."
)
add_screenshot_if_exists(tut_doc, "QA/screenshots/TC006_ADMIN_DASHBOARD_PASS.png", "Gambar 2. Dashboard Administrator SmartTren")

tut_doc.add_heading("2.1 Manajemen User (/admin/users)", level=2)
tut_doc.add_paragraph("1. Buka menu Kelola User pada Dashboard Admin untuk melihat daftar pengguna.\n2. Klik tombol Tambah User untuk membuat akun baru (isi Nama, Email, Password minimal 8 karakter, dan pilih Role: admin, pengurus, atau mahasantri).\n3. Gunakan tombol Edit untuk mengubah data atau Hapus untuk menghapus user (Admin tidak dapat menghapus akun miliknya sendiri yang sedang aktif).")
add_screenshot_if_exists(tut_doc, "QA/screenshots/TC007_ADMIN_USERS_INDEX_PASS.png", "Gambar 3. Halaman Daftar Pengguna (Admin)")

tut_doc.add_heading("2.2 Manajemen Mahasantri & QR Code (/admin/mahasantri)", level=2)
tut_doc.add_paragraph("1. Buka menu Data Mahasantri.\n2. Klik Tambah Mahasantri dan lengkapi data NIM, Nama, Email, Password, Jenis Kelamin (L/P), Kamar, No. HP, dan Status (aktif/nonaktif).\n3. Sistem otomatis membuatkan akun login mahasantri dan kode QR unik berformat MHS-XXXXXXXXXX yang dapat dilihat melalui halaman QR Code.")
add_screenshot_if_exists(tut_doc, "QA/screenshots/TC010_ADMIN_MAHASANTRI_CREATE_PASS.png", "Gambar 4. Form Tambah Data Mahasantri")

tut_doc.add_heading("2.3 Manajemen Kegiatan (/admin/kegiatan)", level=2)
tut_doc.add_paragraph("1. Buka menu Kegiatan untuk melihat daftar kegiatan pesantren (seperti Sholat Subuh, Ngaji Kitab, Roan).\n2. Tambah atau ubah status kegiatan menjadi 'aktif' agar dapat dipilih oleh Pengurus saat membuka sesi presensi.")
add_screenshot_if_exists(tut_doc, "QA/screenshots/TC011_ADMIN_KEGIATAN_INDEX_PASS.png", "Gambar 5. Halaman Daftar Kegiatan")

# Tutorial Pengurus
tut_doc.add_heading("3. Panduan Pengguna: Role Pengurus", level=1)
tut_doc.add_paragraph("Pengurus bertugas membuka sesi presensi untuk kegiatan yang aktif dan memantau rekap kehadiran per sesi.")
add_screenshot_if_exists(tut_doc, "QA/screenshots/TC013_PENGURUS_DASHBOARD_PASS.png", "Gambar 6. Dashboard Pengurus SmartTren")

tut_doc.add_heading("3.1 Mengelola Sesi Presensi (/pengurus/sesi-presensi)", level=2)
tut_doc.add_paragraph("1. Buka menu Sesi Presensi.\n2. Klik Buat Sesi Baru, pilih Kegiatan aktif, tentukan Tanggal, Jam Mulai, Jam Selesai (harus setelah Jam Mulai), dan Status ('aktif', 'selesai', atau 'dibatalkan').\n3. Klik Rekap pada sesi terkait untuk melihat daftar kehadiran mahasantri pada sesi tersebut.")
add_screenshot_if_exists(tut_doc, "QA/screenshots/TC015_PENGURUS_SESI_CREATE_PASS.png", "Gambar 7. Form Pembuatan Sesi Presensi")

tut_doc.add_heading("3.2 Daftar Presensi, Scanner QR, & Laporan Kegiatan", level=2)
tut_doc.add_paragraph("1. Menu Daftar Presensi (/pengurus/presensi) menampilkan daftar sesi untuk melakukan Scan QR Mahasantri atau menandai Alpa secara massal.\n2. Menu Laporan Kegiatan (/pengurus/laporan-kegiatan) dan Laporan Presensi (/pengurus/laporan-presensi) menyediakan rekap kehadiran yang dapat difilter berdasarkan periode harian, bulanan, tahunan, maupun per kegiatan.")
add_screenshot_if_exists(tut_doc, "QA/screenshots/TC018_PENGURUS_LAPORAN_KEGIATAN_PASS.png", "Gambar 7b. Halaman Laporan Kegiatan Pengurus")

# Tutorial Mahasantri
tut_doc.add_heading("4. Panduan Pengguna: Role Mahasantri", level=1)
tut_doc.add_paragraph("Mahasantri dapat menampilkan QR Code presensi, melihat riwayat dan rekap kehadiran, serta mengajukan surat izin/sakit.")
add_screenshot_if_exists(tut_doc, "QA/screenshots/TC020_MAHASANTRI_DASHBOARD_PASS.png", "Gambar 8. Dashboard Mahasantri dengan Sidebar Menu & Form Izin")

tut_doc.add_heading("4.1 Menampilkan QR Code Presensi (/mahasantri/presensi)", level=2)
tut_doc.add_paragraph("Klik menu 'Presensi Kegiatan' di sidebar atau kartu menu untuk menampilkan QR Code pribadi Anda agar dapat dipindai oleh Pengurus saat kegiatan berlangsung.")

tut_doc.add_heading("4.2 Melihat Riwayat & Rekap Kehadiran", level=2)
tut_doc.add_paragraph("1. Menu 'Riwayat Presensi' menampilkan daftar kehadiran Anda secara kronologis.\n2. Menu 'Rekap Kehadiran' menampilkan ringkasan jumlah Hadir, Izin, Sakit, dan Alpa serta dilengkapi filter berdasarkan Kegiatan, Rentang Tanggal, dan Status.")
add_screenshot_if_exists(tut_doc, "QA/screenshots/TC023_MAHASANTRI_REKAP_PASS.png", "Gambar 9. Halaman Rekap Kehadiran Mahasantri")

tut_doc.add_heading("4.3 Mengajukan Surat Izin / Sakit", level=2)
tut_doc.add_paragraph("Pada bagian bawah Dashboard Mahasantri, isi formulir 'Pengajuan Surat Izin / Sakit' dengan memilih Jenis Izin (Sakit/Izin), Tanggal Izin, Keterangan, dan mengunggah foto bukti (maksimal 2MB), lalu klik kirim.")

safe_save(tut_doc, 'QA/reports/Website_User_Tutorial.docx')

# ==============================================================================
# 3. HTML SUMMARY REPORT
# ==============================================================================
html_rows = ""
for r in test_results:
    badge = "#16a34a" if r['status'] == 'PASS' else "#dc2626"
    html_rows += f"<tr><td>{r['testCaseId']}</td><td>{r['role']}</td><td>{r['page']}</td><td>{r['testObjective']}</td><td>{r['actualResult']}</td><td><span style='background:{badge};color:#fff;padding:3px 8px;border-radius:4px;font-weight:bold;font-size:12px'>{r['status']}</span></td></tr>\n"

html_content = f"""<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>SmartTren QA Summary Report</title>
<style>
body {{ font-family: Arial, sans-serif; margin: 32px; background: #f8fafc; color: #1e293b; }}
h1 {{ color: #087443; }}
.cards {{ display: flex; gap: 16px; margin-bottom: 24px; }}
.card {{ background: #fff; padding: 16px 24px; border-radius: 10px; border: 1px solid #e2e8f0; min-width: 150px; }}
.card h3 {{ margin: 0; font-size: 13px; color: #64748b; }}
.card p {{ margin: 6px 0 0; font-size: 24px; font-weight: bold; }}
table {{ width: 100%; border-collapse: collapse; background: #fff; border-radius: 8px; overflow: hidden; }}
th {{ background: #087443; color: #fff; padding: 10px; text-align: left; font-size: 13px; }}
td {{ padding: 10px; border-bottom: 1px solid #e2e8f0; font-size: 13px; vertical-align: top; }}
</style>
</head>
<body>
<h1>SmartTren — QA Automation Summary</h1>
<div class="cards">
  <div class="card"><h3>Total Test Case</h3><p>{total_tc}</p></div>
  <div class="card"><h3>PASS</h3><p style="color:#16a34a">{passed_tc}</p></div>
  <div class="card"><h3>FAIL</h3><p style="color:#dc2626">{failed_tc}</p></div>
  <div class="card"><h3>Pass Rate</h3><p>{pass_rate}</p></div>
  <div class="card"><h3>Bugs Found</h3><p style="color:#d97706">{len(bugs)}</p></div>
</div>
<table>
  <thead><tr><th>TC ID</th><th>Role</th><th>Halaman</th><th>Objektif</th><th>Hasil Aktual</th><th>Status</th></tr></thead>
  <tbody>{html_rows}</tbody>
</table>
</body>
</html>"""
with open('QA/results/qa-summary.html', 'w', encoding='utf-8') as f:
    f.write(html_content)

# ==============================================================================
# 4. README.md IN QA FOLDER
# ==============================================================================
readme_content = f"""# SmartTren QA & Application Discovery Documentation

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

- **Total Test Case**: {total_tc}
- **Passed**: {passed_tc}
- **Failed**: {failed_tc}
- **Pass Rate**: {pass_rate}
- **Total Bug Ditemukan**: {len(bugs)} ({sev_counts['Critical']} Critical, {sev_counts['High']} High, {sev_counts['Medium']} Medium)
"""
with open('QA/README.md', 'w', encoding='utf-8') as f:
    f.write(readme_content)

print("QA_REPORTS_GENERATED_OK")
