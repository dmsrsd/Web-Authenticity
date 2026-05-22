<style>
    /* CSS untuk kartu band agar rapi */
    .band-card {
        background: #fff;
        border: 1px solid #ddd;
        border-radius: 8px;
        margin-bottom: 30px;
        overflow: hidden;
        transition: transform 0.3s ease;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    }
    .band-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 12px rgba(0,0,0,0.15);
    }
    .band-img {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }
    .band-body {
        padding: 15px;
        text-align: left;
    }
</style>

<!-- Komponen Utama -->
<div class="page-soundroom new-bs" style="padding: 100px 0;">
    <div class="container text-center">
        <h1>Welcome to Authenticity Soundroom 2026</h1>
        <p>Prepare your best tracks!</p>
        <a href="<?= base_url('profile/soundroom2026') ?>" class="btn btn-primary btn-lg">
            Register Band 2026
        </a>
    </div>
</div>

<!-- Komponen List Band (Grid) -->
<div class="container" style="padding: 50px 0;">
    <h3 style="margin-bottom: 30px;">Participant</h3>
    
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
                             class="band-img" 
                             alt="<?= htmlspecialchars($b['judul'] ?? 'Band Image'); ?>">
                        
                        <div class="band-body">
                            <h4 style="margin: 0 0 10px 0; font-weight: bold;">
                                <?= htmlspecialchars($b['judul'] ?? 'Untitled Band'); ?>
                            </h4>
                            <span class="label label-primary">
                                <?= htmlspecialchars($b['gendre'] ?? 'General'); ?>
                            </span>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-md-12 text-center">
                <p>Belum ada band yang terdaftar untuk Soundroom 2026.</p>
            </div>
        <?php endif; ?>
    </div>

    <!-- Pagination -->
    <div class="text-center">
        <nav>
            <?php echo $links ?? ''; ?>
        </nav>
    </div>
</div>