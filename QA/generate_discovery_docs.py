import os
import json
from docx import Document
from docx.shared import Inches, Pt, Cm, RGBColor
from docx.enum.text import WD_ALIGN_PARAGRAPH
from docx.enum.table import WD_TABLE_ALIGNMENT
from docx.oxml import OxmlElement, parse_xml
from docx.oxml.ns import nsdecls, qn
import openpyxl
from openpyxl.styles import Font, PatternFill, Alignment, Border, Side
from openpyxl.utils import get_column_letter

os.makedirs('QA/discovery', exist_ok=True)

# ==============================================================================
# HELPER FUNCTIONS FOR DOCX
# ==============================================================================
def set_a4_margins(doc):
    for section in doc.sections:
        section.page_width = Cm(21.0)
        section.page_height = Cm(29.7)
        section.top_margin = Cm(2.2)
        section.bottom_margin = Cm(2.2)
        section.left_margin = Cm(2.2)
        section.right_margin = Cm(2.2)

def add_header_footer(doc, header_text, footer_text):
    section = doc.sections[0]
    header = section.header
    hp = header.paragraphs[0]
    hp.alignment = WD_ALIGN_PARAGRAPH.RIGHT
    hrun = hp.add_run(header_text)
    hrun.font.name = 'Arial'
    hrun.font.size = Pt(8.5)
    hrun.font.color.rgb = RGBColor(100, 116, 139)

    footer = section.footer
    fp = footer.paragraphs[0]
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

def add_styled_table(doc, headers, rows, col_widths=None):
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
        run.font.size = Pt(9.5)
        run.font.color.rgb = RGBColor(255, 255, 255)
        if col_widths:
            hdr_cells[i].width = Cm(col_widths[i])

    for r_idx, row_data in enumerate(rows):
        row_cells = table.rows[r_idx + 1].cells
        bg = "F8FAFC" if r_idx % 2 == 1 else "FFFFFF"
        for c_idx, val in enumerate(row_data):
            set_cell_bg(row_cells[c_idx], bg)
            p = row_cells[c_idx].paragraphs[0]
            p.paragraph_format.space_before = Pt(3)
            p.paragraph_format.space_after = Pt(3)
            run = p.add_run(str(val))
            run.font.name = 'Arial'
            run.font.size = Pt(9)
            run.font.color.rgb = RGBColor(30, 41, 59)
            if col_widths:
                row_cells[c_idx].width = Cm(col_widths[c_idx])
    doc.add_paragraph()
    return table

def style_base_doc(doc):
    style = doc.styles['Normal']
    style.font.name = 'Arial'
    style.font.size = Pt(10.5)
    style.font.color.rgb = RGBColor(30, 41, 59)
    style.paragraph_format.line_spacing = 1.15
    style.paragraph_format.space_after = Pt(6)

    for level, size in [(1, 15), (2, 12.5), (3, 11)]:
        h = doc.styles[f'Heading {level}']
        h.font.name = 'Arial'
        h.font.size = Pt(size)
        h.font.bold = True
        h.font.color.rgb = RGBColor(8, 116, 67) if level == 1 else RGBColor(15, 23, 42)
        h.paragraph_format.space_before = Pt(12 if level == 1 else 8)
        h.paragraph_format.space_after = Pt(4)

# ==============================================================================
# 1. GENERATE APPLICATION DISCOVERY REPORT DOCX
# ==============================================================================
doc = Document()
set_a4_margins(doc)
style_base_doc(doc)
add_header_footer(doc, "SmartTren — Application Discovery & System Analysis", "SmartTren QA Documentation")

# Cover
p_tag = doc.add_paragraph()
p_tag.paragraph_format.space_before = Pt(40)
r_tag = p_tag.add_run("DOKUMEN ANALISIS SISTEM & APPLICATION DISCOVERY")
r_tag.bold = True
r_tag.font.size = Pt(11)
r_tag.font.color.rgb = RGBColor(8, 116, 67)

p_title = doc.add_paragraph()
r_title = p_title.add_run("Aplikasi SmartTren\n(Sistem Informasi & Presensi Pesantren Mahasiswa)")
r_title.bold = True
r_title.font.size = Pt(22)
r_title.font.color.rgb = RGBColor(15, 23, 42)

p_sub = doc.add_paragraph()
r_sub = p_sub.add_run("Pemetaan Arsitektur Aktual, Modul, Role & Hak Akses, Fitur, Struktur Data, Aturan Bisnis, dan Kebutuhan QA sebagai Baseline Pengujian Otomatis.")
r_sub.font.size = Pt(11)
r_sub.font.color.rgb = RGBColor(71, 85, 105)

add_styled_table(doc, ["Atribut Dokumen", "Keterangan"], [
    ["Nama Proyek", "SmartTren (SmartTren_Kel4)"],
    ["Jenis Aplikasi", "Custom Web Application — Sistem Presensi & Manajemen Kegiatan Pesantren Mahasiswa"],
    ["Teknologi Utama", "Laravel 12 (PHP), Blade Templates, Tailwind CSS, Alpine.js, Vite, MySQL"],
    ["Metode Discovery", "Analisis Source Code (Routes, Controllers, Models, Migrations, Views) & Eksplorasi Runtime"],
    ["Tanggal Dokumen", "25 November 2026"],
    ["Status", "Final Baseline untuk QA Automation"]
], col_widths=[5.5, 11.1])

doc.add_page_break()

# Bab 1
doc.add_heading("1. Identifikasi & Profil Proyek (Phase 0)", level=1)
doc.add_paragraph(
    "SmartTren adalah aplikasi web berbasis Laravel yang dirancang untuk mengelola kegiatan pesantren mahasiswa, "
    "data mahasantri beserta QR Code unik, sesi presensi per kegiatan, pencatatan kehadiran (hadir, izin, sakit, alpa), "
    "serta pengajuan surat izin/sakit secara daring."
)
add_styled_table(doc, ["Komponen Profil", "Hasil Discovery Aktual", "Status Bukti"], [
    ["Target Pengguna", "3 Role: Admin, Pengurus, Mahasantri (+ Public/Guest pada halaman awal & auth)", "Verified (Database & Routes)"],
    ["Autentikasi", "Laravel Breeze (Session-based Web Auth: Login, Register, Forgot/Reset Password)", "Verified (routes/auth.php)"],
    ["Otorisasi", "Custom Middleware role:<role> pada kolom users.role (enum: admin, pengurus, mahasantri). Paket Spatie Permission terpasang tetapi tidak aktif digunakan pada User model.", "Verified (User.php, web.php)"],
    ["Database", "MySQL (smarttren) dengan 10 file migrasi aktif", "Verified (migrate:status)"],
    ["Proses Bisnis Inti", "1) Admin kelola master user, mahasantri (auto-generate QR), dan kegiatan; 2) Pengurus buka sesi presensi & rekap; 3) Mahasantri tampilkan QR, cek riwayat/rekap, dan ajukan surat izin.", "Verified (Controllers & Views)"]
], col_widths=[4.5, 8.6, 3.5])

# Bab 2
doc.add_heading("2. Struktur Modul & Inventaris Halaman (Phase 1)", level=1)
doc.add_paragraph(
    "Berdasarkan penelusuran routes/web.php, routes/auth.php, dan resources/views/, berikut daftar halaman aktual yang ditemukan:"
)
add_styled_table(doc, ["Page ID", "Modul", "Nama Halaman & Route", "Role Akses", "Status Discovery"], [
    ["PG-001", "MOD-PUB", "Welcome Page (/)", "Public", "Verified"],
    ["PG-002", "MOD-AUTH", "Login (/login), Register (/register), Forgot Password", "Public / Guest", "Verified"],
    ["PG-003", "MOD-AUTH", "Redirect Dashboard (/dashboard)", "Authenticated", "Verified"],
    ["PG-004", "MOD-ADM", "Dashboard Admin (/admin/dashboard)", "admin", "Verified"],
    ["PG-005", "MOD-ADM", "Manajemen User (/admin/users, create, edit)", "admin", "Verified"],
    ["PG-006", "MOD-ADM", "Manajemen Mahasantri & QR (/admin/mahasantri, create, show, edit, qr)", "admin", "Verified"],
    ["PG-007", "MOD-ADM", "Manajemen Kegiatan (/admin/kegiatan, create, show, edit)", "admin", "Verified"],
    ["PG-008", "MOD-PNG", "Dashboard Pengurus (/pengurus/dashboard)", "pengurus", "Verified"],
    ["PG-009", "MOD-PNG", "Manajemen Sesi Presensi (/pengurus/sesi-presensi, create, edit)", "pengurus", "Verified"],
    ["PG-010", "MOD-PNG", "Rekap Sesi Presensi (/pengurus/presensi/{id}/rekap)", "pengurus", "Verified"],
    ["PG-011", "MOD-PNG", "Daftar Presensi, Scanner QR, Laporan Kegiatan (/pengurus/presensi, /pengurus/laporan-kegiatan, dll)", "pengurus", "Verified (Scanner QR masih terkendala variabel $sesiPresensi)"],
    ["PG-012", "MOD-MHS", "Dashboard Mahasantri (/mahasantri/dashboard)", "mahasantri", "Verified"],
    ["PG-013", "MOD-MHS", "Presensi QR Mahasantri (/mahasantri/presensi)", "mahasantri", "Verified"],
    ["PG-014", "MOD-MHS", "Riwayat & Rekap Presensi (/mahasantri/riwayat-presensi, /mahasantri/rekap-presensi)", "mahasantri", "Verified"],
    ["PG-015", "MOD-MHS", "Data Akun Mahasantri (/mahasantri/akun)", "mahasantri", "Verified"],
    ["PG-016", "MOD-AUTH", "Profil Akun Breeze (/profile)", "Authenticated", "Verified"]
], col_widths=[1.8, 2.2, 5.8, 3.3, 3.5])

# Bab 3
doc.add_heading("3. Analisis Pengguna, Role & Hak Akses (Phase 2)", level=1)
doc.add_paragraph(
    "Aplikasi menggunakan model Multi-Role Users dengan tiga role utama yang disimpan pada kolom users.role. "
    "Catatan: Meskipun RolePermissionSeeder.php (Spatie) ada di repository, model User tidak menggunakan trait HasRoles dan seluruh rute menggunakan middleware custom role:<nama_role>."
)
add_styled_table(doc, ["Role", "Tanggung Jawab Utama", "Modul yang Diizinkan", "Temuan Keamanan / Access Control"], [
    ["admin", "Mengelola akun pengguna, data master mahasantri (termasuk QR Code), dan data master kegiatan.", "MOD-ADM, Profile", "Terproteksi dengan baik oleh middleware ['auth', 'role:admin']."],
    ["pengurus", "Membuat dan mengelola sesi presensi kegiatan, merekap presensi per sesi, serta (direncanakan) melakukan scan QR dan mencetak laporan.", "MOD-PNG, Profile", "Terproteksi oleh ['auth', 'role:pengurus'], namun 10 rute mengarah ke PresensiController yang tidak eksis."],
    ["mahasantri", "Menampilkan QR Code pribadi, melihat riwayat & rekap kehadiran, mengajukan surat izin/sakit, dan memperbarui akun.", "MOD-MHS, Profile", "CRITICAL: Rute mahasantri didefinisikan ulang di luar middleware pada routes/web.php baris 378-441 sehingga dapat diakses tanpa autentikasi."]
], col_widths=[2.5, 5.2, 3.2, 5.7])

# Bab 4
doc.add_heading("4. Alur Bisnis & Ketergantungan Fitur (Phase 3 & 4)", level=1)
doc.add_paragraph("Alur proses bisnis utama pada aplikasi SmartTren:")
flows = [
    "1. Autentikasi & Routing Role: Pengguna login melalui /login, kemudian rute /dashboard mengarahkan ke dashboard masing-masing role (admin.dashboard, pengurus.dashboard, atau mahasantri.dashboard).",
    "2. Pengelolaan Master Data (Admin): Admin menambahkan Kegiatan (contoh: Sholat Subuh, Ngaji Kitab) dan Mahasantri. Saat Mahasantri dibuat, sistem otomatis membuat akun User ber-role mahasantri dan men-generate kode QR unik dengan format MHS-<10 karakter acak> dalam transaksi database.",
    "3. Pengelolaan Sesi Presensi (Pengurus): Pengurus membuat Sesi Presensi berdasarkan Kegiatan yang berstatus 'aktif', menentukan tanggal, jam_mulai, jam_selesai (wajib setelah jam_mulai), dan status ('aktif', 'selesai', 'dibatalkan').",
    "4. Pengajuan Surat Izin (Mahasantri): Mahasantri mengisi form pengajuan izin (jenis_izin: Sakit/Izin, tanggal, keterangan, dan upload bukti_foto max 2MB) melalui Dashboard Mahasantri yang disimpan ke tabel surat_izins.",
    "5. Rekap Kehadiran (Mahasantri): Mahasantri melihat gabungan data presensi fisik dan surat izin dengan filter kegiatan, rentang tanggal, dan status."
]
for f in flows:
    doc.add_paragraph(f, style='List Bullet')

doc.add_heading("Aturan Bisnis & Validasi yang Ditemukan", level=2)
add_styled_table(doc, ["ID Aturan", "Modul", "Aturan Bisnis / Validasi Aktual", "Sumber Bukti"], [
    ["BR-001", "Manajemen User", "Admin tidak dapat menghapus akun miliknya sendiri yang sedang aktif login.", "UserController::destroy"],
    ["BR-002", "Manajemen Mahasantri", "NIM harus unik, email unik di tabel users, jenis kelamin hanya 'L' atau 'P', password minimal 8 karakter, QR code unik berawalan 'MHS-'.", "MahasantriController::store"],
    ["BR-003", "Manajemen Kegiatan", "Nama kegiatan maksimal 100 karakter dan wajib unik; status hanya 'aktif' atau 'nonaktif'.", "KegiatanController::store"],
    ["BR-004", "Sesi Presensi", "Hanya kegiatan berstatus 'aktif' yang muncul di form buat sesi; jam_selesai wajib lebih besar dari jam_mulai.", "SesiPresensiController::create & store"],
    ["BR-005", "Surat Izin", "Bukti foto wajib berupa gambar maksimal 2048 KB; jenis izin hanya 'Sakit' atau 'Izin'.", "SuratIzinController::store"]
], col_widths=[2.2, 3.2, 7.7, 3.5])

# Bab 5
doc.add_heading("5. Struktur Data & Relasi Database (Phase 5)", level=1)
add_styled_table(doc, ["Tabel", "Kolom Utama", "Relasi / Constraint"], [
    ["users", "id, name, email (UK), role (enum: admin, pengurus, mahasantri), password", "1:1 ke mahasantri; 1:N ke surat_izins"],
    ["mahasantri", "id, user_id (FK, UK), nim (UK), nama, jenis_kelamin (L/P), kamar, no_hp, qr_code (UK), status", "Milik users (cascade delete); 1:N ke presensi"],
    ["kegiatan", "id, nama_kegiatan, deskripsi, status (aktif/nonaktif)", "1:N ke sesi_presensi"],
    ["sesi_presensi", "id, kegiatan_id (FK), tanggal, jam_mulai, jam_selesai, status (aktif/selesai/dibatalkan)", "Milik kegiatan; 1:N ke presensi"],
    ["presensi", "id, sesi_presensi_id (FK), mahasantri_id (FK), status (hadir/izin/sakit/alpa), keterangan, waktu_presensi", "Unique composite (sesi_presensi_id, mahasantri_id)"],
    ["surat_izins", "id, user_id (FK), jenis_izin (Sakit/Izin), tanggal, keterangan, bukti_foto, status (pending/disetujui/ditolak)", "Milik users (cascade delete)"]
], col_widths=[3.0, 8.2, 5.4])

# Bab 6
doc.add_heading("6. Keterbatasan Discovery & Handover ke QA Automation (Phase 6)", level=1)
doc.add_paragraph(
    "Hasil discovery ini menjadi acuan langsung untuk pengujian otomatis menggunakan Playwright. "
    "Keterbatasan yang dicatat selama discovery: (1) Tabel mahasantri berisi 0 baris pada database uji sehingga alur scan QR end-to-end belum dapat diuji penuh; "
    "(2) Terdapat 10 rute pengurus yang merujuk pada controller yang belum ada (App\\Http\\Controllers\\PresensiController); "
    "(3) View mahasantri.akun.index belum tersedia."
)

doc.save('QA/discovery/SmartTren_Application_Discovery_Report.docx')

# ==============================================================================
# 2. GENERATE FEATURE INVENTORY & QA REQUIREMENTS XLSX
# ==============================================================================
wb = openpyxl.Workbook()

# Sheet 1: Feature Inventory
ws1 = wb.active
ws1.title = "Feature Inventory"
headers1 = ["Feature ID", "Module ID", "Page Ref", "Feature Name", "Actor / Role", "Description", "Discovery Status", "Verification Status"]
rows1 = [
    ["FEAT-PUB-01", "MOD-PUB", "PG-001", "Halaman Landing / Welcome", "Public", "Menampilkan halaman awal aplikasi SmartTren.", "Discovered", "Verified"],
    ["FEAT-AUTH-01", "MOD-AUTH", "PG-002", "Login & Autentikasi", "All Users", "Masuk ke sistem menggunakan email dan password.", "Discovered", "Verified"],
    ["FEAT-AUTH-02", "MOD-AUTH", "PG-003", "Redirect Dashboard Berbasis Role", "Authenticated", "Mengarahkan user ke dashboard sesuai role.", "Discovered", "Verified (Bug pada Mahasantri)"],
    ["FEAT-AUTH-03", "MOD-AUTH", "All Protected", "Role Access Control Middleware", "Admin/Pengurus/Mahasantri", "Membatasi akses halaman sesuai role.", "Discovered", "Verified (Bug Duplikasi Route)"],
    ["FEAT-ADM-01", "MOD-ADM", "PG-004", "Dashboard Admin", "Admin", "Ringkasan dan menu navigasi admin.", "Discovered", "Verified"],
    ["FEAT-ADM-02", "MOD-ADM", "PG-005", "CRUD Manajemen User", "Admin", "Tambah, lihat, ubah, dan hapus akun pengguna.", "Discovered", "Verified"],
    ["FEAT-ADM-03", "MOD-ADM", "PG-006", "CRUD Mahasantri & Generate QR", "Admin", "Kelola data mahasantri, buat akun otomatis & QR Code unik.", "Discovered", "Verified"],
    ["FEAT-ADM-04", "MOD-ADM", "PG-007", "CRUD Master Kegiatan", "Admin", "Tambah, lihat, ubah, hapus daftar kegiatan pesantren.", "Discovered", "Verified"],
    ["FEAT-PNG-01", "MOD-PNG", "PG-008", "Dashboard Pengurus", "Pengurus", "Halaman utama pengurus pesantren.", "Discovered", "Verified"],
    ["FEAT-PNG-02", "MOD-PNG", "PG-009", "CRUD Sesi Presensi", "Pengurus", "Membuat, mengubah, dan menghapus jadwal sesi presensi.", "Discovered", "Verified"],
    ["FEAT-PNG-03", "MOD-PNG", "PG-010", "Rekap Presensi per Sesi", "Pengurus", "Melihat daftar kehadiran mahasantri dalam satu sesi.", "Discovered", "Verified"],
    ["FEAT-PNG-04", "MOD-PNG", "PG-011", "Daftar Presensi & Scanner QR", "Pengurus", "Halaman daftar presensi, scanner QR, update status, generate alpa.", "Discovered", "Partially Verified (Scanner terkendala $sesiPresensi)"],
    ["FEAT-PNG-05", "MOD-PNG", "PG-011", "Laporan Kegiatan & Cetak PDF", "Pengurus", "Laporan rekap kegiatan dan ekspor PDF.", "Discovered", "Verified"],
    ["FEAT-MHS-01", "MOD-MHS", "PG-012", "Dashboard Mahasantri", "Mahasantri", "Halaman utama mahasantri dengan sidebar & form izin.", "Discovered", "Verified"],
    ["FEAT-MHS-02", "MOD-MHS", "PG-013", "Tampil QR Code Presensi", "Mahasantri", "Menampilkan QR Code pribadi untuk di-scan pengurus.", "Discovered", "Verified"],
    ["FEAT-MHS-03", "MOD-MHS", "PG-014", "Riwayat Presensi Mahasantri", "Mahasantri", "Menampilkan daftar riwayat presensi pribadi.", "Discovered", "Verified (Bug Query FK)"],
    ["FEAT-MHS-04", "MOD-MHS", "PG-014", "Rekap Kehadiran & Filter", "Mahasantri", "Ringkasan Hadir/Izin/Sakit/Alpa dengan filter tanggal & kegiatan.", "Discovered", "Verified (Bug Case-Sensitive)"],
    ["FEAT-MHS-05", "MOD-MHS", "PG-012", "Pengajuan Surat Izin / Sakit", "Mahasantri", "Form pengajuan izin dengan upload bukti foto.", "Discovered", "Partially Verified"],
    ["FEAT-MHS-06", "MOD-MHS", "PG-015", "Data Akun Mahasantri", "Mahasantri", "Ubah nama, email, dan password akun mahasantri.", "Discovered", "Verified"],
    ["FEAT-UI-01", "MOD-UI", "PG-012", "Responsive Layout", "All", "Tampilan adaptif pada desktop dan mobile.", "Discovered", "Verified"]
]

# Sheet 2: QA Requirements
ws2 = wb.create_sheet("QA Requirements")
headers2 = ["Requirement ID", "Feature ID", "Requirement Description", "Priority", "Risk Reason", "Test Types"]
rows2 = [
    ["REQ-PUB-01", "FEAT-PUB-01", "Halaman utama (/) harus dapat diakses dengan HTTP 200 tanpa error.", "Medium", "Pintu masuk pertama aplikasi.", "Functional, UI"],
    ["REQ-AUTH-01", "FEAT-AUTH-01", "Pengguna dengan kredensial valid dapat login dan diarahkan ke dashboard sesuai role.", "Critical", "Akses inti seluruh sistem.", "Functional"],
    ["REQ-AUTH-02", "FEAT-AUTH-01", "Sistem harus menolak kredensial tidak valid dan menampilkan pesan error.", "High", "Keamanan autentikasi.", "Negative"],
    ["REQ-SEC-01", "FEAT-AUTH-03", "Guest tidak boleh mengakses /admin/dashboard dan harus diarahkan ke /login.", "Critical", "Integritas data master admin.", "Security, Authorization"],
    ["REQ-SEC-02", "FEAT-AUTH-03", "Guest tidak boleh mengakses /mahasantri/dashboard dan harus diarahkan ke /login.", "Critical", "Kebocoran akses & error null user.", "Security, Authorization"],
    ["REQ-SEC-03", "FEAT-AUTH-03", "Admin tidak boleh mengakses route khusus Pengurus (HTTP 403).", "High", "Pemisahan kewenangan antar role.", "Security, Authorization"],
    ["REQ-SEC-04", "FEAT-AUTH-03", "Pengurus tidak boleh mengakses route khusus Admin (HTTP 403).", "High", "Pemisahan kewenangan antar role.", "Security, Authorization"],
    ["REQ-ADM-01", "FEAT-ADM-01", "Dashboard Admin tampil lengkap untuk role admin.", "High", "Pusat navigasi admin.", "Functional"],
    ["REQ-ADM-02", "FEAT-ADM-02", "Halaman daftar user (/admin/users) menampilkan daftar pengguna.", "High", "Pengelolaan akses pengguna.", "Functional"],
    ["REQ-ADM-03", "FEAT-ADM-02", "Form tambah user (/admin/users/create) tersedia dan dapat dibuka.", "Medium", "Operasional pembuatan akun.", "Functional"],
    ["REQ-ADM-04", "FEAT-ADM-03", "Halaman data mahasantri (/admin/mahasantri) tampil dengan benar.", "High", "Data inti peserta pesantren.", "Functional"],
    ["REQ-ADM-05", "FEAT-ADM-03", "Form tambah mahasantri (/admin/mahasantri/create) tersedia dan dapat dibuka.", "Medium", "Pendaftaran mahasantri & QR.", "Functional"],
    ["REQ-ADM-06", "FEAT-ADM-04", "Halaman data kegiatan (/admin/kegiatan) menampilkan data master kegiatan.", "High", "Basis sesi presensi.", "Functional"],
    ["REQ-PNG-01", "FEAT-PNG-01", "Dashboard Pengurus tampil untuk role pengurus.", "High", "Pusat operasional pengurus.", "Functional"],
    ["REQ-PNG-02", "FEAT-PNG-02", "Daftar sesi presensi (/pengurus/sesi-presensi) tampil untuk pengurus.", "High", "Manajemen jadwal presensi.", "Functional"],
    ["REQ-PNG-03", "FEAT-PNG-02", "Form buat sesi presensi (/pengurus/sesi-presensi/create) dapat dibuka.", "High", "Pembuatan sesi baru.", "Functional"],
    ["REQ-PNG-04", "FEAT-PNG-03", "Halaman rekap satu sesi (/pengurus/presensi/1/rekap) dapat dibuka.", "High", "Monitoring kehadiran sesi.", "Functional"],
    ["REQ-PNG-05", "FEAT-PNG-04", "Halaman daftar presensi pengurus (/pengurus/presensi) harus dapat diakses.", "Critical", "Operasional presensi & scan QR.", "Functional"],
    ["REQ-PNG-06", "FEAT-PNG-05", "Halaman laporan kegiatan (/pengurus/laporan-kegiatan) harus dapat diakses.", "High", "Pelaporan kegiatan pesantren.", "Functional"],
    ["REQ-MHS-01", "FEAT-MHS-01", "Dashboard Mahasantri tampil beserta sidebar dan form izin.", "High", "Pusat aktivitas mahasantri.", "Functional"],
    ["REQ-MHS-02", "FEAT-MHS-02", "Halaman QR Code presensi (/mahasantri/presensi) dapat dibuka.", "High", "Media presensi mahasantri.", "Functional"],
    ["REQ-MHS-03", "FEAT-MHS-03", "Halaman riwayat presensi (/mahasantri/riwayat-presensi) dapat dibuka.", "Medium", "Transparansi kehadiran.", "Functional"],
    ["REQ-MHS-04", "FEAT-MHS-04", "Halaman rekap kehadiran (/mahasantri/rekap-presensi) tampil dengan filter.", "Medium", "Ringkasan kehadiran pribadi.", "Functional"],
    ["REQ-MHS-06", "FEAT-MHS-06", "Halaman Data Akun (/mahasantri/akun) dapat diakses dari sidebar.", "High", "Pengelolaan akun mandiri.", "Functional"],
    ["REQ-UI-01", "FEAT-UI-01", "Layout Dashboard Mahasantri responsif tanpa horizontal overflow di mobile (390x844).", "Medium", "Kenyamanan pengguna mobile.", "UI, Responsive"]
]

def format_sheet(ws, headers, rows):
    header_fill = PatternFill(start_color="087443", end_color="087443", fill_type="solid")
    header_font = Font(name="Arial", size=10, bold=True, color="FFFFFF")
    cell_font = Font(name="Arial", size=9.5, color="1E293B")
    thin_border = Border(
        left=Side(style='thin', color='CBD5E1'),
        right=Side(style='thin', color='CBD5E1'),
        top=Side(style='thin', color='CBD5E1'),
        bottom=Side(style='thin', color='CBD5E1')
    )
    ws.append(headers)
    for col_idx in range(1, len(headers) + 1):
        c = ws.cell(row=1, column=col_idx)
        c.fill = header_fill
        c.font = header_font
        c.alignment = Alignment(horizontal="center", vertical="center", wrap_text=True)
        c.border = thin_border

    for r_idx, row in enumerate(rows, start=2):
        ws.append(row)
        bg = PatternFill(start_color="F8FAFC", end_color="F8FAFC", fill_type="solid") if r_idx % 2 == 1 else PatternFill(start_color="FFFFFF", end_color="FFFFFF", fill_type="solid")
        for col_idx in range(1, len(headers) + 1):
            c = ws.cell(row=r_idx, column=col_idx)
            c.font = cell_font
            c.fill = bg
            c.alignment = Alignment(vertical="top", wrap_text=True)
            c.border = thin_border

    ws.freeze_panes = "A2"
    ws.auto_filter.ref = f"A1:{get_column_letter(len(headers))}{len(rows)+1}"
    for col_idx in range(1, len(headers) + 1):
        max_len = max([len(str(ws.cell(row=r, column=col_idx).value or "")) for r in range(1, len(rows)+2)])
        ws.column_dimensions[get_column_letter(col_idx)].width = min(max(max_len + 4, 14), 48)

format_sheet(ws1, headers1, rows1)
format_sheet(ws2, headers2, rows2)
wb.save('QA/discovery/SmartTren_Feature_and_QA_Requirements.xlsx')
print("DISCOVERY_DOCS_GENERATED_OK")
