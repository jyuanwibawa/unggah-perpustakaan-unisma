function switchRole(role) {
    const tabMhs = document.getElementById('tab-mahasiswa');
    const tabDosen = document.getElementById('tab-dosen');
    const labelId = document.getElementById('label-identifier');
    const exampleId = document.getElementById('example-identifier');
    const inputId = document.getElementById('identifier');

    if (!labelId || !exampleId || !inputId) return;

    if (role === 'mahasiswa') {
        if (tabMhs) tabMhs.className = 'flex-1 py-2.5 px-4 text-center rounded-lg font-label-md text-sm font-semibold transition-all duration-200 bg-primary text-on-primary shadow-sm flex items-center justify-center gap-2';
        if (tabDosen) tabDosen.className = 'flex-1 py-2.5 px-4 text-center rounded-lg font-label-md text-sm font-semibold transition-all duration-200 text-on-surface-variant hover:text-on-surface flex items-center justify-center gap-2';
        labelId.textContent = 'Nomor Anggota / NIM / Email';
        exampleId.textContent = 'Contoh: 2108103019';
        inputId.placeholder = 'Nomor kartu atau email institusi';
    } else {
        if (tabDosen) tabDosen.className = 'flex-1 py-2.5 px-4 text-center rounded-lg font-label-md text-sm font-semibold transition-all duration-200 bg-primary text-on-primary shadow-sm flex items-center justify-center gap-2';
        if (tabMhs) tabMhs.className = 'flex-1 py-2.5 px-4 text-center rounded-lg font-label-md text-sm font-semibold transition-all duration-200 text-on-surface-variant hover:text-on-surface flex items-center justify-center gap-2';
        labelId.textContent = 'NIDN / NIP / Surel Akademik';
        exampleId.textContent = 'Contoh: 19820412...';
        inputId.placeholder = 'NIDN atau email resmi staf pengajar';
    }
}

function togglePasswordVisibility() {
    const pwd = document.getElementById('password');
    const icon = document.getElementById('eye-icon');
    if (!pwd || !icon) return;
    if (pwd.type === 'password') {
        pwd.type = 'text';
        icon.textContent = 'visibility_off';
    } else {
        pwd.type = 'password';
        icon.textContent = 'visibility';
    }
}

function simulateAuth() {
    const btn = document.getElementById('submit-btn');
    const text = document.getElementById('submit-text');
    if (!btn || !text) return;
    const originalText = text.textContent;
    btn.disabled = true;
    text.textContent = 'Memverifikasi Akses...';
    btn.classList.add('opacity-80');

    setTimeout(() => {
        text.textContent = 'Akses Diberikan. Membuka...';
        btn.classList.remove('bg-primary');
        btn.classList.add('bg-secondary');
        setTimeout(() => {
            text.textContent = originalText;
            btn.disabled = false;
            btn.classList.remove('opacity-80', 'bg-secondary');
            btn.classList.add('bg-primary');
        }, 1500);
    }, 1200);
}
