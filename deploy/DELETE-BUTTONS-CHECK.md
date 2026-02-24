# Pemeriksaan Tombol Delete – Semua Menu CMS

## Ringkasan
- **Yang sudah diperbaiki:** Event (list event) – method `deletesoft()` tidak ada di controller Event, sekarang sudah ditambah.
- **Lainnya:** Semua tombol delete mengarah ke handler yang ada (Logic atau Event).

## Pola URL Delete

| Pola URL | Controller | Method | Jenis |
|----------|------------|--------|--------|
| `cms/logic/delete/{table}/{id}` | cms/Logic | `delete($table, $id)` | Hard delete (hapus row + unlink file untuk beberapa tabel) |
| `cms/logic/deletesoft/{table}/{id}` | cms/Logic | `deletesoft($table, $id)` | Soft delete (set status = -1) |
| `cms/event/deletesoft/{id}` | cms/Event | `deletesoft($id)` | Soft delete (set status = 2) – **sudah diperbaiki** |
| `cms/event/hangoutdeletesoft/{id}` | cms/Event | `hangoutdeletesoft($id)` | Soft delete outlet_hangout |

## Daftar Menu / View dan URL Delete-nya

| Menu / View | URL Delete | Status |
|-------------|------------|--------|
| Event (list) | cms/event/deletesoft/{id} | ✅ Diperbaiki (method ditambah) |
| Hangout (list) | cms/event/hangoutdeletesoft/{id} | ✅ Ada |
| Artikel | cms/logic/delete/artikel/{id} | ✅ Ada |
| Write (artikel) | Tombol delete di-comment | - |
| Video | cms/logic/delete/video/{id} | ✅ Ada |
| User | cms/logic/delete/user/{id} | ✅ Ada |
| User SP | cms/logic/deletesoft/usersp/{id} | ✅ Ada |
| Ticket | cms/logic/delete/ticket/{id} | ✅ Ada |
| Store | cms/logic/delete/store/{id} | ✅ Ada |
| Store Product | cms/logic/delete/storeproduct/{id} | ✅ Ada |
| Soundroom (2019, 2023, 2024, 2025) | cms/logic/delete/soundroom*/{id} | ✅ Ada |
| Slide (slide, slidepodcast, slideiag, slidestore, slidedistrictcampaign) | cms/logic/delete/slide*/{id} | ✅ Ada |
| Section | cms/logic/deletesoft/web_section/{id} | ✅ Ada |
| Redeem Point | cms/logic/deletesoft/redeempoint/{id} | ✅ Ada |
| Poster Challenge | cms/logic/delete/posterchallenge/{id} | ✅ Ada |
| Podcast | cms/logic/deletesoft/podcast/{id} | ✅ Ada |
| New Campaign | cms/logic/delete/newcampaign/{id} | ✅ Ada |
| Darbotz / Merch Woro | cms/logic/delete/darbotz/{id} | ✅ Ada |
| Kontributor | cms/logic/delete/kontributor/{id} | ✅ Ada |
| Kategori | cms/logic/delete/kategori/{id} | ✅ Ada |
| Galeri | cms/logic/delete/galeri/{id} | ✅ Ada |
| EO | cms/logic/deletesoft/eo/{id} | ✅ Ada |
| District Campaign | cms/logic/deletesoft/district_campaign/{id} | ✅ Ada |
| Design Competition | cms/logic/delete/designcompetition/{id} | ✅ Ada |
| Tracking (point/redeem) | JavaScript .hapus-point / .hapus-redeem | AJAX (cek di dashboard/tracking) |

## Catatan
- **Soft delete:** Data tetap di tabel, hanya kolom `status` diubah (biasanya -1 atau 2).
- **Hard delete:** Row dihapus dari tabel; untuk beberapa tabel file (gambar/sound) ikut di-unlink di `logic->delete()`.
