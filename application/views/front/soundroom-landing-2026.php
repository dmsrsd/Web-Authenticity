<style>
    /* Styling Premium */
    .hero-section {
        background: #f8f9fa;
        padding: 80px 0;
        border-bottom: 1px solid #eee;
    }
    .hero-banner {
        max-width: 100%;
        height: auto;
        border-radius: 12px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        margin-bottom: 20px;
    }
    .band-card {
        background: #fff;
        border: 1px solid #eef2f6;
        border-radius: 16px;
        margin-bottom: 30px;
        overflow: hidden;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        box-shadow: 0 4px 6px rgba(0,0,0,0.05);
    }
    .band-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.1);
        border-color: #007bff;
    }
    .band-img {
        width: 100%;
        height: 220px;
        object-fit: cover;
    }
    .band-body {
        padding: 20px;
    }
    .band-title {
        font-size: 1.25rem;
        margin: 0 0 10px 0;
        font-weight: 700;
        color: #333;
    }
    .label-genre {
        background: #e9ecef;
        color: #495057;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
        display: inline-block;
    }
</style>

<!-- Banner Hero Section (Logic Otomatis) -->
<div class="hero-section text-center">
    <div class="container">
        <?php
            // Logic: Cek apakah file banner 2026 sudah ada di folder server
            $banner_path = 'assets/front/img/soundroom/banner-2026.png';
            $default_banner = 'https://plus.unsplash.com/premium_photo-1682855223699-edb85ffa57b3?q=80&w=1200';
            $banner_url = file_exists(FCPATH . $banner_path) ? base_url($banner_path) : $default_banner;
        ?>
        <img src="<?= $banner_url; ?>" class="hero-banner" alt="Authenticity Soundroom 2026">
        
        <h1 style="font-weight: 800; margin-bottom: 15px;">Authenticity Soundroom 2026</h1>
        <p style="color: #666; font-size: 1.1rem;">Mau band lo manggung di Authenticity Soundroom 2026?</br> Kirim karya lagu terbaik lo yang akan dikurasi tim Authenticity. Mau apapun genre lo, lo punya kesempatan beraksi di panggung festival musik terbesar tahun ini!</p>
        <a href="<?= base_url('profile/soundroom2026') ?>" class="btn btn-primary btn-lg" style="margin-top: 20px; border-radius: 50px; padding: 12px 30px;">
            Ikutan Sekarang !
        </a>
    </div>
</div>

<!-- Grid List Band -->
<div class="container" style="padding: 60px 0;">
    <h3 style="margin-bottom: 40px; font-weight: 800; text-align: center;">2026 Participant List</h3>
    
    <div class="row">
        <?php if (!empty($bands)): ?>
            <?php foreach ($bands as $b): ?>
                <div class="col-md-3 col-sm-6">
                    <div class="band-card">
                        <?php 
                            $raw_image = $b['image'] ?? '';
                            $folder_path = 'uploads/soundroom/';
                            $img_src = !empty($raw_image) ? base_url($folder_path . urlencode($raw_image)) : 'https://plus.unsplash.com/premium_photo-1682855223699-edb85ffa57b3?q=80&w=1170&auto=format&fit=crop';
                        ?>
                        <img src="<?= $img_src; ?>" 
                             onerror="this.src='https://plus.unsplash.com/premium_photo-1682855223699-edb85ffa57b3?q=80&w=1170&auto=format&fit=crop';"
                             class="band-img" 
                             alt="<?= htmlspecialchars($b['judul'] ?? 'Band Image'); ?>">
                        
                        <div class="band-body">
                            <h4 class="band-title">
                                <?= htmlspecialchars($b['judul'] ?? 'Untitled Band'); ?>
                            </h4>
                            <span class="label-genre">
                                <?= htmlspecialchars($b['gendre'] ?? 'General'); ?>
                            </span>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-md-12 text-center" style="padding: 50px;">
                <p>Belum ada band yang terdaftar untuk Soundroom 2026.</p>
            </div>
        <?php endif; ?>
    </div>

    <!-- Pagination -->
    <div class="text-center" style="margin-top: 30px;">
        <nav>
            <?php echo $links ?? ''; ?>
        </nav>
    </div>
</div>